<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Data Pemeriksaan</title>
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
    <h2>Laporan Data Pemeriksaan</h2>
    <table>
        <thead>
            <tr>
                <th style="width: 5%;">No</th>
                <th style="width: 14%;">No. Pemeriksaan</th>
                <th style="width: 10%;">No. Antrean</th>
                <th style="width: 16%;">Nama Anak</th>
                <th style="width: 16%;">Nama Kegiatan</th>
                <th style="width: 12%;">Metode</th>
                <th style="width: 12%;">Tanggal</th>
                <th style="width: 8%;">Umur</th>
                <th style="width: 12%;">Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($data as $item)
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td>{{ $item['nomor_pemeriksaan'] }}</td>
                    <td class="text-center">{{ $item['nomor_antri'] }}</td>
                    <td>{{ $item['nama_anak'] }}</td>
                    <td>{{ $item['nama_kegiatan'] }}</td>
                    <td class="text-center">{{ $item['metode_kunjungan'] }}</td>
                    <td class="text-center">{{ $item['tanggal_kunjungan'] }}</td>
                    <td class="text-center">{{ $item['umur_bulan'] }}</td>
                    <td class="text-center">{{ $item['approvel_status'] }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="9" class="text-center">Tidak ada data.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>