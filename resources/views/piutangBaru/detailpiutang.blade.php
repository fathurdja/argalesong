@php
    function angkaTerbilang($angka)
    {
        $angka = abs($angka);
        $huruf = [
            '',
            ' SATU ',
            ' DUA ',
            ' TIGA ',
            ' EMPAT ',
            ' LIMA ',
            ' ENAM ',
            ' TUJUH ',
            ' DELAPAN ',
            ' SEMBILAN ',
            ' SEPULUH ',
            ' SEBELAS ',
        ];
        $temp = '';

        if ($angka < 12) {
            $temp = ' ' . $huruf[$angka];
        } elseif ($angka < 20) {
            $temp = angkaTerbilang($angka - 10) . ' BELAS ';
        } elseif ($angka < 100) {
            $temp = angkaTerbilang($angka / 10) . ' PULUH ' . angkaTerbilang($angka % 10);
        } elseif ($angka < 200) {
            $temp = ' SERATUS ' . angkaTerbilang($angka - 100);
        } elseif ($angka < 1000) {
            $temp = angkaTerbilang($angka / 100) . ' RATUS ' . angkaTerbilang($angka % 100);
        } elseif ($angka < 2000) {
            $temp = ' SERIBU ' . angkaTerbilang($angka - 1000);
        } elseif ($angka < 1000000) {
            $temp = angkaTerbilang($angka / 1000) . ' RIBU ' . angkaTerbilang($angka % 1000);
        } elseif ($angka < 1000000000) {
            $temp = angkaTerbilang($angka / 1000000) . ' JUTA ' . angkaTerbilang($angka % 1000000);
        } elseif ($angka < 1000000000000) {
            $temp = angkaTerbilang($angka / 1000000000) . ' MILYAR ' . angkaTerbilang($angka % 1000000000);
        } elseif ($angka < 1000000000000000) {
            $temp = angkaTerbilang($angka / 1000000000000) . ' TRILIUN ' . angkaTerbilang($angka % 1000000000000);
        }

        return trim($temp);
    }

    function angkaMenjadiTerbilang($angka)
    {
        return angkaTerbilang($angka) . ' RUPIAH';
    }

@endphp


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kwitansi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 10px;
        }

        .container {
            border: 1px solid #ccc;
            padding: 20px;
            width: 100%;
        }

        .header {
            width: 100%;
            margin-bottom: 20px;
        }

        .header-table {
            width: 100%;
            border-collapse: collapse;
        }

        .header-logo {
            width: 70px;
            text-align: left;
            vertical-align: top;
        }

        .header-content {
            text-align: left;
        }

        .header-content h1 {
            font-size: 16px;
            margin: 0;
        }

        .header-content p {
            margin: 2px 0;
        }

        hr {
            border: 0;
            height: 1px;
            background-color: black;
            margin: 10px 0;
        }

        .title {
            text-align: center;
            margin-bottom: 20px;
        }

        .title h2 {
            font-size: 14px;
            font-weight: bold;
            margin: 0;
        }

        .content p {
            margin: 5px 0;
        }

        .footer {
            text-align: right;
            margin-top: 20px;
        }

        .footer img {
            display: block;
            margin: 10px auto;
        }

        .footer .signature {
            text-align: right;
            margin-top: 20px;
        }

        .footer .signature p {
            margin: 5px 0;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <table class="header-table">
                <tr>
                    <td class="header-content">
                        <h1>PT. SINAR GALESONG PRATAMA</h1>
                        <p>Galesong Building lantai 9</p>
                        <p>Jl. A. P. Pettarani No. 55, Makassar, Sulawesi Selatan - 90222</p>
                        <p>Telp. (0411) 444777 (Hunting) ; Fax : (0411) 455091</p>
                        <p>www.galesong.co.id</p>
                    </td>
                    <td class="header-logo">
                        <img src="{{ asset('assets/logo/galesong.png') }}" alt="Logo" width="70" height="70">
                    </td>

                </tr>
            </table>
        </div>
        <hr>
        <div class="title">
            <h2>KWITANSI</h2>
            <p>No. {{ $invoice->no_invoice }}</p>
        </div>
        <div class="content">
            <p><strong>Telah terima dari</strong>: {{ $invoice->pelanggan->name }}</p>
            <p><strong>Terbilang</strong>: {{ angkaMenjadiTerbilang($invoice->nominal) }}</p>
            <p><strong>Untuk Pembayaran</strong>: Sewa Departement Store dan Biaya Service Charge atas Sewa Departement
                Store periode {{ $Dateterbit }} s.d {{ $DatejTempo }}</p>
            <p><strong>Tagihan</strong>: Rp. {{ number_format($invoice->nominal, 0) }}</p>
            <p><strong>Pph 4(2)</strong>: Rp({{ number_format($invoice->pph, 0) }})</p>
            <p><strong>Total</strong>: Rp523,815,714</p>
        </div>
        <div class="content">
            <p>*Pelunasan paling lambat 14 (empat belas) hari setelah diterimanya dokumen penagihan</p>
            <p>*Kwitansi ini dianggap sah apabila pembayaran telah diterima.</p>
        </div>
        <div class="footer">
            <p>Makassar, {{ $formattedDate }}</p>
            <p><strong>PT Sinar Galesong Pratama</strong></p>
            <img src="https://placehold.co/100x50" alt="Stamp with Indonesian currency and official seal" width="100"
                height="50">
            <div class="signature">
                <p>FELIX TANDIAWAN</p>
                <p>Direktur</p>
            </div>
        </div>
    </div>
</body>

</html>
