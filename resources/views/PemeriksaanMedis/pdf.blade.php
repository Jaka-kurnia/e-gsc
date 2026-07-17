<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Pemeriksaan Medis</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #2563EB; color: white; text-align: center; }
        .text-center { text-align: center; }
    </style>
</head>
<body>
    <h2 class="text-center">Laporan Pemeriksaan Medis</h2>
    <hr>
    
    <table>
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="15%">No. Pemeriksaan</th>
                <th width="20%">Nama Anak</th>
                <th width="15%">Pemberian Vitamin</th>
                <th width="15%">Obat Cacing</th>
                <th width="15%">Rujukan Medis</th>
                <th width="15%">Catatan</th>
            </tr>
        </thead>
        <tbody>
            @forelse($data as $index => $item)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td>{{ $item['nomor_pemeriksaan'] }}</td>
                    <td>{{ $item['nama_anak'] }}</td>
                    <td>{{ $item['pemberian_vitamin'] }}</td>
                    <td class="text-center">{{ $item['pemberian_obat_cacing'] }}</td>
                    <td class="text-center">{{ $item['status_rujukan_medis'] }}</td>
                    <td>{{ $item['catatan'] }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">Data Pemeriksaan Medis tidak tersedia</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
