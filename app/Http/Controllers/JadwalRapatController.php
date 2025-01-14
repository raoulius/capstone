<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JadwalRapat;

class JadwalRapatController extends Controller
{
    // Menampilkan daftar jadwal rapat dalam format JSON untuk FullCalendar
    public function list()
    {
        $jadwal = JadwalRapat::all();

        $events = $jadwal->map(function ($item) {
            return [
                'id' => $item->id,
                'title' => $item->title,
                'start' => $item->start_date->format('Y-m-d\TH:i:s'),
                'end' => $item->end_date->format('Y-m-d\TH:i:s'),
                'category' => $item->category,
            ];
        });

        return response()->json($events);
    }

    // Menampilkan form pembuatan jadwal rapat
    public function create(Request $request)
    {
        $start_date = $request->start_date;
        $end_date = $request->end_date;

        return view('admin.jadwalrapat.create', compact('start_date', 'end_date'));
    }

    // Menyimpan jadwal rapat baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'category' => 'nullable|string|max:100',
        ]);

        $jadwal = JadwalRapat::create($validated);

        return response()->json([
            'message' => 'Jadwal rapat berhasil dibuat.',
            'data' => $jadwal,
        ]);
    }

    // Menampilkan form untuk mengedit jadwal rapat
    public function edit($id)
    {
        $jadwal = JadwalRapat::findOrFail($id);
        return view('admin.jadwalrapat.edit', compact('jadwal'));
    }

    // Memperbarui jadwal rapat
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'category' => 'nullable|string|max:100',
        ]);

        $jadwal = JadwalRapat::findOrFail($id);
        $jadwal->update($validated);

        return response()->json([
            'message' => 'Jadwal rapat berhasil diperbarui.',
            'data' => $jadwal,
        ]);
    }

    // Menghapus jadwal rapat
    public function destroy($id)
    {
        $jadwal = JadwalRapat::findOrFail($id);
        $jadwal->delete();

        return response()->json([
            'message' => 'Jadwal rapat berhasil dihapus.',
        ]);
    }

    public function index()
{
    $jadwal = JadwalRapat::all();

    // Konversi data ke format yang sesuai untuk FullCalendar
    $events = $jadwal->map(function ($item) {
        return [
            'id' => $item->id,
            'title' => $item->title,
            'start' => $item->start_date->format('Y-m-d\TH:i:s'),
            'end' => $item->end_date->format('Y-m-d\TH:i:s'),
            'category' => $item->category,
        ];
    });

    return response()->json($events);
}

}
