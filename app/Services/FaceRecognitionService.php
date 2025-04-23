<?php

// app/Services/FaceRecognitionService.php
namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class FaceRecognitionService
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'http://localhost:5000/',
            'timeout'  => 2.0,
        ]);
    }

    public function recognize($imagePath)
    {
        try {
            $response = $this->client->post('recognize', [
                'multipart' => [
                    [
                        'name'     => 'image',
                        'contents' => fopen($imagePath, 'r'),
                        'filename' => 'upload.jpg'
                    ]
                ]
            ]);
            
            return json_decode($response->getBody(), true);
        } catch (\Exception $e) {
            Log::error("Face recognition error: " . $e->getMessage());
            return null;
        }
    }
}