<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Data Imunisasi</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 11px; margin: 20px; }
        h2 { text-align: center; margin-bottom: 15px; color: #1e293b; }
        table { width: 100%; border-collapse: collapse; }
        th { background-color: #2563EB; color: #ffffff; font-weight: bold; text-align: center; padding: 8px 6px; }
        td { padding: 6px; border: 1px solid #d1d5db; }
        tr:nth-child(even) { background-color: #f8fafc; }
        .text-center { text-align: center; }
    </style>
</head>
<body>
    <h2>Laporan Data Imunisasi</h2>
    <table>
        <thead>
            <tr>
                <th style="width: 5%;">No</th>
                <th style="width: 20%;">Kode Imunisasi</th>
                <th style="width: 30%;">Nama Imunisasi</th>
                <th style="width: 45%;">Deskripsi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($data as $item)
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td class="text-center">{{ $item['kode_imunisasi'] }}</td>
                    <td>{{ $item['nama_imunisasi'] }}</td>
                    <td>{{ $item['deskripsi'] }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center">Tidak ada data.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
