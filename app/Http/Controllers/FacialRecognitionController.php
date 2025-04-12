<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;
use App\Models\HasilAbsenRapatKomisi2;
use Illuminate\Support\Facades\DB;

class FacialRecognitionController extends Controller
{
    public function startRecognition($rapat_id)
    {
        try {
            $process = new Process([
                'python3',
                base_path('scripts/facial-recognition/attendance.py'),
                $rapat_id
            ]);
            
            $process->setTimeout(3600);
            $process->run();

            if (!$process->isSuccessful()) {
                throw new ProcessFailedException($process);
            }

            // Get the recognized people from the Python script
            $recognizedPeople = json_decode($process->getOutput(), true);

            // Store attendance records
            foreach ($recognizedPeople as $name) {
                HasilAbsenRapatKomisi2::create([
                    'rapat_id' => $rapat_id,
                    'name' => $name,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            return response()->json([
                'success' => true,
                'message' => 'Attendance recorded successfully',
                'recognized_people' => $recognizedPeople
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }
} 