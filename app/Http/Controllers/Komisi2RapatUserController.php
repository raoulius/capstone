<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Komisi2Rapat;
use App\Services\FaceRecognitionService;
use App\Models\Attendance;
use Illuminate\Support\Facades\Storage;

class Komisi2RapatUserController extends Controller
{
    protected $faceRecognition;

    // Move constructor to the top after properties
    public function __construct(FaceRecognitionService $faceRecognition)
    {
        $this->faceRecognition = $faceRecognition;
    }

    public function index()
    {
        $rapats = Komisi2Rapat::all();
        return view('komisi.agenda-komisi.rapatkomisi2', compact('rapats'));
    }

    public function mulaiRapat($id)
    {
        $rapat = Komisi2Rapat::findOrFail($id);
        return view('komisi.agenda-komisi.mulairapat', compact('rapat'));
    }

    public function processAttendance(Request $request, $rapatId)
    {
        $rapat = Komisi2Rapat::findOrFail($rapatId);
        
        // Get the temporary image path
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);
    
        $image = $request->file('image');
        
        if (!$image) {
            return back()->with('error', 'No image file received');
        }
    
        try {
            // Store in temporary directory (automatically creates if doesn't exist)
            $imagePath = $image->store('temp', 'public');
            
            // Full path to the stored image
            $fullPath = storage_path('app/public/' . $imagePath);
            
            // Process recognition
            $results = $this->faceRecognition->recognize($fullPath);
            
            // Delete temp file when done
            Storage::delete('public/' . $imagePath);
            
            // Clean up the temp file
            unlink($fullPath);

            if ($results && !empty($results['results'])) {
                foreach ($results['results'] as $result) {
                    Attendance::create([
                        'komisi_id' => $rapat->komisi_id,
                        'rapat_id' => $rapat->id,
                        'rapat_type' => get_class($rapat),
                        'name' => $result['name'],
                        'confidence' => $result['confidence']
                    ]);
                }
                
                return back()->with('success', 'Attendance recorded successfully');
            }
            
            return back()->with('error', 'No faces recognized');
        } catch (\Exception $e) {
            return back()->with('error', 'Error processing attendance: ' . $e->getMessage());
        }
    }
}