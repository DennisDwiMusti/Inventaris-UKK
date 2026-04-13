@extends('templates.app')

@section('content')
<div style="padding: 24px; max-width: 800px; margin: 0 auto; font-family: 'Inter', sans-serif;">
    <div style="background: white; padding: 40px; border-radius: 20px; box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.05); border: 1px solid #e2e8f0;">

        <div style="margin-bottom: 32px;">
            <h2 style="color: #0f172a; font-size: 1.5rem; font-weight: 800; margin: 0 0 8px 0; letter-spacing: -0.025em;">Edit Account</h2>
            <p style="color: #64748b; font-size: 0.95rem; margin: 0;">
                Harap <span style="color: #4f46e5; font-weight: 600;">isi semua</span> kolom input dengan data yang benar.
            </p>
        </div>

        <form action="{{ route('users.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div style="margin-bottom: 24px;">
                <label style="display: block; color: #475569; font-size: 0.9rem; font-weight: 600; margin-bottom: 8px;">Nama Lengkap</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}" placeholder="Contoh: Admin Wikrama"
                       style="width: 100%; padding: 12px 16px; font-size: 0.95rem; border-radius: 10px; outline: none; border: 1px solid #e2e8f0; color: #1e293b; transition: all 0.2s;"
                       onfocus="this.style.borderColor='#4f46e5'; this.style.boxShadow='0 0 0 4px rgba(79, 70, 229, 0.1)'"
                       onblur="this.style.borderColor='#e2e8f0'; this.style.boxShadow='none'">
                @error('name')
                    <div style="color: #ef4444; font-size: 0.85rem; margin-top: 6px; font-weight: 500;">{{ $message }}</div>
                @enderror
            </div>

            <div style="margin-bottom: 24px;">
                <label style="display: block; color: #475569; font-size: 0.9rem; font-weight: 600; margin-bottom: 8px;">Alamat Email</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}" placeholder="admin@gmail.com"
                       style="width: 100%; padding: 12px 16px; font-size: 0.95rem; border-radius: 10px; outline: none; border: 1px solid #e2e8f0; color: #1e293b; transition: all 0.2s;"
                       onfocus="this.style.borderColor='#4f46e5'; this.style.boxShadow='0 0 0 4px rgba(79, 70, 229, 0.1)'"
                       onblur="this.style.borderColor='#e2e8f0'; this.style.boxShadow='none'">
                @error('email')
                    <div style="color: #ef4444; font-size: 0.85rem; margin-top: 6px; font-weight: 500;">{{ $message }}</div>
                @enderror
            </div>

            <div style="margin-bottom: 32px;">
                <label style="display: block; color: #475569; font-size: 0.9rem; font-weight: 600; margin-bottom: 8px;">
                    Password Baru <span style="color: #f59e0b; font-weight: 400; font-size: 0.8rem; margin-left: 4px;">(opsional)</span>
                </label>
                <input type="password" name="password" placeholder="Kosongkan jika tidak ingin mengubah password"
                       style="width: 100%; padding: 12px 16px; font-size: 0.95rem; border-radius: 10px; outline: none; border: 1px solid #e2e8f0; color: #1e293b; transition: all 0.2s;"
                       onfocus="this.style.borderColor='#4f46e5'; this.style.boxShadow='0 0 0 4px rgba(79, 70, 229, 0.1)'"
                       onblur="this.style.borderColor='#e2e8f0'; this.style.boxShadow='none'">
                @error('password')
                    <div style="color: #ef4444; font-size: 0.85rem; margin-top: 6px; font-weight: 500;">{{ $message }}</div>
                @enderror
            </div>

            <div style="display: flex; justify-content: flex-end; gap: 12px; padding-top: 24px; border-top: 1px solid #f1f5f9;">
                <a href="{{ route('users.index', ['role' => $user->role]) }}"
                   style="background-color: #f8fafc; color: #64748b; text-decoration: none; padding: 12px 24px; border-radius: 10px; font-size: 0.95rem; font-weight: 600; border: 1px solid #e2e8f0; transition: all 0.2s;"
                   onmouseover="this.style.backgroundColor='#f1f5f9'" onmouseout="this.style.backgroundColor='#f8fafc'">
                    Batal
                </a>
                <button type="submit"
                        style="background-color: #4f46e5; color: white; border: none; padding: 12px 32px; border-radius: 10px; font-size: 0.95rem; font-weight: 600; cursor: pointer; transition: all 0.2s; box-shadow: 0 4px 12px rgba(79, 70, 229, 0.2);"
                        onmouseover="this.style.backgroundColor='#4338ca'" onmouseout="this.style.backgroundColor='#4f46e5'">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
