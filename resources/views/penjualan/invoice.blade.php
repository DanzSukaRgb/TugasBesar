<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice Penjualan #{{ $penjualan->id }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
            color: #333;
        }
        .invoice-box {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ddd;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .invoice-box table {
            width: 100%;
            border-collapse: collapse;
        }
        .invoice-box table td, .invoice-box table th {
            padding: 8px;
            vertical-align: top;
        }
        .invoice-box .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        .invoice-box .header .title {
            font-size: 24px;
            font-weight: bold;
            color: #333;
        }
        .invoice-box .info-table td:first-child {
            font-weight: bold;
            width: 30%;
        }
        .invoice-box .items-table th {
            background-color: #f2f2f2;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }
        .invoice-box .items-table td {
            border-bottom: 1px solid #eee;
        }
        .invoice-box .total {
            font-weight: bold;
            font-size: 16px;
            text-align: right;
            margin-top: 10px;
        }
        .no-print {
            margin-top: 20px;
        }
        @media print {
            .no-print {
                display: none;
            }
            .invoice-box {
                border: none;
                box-shadow: none;
                margin: 0;
            }
        }
    </style>
</head>
<body>
    <div class="invoice-box">
        <div class="header">
            <div class="title">Toko Online</div>
            <div>
                <strong>Invoice #{{ $penjualan->id }}</strong><br>
                Tanggal: {{ date('d F Y', strtotime($penjualan->tanggal_pesan)) }}<br>
                Kasir: {{ $penjualan->kasir->username }}
            </div>
        </div>

        <table class="info-table mb-4">
            <tr>
                <td>Kepada</td>
                <td>
                    {{ $penjualan->pembeli->nama }}<br>
                    {{ $penjualan->pembeli->alamat }}<br>
                    No HP: {{ $penjualan->pembeli->no_hp }}
                </td>
            </tr>
            <tr>
                <td>Dari</td>
                <td>
                    Toko Online<br>
                    Jl. Contoh No. 123, Kota<br>
                    Kode Pos 12345
                </td>
            </tr>
        </table>

        <table class="items-table">
            <thead>
                <tr>
                    <th>Barang</th>
                    <th>Jumlah</th>
                    <th>Harga Satuan</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($penjualan->detailPenjualans as $detail)
                <tr>
                    <td>{{ $detail->barang->nama }}</td>
                    <td>{{ $detail->jumlah }}</td>
                    <td>Rp {{ number_format($detail->barang->harga, 0, ',', '.') }}</td>
                    <td>Rp {{ number_format($detail->total_harga, 0, ',', '.') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="total">
            Total: Rp {{ number_format($penjualan->total, 0, ',', '.') }}
        </div>

        <div class="no-print">
            <button onclick="window.print()" class="btn btn-primary">
                <i class="fas fa-print me-1"></i> Cetak
            </button>
            <a href="{{ route('penjualan.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-1"></i> Kembali
            </a>
        </div>
    </div>
</body>
</html>
