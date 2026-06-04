<?php

namespace App\Mcp\Tools;

use Illuminate\Contracts\JsonSchema\JsonSchema;
use Laravel\Mcp\Request;
use Laravel\Mcp\Response;
use Laravel\Mcp\Server\Attributes\Description;
use Laravel\Mcp\Server\Tool;
use App\Models\PortalLink;

#[Description('Fetches the active portal links for SMA Negeri 5 Morotai (like SIMORO, LMS, Absensi, Web OSIS).')]
class GetPortalLinksTool extends Tool
{
    /**
     * Handle the tool request.
     */
    public function handle(Request $request): Response
    {
        $links = PortalLink::where('is_active', true)
            ->orderBy('sort_order')
            ->get(['name', 'url']);

        if ($links->isEmpty()) {
            return Response::text('No portal links available.');
        }

        $text = "Active Portal Links:\n";
        foreach ($links as $link) {
            $text .= "- {$link->name}: {$link->url}\n";
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
        return [];
    }
}
