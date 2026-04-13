@extends('templates.app')

@section('content')
<div style="padding: 24px; max-width: 1200px; margin: 0 auto; font-family: 'Inter', sans-serif;">

    @if(session('success'))
        <div style="background-color: #ecfdf5; color: #065f46; padding: 16px 20px; border-radius: 12px; margin-bottom: 24px; border: 1px solid #a7f3d0; display: flex; align-items: center; gap: 12px; animation: slideIn 0.3s ease-out;">
            <i class="fas fa-check-circle" style="font-size: 1.2rem;"></i>
            <span style="font-weight: 500;">{{ session('success') }}</span>
        </div>
    @endif

    <div style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 32px;">
        <div>
            <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 8px;">
                <h2 style="color: #0f172a; font-size: 1.85rem; font-weight: 800; margin: 0; letter-spacing: -0.025em;">
                    Daftar Akun {{ request('role') == 'operator' ? 'Operator' : 'Administrator' }}
                </h2>
                <span style="background: #eff6ff; color: #2563eb; padding: 6px 14px; border-radius: 99px; font-size: 0.75rem; font-weight: 700; text-transform: uppercase; border: 1px solid #dbeafe;">
                    {{ request('role') ?? 'User' }}
                </span>
            </div>
            <p style="color: #64748b; font-size: 1rem; margin: 0; max-width: 500px; line-height: 1.5;">
                Manajemen data pengguna sistem. Anda dapat menambah, mengubah, atau menghapus hak akses pengguna.
            </p>
        </div>

        <div style="display: flex; gap: 12px;">
            <a href="{{ route('users.export', ['role' => request('role')]) }}"
               style="background-color: #ffffff; color: #334155; border: 1px solid #e2e8f0; text-decoration: none; padding: 10px 20px; border-radius: 10px; font-weight: 600; font-size: 0.9rem; display: inline-flex; align-items: center; gap: 8px; transition: all 0.2s; cursor: pointer;"
               onmouseover="this.style.backgroundColor='#f8fafc'; this.style.borderColor='#cbd5e1'"
               onmouseout="this.style.backgroundColor='#ffffff'; this.style.borderColor='#e2e8f0'">
                <i class="fas fa-file-excel" style="color: #16a34a;"></i> Export Excel
            </a>

            <a href="{{ route('users.create') }}"
               style="background-color: #4f46e5; color: white; text-decoration: none; padding: 10px 22px; border-radius: 10px; font-weight: 600; font-size: 0.9rem; display: inline-flex; align-items: center; gap: 8px; box-shadow: 0 4px 12px rgba(79, 70, 229, 0.25); transition: all 0.2s;"
               onmouseover="this.style.backgroundColor='#4338ca'; this.style.transform='translateY(-1px)'"
               onmouseout="this.style.backgroundColor='#4f46e5'; this.style.transform='translateY(0)'">
                <i class="fas fa-plus"></i> Tambah Akun
            </a>
        </div>
    </div>

    <div style="background: white; border-radius: 20px; border: 1px solid #e2e8f0; box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.05); overflow: hidden;">

        <div style="padding: 14px 24px; background: #fafafa; border-bottom: 1px solid #f1f5f9; display: flex; align-items: center; gap: 8px;">
            <i class="fas fa-shield-alt" style="color: #94a3b8; font-size: 0.9rem;"></i>
            <p style="margin: 0; font-size: 0.85rem; color: #64748b; font-weight: 500;">
                Sistem Keamanan: Password default menggunakan <span style="color: #4f46e5; font-weight: 700;">4 karakter email + ID</span>
            </p>
        </div>

        <table style="width: 100%; border-collapse: collapse; text-align: left;">
            <thead>
                <tr style="background-color: #ffffff;">
                    <th style="padding: 18px 24px; font-weight: 700; color: #475569; font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.05em; border-bottom: 2px solid #f1f5f9;">No</th>
                    <th style="padding: 18px 24px; font-weight: 700; color: #475569; font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.05em; border-bottom: 2px solid #f1f5f9;">Informasi Pengguna</th>
                    <th style="padding: 18px 24px; font-weight: 700; color: #475569; font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.05em; border-bottom: 2px solid #f1f5f9;">Alamat Email</th>
                    <th style="padding: 18px 24px; font-weight: 700; color: #475569; font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.05em; border-bottom: 2px solid #f1f5f9; text-align: center;">Tindakan</th>
                </tr>
            </thead>
            <tbody style="color: #334155;">
                @forelse ($users as $index => $user)
                    <tr style="border-bottom: 1px solid #f1f5f9; transition: all 0.2s;" onmouseover="this.style.backgroundColor='#f9fafb'" onmouseout="this.style.backgroundColor='transparent'">
                        <td style="padding: 20px 24px; font-size: 0.9rem; color: #94a3b8; font-weight: 500;">{{ $index + 1 }}</td>
                        <td style="padding: 20px 24px;">
                            <div style="display: flex; align-items: center; gap: 12px;">
                                <div style="width: 36px; height: 36px; border-radius: 10px; background: #f1f5f9; display: flex; align-items: center; justify-content: center; color: #475569; font-weight: 700; font-size: 0.85rem;">
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                </div>
                                <span style="font-weight: 600; color: #1e293b; font-size: 0.95rem;">{{ $user->name }}</span>
                            </div>
                        </td>
                        <td style="padding: 20px 24px; font-size: 0.95rem; color: #64748b;">
                            <div style="display: flex; align-items: center; gap: 8px;">
                                <i class="far fa-envelope" style="color: #cbd5e1;"></i>
                                {{ $user->email }}
                            </div>
                        </td>
                        <td style="padding: 20px 24px; display: flex; justify-content: center; gap: 10px;">
                            @if(request('role') == 'admin' || !request()->has('role'))
                                <a href="{{ route('users.edit', $user->id) }}"
                                   style="background-color: #6366f1; color: white; text-decoration: none; padding: 8px 18px; border-radius: 8px; font-weight: 600; font-size: 0.85rem; transition: all 0.2s; display: inline-flex; align-items: center; gap: 6px;">
                                    <i class="far fa-edit"></i> Edit
                                </a>
                            @endif
                            @if(request('role') == 'operator')
                                <form action="{{ route('users.reset_password', $user->id) }}" method="POST" onsubmit="return confirm('Kembalikan password akun ini ke pengaturan awal?');" style="margin: 0;">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" style="background-color: #fef3c7; color: #b45309; border: 1px solid #fcd34d; padding: 8px 18px; border-radius: 8px; font-weight: 600; font-size: 0.85rem; cursor: pointer; transition: all 0.2s; display: inline-flex; align-items: center; gap: 6px;"
                                            onmouseover="this.style.backgroundColor='#fde68a'" onmouseout="this.style.backgroundColor='#fef3c7'">
                                        <i class="fas fa-key"></i> Reset Password
                                    </button>
                                </form>
                            @endif

                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Hapus akun ini secara permanen?');" style="margin: 0;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" style="background-color: #ffffff; color: #ef4444; border: 1px solid #fee2e2; padding: 8px 18px; border-radius: 8px; font-weight: 600; font-size: 0.85rem; cursor: pointer; transition: all 0.2s; display: inline-flex; align-items: center; gap: 6px;"
                                        onmouseover="this.style.backgroundColor='#fef2f2'; this.style.borderColor='#fecaca'" onmouseout="this.style.backgroundColor='#ffffff'; this.style.borderColor='#fee2e2'">
                                    <i class="far fa-trash-alt"></i> Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" style="padding: 60px; text-align: center; color: #94a3b8;">
                            <div style="display: flex; flex-direction: column; align-items: center; gap: 16px;">
                                <div style="width: 64px; height: 64px; background: #f8fafc; border-radius: 20px; display: flex; align-items: center; justify-content: center;">
                                    <i class="fas fa-users-slash" style="font-size: 1.5rem; color: #e2e8f0;"></i>
                                </div>
                                <span style="font-weight: 500; font-size: 1rem;">Tidak ada data pengguna ditemukan</span>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<style>
    @keyframes slideIn {
        from { opacity: 0; transform: translateY(-10px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>
@endsection
