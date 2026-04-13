@extends('templates.app')

@section('content')
<div style="padding: 24px; max-width: 1200px; margin: 0 auto; font-family: 'Inter', sans-serif;">

    @if(session('success'))
        <div style="background-color: #ecfdf5; color: #065f46; padding: 16px 20px; border-radius: 12px; margin-bottom: 24px; border: 1px solid #a7f3d0; display: flex; align-items: center; gap: 12px;">
            <i class="fas fa-check-circle"></i>
            <span style="font-weight: 500;">{{ session('success') }}</span>
        </div>
    @endif

    <div style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 32px;">
        <div>
            <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 8px;">
                <h2 style="color: #0f172a; font-size: 1.85rem; font-weight: 800; margin: 0; letter-spacing: -0.025em;">Data Inventaris</h2>
                <span style="background: #f5f3ff; color: #4f46e5; padding: 6px 14px; border-radius: 99px; font-size: 0.75rem; font-weight: 700; text-transform: uppercase; border: 1px solid #ddd6fe;">
                    Total: {{ $items->count() }}
                </span>
            </div>
            <p style="color: #64748b; font-size: 1rem; margin: 0;">Kelola stok barang, pantau perbaikan, dan status peminjaman aset.</p>
        </div>

        <div style="display: flex; gap: 12px;">
            <a href="{{ route('items.export') }}"
               style="background-color: #ffffff; color: #334155; border: 1px solid #e2e8f0; text-decoration: none; padding: 10px 20px; border-radius: 10px; font-weight: 600; font-size: 0.9rem; display: inline-flex; align-items: center; gap: 8px; transition: all 0.2s;">
                <i class="fas fa-file-excel" style="color: #16a34a;"></i> Export Excel
            </a>

            <a href="{{ route('items.create') }}"
               style="background-color: #4f46e5; color: white; text-decoration: none; padding: 10px 22px; border-radius: 10px; font-weight: 600; font-size: 0.9rem; display: inline-flex; align-items: center; gap: 8px; box-shadow: 0 4px 12px rgba(79, 70, 229, 0.25); transition: all 0.2s;">
                <i class="fas fa-plus"></i> Tambah Barang
            </a>
        </div>
    </div>

    <div style="background: white; border-radius: 20px; border: 1px solid #e2e8f0; box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.05); overflow: hidden;">
        <table style="width: 100%; border-collapse: collapse; text-align: left;">
            <thead>
                <tr style="background-color: #ffffff;">
                    <th style="padding: 18px 24px; font-weight: 700; color: #475569; font-size: 0.8rem; text-transform: uppercase; border-bottom: 2px solid #f1f5f9; width: 5%;">#</th>
                    <th style="padding: 18px 24px; font-weight: 700; color: #475569; font-size: 0.8rem; text-transform: uppercase; border-bottom: 2px solid #f1f5f9;">Category</th>
                    <th style="padding: 18px 24px; font-weight: 700; color: #475569; font-size: 0.8rem; text-transform: uppercase; border-bottom: 2px solid #f1f5f9;">Name</th>
                    <th style="padding: 18px 24px; font-weight: 700; color: #475569; font-size: 0.8rem; text-transform: uppercase; border-bottom: 2px solid #f1f5f9; text-align: center;">Total</th>

                    @if(Auth::user()->role == 'admin')
                        <th style="padding: 18px 24px; font-weight: 700; color: #475569; font-size: 0.8rem; text-transform: uppercase; border-bottom: 2px solid #f1f5f9; text-align: center;">Rusak</th>
                        <th style="padding: 18px 24px; font-weight: 700; color: #475569; font-size: 0.8rem; text-transform: uppercase; border-bottom: 2px solid #f1f5f9; text-align: center;">Peminjaman</th>
                        <th style="padding: 18px 24px; font-weight: 700; color: #475569; font-size: 0.8rem; text-transform: uppercase; border-bottom: 2px solid #f1f5f9; text-align: center;">Aksi</th>

                    @else
                        <th style="padding: 18px 24px; font-weight: 700; color: #475569; font-size: 0.8rem; text-transform: uppercase; border-bottom: 2px solid #f1f5f9; text-align: center;">Available</th>
                        <th style="padding: 18px 24px; font-weight: 700; color: #475569; font-size: 0.8rem; text-transform: uppercase; border-bottom: 2px solid #f1f5f9; text-align: center;">Lending Total</th>
                    @endif
                </tr>
            </thead>
            <tbody style="color: #334155;">
                @forelse ($items as $index => $item)
                    <tr style="border-bottom: 1px solid #f1f5f9; transition: all 0.2s;" onmouseover="this.style.backgroundColor='#f9fafb'" onmouseout="this.style.backgroundColor='transparent'">
                        <td style="padding: 20px 24px; font-size: 0.9rem; color: #94a3b8; font-weight: 500;">{{ $index + 1 }}</td>
                        <td style="padding: 20px 24px;">
                            <span style="background: #f1f5f9; color: #475569; padding: 4px 10px; border-radius: 6px; font-size: 0.85rem; font-weight: 600;">
                                {{ $item->category->name }}
                            </span>
                        </td>
                        <td style="padding: 20px 24px;">
                            <span style="font-weight: 600; color: #1e293b; font-size: 0.95rem;">{{ $item->name }}</span>
                        </td>
                        <td style="padding: 20px 24px; text-align: center; font-weight: 700; color: #4f46e5;">{{ $item->total }}</td>

                        @if(Auth::user()->role == 'admin')
                            <td style="padding: 20px 24px; text-align: center;">
                                @if($item->repair > 0)
                                    <span style="color: #ef4444; font-weight: 700;">{{ $item->repair }}</span>
                                @else
                                    <span style="color: #cbd5e1;">-</span>
                                @endif
                            </td>
                            <td style="padding: 20px 24px; text-align: center;">
                                @if($item->lending_id > 0)
                                    <a href="{{ route('lendings.index', ['filter_item' => $item->id]) }}"
                                       title="Lihat detail peminjaman"
                                       style="display: inline-flex; align-items: center; justify-content: center; width: 32px; height: 32px; background: #eff6ff; color: #4f46e5; text-decoration: none; font-weight: 700; border-radius: 8px; border: 1px solid #c7d2fe; transition: all 0.2s;">
                                        {{ $item->lending_id }}
                                    </a>
                                @else
                                    <span style="color: #94a3b8; font-weight: 600;">0</span>
                                @endif
                            </td>
                            <td style="padding: 20px 24px; display: flex; justify-content: center; gap: 8px;">
                                <a href="{{ route('items.edit', $item->id) }}"
                                   style="background-color: #6366f1; color: white; text-decoration: none; padding: 8px 18px; border-radius: 8px; font-weight: 600; font-size: 0.85rem;">
                                    <i class="far fa-edit"></i> Edit
                                </a>
                            </td>

                        @else
                            @php
                                $available = $item->total - $item->repair - $item->lending_id;
                            @endphp
                            <td style="padding: 20px 24px; text-align: center; font-weight: 700; color: #10b981;">
                                {{ $available }}
                            </td>
                            <td style="padding: 20px 24px; text-align: center; font-weight: 600; color: #64748b;">
                                {{ $item->lending_id }}
                            </td>
                        @endif
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" style="padding: 60px; text-align: center; color: #94a3b8;">Belum ada data barang.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
