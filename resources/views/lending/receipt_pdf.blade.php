<!DOCTYPE html>
<html>
<head>
    <title>Struk Pengembalian</title>
    <style>
        body { font-family: sans-serif; padding: 20px; color: #333; }
        .header { text-align: center; border-bottom: 2px solid #333; padding-bottom: 10px; margin-bottom: 20px; }
        .header h2 { margin: 0; text-transform: uppercase; }
        .header p { margin: 5px 0 0 0; font-size: 0.9rem; color: #666; }

        .content { margin-top: 20px; }
        .table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        .table th, .table td { border: 1px solid #ddd; padding: 10px; text-align: left; font-size: 0.9rem; }
        .table th { background-color: #f9fafb; width: 35%; }

        /* Container Tanda Tangan */
        .signature-container {
            margin-top: 50px;
            width: 100%;
        }
        .sig-box {
            width: 45%;
            text-align: center;
            display: inline-block;
            vertical-align: top;
        }
        .sig-space {
            height: 100px;
            margin: 10px 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .sig-name {
            font-weight: bold;
            text-decoration: underline;
            margin-top: 5px;
            font-size: 0.9rem;
        }
        .sig-label {
            font-size: 0.85rem;
            margin-bottom: 5px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>Struk Pengembalian Barang</h2>
        <p>SMK Wikrama Bogor</p>
    </div>

    <div class="content">
        <p style="font-size: 0.9rem;">Berikut adalah rincian pengembalian aset sekolah:</p>
        <table class="table">
            <tr><th>Nama Peminjam</th><td>{{ $lending->name }}</td></tr>
            <tr><th>Nama Barang</th><td>{{ $lending->item->name }}</td></tr>
            <tr><th>Jumlah Unit</th><td>{{ $lending->total_items }} Unit</td></tr>
            <tr><th>Kondisi Rusak</th><td>{{ $broken_items }} Unit</td></tr>
            <tr><th>Waktu Kembali</th><td>{{ now()->format('d F Y, H:i') }} WIB</td></tr>
        </table>
    </div>

    <div class="signature-container">
        <div class="sig-box" style="float: left;">
            <p class="sig-label">Peminjam,</p>
            <div class="sig-space">
                {{-- Menggunakan variabel signature_peminjam dari controller --}}
                <img src="{{ $signature_peminjam }}" width="150" height="80">
            </div>
            <p class="sig-name">{{ $lending->name }}</p>
        </div>

        <div class="sig-box" style="float: right;">
            <p class="sig-label">Petugas Sarpras,</p>
            <div class="sig-space">
                {{-- Menggunakan variabel signature_petugas dari controller --}}
                <img src="{{ $signature_petugas }}" width="150" height="80">
            </div>
            <p class="sig-name">{{ Auth::user()->name }}</p>
        </div>

        <div style="clear: both;"></div>
    </div>

    <div style="margin-top: 60px; font-size: 0.7rem; color: #999; text-align: center; border-top: 1px dashed #ddd; padding-top: 10px;">
        Dokumen ini sah dan dicetak otomatis oleh Sistem Inventaris SMK Wikrama pada {{ now()->format('d/m/Y H:i') }}
    </div>
</body>
</html>
