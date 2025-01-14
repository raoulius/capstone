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
        <h2 class="header">RAPAT PIMPINAN</h2>
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
        // Data untuk beberapa tabel
        const tables = [
          [
            { no: 1, nama: "Zamroni Akhmad Affandi" },
            { no: 2, nama: "Raffi Majid Hidayatullah" },
            { no: 3, nama: "Abigael Farel Harahap" },
            { no: 4, nama: "Candra Adrianando Satrio P." },
            { no: 5, nama: "Muhammad Gibran Widiharuyanto" },
            { no: 1, nama: "Zamroni Akhmad Affandi" },
            { no: 2, nama: "Raffi Majid Hidayatullah" },
            { no: 3, nama: "Abigael Farel Harahap" },
            { no: 4, nama: "Candra Adrianando Satrio P." },
            { no: 5, nama: "Muhammad Gibran Widiharuyanto" },
          ],
          [
            { no: 6, nama: "Felicia Adelyne Rustani" },
            { no: 7, nama: "Muhammad Habib Zaid El Hakim" },
            { no: 8, nama: "Fakhrunnisa Arvia Alceria" },
            { no: 9, nama: "Maharani Ali Putri" },
            { no: 10, nama: "Putri Shafira Ramadhania" },
            { no: 6, nama: "Felicia Adelyne Rustani" },
            { no: 7, nama: "Muhammad Habib Zaid El Hakim" },
            { no: 8, nama: "Fakhrunnisa Arvia Alceria" },
            { no: 9, nama: "Maharani Ali Putri" },
            { no: 10, nama: "Putri Shafira Ramadhania" },
          ],
          [
            { no: 11, nama: "Zalfaritza Adelia Sukmaclevi" },
            { no: 12, nama: "Muhammad Ridho Putra P." },
            { no: 11, nama: "Zalfaritza Adelia Sukmaclevi" },
            { no: 12, nama: "Muhammad Ridho Putra P." },
            { no: 11, nama: "Zalfaritza Adelia Sukmaclevi" },
            { no: 12, nama: "Muhammad Ridho Putra P." },
            { no: 11, nama: "Zalfaritza Adelia Sukmaclevi" },
            { no: 12, nama: "Muhammad Ridho Putra P." },
          ],
        ];
      
        const tableBody = document.getElementById("table-body");
      
        // Fungsi untuk merender tabel berdasarkan indeks
        function renderTable(index) {
          tableBody.innerHTML = ""; // Bersihkan isi tabel
      
          // Dapatkan data tabel berdasarkan indeks
          const currentTable = tables[index];
      
          currentTable.forEach((row) => {
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
      
          // Perbarui konten section
          const sectionData = [
            {
              title: "AGENDA KERJA",
              description: "Berisikan Data Presensi Rapat Agenda Kerja."
            },
          ];
          const currentSection = sectionData[index];
          const dynamicSection = document.getElementById("dynamic-section");
          dynamicSection.querySelector(".header").textContent = currentSection.title;
          dynamicSection.querySelector(".sub-header").textContent = currentSection.description;
        }
      
        // Render tabel pertama saat halaman dimuat
        renderTable(0);
      </script>
    @endsection
