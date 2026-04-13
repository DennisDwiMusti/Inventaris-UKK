@extends('templates.app')

@section('content')
<div style="padding: 32px; max-width: 1400px; margin: 0 auto; font-family: 'Inter', sans-serif; background-color: #f8fafc; min-height: 100vh;">

    {{-- Notifikasi Session --}}
    @if(session('success'))
        <div style="background: #ecfdf5; color: #065f46; padding: 16px 24px; border-radius: 16px; margin-bottom: 28px; border: 1px solid #a7f3d0; display: flex; align-items: center; gap: 14px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05); animation: slideDown 0.4s ease-out;">
            <div style="background: #10b981; color: white; width: 32px; height: 32px; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                <i class="fas fa-check" style="font-size: 0.9rem;"></i>
            </div>
            <span style="font-weight: 600; font-size: 0.95rem;">{{ session('success') }}</span>
        </div>
    @endif

    {{-- Header Section --}}
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 40px;">
        <div>
            <div style="display: flex; align-items: center; gap: 16px; margin-bottom: 10px;">
                <h2 style="color: #1e293b; font-size: 2.25rem; font-weight: 900; margin: 0; letter-spacing: -0.05em;">Log Peminjaman</h2>
                <div style="background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%); color: white; padding: 6px 18px; border-radius: 99px; font-size: 0.75rem; font-weight: 800; text-transform: uppercase; letter-spacing: 0.05em; box-shadow: 0 10px 15px -3px rgba(79, 70, 229, 0.3);">
                    {{ $lendings->count() }} Records
                </div>
            </div>
            <p style="color: #64748b; font-size: 1.05rem; margin: 0; max-width: 500px; line-height: 1.6;">Kelola alur distribusi aset sekolah dengan sistem pencatatan otomatis dan struk digital.</p>
        </div>

        <div style="display: flex; gap: 14px; align-items: center;">
            <form action="{{ route('lendings.index') }}" method="GET" style="margin: 0;">
                <select name="filter" onchange="this.form.submit()" style="padding: 12px 20px; border-radius: 12px; border: 1px solid #e2e8f0; outline: none; background: white; color: #475569; font-weight: 700; font-size: 0.9rem; cursor: pointer; transition: all 0.2s; box-shadow: 0 1px 3px rgba(0,0,0,0.05);">
                    <option value="">📅 Semua Waktu</option>
                    <option value="day" {{ request('filter') == 'day' ? 'selected' : '' }}>Hari Ini</option>
                    <option value="week" {{ request('filter') == 'week' ? 'selected' : '' }}>Minggu Ini</option>
                    <option value="month" {{ request('filter') == 'month' ? 'selected' : '' }}>Bulan Ini</option>
                </select>
            </form>

            <a href="{{ route('lendings.export') }}" style="background: white; color: #1e293b; border: 1px solid #e2e8f0; text-decoration: none; padding: 12px 24px; border-radius: 12px; font-weight: 700; font-size: 0.9rem; display: inline-flex; align-items: center; gap: 10px; transition: all 0.2s;">
                <i class="fas fa-file-excel" style="color: #16a34a; font-size: 1.1rem;"></i> Export
            </a>

            <a href="{{ route('lendings.create') }}" style="background: #4f46e5; color: white; text-decoration: none; padding: 12px 28px; border-radius: 12px; font-weight: 700; font-size: 0.9rem; display: inline-flex; align-items: center; gap: 10px; box-shadow: 0 10px 15px -3px rgba(79, 70, 229, 0.3); transition: all 0.3s;" onmouseover="this.style.transform='translateY(-2px)'" onmouseout="this.style.transform='translateY(0)'">
                <i class="fas fa-plus"></i> Pinjam Baru
            </a>
        </div>
    </div>

    {{-- Table Section --}}
    <div style="background: white; border-radius: 24px; border: 1px solid #e2e8f0; box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.05); overflow: hidden;">
        <table style="width: 100%; border-collapse: collapse; text-align: left;">
            <thead>
                <tr style="background-color: #f8fafc; border-bottom: 2px solid #f1f5f9;">
                    <th style="padding: 20px 24px; font-weight: 700; color: #64748b; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.05em; width: 60px;">ID</th>
                    <th style="padding: 20px 24px; font-weight: 700; color: #64748b; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.05em;">Informasi Barang</th>
                    <th style="padding: 20px 24px; font-weight: 700; color: #64748b; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.05em;">Peminjam</th>
                    <th style="padding: 20px 24px; font-weight: 700; color: #64748b; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.05em;">Detail Penggunaan</th>
                    <th style="padding: 20px 24px; font-weight: 700; color: #64748b; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.05em;">Waktu</th>
                    <th style="padding: 20px 24px; font-weight: 700; color: #64748b; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.05em; text-align: center;">Status</th>
                    <th style="padding: 20px 24px; font-weight: 700; color: #64748b; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.05em; text-align: center;">Tindakan</th>
                </tr>
            </thead>
            <tbody style="color: #334155;">
                @forelse ($lendings as $index => $lending)
                    <tr style="border-bottom: 1px solid #f1f5f9; transition: all 0.2s;" onmouseover="this.style.backgroundColor='#f9fafb'" onmouseout="this.style.backgroundColor='transparent'">
                        <td style="padding: 20px 24px; font-size: 0.85rem; color: #94a3b8; font-weight: 700;">#{{ $index + 1 }}</td>
                        <td style="padding: 20px 24px;">
                            <div style="display: flex; flex-direction: column; gap: 4px;">
                                <span style="font-weight: 800; color: #1e293b; font-size: 1rem;">{{ $lending->item->name }}</span>
                                <div style="display: flex; align-items: center; gap: 6px;">
                                    <span style="background: #eef2ff; color: #4f46e5; padding: 2px 10px; border-radius: 6px; font-size: 0.75rem; font-weight: 700; border: 1px solid #e0e7ff;">{{ $lending->total_items }} Unit</span>
                                </div>
                            </div>
                        </td>
                        <td style="padding: 20px 24px;">
                            <div style="display: flex; align-items: center; gap: 10px;">
                                <div style="width: 32px; height: 32px; background: #f1f5f9; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #64748b; font-weight: 800; font-size: 0.8rem;">
                                    {{ substr($lending->name, 0, 1) }}
                                </div>
                                <span style="font-weight: 700; color: #334155; font-size: 0.95rem;">{{ $lending->name }}</span>
                            </div>
                        </td>
                        <td style="padding: 20px 24px;">
                            <p style="font-size: 0.85rem; color: #64748b; margin: 0; line-height: 1.5; font-style: italic;">"{{ Str::limit($lending->keterangan, 40) }}"</p>
                        </td>
                        <td style="padding: 20px 24px;">
                            <div style="display: flex; flex-direction: column;">
                                <span style="font-size: 0.9rem; color: #1e293b; font-weight: 700;">{{ \Carbon\Carbon::parse($lending->date)->translatedFormat('d M Y') }}</span>
                                <span style="font-size: 0.75rem; color: #94a3b8;">{{ \Carbon\Carbon::parse($lending->date)->format('H:i') }} WIB</span>
                            </div>
                        </td>
                        <td style="padding: 20px 24px; text-align: center;">
                            @if($lending->return_date)
                                <div style="display: inline-flex; align-items: center; gap: 6px; background: #f0fdf4; color: #16a34a; padding: 6px 14px; border-radius: 99px; font-size: 0.75rem; font-weight: 800; border: 1px solid #bbf7d0;">
                                    <span style="width: 6px; height: 6px; background: #16a34a; border-radius: 50%;"></span>
                                    DIKEMBALIKAN
                                </div>
                            @else
                                <div style="display: inline-flex; align-items: center; gap: 6px; background: #fff7ed; color: #ea580c; padding: 6px 14px; border-radius: 99px; font-size: 0.75rem; font-weight: 800; border: 1px solid #ffedd5;">
                                    <span style="width: 6px; height: 6px; background: #ea580c; border-radius: 50%; animation: pulse 2s infinite;"></span>
                                    BELUM KEMBALI
                                </div>
                            @endif
                        </td>
                        <td style="padding: 20px 24px; text-align: center;">
                            <div style="display: flex; justify-content: center; gap: 10px; align-items: center;">
                                @if(!$lending->return_date)
                                    <form action="{{ route('lendings.confirm', $lending->id) }}" method="GET" style="margin: 0; display: flex; align-items: center; gap: 8px; background: #f8fafc; padding: 6px 10px; border-radius: 12px; border: 1px solid #e2e8f0;">
                                        <div style="display: flex; flex-direction: column; align-items: flex-start;">
                                            <label style="font-size: 0.6rem; font-weight: 800; color: #94a3b8; text-transform: uppercase;">Rusak:</label>
                                            <input type="number" name="broken_items" value="0" min="0" max="{{ $lending->total_items }}" style="width: 45px; border: none; background: transparent; font-weight: 800; color: #ef4444; outline: none; padding: 0;">
                                        </div>
                                        <button type="submit" style="background: #f59e0b; color: white; border: none; padding: 10px 16px; border-radius: 10px; font-weight: 800; font-size: 0.75rem; cursor: pointer; transition: all 0.2s; box-shadow: 0 4px 6px -1px rgba(245, 158, 11, 0.2);">
                                            KEMBALIKAN
                                        </button>
                                    </form>
                                @else
                                    <span style="font-size: 0.75rem; color: #94a3b8; font-weight: 600;">Selesai pada {{ \Carbon\Carbon::parse($lending->return_date)->format('d/m/y') }}</span>
                                @endif

                                <form action="{{ route('lendings.destroy', $lending->id) }}" method="POST" onsubmit="return confirm('Hapus permanen log ini?');" style="margin: 0;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" style="background: white; color: #94a3b8; border: 1px solid #e2e8f0; width: 38px; height: 38px; border-radius: 10px; display: flex; align-items: center; justify-content: center; cursor: pointer; transition: all 0.2s;" onmouseover="this.style.color='#ef4444'; this.style.borderColor='#fecaca'; this.style.backgroundColor='#fef2f2'" onmouseout="this.style.color='#94a3b8'; this.style.borderColor='#e2e8f0'; this.style.backgroundColor='white'">
                                        <i class="far fa-trash-alt"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" style="padding: 100px 24px; text-align: center;">
                            <img src="https://illustrations.popsy.co/slate/empty-box.svg" alt="empty" style="width: 150px; margin-bottom: 20px;">
                            <p style="color: #94a3b8; font-weight: 600; font-size: 1.1rem; margin: 0;">Oops! Belum ada riwayat peminjaman.</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{-- Footer Tabel --}}
        <div style="padding: 20px 24px; background: #f8fafc; border-top: 1px solid #f1f5f9; display: flex; justify-content: space-between; align-items: center;">
            <span style="font-size: 0.85rem; color: #64748b; font-weight: 600;">Menampilkan {{ $lendings->count() }} log aktivitas</span>
            <div style="display: flex; gap: 8px;">
                {{-- Pagination bisa ditaruh di sini jika ada --}}
            </div>
        </div>
    </div>
</div>

<style>
    @keyframes pulse {
        0% { opacity: 1; transform: scale(1); }
        50% { opacity: 0.5; transform: scale(1.2); }
        100% { opacity: 1; transform: scale(1); }
    }
    @keyframes slideDown {
        from { transform: translateY(-10px); opacity: 0; }
        to { transform: translateY(0); opacity: 1; }
    }
    tr:hover td { color: #1e293b !important; }
</style>
@endsection
