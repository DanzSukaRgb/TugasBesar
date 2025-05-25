<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Penjualan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }
        .report-box {
            max-width: 800px;
            margin: auto;
            padding: 20px;
        }
        .report-box table {
            width: 100%;
            border-collapse: collapse;
        }
        .report-box table th,
        .report-box table td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        .report-box table th {
            background-color: #f2f2f2;
            font-weight: bold;
        }
        .report-box table tr.total td {
            font-weight: bold;
            background-color: #f8f9fa;
        }
        @media print {
            .no-print {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="report-box">
        <h2 class="text-center mb-4">Laporan Penjualan</h2>
        <p class="text-center mb-4">
            Periode: {{ request('tanggal_mulai', date('Y-m-01')) }} s/d {{ request('tanggal_akhir', date('Y-m-d')) }}<br>
            Kasir: {{ request('kasir_id') ? App\Models\User::find(request('kasir_id'))->username : 'Semua Kasir' }}
        </p>

        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Pembeli</th>
                    <th>Kasir</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @forelse($penjualans as $index => $penjualan)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ date('d-m-Y', strtotime($penjualan->tanggal_pesan)) }}</td>
                    <td>{{ $penjualan->pembeli->nama }}</td>
                    <td>{{ $penjualan->kasir->username }}</td>
                    <td>Rp {{ number_format($penjualan->total, 0, ',', '.') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center">Data kosong</td>
                </tr>
                @endforelse
                <tr class="total">
                    <td colspan="4" class="text-end">Total Pendapatan</td>
                    <td>Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</td>
                </tr>
            </tbody>
        </table>

        <div class="mt-4 no-print">
            <button onclick="window.print()" class="btn btn-primary">
                <i class="fas fa-print me-1"></i> Cetak
            </button>
            <a href="{{ route('laporan.penjualan') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-1"></i> Kembali
            </a>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
    <script>
        // Auto-generate PDF on page load
        window.onload = function() {
            const element = document.querySelector('.report-box');
            html2pdf()
                .from(element)
                .set({
                    margin: 1,
                    filename: 'laporan-penjualan.pdf',
                    html2canvas: { scale: 2 },
                    jsPDF: { orientation: 'portrait', unit: 'in', format: 'letter' }
                })
                .save();
        };
    </script>
</body>
</html>
