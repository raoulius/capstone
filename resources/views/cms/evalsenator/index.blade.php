@extends("cms.layouts.layout")

@section("content")
  <link href="{{ URL::asset("cms/evalsenator/styleindex.css") }}" rel="stylesheet">
  <div class="">
    <h2 class="cms-header">Kelola Data Senator</h2>
    
    <!-- Form Tambah Data -->
    <div class="form-container">
        <form id="add-senator-form">
            <div class="form-group">
                <label for="name">Nama Senator:</label>
                <input type="text" id="name" name="name" placeholder="Masukkan nama senator" required>
            </div>

            <div class="form-group">
                <label for="attendance">Presensi (%)</label>
                <div class="attendance-inputs">
                    <div>
                        <label for="januari">Januari:</label>
                        <input type="number" id="januari" name="attendance[januari]" placeholder="0-100" min="0" max="100" required>
                    </div>
                    <div>
                        <label for="februari">Februari:</label>
                        <input type="number" id="februari" name="attendance[februari]" placeholder="0-100" min="0" max="100" required>
                    </div>
                    <div>
                        <label for="maret">Maret:</label>
                        <input type="number" id="maret" name="attendance[maret]" placeholder="0-100" min="0" max="100" required>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn-submit">Tambah</button>
        </form>
    </div>

    <!-- Tabel Data Senator -->
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Januari</th>
                    <th>Februari</th>
                    <th>Maret</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody id="senator-data">
                <!-- Contoh data statis -->
                <tr>
                    <td>1</td>
                    <td>Zamroni Akhmad Affandi</td>
                    <td>100%</td>
                    <td>100%</td>
                    <td>100%</td>
                    <td>
                        <button class="btn-edit">Edit</button>
                        <button class="btn-delete">Hapus</button>
                    </td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Raffi Majid Hidayatullah</td>
                    <td>95%</td>
                    <td>90%</td>
                    <td>85%</td>
                    <td>
                        <button class="btn-edit">Edit</button>
                        <button class="btn-delete">Hapus</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>



  
@endsection
