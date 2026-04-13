@extends('templates.app')

@section('content')
<div style="padding: 24px; max-width: 600px; margin: 0 auto; font-family: 'Inter', sans-serif;">
    <div style="background: white; padding: 40px; border-radius: 20px; box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.05); border: 1px solid #e2e8f0;">
        <h2 style="font-weight: 800; color: #0f172a; margin-bottom: 8px;">Konfirmasi Pengembalian</h2>
        <p style="color: #64748b; margin-bottom: 24px;">Barang: <b>{{ $lending->item->name }}</b> ({{ $lending->total_items }} Unit)</p>

        <form action="{{ route('lendings.update', $lending->id) }}" method="POST" id="signature-form">
            @csrf
            @method('PATCH')

            {{-- 1. Input Barang Rusak --}}
<div style="margin-bottom: 24px;">
    <label style="display: block; font-weight: 700; margin-bottom: 8px; font-size: 0.9rem;">Jumlah Barang Rusak (Jika ada):</label>
    {{-- Ambil variabel $broken_items dari controller --}}
    <input type="number" name="broken_items" value="{{ $broken_items }}" min="0" max="{{ $lending->total_items }}"
           style="width: 100%; padding: 12px; border-radius: 10px; border: 1px solid #e2e8f0; font-size: 1rem; outline: none; background: #f8fafc;">
</div>

            {{-- 2. Tanda Tangan Peminjam --}}
            <div style="margin-bottom: 24px;">
                <label style="display: block; font-weight: 700; margin-bottom: 8px; font-size: 0.9rem;">Tanda Tangan Peminjam ({{ $lending->name }}):</label>
                <div style="border: 2px dashed #cbd5e1; border-radius: 12px; background: #ffffff; position: relative;">
                    {{-- Berikan width dan height eksplisit pada atribut canvas --}}
                    <canvas id="pad-peminjam" width="520" height="150" style="width: 100%; height: 150px; cursor: crosshair; touch-action: none;"></canvas>
                </div>
                <button type="button" id="clear-peminjam" style="margin-top: 8px; background: none; border: none; color: #ef4444; font-weight: 600; cursor: pointer; font-size: 0.8rem;">Hapus Tanda Tangan</button>
            </div>

            {{-- 3. Tanda Tangan Penerima (Petugas) --}}
            <div style="margin-bottom: 32px;">
                <label style="display: block; font-weight: 700; margin-bottom: 8px; font-size: 0.9rem;">Tanda Tangan Petugas ({{ Auth::user()->name }}):</label>
                <div style="border: 2px dashed #cbd5e1; border-radius: 12px; background: #ffffff; position: relative;">
                    <canvas id="pad-petugas" width="520" height="150" style="width: 100%; height: 150px; cursor: crosshair; touch-action: none;"></canvas>
                </div>
                <button type="button" id="clear-petugas" style="margin-top: 8px; background: none; border: none; color: #ef4444; font-weight: 600; cursor: pointer; font-size: 0.8rem;">Hapus Tanda Tangan</button>
            </div>

            <input type="hidden" name="signature_peminjam" id="input-peminjam">
            <input type="hidden" name="signature_petugas" id="input-petugas">

            <div style="display: flex; flex-direction: column; gap: 12px;">
                {{-- Tombol Utama --}}
                <button type="submit" style="width: 100%; background: #4f46e5; color: white; border: none; padding: 14px; border-radius: 12px; font-weight: 700; cursor: pointer; transition: all 0.2s; display: flex; align-items: center; justify-content: center; gap: 8px;">
                    <i class="fas fa-file-download"></i> Simpan & Cetak Struk
                </button>

                <div style="display: flex; gap: 12px; width: 100%;">
                    {{-- Tombol Lanjutkan ke Daftar Peminjaman --}}
                    <a href="{{ route('lendings.index') }}"
                       style="flex: 1; background: #f1f5f9; color: #475569; text-decoration: none; padding: 12px; border-radius: 10px; font-weight: 600; text-align: center; font-size: 0.9rem; transition: all 0.2s; border: 1px solid #e2e8f0; display: flex; align-items: center; justify-content: center; gap: 8px;">
                        <i class="fas fa-arrow-right"></i> Lanjutkan ke Daftar
                    </a>

                    {{-- Tombol Batal --}}
                    <a href="{{ route('lendings.index') }}"
                       style="flex: 1; background: white; color: #ef4444; text-decoration: none; padding: 12px; border-radius: 10px; font-weight: 600; text-align: center; font-size: 0.9rem; border: 1px solid #fee2e2; transition: all 0.2s;">
                        Batal
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const canvasPeminjam = document.getElementById('pad-peminjam');
        const canvasPetugas = document.getElementById('pad-petugas');

        const padPeminjam = new SignaturePad(canvasPeminjam);
        const padPetugas = new SignaturePad(canvasPetugas);

        // Tombol hapus
        document.getElementById('clear-peminjam').addEventListener('click', () => padPeminjam.clear());
        document.getElementById('clear-petugas').addEventListener('click', () => padPetugas.clear());

        const form = document.getElementById('signature-form');
        form.addEventListener('submit', function(e) {
            // Cek apakah pad benar-benar kosong
            if (padPeminjam.isEmpty() || padPetugas.isEmpty()) {
                e.preventDefault();
                alert("Harap lengkapi kedua tanda tangan!");
                return false;
            }

            // Masukkan data base64 ke hidden input
            document.getElementById('input-peminjam').value = padPeminjam.toDataURL();
            document.getElementById('input-petugas').value = padPetugas.toDataURL();
        });

        // Fungsi resize yang lebih aman
        function resizeCanvas() {
            const ratio = Math.max(window.devicePixelRatio || 1, 1);

            [canvasPeminjam, canvasPetugas].forEach(canvas => {
                const width = canvas.offsetWidth;
                const height = canvas.offsetHeight;
                canvas.width = width * ratio;
                canvas.height = height * ratio;
                canvas.getContext("2d").scale(ratio, ratio);
            });

            padPeminjam.clear();
            padPetugas.clear();
        }

        window.addEventListener("resize", resizeCanvas);
        // Jangan panggil resizeCanvas() langsung jika menggunakan width/height atribut manual
        // Agar tidak menghapus coretan saat halaman dimuat
    });
</script>
@endsection
