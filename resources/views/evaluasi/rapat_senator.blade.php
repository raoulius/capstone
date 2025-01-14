@extends("layouts.layout")
@section("content")

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/3.5.0/remixicon.min.css" rel="stylesheet">
    <link href="{{ asset('styletransparansi.css')  }}" rel="stylesheet">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/3.5.0/remixicon.min.css" rel="stylesheet">
    <link href="{{ asset('styleevaluasisenator.css') }}" rel="stylesheet">
    <title>SENAT FH UNDIP</title>
  </head>

  <body>

    <section id="dynamic-section">
        <h2 class="header">RAPAT SENATOR</h2>
        <p class="sub-header">Berisikan tentang data presensi senator selama tiga bulan</p>
      </section>
      
      <div class="container">
        <table>
          <thead>
            <tr>
              <th>No</th>
              <th>Nama</th>
              <th>Januari</th>
              <th>Februari</th>
              <th>Maret</th>
            </tr>
          </thead>
          <tbody id="table-body"></tbody>
        </table>
      </div>

      <script>
        // Data untuk tabel
        const tables = [
          [
            { no: 1, nama: "Zamroni Akhmad Affandi" },
            { no: 2, nama: "Raffi Majid Hidayatullah" },
            { no: 3, nama: "Abigael Farel Harahap" },
            { no: 4, nama: "Candra Adrianando Satrio P." },
            { no: 5, nama: "Muhammad Gibran Widiharuyanto" },
          ],
        ];
      
        const tableBody = document.getElementById("table-body");
      
        // Fungsi untuk merender tabel
        function renderTable(data) {
          tableBody.innerHTML = ""; // Bersihkan isi tabel
      
          data.forEach((row) => {
            const tr = document.createElement("tr");
            tr.innerHTML = `
              <td>${row.no}</td>
              <td>${row.nama}</td>
              <td class="green">100%</td>
              <td class="green">100%</td>
              <td class="green">100%</td>
            `;
            tableBody.appendChild(tr);
          });
        }
      
        // Render tabel saat halaman dimuat
        renderTable(tables[0]);
      </script>
    @endsection
