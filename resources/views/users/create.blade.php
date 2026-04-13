@extends('templates.app')

@section('content')
<div style="padding: 24px; max-width: 800px; margin: 0 auto; font-family: 'Inter', sans-serif;">
    <div style="background: white; padding: 40px; border-radius: 20px; box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.05); border: 1px solid #e2e8f0;">

        <div style="margin-bottom: 32px;">
            <h2 style="color: #0f172a; font-size: 1.5rem; font-weight: 800; margin: 0 0 8px 0; letter-spacing: -0.025em;">Add New Account</h2>
            <p style="color: #64748b; font-size: 0.95rem; margin: 0;">
                Sistem akan membuat <span style="color: #4f46e5; font-weight: 600;">password otomatis</span> berdasarkan email dan ID.
            </p>
        </div>

        <form action="{{ route('users.store') }}" method="POST">
            @csrf

            <div style="margin-bottom: 24px;">
                <label style="display: block; color: #475569; font-size: 0.9rem; font-weight: 600; margin-bottom: 8px;">Nama Lengkap</label>
                <div style="position: relative;">
                    <input type="text" name="name" value="{{ old('name') }}" placeholder="Contoh: Dunia"
                           style="width: 100%; padding: 12px 16px; font-size: 0.95rem; border-radius: 10px; outline: none; transition: all 0.2s;
                                  border: 1px solid {{ $errors->has('name') ? '#ef4444' : '#e2e8f0' }};
                                  color: #1e293b;"
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

            <div style="margin-bottom: 24px;">
                <label style="display: block; color: #475569; font-size: 0.9rem; font-weight: 600; margin-bottom: 8px;">Alamat Email</label>
                <div style="position: relative;">
                    <input type="email" name="email" value="{{ old('email') }}" placeholder="dunia@gmail.com"
                           style="width: 100%; padding: 12px 16px; font-size: 0.95rem; border-radius: 10px; outline: none; transition: all 0.2s;
                                  border: 1px solid {{ $errors->has('email') ? '#ef4444' : '#e2e8f0' }};
                                  color: #1e293b;"
                           onfocus="this.style.borderColor='#4f46e5'; this.style.boxShadow='0 0 0 4px rgba(79, 70, 229, 0.1)'"
                           onblur="this.style.borderColor='{{ $errors->has('email') ? '#ef4444' : '#e2e8f0' }}'; this.style.boxShadow='none'">
                    @error('email')
                        <i class="fas fa-exclamation-circle" style="position: absolute; right: 16px; top: 14px; color: #ef4444;"></i>
                    @enderror
                </div>
                @error('email')
                    <div style="color: #ef4444; font-size: 0.85rem; margin-top: 6px; font-weight: 500;">{{ $message }}</div>
                @enderror
            </div>

            <div style="margin-bottom: 32px;">
                <label style="display: block; color: #475569; font-size: 0.9rem; font-weight: 600; margin-bottom: 8px;">Role Akun</label>
                <div style="position: relative;">
                    <select name="role" style="width: 100%; padding: 12px 16px; font-size: 0.95rem; border-radius: 10px; outline: none; appearance: none; background: white; cursor: pointer; transition: all 0.2s;
                                  border: 1px solid {{ $errors->has('role') ? '#ef4444' : '#e2e8f0' }};
                                  color: #1e293b;"
                            onfocus="this.style.borderColor='#4f46e5'; this.style.boxShadow='0 0 0 4px rgba(79, 70, 229, 0.1)'"
                            onblur="this.style.borderColor='{{ $errors->has('role') ? '#ef4444' : '#e2e8f0' }}'; this.style.boxShadow='none'">
                        <option value="" disabled selected>Pilih Role...</option>
                        <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Administrator</option>
                        <option value="operator" {{ old('role') == 'operator' ? 'selected' : '' }}>Operator</option>
                    </select>
                    <i class="fas fa-chevron-down" style="position: absolute; right: 16px; top: 16px; color: #94a3b8; pointer-events: none; font-size: 0.8rem;"></i>
                </div>
                @error('role')
                    <div style="color: #ef4444; font-size: 0.85rem; margin-top: 6px; font-weight: 500;">{{ $message }}</div>
                @enderror
            </div>

            <div style="display: flex; justify-content: flex-end; gap: 12px; padding-top: 24px; border-top: 1px solid #f1f5f9;">
                <a href="{{ route('users.index') }}"
                   style="background-color: #f8fafc; color: #64748b; text-decoration: none; padding: 12px 24px; border-radius: 10px; font-size: 0.95rem; font-weight: 600; border: 1px solid #e2e8f0; transition: all 0.2s;"
                   onmouseover="this.style.backgroundColor='#f1f5f9'" onmouseout="this.style.backgroundColor='#f8fafc'">
                    Batal
                </a>
                <button type="submit"
                        style="background-color: #4f46e5; color: white; border: none; padding: 12px 32px; border-radius: 10px; font-size: 0.95rem; font-weight: 600; cursor: pointer; transition: all 0.2s; box-shadow: 0 4px 12px rgba(79, 70, 229, 0.2);"
                        onmouseover="this.style.backgroundColor='#4338ca'" onmouseout="this.style.backgroundColor='#4f46e5'">
                    Daftarkan Akun
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
