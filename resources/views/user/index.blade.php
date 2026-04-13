@extends('templates.app')

@section('content')
    @if(session('success'))
        <div style="background-color: #d1fae5; color: #065f46; padding: 12px 20px; border-radius: 6px; margin-bottom: 24px; border-left: 4px solid #10b981;">
            {{ session('success') }}
        </div>
    @endif

    <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 24px;">
        <div>
            <h3 style="color: #1e293b; font-size: 1.4rem; font-weight: 600; margin: 0 0 6px 0;">
                {{ request('role') == 'operator' ? 'Operator' : 'Admin' }} Accounts Table
            </h3>
            <p style="color: #64748b; font-size: 0.95rem; margin: 0 0 4px 0;">
                Add, delete, update <span style="color: #db2777;">.{{ request('role') }}-accounts</span>
            </p>
            <p style="color: #94a3b8; font-size: 0.85rem; margin: 0;">
                <span style="color: #db2777;">p.s password</span> 4 character dari email dan nomor.
            </p>
        </div>

        <div style="display: flex; gap: 12px; align-items: center;">
            <a href="#" style="background-color: #6d28d9; color: white; text-decoration: none; padding: 10px 20px; border-radius: 6px; font-weight: 500; display: inline-flex; align-items: center; gap: 8px; box-shadow: 0 2px 4px rgba(109, 40, 217, 0.2); transition: opacity 0.2s;">
                Export Excel
            </a>

            <a href="{{ route('users.create') }}" style="background-color: #10b981; color: white; text-decoration: none; padding: 10px 20px; border-radius: 6px; font-weight: 500; display: inline-flex; align-items: center; gap: 8px; box-shadow: 0 2px 4px rgba(16, 185, 129, 0.2); transition: opacity 0.2s;">
                <i class="fas fa-plus"></i> Add
            </a>
        </div>
    </div>

    <div style="background: white; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.02); overflow: hidden; border: 1px solid #f1f5f9;">
        <table style="width: 100%; border-collapse: collapse; text-align: left;">
            <thead>
                <tr style="border-bottom: 1px solid #e2e8f0; background-color: #ffffff;">
                    <th style="padding: 16px 24px; font-weight: 600; color: #475569; font-size: 0.95rem; width: 5%;">#</th>
                    <th style="padding: 16px 24px; font-weight: 600; color: #475569; font-size: 0.95rem; width: 30%;">Name</th>
                    <th style="padding: 16px 24px; font-weight: 600; color: #475569; font-size: 0.95rem; width: 35%;">Email</th>
                    <th style="padding: 16px 24px; font-weight: 600; color: #475569; font-size: 0.95rem; width: 30%; text-align: center;">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $index => $admin)
                    <tr style="background-color: {{ $index % 2 == 0 ? '#f4f4f5' : '#ffffff' }}; border-bottom: 1px solid #f1f5f9; transition: background-color 0.2s;">
                        <td style="padding: 16px 24px; color: #334155; font-size: 0.95rem;">
                            {{ $index + 1 }}
                        </td>
                        <td style="padding: 16px 24px; color: #0f172a; font-size: 0.95rem;">
                            {{ $admin->name }}
                        </td>
                        <td style="padding: 16px 24px; color: #334155; font-size: 0.95rem;">
                            {{ $admin->email }}
                        </td>
                        <td style="padding: 16px 24px; display: flex; justify-content: center; gap: 8px;">
                            <a href="{{ route('users.edit', $admin->id) }}" style="background-color: #7c3aed; color: white; text-decoration: none; padding: 8px 24px; border-radius: 4px; font-weight: 500; font-size: 0.9rem; transition: opacity 0.2s;">
                                Edit
                            </a>

                            <form action="{{ route('users.destroy', $admin->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus akun ini?');" style="margin: 0;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" style="background-color: #ef4444; color: white; border: none; padding: 8px 20px; border-radius: 4px; font-weight: 500; font-size: 0.9rem; cursor: pointer; transition: opacity 0.2s;">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" style="padding: 30px; text-align: center; color: #94a3b8; font-size: 0.95rem;">
                            Belum ada data User.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
