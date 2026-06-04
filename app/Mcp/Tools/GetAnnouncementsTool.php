<?php

namespace App\Mcp\Tools;

use Illuminate\Contracts\JsonSchema\JsonSchema;
use Laravel\Mcp\Request;
use Laravel\Mcp\Response;
use Laravel\Mcp\Server\Attributes\Description;
use Laravel\Mcp\Server\Tool;
use App\Models\Announcement;

#[Description('Fetches the latest published announcements for SMA Negeri 5 Morotai.')]
class GetAnnouncementsTool extends Tool
{
    /**
     * Handle the tool request.
     */
    public function handle(Request $request): Response
    {
        $limit = $request->get('limit', 5);

        $announcements = Announcement::where('is_draft', false)
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now())
            ->latest('published_at')
            ->limit($limit)
            ->get(['title', 'excerpt', 'category', 'published_at']);

        if ($announcements->isEmpty()) {
            return Response::text('No announcements available at the moment.');
        }

        $text = "Latest Announcements:\n";
        foreach ($announcements as $announcement) {
            $text .= "- [{$announcement->category}] {$announcement->title} ({$announcement->published_at})\n";
            $text .= "  {$announcement->excerpt}\n";
        }

        return Response::text($text);
    }

    /**
     * Get the tool's input schema.
     *
     * @return array<string, \Illuminate\JsonSchema\Types\Type>
     */
    public function schema(JsonSchema $schema): array
    {
        return [
            'limit' => $schema->integer()
                ->description('The maximum number of announcements to return.')
                ->default(5),
        ];
    }
}
