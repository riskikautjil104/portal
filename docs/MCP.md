# Laravel MCP

## Introduction

Laravel MCP provides a simple and elegant way for AI clients to interact with your Laravel application through the Model Context Protocol. It offers an expressive, fluent interface for defining servers, tools, resources, and prompts that enable AI-powered interactions with your application.

## Installation

To get started, install Laravel MCP into your project using the Composer package manager:

```bash
composer require laravel/mcp
```

## Publishing Routes

After installing Laravel MCP, execute the vendor:publish Artisan command to publish the `routes/ai.php` file where you will define your MCP servers:

```bash
php artisan vendor:publish --tag=ai-routes
```

This command creates the `routes/ai.php` file in your application's `routes` directory, which you will use to register your MCP servers.

## Creating Servers

You can create an MCP server using the `make:mcp-server` Artisan command. Servers act as the central communication point that exposes MCP capabilities like tools, resources, and prompts to AI clients:

```bash
php artisan make:mcp-server WeatherServer
```

This command will create a new server class in the `app/Mcp/Servers` directory. The generated server class extends Laravel MCP's base `Laravel\Mcp\Server` class and provides attributes and properties for configuring the server and registering tools, resources, and prompts:

```php
<?php
 
namespace App\Mcp\Servers;
 
use Laravel\Mcp\Server\Attributes\Instructions;
use Laravel\Mcp\Server\Attributes\Name;
use Laravel\Mcp\Server\Attributes\Version;
use Laravel\Mcp\Server;
 
#[Name('Weather Server')]
#[Version('1.0.0')]
#[Instructions('This server provides weather information and forecasts.')]
class WeatherServer extends Server
{
    /**
     * The tools registered with this MCP server.
     *
     * @var array<int, class-string<\Laravel\Mcp\Server\Tool>>
     */
    protected array $tools = [
        // GetCurrentWeatherTool::class,
    ];
 
    /**
     * The resources registered with this MCP server.
     *
     * @var array<int, class-string<\Laravel\Mcp\Server\Resource>>
     */
    protected array $resources = [
        // WeatherGuidelinesResource::class,
    ];
 
    /**
     * The prompts registered with this MCP server.
     *
     * @var array<int, class-string<\Laravel\Mcp\Server\Prompt>>
     */
    protected array $prompts = [
        // DescribeWeatherPrompt::class,
    ];
}
```

## Server Registration

Once you've created a server, you must register it in your `routes/ai.php` file to make it accessible. Laravel MCP provides two methods for registering servers: `web` for HTTP-accessible servers and `local` for command-line servers.

### Web Servers

Web servers are the most common types of servers and are accessible via HTTP POST requests, making them ideal for remote AI clients or web-based integrations. Register a web server using the `web` method:

```php
use App\Mcp\Servers\WeatherServer;
use Laravel\Mcp\Facades\Mcp;
 
Mcp::web('/mcp/weather', WeatherServer::class);
```

Just like normal routes, you may apply middleware to protect your web servers:

```php
Mcp::web('/mcp/weather', WeatherServer::class)
    ->middleware(['throttle:mcp']);
```

### Local Servers

Local servers run as Artisan commands, perfect for building local AI assistant integrations like Laravel Boost. Register a local server using the `local` method:

```php
use App\Mcp\Servers\WeatherServer;
use Laravel\Mcp\Facades\Mcp;
 
Mcp::local('weather', WeatherServer::class);
```

Once registered, you should not typically need to manually run the `mcp:start` Artisan command yourself. Instead, configure your MCP client (AI agent) to start the server or use the MCP Inspector.

## Tools

Tools enable your server to expose functionality that AI clients can call. They allow language models to perform actions, run code, or interact with external systems:

```php
<?php
 
namespace App\Mcp\Tools;
 
use Illuminate\Contracts\JsonSchema\JsonSchema;
use Laravel\Mcp\Request;
use Laravel\Mcp\Response;
use Laravel\Mcp\Server\Attributes\Description;
use Laravel\Mcp\Server\Tool;
 
#[Description('Fetches the current weather forecast for a specified location.')]
class CurrentWeatherTool extends Tool
{
    /**
     * Handle the tool request.
     */
    public function handle(Request $request): Response
    {
        $location = $request->get('location');
 
        return Response::text('The weather is...');
    }
 
    /**
     * Get the tool's input schema.
     *
     * @return array<string, \Illuminate\JsonSchema\Types\Type>
     */
    public function schema(JsonSchema $schema): array
    {
        return [
            'location' => $schema->string()
                ->description('The location to get the weather for.')
                ->required(),
        ];
    }
}
```

## Creating Tools

To create a tool, run the `make:mcp-tool` Artisan command:

```bash
php artisan make:mcp-tool CurrentWeatherTool
```

After creating a tool, register it in your server's `$tools` property:

```php
<?php
 
namespace App\Mcp\Servers;
 
use App\Mcp\Tools\CurrentWeatherTool;
use Laravel\Mcp\Server;
 
class WeatherServer extends Server
{
    protected array $tools = [
        CurrentWeatherTool::class,
    ];
}
```

## Tool Name, Title, and Description

By default, the tool's name and title are derived from the class name. For example, `CurrentWeatherTool` will have a name of `current-weather` and a title of `Current Weather Tool`. You may customize these values using the `Name` and `Title` attributes.

## Tool Input Schemas

Tools can define input schemas to specify what arguments they accept from AI clients. Use Laravel's `Illuminate\Contracts\JsonSchema\JsonSchema` builder to define your tool's input requirements.

## Tool Output Schemas

Tools can define output schemas to specify the structure of their responses. This enables better integration with AI clients that need parseable tool results.
