<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Firebase Cloud Messaging (FCM) HTTP v1 API Service untuk Portal Web SMAN 5 Morotai
 * Menggunakan kredensial Service Account dengan autentikasi native OpenSSL JWT (Zero Dependency).
 */
class FcmService
{
    protected static ?string $credentialsPath = null;

    /**
     * Path file kredensial Service Account
     */
    protected static function getCredentialsPath(): string
    {
        if (self::$credentialsPath === null) {
            self::$credentialsPath = storage_path('app/firebase-credentials.json');
        }
        return self::$credentialsPath;
    }

    /**
     * Dapatkan OAuth2 Access Token dari Google menggunakan JWT Assertion
     */
    public static function getAccessToken(): ?string
    {
        $path = self::getCredentialsPath();
        if (!file_exists($path)) {
            Log::warning('[FCM Portal] File kredensial tidak ditemukan: ' . $path);
            return null;
        }

        return Cache::remember('fcm_portal_oauth_token', 3000, function () use ($path) {
            try {
                $json = json_decode(file_get_contents($path), true);
                if (!$json || empty($json['client_email']) || empty($json['private_key'])) {
                    Log::error('[FCM Portal] File firebase-credentials.json tidak valid.');
                    return null;
                }

                $now = time();
                $header = self::base64UrlEncode(json_encode(['alg' => 'RS256', 'typ' => 'JWT']));
                $claim = self::base64UrlEncode(json_encode([
                    'iss'   => $json['client_email'],
                    'scope' => 'https://www.googleapis.com/auth/firebase.messaging',
                    'aud'   => 'https://oauth2.googleapis.com/token',
                    'exp'   => $now + 3600,
                    'iat'   => $now,
                ]));

                $signature = '';
                $success = openssl_sign("$header.$claim", $signature, $json['private_key'], OPENSSL_ALGO_SHA256);
                if (!$success) {
                    Log::error('[FCM Portal] Gagal menandatangani OpenSSL JWT assertion.');
                    return null;
                }

                $jwt = "$header.$claim." . self::base64UrlEncode($signature);

                $response = Http::asForm()->post('https://oauth2.googleapis.com/token', [
                    'grant_type' => 'urn:ietf:params:oauth:grant-type:jwt-bearer',
                    'assertion'  => $jwt,
                ]);

                if ($response->successful()) {
                    return $response->json('access_token');
                }

                Log::error('[FCM Portal] Gagal request token ke Google: ' . $response->body());
                return null;
            } catch (\Exception $e) {
                Log::error('[FCM Portal] Exception saat generate OAuth token: ' . $e->getMessage());
                return null;
            }
        });
    }

    /**
     * Kirim Notifikasi Push ke Topic FCM (misal: 'all_users')
     */
    public static function sendToTopic(string $topic, string $title, string $body, array $data = []): bool
    {
        $accessToken = self::getAccessToken();
        if (!$accessToken) {
            Log::warning('[FCM Portal] Skip kirim notifikasi karena Access Token null.');
            return false;
        }

        $path = self::getCredentialsPath();
        $projectId = 'moro5smart-cbt';
        if (file_exists($path)) {
            $json = json_decode(file_get_contents($path), true);
            $projectId = $json['project_id'] ?? $projectId;
        }

        // Pastikan semua value dalam array data adalah tipe string
        $stringData = [];
        foreach ($data as $k => $v) {
            $stringData[(string)$k] = (string)$v;
        }
        $stringData['title'] = (string)$title;
        $stringData['body']  = (string)$body;

        try {
            $url = "https://fcm.googleapis.com/v1/projects/{$projectId}/messages:send";

            $payload = [
                'message' => [
                    'topic' => $topic,
                    'notification' => [
                        'title' => $title,
                        'body'  => $body,
                    ],
                    'data' => $stringData,
                    'android' => [
                        'priority' => 'HIGH',
                        'notification' => [
                            'channel_id'            => 'moro5smart_high_importance_channel',
                            'sound'                 => 'default',
                            'notification_priority' => 'PRIORITY_HIGH',
                        ],
                    ],
                    'apns' => [
                        'payload' => [
                            'aps' => [
                                'sound' => 'default',
                                'badge' => 1,
                            ],
                        ],
                    ],
                ],
            ];

            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type'  => 'application/json',
            ])->post($url, $payload);

            if ($response->successful()) {
                Log::info("[FCM Portal] Notifikasi berhasil terkirim ke topic '$topic': $title");
                return true;
            }

            Log::error("[FCM Portal] Gagal kirim notifikasi: " . $response->body());
            return false;
        } catch (\Exception $e) {
            Log::error("[FCM Portal] Error kirim ke topic '$topic': " . $e->getMessage());
            return false;
        }
    }

    private static function base64UrlEncode(string $data): string
    {
        return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
    }
}
