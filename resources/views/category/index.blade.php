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
                <h2 style="color: #0f172a; font-size: 1.85rem; font-weight: 800; margin: 0; letter-spacing: -0.025em;">Kategori Barang</h2>
                <span style="background: #f5f3ff; color: #4f46e5; padding: 6px 14px; border-radius: 99px; font-size: 0.75rem; font-weight: 700; text-transform: uppercase; border: 1px solid #ddd6fe;">
                    Total: {{ $categories->count() }}
                </span>
            </div>
            <p style="color: #64748b; font-size: 1rem; margin: 0;">Kelola pengelompokan barang berdasarkan divisi dan fungsi.</p>
        </div>

        <a href="{{ route('categories.create') }}"
           style="background-color: #4f46e5; color: white; text-decoration: none; padding: 10px 22px; border-radius: 10px; font-weight: 600; font-size: 0.9rem; display: inline-flex; align-items: center; gap: 8px; box-shadow: 0 4px 12px rgba(79, 70, 229, 0.25); transition: all 0.2s;">
            <i class="fas fa-plus"></i> Tambah Kategori
        </a>
    </div>

    <div style="background: white; border-radius: 20px; border: 1px solid #e2e8f0; box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.05); overflow: hidden;">
        <table style="width: 100%; border-collapse: collapse; text-align: left;">
            <thead>
                <tr style="background-color: #ffffff;">
                    <th style="padding: 18px 24px; font-weight: 700; color: #475569; font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.05em; border-bottom: 2px solid #f1f5f9; width: 5%;">No</th>
                    <th style="padding: 18px 24px; font-weight: 700; color: #475569; font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.05em; border-bottom: 2px solid #f1f5f9;">Nama Kategori</th>
                    <th style="padding: 18px 24px; font-weight: 700; color: #475569; font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.05em; border-bottom: 2px solid #f1f5f9;">Divisi PJ</th>
                    <th style="padding: 18px 24px; font-weight: 700; color: #475569; font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.05em; border-bottom: 2px solid #f1f5f9;">Tipe</th>
                    <th style="padding: 18px 24px; font-weight: 700; color: #475569; font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.05em; border-bottom: 2px solid #f1f5f9; text-align: center;">Tindakan</th>
                </tr>
            </thead>
            <tbody style="color: #334155;">
                @forelse ($categories as $index => $category)
                    <tr style="border-bottom: 1px solid #f1f5f9; transition: all 0.2s;" onmouseover="this.style.backgroundColor='#f9fafb'" onmouseout="this.style.backgroundColor='transparent'">
                        <td style="padding: 20px 24px; font-size: 0.9rem; color: #94a3b8; font-weight: 500;">{{ $index + 1 }}</td>
                        <td style="padding: 20px 24px;">
                            <span style="font-weight: 600; color: #1e293b; font-size: 0.95rem;">{{ $category->name }}</span>
                        </td>
                        <td style="padding: 20px 24px;">
                            <span style="background: #f1f5f9; color: #475569; padding: 4px 10px; border-radius: 6px; font-size: 0.85rem; font-weight: 600;">
                                {{ $category->division }}
                            </span>
                        </td>
                        <td style="padding: 20px 24px; font-size: 0.95rem; color: #64748b;">
                            {{ $category->{'total-items'} }} Item
                        </td>
                        <td style="padding: 20px 24px; display: flex; justify-content: center; gap: 10px;">
                            <a href="{{ route('categories.edit', $category->id) }}"
                               style="background-color: #6366f1; color: white; text-decoration: none; padding: 8px 18px; border-radius: 8px; font-weight: 600; font-size: 0.85rem; transition: all 0.2s; display: inline-flex; align-items: center; gap: 6px;">
                                <i class="far fa-edit"></i> Edit
                            </a>

                            <form action="{{ route('categories.destroy', $category->id) }}" method="POST" onsubmit="return confirm('Hapus kategori ini?');" style="margin: 0;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" style="background-color: #ffffff; color: #ef4444; border: 1px solid #fee2e2; padding: 8px 18px; border-radius: 8px; font-weight: 600; font-size: 0.85rem; cursor: pointer; transition: all 0.2s;"
                                        onmouseover="this.style.backgroundColor='#fef2f2'" onmouseout="this.style.backgroundColor='#ffffff'">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" style="padding: 60px; text-align: center; color: #94a3b8;">Tidak ada data kategori.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
