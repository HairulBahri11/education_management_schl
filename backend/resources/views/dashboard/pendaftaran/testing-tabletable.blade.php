<!DOCTYPE html>
<html>

<head>
    <style>
        /* Style untuk tabel utama */
        table {
            width: 80%;
            border-collapse: collapse;
            margin: 20px;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
        }

        /* Style untuk tabel detail */
        .detail-table {
            width: 100%;
        }

        .detail-table,
        .detail-table th,
        .detail-table td {
            border: 1px solid gray;
            border-collapse: collapse;
        }

        .detail-table th,
        .detail-table td {
            padding: 5px;
            text-align: left;
        }
    </style>
</head>

<body>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Usia</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>John Doe</td>
                <td>30</td>
            </tr>
            <tr>
                <td>2</td>
                <td>Jane Smith</td>
                <td>28</td>
            </tr>
        </tbody>
    </table>

    <!-- Tabel detail tersembunyi untuk John Doe -->
    <table class="detail-table" style="display: none;">
        <thead>
            <tr>
                <th>ID Pekerjaan</th>
                <th>Pekerjaan</th>
                <th>Perusahaan</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>Programmer</td>
                <td>ABC Software Co.</td>
            </tr>
            <tr>
                <td>2</td>
                <td>Desainer</td>
                <td>XYZ Design Inc.</td>
            </tr>
        </tbody>
    </table>

    <!-- Tabel detail tersembunyi untuk Jane Smith -->
    <table class="detail-table" style="display: none;">
        <thead>
            <tr>
                <th>ID Pekerjaan</th>
                <th>Pekerjaan</th>
                <th>Perusahaan</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>3</td>
                <td>Pemasaran</td>
                <td>Marketing Pro LLC</td>
            </tr>
            <tr>
                <td>4</td>
                <td>Akuntan</td>
                <td>ABC Finance Inc.</td>
            </tr>
        </tbody>
    </table>

    <script>
        // JavaScript untuk menampilkan atau menyembunyikan tabel detail
        const userRows = document.querySelectorAll('table tbody tr');

        userRows.forEach((row, index) => {
            row.addEventListener('click', () => {
                // Cari elemen detail-row yang mungkin ada di bawah baris yang diklik
                const detailRow = row.nextElementSibling;

                // Jika detailRow adalah null, maka buat dan sisipkan baris baru
                if (!detailRow || !detailRow.classList.contains('detail-row')) {
                    // Membuat baris baru untuk tabel detail
                    const detailRow = document.createElement('tr');
                    detailRow.classList.add('detail-row');

                    // Membuat satu sel di dalam baris baru
                    const detailCell = document.createElement('td');
                    detailCell.setAttribute('colspan', '3'); // Sesuaikan jumlah kolom yang sesuai
                    detailCell.innerHTML =
                        `<table class="detail-table"><tr><th>ID Pekerjaan</th><th>Pekerjaan</th><th>Perusahaan</th></tr><tr><td>1</td><td>Programmer</td><td>ABC Software Co.</td></tr><tr><td>2</td><td>Desainer</td><td>XYZ Design Inc.</td></tr></table>`;

                    // Sisipkan sel ke dalam baris baru
                    detailRow.appendChild(detailCell);

                    // Sisipkan baris baru tepat di bawah baris yang diklik
                    row.parentNode.insertBefore(detailRow, row.nextSibling);
                } else {
                    // Jika detailRow sudah ada, maka hilangkan atau sembunyikan
                    detailRow.remove();
                }
            });
        });
    </script>
</body>

</html>
