<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Peminjaman Barang</title>
    <style>
        :root {
            --primary: #4f46e5;
            --bg-color: #f8fafc;
            --card-bg: #ffffff;
            --text-main: #1e293b;
            --text-muted: #64748b;
            --border-color: #e2e8f0;
        }
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: var(--bg-color); color: var(--text-main); margin: 0; padding: 30px; }
        .wrapper { max-width: 1100px; margin: 0 auto; }
        .header-flex { display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px; background: var(--card-bg); padding: 20px 30px; border-radius: 12px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05); }
        .header-flex h2 { margin: 0; font-size: 22px; }
        .btn-back { background-color: #4f46e5; color: white; padding: 10px 18px; border-radius: 6px; text-decoration: none; font-size: 14px; font-weight: 600; }
        .btn-back:hover { background-color: #4338ca; }
        .card-container { background: var(--card-bg); padding: 30px; border-radius: 12px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05); }
        table { width: 100%; border-collapse: collapse; text-align: left; }
        th, td { padding: 14px 16px; border-bottom: 1px solid var(--border-color); font-size: 14px; }
        th { background-color: #f1f5f9; color: var(--text-muted); font-weight: 600; text-transform: uppercase; font-size: 12px; }
        .badge-status { background-color: #fef3c7; color: #92400e; padding: 4px 10px; border-radius: 20px; font-size: 12px; font-weight: 600; text-transform: uppercase; }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="header-flex">
            <h2>📜 Riwayat Pengajuan Peminjaman</h2>
            <a href="{{ route('items.index') }}" class="btn-back">⬅️ Kembali ke Katalog</a>
        </div>

        <div class="card-container">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Peminjam</th>
                        <th>Nama Barang</th>
                        <th>Tanggal Pinjam</th>
                        <th>Tanggal Kembali</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($borrowRecords as $index => $record)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td><strong>{{ $record->user->name ?? 'User' }}</strong></td>
                        <td>{{ $record->item->name ?? 'Barang Dihapus' }}</td>
                        <td>{{ $record->borrow_date }}</td>
                        <td>{{ $record->return_date }}</td>
                        <td><span class="badge-status">{{ $record->status }}</span></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>