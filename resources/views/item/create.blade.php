@extends('templates.app')

@section('content')
<div style="padding: 24px; max-width: 800px; margin: 0 auto; font-family: 'Inter', sans-serif;">
    <div style="background: white; padding: 40px; border-radius: 20px; box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.05); border: 1px solid #e2e8f0;">

        <div style="margin-bottom: 32px;">
            <h2 style="color: #0f172a; font-size: 1.5rem; font-weight: 800; margin: 0 0 8px 0; letter-spacing: -0.025em;">Add Item Forms</h2>
            <p style="color: #64748b; font-size: 0.95rem; margin: 0;">Harap <span style="color: #4f46e5; font-weight: 600;">isi semua</span> input form dengan nilai yang benar.</p>
        </div>

        <form action="{{ route('items.store') }}" method="POST">
            @csrf

            <div style="margin-bottom: 24px;">
                <label style="display: block; color: #475569; font-size: 0.9rem; font-weight: 600; margin-bottom: 8px;">Nama Barang</label>
                <div style="position: relative;">
                    <input type="text" name="name" value="{{ old('name') }}" placeholder="Masukkan nama item"
                           style="width: 100%; padding: 12px 16px; font-size: 0.95rem; border-radius: 10px; outline: none; border: 1px solid {{ $errors->has('name') ? '#ef4444' : '#e2e8f0' }}; color: #1e293b; transition: all 0.2s;"
                           onfocus="this.style.borderColor='#4f46e5'; this.style.boxShadow='0 0 0 4px rgba(79, 70, 229, 0.1)'"
                           onblur="this.style.borderColor='{{ $errors->has('name') ? '#ef4444' : '#e2e8f0' }}'; this.style.boxShadow='none'">
                    @error('name') <i class="fas fa-exclamation-circle" style="position: absolute; right: 16px; top: 14px; color: #ef4444;"></i> @enderror
                </div>
                @error('name') <div style="color: #ef4444; font-size: 0.85rem; margin-top: 6px;">{{ $message }}</div> @enderror
            </div>

            <div style="margin-bottom: 24px;">
                <label style="display: block; color: #475569; font-size: 0.9rem; font-weight: 600; margin-bottom: 8px;">Kategori</label>
                <div style="position: relative;">
                    <select name="category_id"
                            style="width: 100%; padding: 12px 16px; font-size: 0.95rem; border-radius: 10px; outline: none; appearance: none; background: white; cursor: pointer; border: 1px solid {{ $errors->has('category_id') ? '#ef4444' : '#e2e8f0' }}; color: #1e293b; transition: all 0.2s;"
                            onfocus="this.style.borderColor='#4f46e5'; this.style.boxShadow='0 0 0 4px rgba(79, 70, 229, 0.1)'"
                            onblur="this.style.borderColor='{{ $errors->has('category_id') ? '#ef4444' : '#e2e8f0' }}'; this.style.boxShadow='none'">
                        <option value="" disabled selected>Pilih Category</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                        @endforeach
                    </select>
                    <i class="fas fa-chevron-down" style="position: absolute; right: 16px; top: 16px; color: #94a3b8; font-size: 0.8rem; pointer-events: none;"></i>
                </div>
                @error('category_id') <div style="color: #ef4444; font-size: 0.85rem; margin-top: 6px;">{{ $message }}</div> @enderror
            </div>

            <div style="margin-bottom: 32px;">
                <label style="display: block; color: #475569; font-size: 0.9rem; font-weight: 600; margin-bottom: 8px;">Total Barang</label>
                <div style="display: flex; border-radius: 10px; overflow: hidden; border: 1px solid {{ $errors->has('total') ? '#ef4444' : '#e2e8f0' }}; transition: all 0.2s;" id="totalWrapper">
                    <input type="number" name="total" value="{{ old('total') }}" placeholder="Contoh: 10"
                           style="flex-grow: 1; padding: 12px 16px; font-size: 0.95rem; border: none; outline: none; background: transparent; color: #1e293b;"
                           onfocus="document.getElementById('totalWrapper').style.borderColor='#4f46e5'; document.getElementById('totalWrapper').style.boxShadow='0 0 0 4px rgba(79, 70, 229, 0.1)'"
                           onblur="document.getElementById('totalWrapper').style.borderColor='{{ $errors->has('total') ? '#ef4444' : '#e2e8f0' }}'; document.getElementById('totalWrapper').style.boxShadow='none'">
                    <div style="background-color: #f8fafc; padding: 12px 18px; color: #94a3b8; font-size: 0.9rem; font-weight: 600; border-left: 1px solid {{ $errors->has('total') ? '#ef4444' : '#e2e8f0' }};">item</div>
                </div>
                @error('total') <div style="color: #ef4444; font-size: 0.85rem; margin-top: 6px;">{{ $message }}</div> @enderror
            </div>

            <div style="display: flex; justify-content: flex-end; gap: 12px; padding-top: 24px; border-top: 1px solid #f1f5f9;">
                <a href="{{ route('items.index') }}" style="background-color: #f8fafc; color: #64748b; text-decoration: none; padding: 12px 28px; border-radius: 10px; font-size: 0.95rem; font-weight: 600; border: 1px solid #e2e8f0;">Batal</a>
                <button type="submit" style="background-color: #4f46e5; color: white; border: none; padding: 12px 32px; border-radius: 10px; font-size: 0.95rem; font-weight: 600; cursor: pointer; transition: all 0.2s; box-shadow: 0 4px 12px rgba(79, 70, 229, 0.2);">Submit</button>
            </div>
        </form>
    </div>
</div>
@endsection
