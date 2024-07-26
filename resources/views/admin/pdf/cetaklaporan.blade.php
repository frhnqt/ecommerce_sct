<!DOCTYPE html>
<html>
<head>
    <title>Laporan Data</title>
</head>
<body>
    <h1>Laporan Data Pesanan</h1>
    <table border="1" style="width: 100%; border-collapse: collapse;">
        <thead>
            <tr>
                <th style="text-align: center; vertical-align: middle;">#</th>
                <th style="text-align: center; vertical-align: middle;">Tanggal Pesanan</th>
                <th style="text-align: center; vertical-align: middle;">Kode Pesanan</th>
                <th style="text-align: center; vertical-align: middle;">Invoice</th>
                <th style="text-align: center; vertical-align: middle;">Metode Pembayaran</th>
                <th style="text-align: center; vertical-align: middle;">Total Belanja</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($listpesanandiselesaikan as $key => $pesanan)
            <tr>
                <td style="text-align: center; vertical-align: middle;">{{ $key + 1 }}</td>
                <td style="text-align: center; vertical-align: middle;">{{ $pesanan->tanggal_pesanan }}</td>
                <td style="text-align: center; vertical-align: middle;">{{ $pesanan->kodepesanan }}</td>
                <td style="text-align: center; vertical-align: middle;">{{ $pesanan->invoice }}</td>
                <td style="text-align: center; vertical-align: middle;">{{ $pesanan->metodepembayaran ? $pesanan->metodepembayaran->namabank : 'N/A' }}</td>
                <td style="text-align: center; vertical-align: middle;">{{ number_format($pesanan->totalbelanja, 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
