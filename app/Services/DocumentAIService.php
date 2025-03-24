<?php

namespace App\Services;

use Google\Cloud\DocumentAI\V1\DocumentProcessorServiceClient;
use Google\Cloud\DocumentAI\V1\RawDocument;

class DocumentAIService
{
    protected $client;

    public function __construct()
    {
        $this->client = new DocumentProcessorServiceClient();
    }

    public function processDocument($filePath)
    {
        $processorId = env('DOCUMENT_AI_PROCESSOR_ID');
        $location = env('DOCUMENT_AI_LOCATION');
        $projectId = env('GOOGLE_PROJECT_ID');

        $client = new DocumentProcessorServiceClient();

        $rawDocument = new RawDocument([
            'content' => file_get_contents($filePath),
            'mime_type' => 'image/png', // Update based on file type
        ]);

        $response = $client->processDocument([
            'name' => "projects/$projectId/locations/$location/processors/$processorId",
            'raw_document' => $rawDocument,
        ]);

        return $response->getDocument()->getText();
    }
}
