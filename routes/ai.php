<?php

use App\Mcp\Servers\PortalServer;
use Laravel\Mcp\Facades\Mcp;

Mcp::web('/mcp/portal', PortalServer::class)
    ->middleware(['throttle:mcp']);

Mcp::local('portal', PortalServer::class);
