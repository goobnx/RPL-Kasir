<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Struk Pembayaran</title>
    <style>
        body {
            font-family: Tahoma;
            font-size: 8pt;
        }

        #tabel {
            font-size: 15px;
            border-collapse: collapse;
        }
        #tabel td {
            padding-left: 5px;
            border: 1px solid black;
        }
    </style>
</head>
<body onload="window.print()">
    <center>
        <table style='width: 550px; font-size: 8pt; font-family: calibri; border-collapse: collapse;' border='0'>
            <tr>
                <td width='70%' align='left' style='padding-right: 80px; vertical-align: top'>
                    <span style='font-size: 12pt'><b>TOKO SERBAGUNA</b></span><br>
                    Jl. dr. Soebandi No. 31, Jember<br>
                    Nomor Telepon : 081233566002
                </td>
                <td style='vertical-align: top' width='30%' align='left'>
                    <b><span style='font-size: 12pt'>STRUK PESANAN</span></b><br>
                    ID Pesanan : <br>
                    Tanggal Pemesanan : <br>
                </td>
            </tr>
        </table>
        <table style='width: 550px; font-size: 8pt; font-family: calibri; border-collapse: collapse;' border='0'>
            <tr>
                <td width='70%' align='left' style='padding-right: 80px; vertical-align: top'>
                </td>
                <td style='vertical-align: top' width='30%' align='left'>
                    Nama Pelanggan : <br>
                    Alamat : <br>
                    Nomor Telepon : <br><br>
                    <b>Total Item : </b>
                </td>
            </tr>
        </table>
        <table cellspacing='0' style='width: 550px; font-size: 8pt; font-family: calibri; border-collapse: collapse;' border='1'>
            <tr align='center'>
                <td width='12%'>ID Produk</td>
                <td width='28%'>Nama Produk</td>
                <td width='20%'>Harga Satuan</td>
                <td width='10%'>Jumlah</td>
                <td width='30%'>Total Harga</td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td style='text-align:right'></td>
            </tr>
            <tr>
                <td colspan='4'>
                    <div style='text-align:right'>Total Harga : </div>
                    <div style='text-align:right'>Tunai : </div>
                    <div style='text-align:right'>Kembali : </div>
                </td>
                <td style='text-align:right'></td>
            </tr>
        </table>
    </center>
</body>
</html>
