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
                <label for="name">Jenis Rapat:</label>
                <input type="text" id="name" name="name" placeholder="Masukkan jenis rapat" required>
            </div>

            <div class="form-group">
                <label for="attendance">Presensi (%)</label>
                <div class="attendance-inputs">
                    <label1 for="bulan">Bulan:</label1>
                    <select id="bulan" name="attendance[bulan]" required>
                        <option value="" disabled selected>Pilih Bulan</option>
                        <option value="januari">Januari</option>
                        <option value="februari">Februari</option>
                        <option value="maret">Maret</option>
                        <option value="april">April</option>
                        <option value="mei">Mei</option>
                        <option value="juni">Juni</option>
                        <option value="juli">Juli</option>
                        <option value="agustus">Agustus</option>
                        <option value="september">September</option>
                        <option value="oktober">Oktober</option>
                        <option value="november">November</option>
                        <option value="desember">Desember</option>
                    </select>
                    <div>
                        <label1 for="persentase">Presensi (%):</label1>
                        <input type="number" id="persentase" name="attendance[persentase]" placeholder="0-100" min="0" max="100" required>
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
