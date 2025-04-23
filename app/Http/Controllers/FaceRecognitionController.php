<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\KnownFace;
use App\Services\FaceRecognitionService;

class FaceRecognitionController extends Controller
{
    protected $faceService;

    public function __construct(FaceRecognitionService $faceService)
    {
        $this->middleware('auth');
        $this->faceService = $faceService;
    }

    /**
     * Display all registered faces
     */
   
    /**
     * Show the form for adding new faces
     */
    public function create()
    {
        return view('faces.create');
    }

    /**
     * Store a newly registered face
     */
    /**
     * Remove a registered face
     */
 

    /**
     * API Endpoint: Get current encodings
     */
    public function getEncodings()
    {
        $encodingsPath = storage_path('app/face_encodings.pkl');
        
        if (!file_exists($encodingsPath)) {
            return response()->json(['error' => 'Encodings not found'], 404);
        }

        return response()->file($encodingsPath);
    }

    /**
     * API Endpoint: Recognize a face (for Python service)
     */
    public function recognize(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $imagePath = $request->file('image')->store('temp');
        $result = $this->faceService->recognize(storage_path('app/'.$imagePath));
        
        // Clean up
        Storage::delete($imagePath);

        return response()->json($result);
    }
}