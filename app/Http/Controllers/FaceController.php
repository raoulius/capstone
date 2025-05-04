<?php

namespace App\Http\Controllers;

use App\Models\UserFace;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FaceController extends Controller
{
    public function index()
    {
        $faces = auth()->user()->userFace;

        return view('auth.face-recognize', ['faces' => $faces]);
    }

    public function store(Request $request)
    {
        if (!$request->acceptsJson())
            return redirect(-1);

        $request->validate([
            'descriptor' => 'required',
            'image' => 'required'
        ]);

        $descriptor = $request->input('descriptor');
        $base64Image = $request->input('image');

        $image = str_replace('data:image/jpeg;base64,', '', $base64Image);
        $image = str_replace(' ', '+', $image);
        $imageName = 'face_' . auth()->user()->id . '_' . time() . '.jpg';
        Storage::disk('public')->put("faces/$imageName", base64_decode($image));

        $newFace = new UserFace;
        $newFace->user_id = auth()->user()->id;
        $newFace->descriptor = json_encode($descriptor);
        $newFace->path = "faces/$imageName";

        $newFace->save();

        return response()->json(['message' => 'Success', 'data' => $newFace], 201);
    }

    public function destroy(Request $request, string $faceId)
    {
        if (!$request->acceptsJson())
            return redirect(-1);

        $face = UserFace::find($faceId);

        Storage::delete("public/{$face->path}");

        $face->delete();

        return response()->json(['message' => 'Success']);
    }
}
