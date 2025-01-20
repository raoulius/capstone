<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Edit Rapat - {{ $rapat->komisi_type }}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
            <form action="{{ route('admin.master-rapat.update', $rapat->id) }}" method="POST" id="form-action">
                @csrf
                @method('PUT')
                
                <div class="mb-3">
                    <label class="form-label">Nama</label>
                    <input type="text" class="form-control" value="{{ $rapat->nama }}" readonly>
                </div>

                <div class="mb-3">
                    <label class="form-label">Tanggal</label>
                    <input type="date" name="tanggal" class="form-control" value="{{ $rapat->tanggal }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Waktu Mulai</label>
                    <input type="time" name="waktu_mulai" class="form-control" value="{{ $rapat->waktu_mulai }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Waktu Selesai</label>
                    <input type="time" name="waktu_selesai" class="form-control" value="{{ $rapat->waktu_selesai }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Agenda</label>
                    <textarea class="form-control" readonly>{{ $rapat->agenda }}</textarea>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>