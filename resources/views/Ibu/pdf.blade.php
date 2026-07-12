<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Data Orang Tua</title>
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
    <h2>Laporan Data Orang Tua</h2>
    <table>
        <thead>
            <tr>
                <th style="width: 5%;">No</th>
                <th style="width: 15%;">NIK</th>
                <th style="width: 18%;">Nama Ibu</th>
                <th style="width: 18%;">Nama Ayah</th>
                <th style="width: 12%;">No. HP</th>
                <th style="width: 5%;">RT</th>
                <th style="width: 5%;">RW</th>
                <th style="width: 22%;">Alamat</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($data as $item)
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td>{{ $item['nik'] }}</td>
                    <td>{{ $item['nama_ibu'] }}</td>
                    <td>{{ $item['nama_ayah'] }}</td>
                    <td>{{ $item['no_hp'] }}</td>
                    <td class="text-center">{{ $item['rt'] }}</td>
                    <td class="text-center">{{ $item['rw'] }}</td>
                    <td>{{ $item['alamat'] }}</td>
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
