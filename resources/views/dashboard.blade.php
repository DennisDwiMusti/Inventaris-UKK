@extends('templates.app')

@section('content')
<div style="padding: 24px; max-width: 1200px; margin: 0 auto; font-family: 'Inter', sans-serif;">

    <div style="margin-bottom: 32px;">
        <h2 style="color: #0f172a; font-size: 1.85rem; font-weight: 800; margin: 0 0 8px 0; letter-spacing: -0.025em;">Ringkasan Sistem</h2>
        <p style="color: #64748b; font-size: 1rem; margin: 0;">Pantau ketersediaan barang dan riwayat transaksi peminjaman hari ini.</p>
    </div>

    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 24px; margin-bottom: 40px;">

        <div style="background: white; border-radius: 20px; padding: 24px; border: 1px solid #e2e8f0; box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.05); display: flex; align-items: center; gap: 20px; transition: transform 0.2s;" onmouseover="this.style.transform='translateY(-5px)'" onmouseout="this.style.transform='translateY(0)'">
            <div style="width: 64px; height: 64px; border-radius: 16px; background-color: #ecfdf5; color: #10b981; display: flex; justify-content: center; align-items: center; font-size: 1.75rem;">
                <i class="fas fa-box-open"></i>
            </div>
            <div>
                <p style="color: #64748b; font-size: 0.85rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; margin: 0 0 4px 0;">Stok Tersedia</p>
                <h3 style="color: #0f172a; font-size: 1.75rem; font-weight: 800; margin: 0;">{{ number_format($availableItems) }} <span style="font-size: 1rem; color: #94a3b8; font-weight: 600;">Unit</span></h3>
            </div>
        </div>

        <div style="background: white; border-radius: 20px; padding: 24px; border: 1px solid #e2e8f0; box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.05); display: flex; align-items: center; gap: 20px; transition: transform 0.2s;" onmouseover="this.style.transform='translateY(-5px)'" onmouseout="this.style.transform='translateY(0)'">
            <div style="width: 64px; height: 64px; border-radius: 16px; background-color: #e0e7ff; color: #4f46e5; display: flex; justify-content: center; align-items: center; font-size: 1.75rem;">
                <i class="fas fa-hand-holding-heart"></i>
            </div>
            <div>
                <p style="color: #64748b; font-size: 0.85rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; margin: 0 0 4px 0;">Total Transaksi</p>
                <h3 style="color: #0f172a; font-size: 1.75rem; font-weight: 800; margin: 0;">{{ number_format($totalLendings) }} <span style="font-size: 1rem; color: #94a3b8; font-weight: 600;">Data</span></h3>
            </div>
        </div>

        <div style="background: white; border-radius: 20px; padding: 24px; border: 1px solid #e2e8f0; box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.05); display: flex; align-items: center; gap: 20px; transition: transform 0.2s;" onmouseover="this.style.transform='translateY(-5px)'" onmouseout="this.style.transform='translateY(0)'">
            <div style="width: 64px; height: 64px; border-radius: 16px; background-color: #f3e8ff; color: #7c3aed; display: flex; justify-content: center; align-items: center; font-size: 1.75rem;">
                <i class="fas fa-layer-group"></i>
            </div>
            <div>
                <p style="color: #64748b; font-size: 0.85rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; margin: 0 0 4px 0;">Jenis Barang</p>
                <h3 style="color: #0f172a; font-size: 1.75rem; font-weight: 800; margin: 0;">{{ number_format($totalItemTypes) }} <span style="font-size: 1rem; color: #94a3b8; font-weight: 600;">Kategori</span></h3>
            </div>
        </div>

        <div style="background: white; border-radius: 20px; padding: 24px; border: 1px solid #e2e8f0; box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.05); display: flex; align-items: center; gap: 20px; transition: transform 0.2s;" onmouseover="this.style.transform='translateY(-5px)'" onmouseout="this.style.transform='translateY(0)'">
            <div style="width: 64px; height: 64px; border-radius: 16px; background-color: #fee2e2; color: #ef4444; display: flex; justify-content: center; align-items: center; font-size: 1.75rem;">
                <i class="fas fa-tools"></i>
            </div>
            <div>
                <p style="color: #64748b; font-size: 0.85rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; margin: 0 0 4px 0;">Barang Rusak</p>
                <h3 style="color: #0f172a; font-size: 1.75rem; font-weight: 800; margin: 0;">{{ number_format($totalRepair) }} <span style="font-size: 1rem; color: #94a3b8; font-weight: 600;">Unit</span></h3>
            </div>
        </div>

    </div>

    <div style="background: linear-gradient(135deg, #4f46e5 0%, #3b82f6 100%); border-radius: 24px; padding: 40px; color: white; display: flex; justify-content: space-between; align-items: center; box-shadow: 0 20px 25px -5px rgba(79, 70, 229, 0.3);">
        <div>
            <h3 style="font-size: 1.5rem; font-weight: 800; margin: 0 0 10px 0;">Kelola Inventaris dengan Mudah</h3>
            <p style="margin: 0; opacity: 0.9; max-width: 500px; line-height: 1.5;">Akses cepat untuk menambahkan data barang baru atau mencatat transaksi peminjaman terkini.</p>
        </div>
        <div style="display: flex; gap: 16px;">
            @if(Auth::user()->role == 'operator')
            <a href="{{ route('lendings.create') }}" style="background: white; color: #4f46e5; text-decoration: none; padding: 12px 24px; border-radius: 12px; font-weight: 700; display: inline-flex; align-items: center; gap: 8px; transition: transform 0.2s;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                <i class="fas fa-plus"></i> Pinjam Barang
            </a>
            @endif
            <a href="{{ route('items.index') }}" style="background: rgba(255,255,255,0.2); backdrop-filter: blur(10px); color: white; text-decoration: none; padding: 12px 24px; border-radius: 12px; font-weight: 700; border: 1px solid rgba(255,255,255,0.3); display: inline-flex; align-items: center; gap: 8px; transition: transform 0.2s;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                <i class="fas fa-box"></i> Lihat Stok
            </a>
        </div>
    </div>

</div>
@endsection
