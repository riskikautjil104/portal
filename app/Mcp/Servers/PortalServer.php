<?php

namespace App\Mcp\Servers;

use App\Mcp\Tools\GetAnnouncementsTool;
use App\Mcp\Tools\GetPortalLinksTool;
use App\Mcp\Tools\GetStudentMapTool;
use Laravel\Mcp\Server\Attributes\Instructions;
use Laravel\Mcp\Server\Attributes\Name;
use Laravel\Mcp\Server\Attributes\Version;
use Laravel\Mcp\Server;

#[Name('Portal Server')]
#[Version('1.0.0')]
#[Instructions('This server provides information about SMA Negeri 5 Morotai, including announcements, portal links, and student mapping.')]
class PortalServer extends Server
{
    /**
     * The tools registered with this MCP server.
     *
     * @var array<int, class-string<\Laravel\Mcp\Server\Tool>>
     */
    protected array $tools = [
        GetAnnouncementsTool::class,
        GetPortalLinksTool::class,
        GetStudentMapTool::class,
    ];

    /**
     * The resources registered with this MCP server.
     *
     * @var array<int, class-string<\Laravel\Mcp\Server\Resource>>
     */
    protected array $resources = [
        // Add resources if needed
    ];

    /**
     * The prompts registered with this MCP server.
     *
     * @var array<int, class-string<\Laravel\Mcp\Server\Prompt>>
     */
    protected array $prompts = [
        // Add prompts if needed
    ];
}
