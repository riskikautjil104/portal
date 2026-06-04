<?php

namespace App\Mcp\Tools;

use Illuminate\Contracts\JsonSchema\JsonSchema;
use Laravel\Mcp\Request;
use Laravel\Mcp\Response;
use Laravel\Mcp\Server\Attributes\Description;
use Laravel\Mcp\Server\Tool;
use App\Models\StudentLocation;

#[Description('Fetches the student mapping data across different villages in Pulau Morotai.')]
class GetStudentMapTool extends Tool
{
    /**
     * Handle the tool request.
     */
    public function handle(Request $request): Response
    {
        $locations = StudentLocation::orderBy('village_name')->get();

        if ($locations->isEmpty()) {
            return Response::text('No student mapping data available.');
        }

        $totalStudents = $locations->sum('student_count');
        
        $text = "Student Distribution (Total: {$totalStudents}):\n";
        foreach ($locations as $loc) {
            $text .= "- {$loc->village_name}: {$loc->student_count} students (Classes: {$loc->classes})\n";
            $text .= "  Location: {$loc->latitude}, {$loc->longitude}\n";
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
