<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Data Pemeriksaan Antropometri</title>
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
    <h2>Laporan Data Pemeriksaan Antropometri</h2>
    <table>
        <thead>
            <tr>
                <th style="width: 5%;">No</th>
                <th style="width: 16%;">No. Pemeriksaan</th>
                <th style="width: 16%;">Nama Anak</th>
                <th style="width: 12%;">Berat Badan</th>
                <th style="width: 12%;">Tinggi Badan</th>
                <th style="width: 13%;">Lingkar Kepala</th>
                <th style="width: 12%;">Tren Pertumbuhan</th>
                <th style="width: 14%;">Status Gizi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($data as $item)
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td>{{ $item['nomor_pemeriksaan'] }}</td>
                    <td>{{ $item['nama_anak'] }}</td>
                    <td class="text-center">{{ $item['berat_badan'] }}</td>
                    <td class="text-center">{{ $item['tinggi_badan'] }}</td>
                    <td class="text-center">{{ $item['lingkar_kepala'] }}</td>
                    <td class="text-center">{{ $item['tren_pertumbuhan'] }}</td>
                    <td class="text-center">{{ $item['status_gizi'] }}</td>
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
