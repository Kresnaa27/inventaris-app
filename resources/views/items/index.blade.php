<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Inventaris & Peminjaman Barang</title>
    <style>
        :root {
            --primary: #4f46e5;
            --primary-hover: #4338ca;
            --bg-color: #f8fafc;
            --card-bg: #ffffff;
            --text-main: #1e293b;
            --text-muted: #64748b;
            --border-color: #e2e8f0;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: var(--bg-color);
            color: var(--text-main);
            margin: 0;
            padding: 30px;
        }

        .wrapper {
            max-width: 1100px;
            margin: 0 auto;
        }

        /* Header Dashboard */
        .header-flex {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            background: var(--card-bg);
            padding: 20px 30px;
            border-radius: 12px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
        }

        .header-flex h2 {
            margin: 0;
            color: var(--text-main);
            font-size: 22px;
        }

        .btn-history {
            background-color: #0f172a;
            color: white;
            padding: 10px 18px;
            border-radius: 6px;
            text-decoration: none;
            font-size: 14px;
            font-weight: 600;
            transition: background 0.2s;
        }

        .btn-history:hover {
            background-color: #334155;
        }

        /* Container Utama */
        .card-container {
            background: var(--card-bg);
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
        }

        .alert {
            background-color: #d1fae5;
            color: #065f46;
            padding: 12px 18px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
            font-weight: 500;
            border-left: 4px solid #10b981;
        }

        /* Search Bar */
        .search-box {
            width: 100%;
            padding: 12px 16px;
            margin-bottom: 25px;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            font-size: 15px;
            box-sizing: border-box;
            outline: none;
            transition: border-color 0.2s;
        }

        .search-box:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
        }

        /* Tabel Profesional */
        table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
        }

        th, td {
            padding: 14px 16px;
            border-bottom: 1px solid var(--border-color);
            font-size: 14px;
        }

        th {
            background-color: #f1f5f9;
            color: var(--text-muted);
            font-weight: 600;
            text-transform: uppercase;
            font-size: 12px;
            letter-spacing: 0.5px;
        }

        tr:hover {
            background-color: #f8fafc;
        }

        .badge-stock {
            background-color: #dcfce7;
            color: #166534;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        /* Form Peminjaman di Tabel */
        .borrow-form {
            display: flex;
            gap: 8px;
            align-items: center;
        }

        .input-group {
            display: flex;
            flex-direction: column;
        }

        .input-group label {
            font-size: 11px;
            color: var(--text-muted);
            margin-bottom: 2px;
        }

        input[type="date"] {
            padding: 6px 8px;
            border: 1px solid var(--border-color);
            border-radius: 6px;
            font-size: 13px;
            outline: none;
        }

        .btn-borrow {
            background-color: var(--primary);
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 600;
            font-size: 13px;
            transition: background 0.2s;
            margin-top: 16px;
        }

        .btn-borrow:hover {
            background-color: var(--primary-hover);
        }
    </style>
</head>
<body>

    <div class="wrapper">
        <!-- Header Navigasi -->
        <div class="header-flex">
            <h2>📦 Katalog Inventaris & Peminjaman</h2>
            <a href="{{ route('borrow.history') }}" class="btn-history">📜 Lihat Riwayat Peminjaman</a>
        </div>

        <div class="card-container">
            <!-- Notifikasi Sukses -->
            @if(session('success'))
                <div class="alert">✨ {{ session('success') }}</div>
            @endif

            <!-- Input Pencarian -->
            <input type="text" id="searchBox" class="search-box" placeholder="🔍 Cari nama barang atau kategori...">

            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode</th>
                        <th>Nama Barang</th>
                        <th>Kategori</th>
                        <th>Stok</th>
                        <th>Form Peminjaman</th>
                    </tr>
                </thead>
                <tbody id="itemTableBody">
                    @foreach($items as $index =>$item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td><strong>{{ $item->code }}</strong></td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->category }}</td>
                        <td><span class="badge-stock">{{ $item->stock }} Unit</span></td>
                        <td>
                            <form action="{{ route('borrow.store') }}" method="POST" class="borrow-form">
                                @csrf
                                <input type="hidden" name="item_id" value="{{ $item->id }}">
                                
                                <div class="input-group">
                                    <label>Mulai:</label>
                                    <input type="date" name="borrow_date" required>
                                </div>
                                
                                <div class="input-group">
                                    <label>Kembali:</label>
                                    <input type="date" name="return_date" required>
                                </div>

                                <button type="submit" class="btn-borrow">Pinjam</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- JavaScript Live Search -->
    <script>
        const searchBox = document.getElementById('searchBox');
        const itemTableBody = document.getElementById('itemTableBody');

        searchBox.addEventListener('keyup', function() {
            let keyword = searchBox.value;

            fetch(`/items/search?keyword=${keyword}`)
                .then(response => response.json())
                .then(data => {
                    itemTableBody.innerHTML = '';

                    if (data.length === 0) {
                        itemTableBody.innerHTML = `<tr><td colspan="6" style="text-align: center; color: #64748b; padding: 20px;">Barang tidak ditemukan</td></tr>`;
                        return;
                    }

                    data.forEach((item, index) => {
                        itemTableBody.innerHTML += `
                            <tr>
                                <td>${index + 1}</td>
                                <td><strong>${item.code}</strong></td>
                                <td>${item.name}</td>
                                <td>${item.category}</td>
                                <td><span class="badge-stock">${item.stock} Unit</span></td>
                                <td>
                                    <form action="{{ route('borrow.store') }}" method="POST" class="borrow-form">
                                        @csrf
                                        <input type="hidden" name="item_id" value="${item.id}">
                                        
                                        <div class="input-group">
                                            <label>Mulai:</label>
                                            <input type="date" name="borrow_date" required>
                                        </div>
                                        
                                        <div class="input-group">
                                            <label>Kembali:</label>
                                            <input type="date" name="return_date" required>
                                        </div>

                                        <button type="submit" class="btn-borrow">Pinjam</button>
                                    </form>
                                </td>
                            </tr>
                        `;
                    });
                })
                .catch(error => console.error('Terjadi kesalahan:', error));
        });
    </script>
</body>
</html>