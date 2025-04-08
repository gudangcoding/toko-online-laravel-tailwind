<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Transaksi</title>
    <style>
        body { font-size: 12px; font-family: sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 6px; text-align: left; }
    </style>
</head>
<body>
    <h2>Laporan Transaksi</h2>
    <p>Periode:
        {{ $start ? \Carbon\Carbon::parse($start)->format('d M Y') : 'Semua' }} -
        {{ $end ? \Carbon\Carbon::parse($end)->format('d M Y') : 'Semua' }}
    </p>

    <table>
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Pelanggan</th>
                <th>Status Order</th>
                <th>Status Bayar</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($data as $item)
                <tr>
                    <td>{{ \Carbon\Carbon::parse($item->created_at)->translatedFormat('d-F-Y') }}</td>

                    <td>{{ $item->user->name }}</td>
                    <td> {{ $item->status }}</td>
                    <td> {{ $item->status_pembayaran }}</td>
                    <td style="text-align: right">Rp {{ number_format($item->total_harga, 0, ',', '.') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="3">Tidak ada data.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
