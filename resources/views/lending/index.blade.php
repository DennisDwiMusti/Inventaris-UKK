@extends('templates.app')

@section('content')
<div style="padding: 24px; max-width: 1300px; margin: 0 auto; font-family: 'Inter', sans-serif;">

    @if(session('success'))
        <div style="background-color: #ecfdf5; color: #065f46; padding: 16px 20px; border-radius: 12px; margin-bottom: 24px; border: 1px solid #a7f3d0; display: flex; align-items: center; gap: 12px; animation: fadeIn 0.3s ease;">
            <i class="fas fa-check-circle" style="font-size: 1.2rem;"></i>
            <span style="font-weight: 600;">{{ session('success') }}</span>
        </div>
    @endif

    @if(session('warning'))
        <div style="background-color: #fef3c7; color: #92400e; padding: 16px 20px; border-radius: 12px; margin-bottom: 24px; border: 1px solid #fde68a; display: flex; align-items: center; gap: 12px; animation: fadeIn 0.3s ease;">
            <span style="font-weight: 500;">{{ session('warning') }}</span>
        </div>
    @endif

    <div style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 32px;">
        <div>
            <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 8px;">
                <h2 style="color: #0f172a; font-size: 1.85rem; font-weight: 800; margin: 0; letter-spacing: -0.025em;">Daftar Peminjaman</h2>
                <span style="background: #eef2ff; color: #4f46e5; padding: 6px 14px; border-radius: 99px; font-size: 0.75rem; font-weight: 700; text-transform: uppercase; border: 1px solid #e0e7ff;">
                    Lending Logs
                </span>
            </div>
            <p style="color: #64748b; font-size: 1rem; margin: 0;">Monitor penggunaan aset sekolah dan kelola tenggat waktu pengembalian barang.</p>
        </div>

        <div style="display: flex; gap: 12px;">
            <a href="{{ route('lendings.export') }}" style="background-color: #ffffff; color: #334155; border: 1px solid #e2e8f0; text-decoration: none; padding: 10px 20px; border-radius: 10px; font-weight: 600; font-size: 0.9rem; display: inline-flex; align-items: center; gap: 8px; transition: all 0.2s;">
                <i class="fas fa-file-excel" style="color: #16a34a;"></i> Export Excel
            </a>

            <a href="{{ route('lendings.create') }}"
               style="background-color: #4f46e5; color: white; text-decoration: none; padding: 10px 22px; border-radius: 10px; font-weight: 600; font-size: 0.9rem; display: inline-flex; align-items: center; gap: 8px; box-shadow: 0 4px 12px rgba(79, 70, 229, 0.25); transition: all 0.2s;">
                <i class="fas fa-plus"></i> Pinjam Barang
            </a>
        </div>
    </div>

    <div style="background: white; border-radius: 20px; border: 1px solid #e2e8f0; box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.05); overflow: hidden;">
        <table style="width: 100%; border-collapse: collapse; text-align: left;">
            <thead>
                <tr style="background-color: #f8fafc;">
                    <th style="padding: 18px 20px; font-weight: 700; color: #475569; font-size: 0.8rem; text-transform: uppercase; border-bottom: 2px solid #f1f5f9; width: 50px;">#</th>
                    <th style="padding: 18px 20px; font-weight: 700; color: #475569; font-size: 0.8rem; text-transform: uppercase; border-bottom: 2px solid #f1f5f9; width: 200px;">Barang</th>
                    <th style="padding: 18px 20px; font-weight: 700; color: #475569; font-size: 0.8rem; text-transform: uppercase; border-bottom: 2px solid #f1f5f9; width: 150px;">Peminjam</th>
                    <th style="padding: 18px 20px; font-weight: 700; color: #475569; font-size: 0.8rem; text-transform: uppercase; border-bottom: 2px solid #f1f5f9; width: 250px;">Keterangan</th>
                    <th style="padding: 18px 20px; font-weight: 700; color: #475569; font-size: 0.8rem; text-transform: uppercase; border-bottom: 2px solid #f1f5f9; width: 130px;">Tgl Pinjam</th>
                    <th style="padding: 18px 20px; font-weight: 700; color: #475569; font-size: 0.8rem; text-transform: uppercase; border-bottom: 2px solid #f1f5f9; width: 150px; text-align: center;">Status</th>
                    <th style="padding: 18px 20px; font-weight: 700; color: #475569; font-size: 0.8rem; text-transform: uppercase; border-bottom: 2px solid #f1f5f9; text-align: center;">Aksi</th>
                </tr>
            </thead>
            <tbody style="color: #334155;">
                @forelse ($lendings as $index => $lending)
                    <tr style="border-bottom: 1px solid #f1f5f9; transition: all 0.2s;" onmouseover="this.style.backgroundColor='#f9fafb'" onmouseout="this.style.backgroundColor='transparent'">
                        <td style="padding: 16px 20px; font-size: 0.9rem; color: #94a3b8; font-weight: 500;">{{ $index + 1 }}</td>
                        <td style="padding: 16px 20px;">
                            <div style="display: flex; flex-direction: column;">
                                <span style="font-weight: 700; color: #1e293b; font-size: 0.95rem;">{{ $lending->item->name }}</span>
                                <span style="font-size: 0.8rem; color: #6366f1; font-weight: 600;">{{ $lending->total_items }} Unit</span>
                            </div>
                        </td>
                        <td style="padding: 16px 20px;">
                            <span style="font-weight: 600; color: #1e293b; font-size: 0.9rem;">{{ $lending->name }}</span>
                        </td>
                        <td style="padding: 16px 20px;">
                            <div style="font-size: 0.85rem; color: #64748b; line-height: 1.5; word-break: break-word; white-space: normal;">
                                {{ $lending->keterangan }}
                            </div>
                        </td>
                        <td style="padding: 16px 20px; font-size: 0.85rem; color: #475569; font-weight: 500;">
                            {{ \Carbon\Carbon::parse($lending->date)->translatedFormat('d M Y') }}
                        </td>
                        <td style="padding: 16px 20px; text-align: center;">
                            @if($lending->return_date)
                                <div style="display: inline-flex; flex-direction: column; align-items: center; gap: 2px;">
                                    <span style="background: #ecfdf5; color: #059669; padding: 4px 10px; border-radius: 6px; font-size: 0.65rem; font-weight: 800;">RETURNED</span>
                                    <span style="font-size: 0.7rem; color: #94a3b8;">{{ \Carbon\Carbon::parse($lending->return_date)->translatedFormat('d/m/y') }}</span>
                                </div>
                            @else
                                <span style="background: #fff7ed; color: #c2410c; border: 1px solid #ffedd5; padding: 4px 12px; border-radius: 6px; font-size: 0.65rem; font-weight: 800;">
                                    NOT RETURNED
                                </span>
                            @endif
                        </td>
                        <td style="padding: 16px 20px; text-align: center;">
                            <div style="display: flex; justify-content: center; gap: 6px;">
                                @if(!$lending->return_date)
                                    <form action="{{ route('lendings.update', $lending->id) }}" method="POST" style="margin: 0;">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" style="background-color: #fbbf24; color: #78350f; border: none; padding: 6px 12px; border-radius: 8px; font-weight: 700; font-size: 0.75rem; cursor: pointer; white-space: nowrap;">
                                            Dikembalikan
                                        </button>
                                    </form>
                                @endif
                                <form action="{{ route('lendings.destroy', $lending->id) }}" method="POST" onsubmit="return confirm('Hapus data?');" style="margin: 0;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" style="background-color: #ffffff; color: #ef4444; border: 1px solid #fee2e2; padding: 6px 12px; border-radius: 8px; font-weight: 700; font-size: 0.75rem; cursor: pointer;">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" style="padding: 80px 24px; text-align: center;">
                            <p style="color: #94a3b8; font-weight: 500; margin: 0;">Belum ada riwayat peminjaman barang.</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div style="padding: 16px 24px; background: #f8fafc; border-top: 1px solid #f1f5f9; display: flex; justify-content: space-between; align-items: center;">
            <span style="font-size: 0.75rem; color: #94a3b8; font-weight: 500;">TOTAL: {{ $lendings->count() }} DATA</span>
        </div>
    </div>
</div>
@endsection
