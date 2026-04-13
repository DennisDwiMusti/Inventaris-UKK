@extends('templates.app')

@section('content')
<div style="padding: 24px; max-width: 800px; margin: 0 auto; font-family: 'Inter', sans-serif;">
    <div style="background: white; padding: 40px; border-radius: 20px; box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.05); border: 1px solid #e2e8f0;">

        <div style="margin-bottom: 32px;">
            <h2 style="color: #0f172a; font-size: 1.5rem; font-weight: 800; margin: 0 0 8px 0; letter-spacing: -0.025em;">
                {{ isset($category) ? 'Edit Category' : 'Add New Category' }}
            </h2>
            <p style="color: #64748b; font-size: 0.95rem; margin: 0;">
                Kelola kategori untuk mempermudah inventarisasi barang.
            </p>
        </div>

        <form action="{{ isset($category) ? route('categories.update', $category->id) : route('categories.store') }}" method="POST">
            @csrf
            @if(isset($category)) @method('PUT') @endif

            <div style="margin-bottom: 24px;">
                <label style="display: block; color: #475569; font-size: 0.9rem; font-weight: 600; margin-bottom: 8px;">Nama Kategori</label>
                <div style="position: relative;">
                    <input type="text" name="name" value="{{ old('name', $category->name ?? '') }}" placeholder="Contoh: Alat Dapur"
                           style="width: 100%; padding: 12px 16px; font-size: 0.95rem; border-radius: 10px; outline: none; border: 1px solid {{ $errors->has('name') ? '#ef4444' : '#e2e8f0' }}; color: #1e293b; transition: all 0.2s;"
                           onfocus="this.style.borderColor='#4f46e5'; this.style.boxShadow='0 0 0 4px rgba(79, 70, 229, 0.1)'"
                           onblur="this.style.borderColor='{{ $errors->has('name') ? '#ef4444' : '#e2e8f0' }}'; this.style.boxShadow='none'">
                    @error('name')
                        <i class="fas fa-exclamation-circle" style="position: absolute; right: 16px; top: 14px; color: #ef4444;"></i>
                    @enderror
                </div>
                @error('name')
                    <div style="color: #ef4444; font-size: 0.85rem; margin-top: 6px; font-weight: 500;">{{ $message }}</div>
                @enderror
            </div>

            <div style="margin-bottom: 32px;">
                <label style="display: block; color: #475569; font-size: 0.9rem; font-weight: 600; margin-bottom: 8px;">Divisi Penanggung Jawab</label>
                <div style="position: relative; display: flex; align-items: center;">
                    <div style="position: absolute; left: 16px; color: #94a3b8; font-size: 0.9rem;">
                        <i class="fas fa-user-shield"></i>
                    </div>
                    <select name="division"
                            style="width: 100%; padding: 12px 16px 12px 44px; font-size: 0.95rem; border-radius: 10px; outline: none; appearance: none; background: white; cursor: pointer; border: 1px solid {{ $errors->has('division') ? '#ef4444' : '#e2e8f0' }}; color: #1e293b; transition: all 0.2s;"
                            onfocus="this.style.borderColor='#4f46e5'; this.style.boxShadow='0 0 0 4px rgba(79, 70, 229, 0.1)'"
                            onblur="this.style.borderColor='{{ $errors->has('division') ? '#ef4444' : '#e2e8f0' }}'; this.style.boxShadow='none'">
                        <option value="" disabled selected>Pilih Divisi...</option>
                        <option value="Sarpras" {{ old('division', $category->division ?? '') == 'Sarpras' ? 'selected' : '' }}>Sarpras</option>
                        <option value="Tata Usaha" {{ old('division', $category->division ?? '') == 'Tata Usaha' ? 'selected' : '' }}>Tata Usaha</option>
                        <option value="Tefa" {{ old('division', $category->division ?? '') == 'Tefa' ? 'selected' : '' }}>Tefa</option>
                    </select>
                    <i class="fas fa-chevron-down" style="position: absolute; right: 16px; color: #94a3b8; pointer-events: none; font-size: 0.8rem;"></i>
                </div>
                @error('division')
                    <div style="color: #ef4444; font-size: 0.85rem; margin-top: 6px; font-weight: 500;">{{ $message }}</div>
                @enderror
            </div>

            <div style="display: flex; justify-content: flex-end; gap: 12px; padding-top: 24px; border-top: 1px solid #f1f5f9;">
                <a href="{{ route('categories.index') }}"
                   style="background-color: #f8fafc; color: #64748b; text-decoration: none; padding: 12px 24px; border-radius: 10px; font-size: 0.95rem; font-weight: 600; border: 1px solid #e2e8f0; transition: all 0.2s;">
                    Batal
                </a>
                <button type="submit"
                        style="background-color: #4f46e5; color: white; border: none; padding: 12px 32px; border-radius: 10px; font-size: 0.95rem; font-weight: 600; cursor: pointer; transition: all 0.2s; box-shadow: 0 4px 12px rgba(79, 70, 229, 0.2);">
                    {{ isset($category) ? 'Simpan Perubahan' : 'Buat Kategori' }}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
