<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Data Anak</title>
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
    <h2>Laporan Data Anak</h2>
    <table>
        <thead>
            <tr>
                <th style="width: 5%;">No</th>
                <th style="width: 14%;">NIK</th>
                <th style="width: 16%;">Nama Anak</th>
                <th style="width: 16%;">Nama Orang Tua</th>
                <th style="width: 14%;">Tanggal Lahir</th>
                <th style="width: 12%;">Jenis Kelamin</th>
                <th style="width: 11%;">Berat Badan</th>
                <th style="width: 12%;">Tinggi Badan</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($data as $item)
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td>{{ $item['nik'] }}</td>
                    <td>{{ $item['nama'] }}</td>
                    <td>{{ $item['nama_orang_tua'] }}</td>
                    <td class="text-center">{{ $item['tanggal_lahir'] }}</td>
                    <td class="text-center">{{ $item['jenis_kelamin'] }}</td>
                    <td class="text-center">{{ $item['berat_badan'] }}</td>
                    <td class="text-center">{{ $item['tinggi_badan'] }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center">Tidak ada data.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
