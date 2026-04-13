@extends('templates.app')

@section('content')
    @if(session('success'))
        <div style="background-color: #d1fae5; color: #065f46; padding: 12px 20px; border-radius: 6px; margin-bottom: 24px; border-left: 4px solid #10b981;">
            {{ session('success') }}
        </div>
    @endif

    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
        <div>
            <h3 style="color: #1e293b; font-size: 1.4rem; font-weight: 600; margin: 0 0 6px 0;">Items Table</h3>
            <p style="color: #64748b; font-size: 0.95rem; margin: 0;">
                Add, delete, update <span style="color: #db2777;">.items</span>
            </p>
        </div>
        <div style="display: flex; gap: 12px;">
            <a href="{{ route('items.export') }}" style="background-color: #6d28d9; color: white; text-decoration: none; padding: 10px 20px; border-radius: 6px; font-weight: 500; display: inline-flex; align-items: center; gap: 8px; box-shadow: 0 2px 4px rgba(109, 40, 217, 0.2); transition: opacity 0.2s;">
                Export Excel
            </a>

            <a href="{{ route('items.create') }}" style="background-color: #10b981; color: white; text-decoration: none; padding: 10px 20px; border-radius: 6px; font-weight: 500; display: inline-flex; align-items: center; gap: 8px; box-shadow: 0 2px 4px rgba(16, 185, 129, 0.2); transition: opacity 0.2s;">
                <i class="fas fa-plus"></i> Add
            </a>
        </div>
    </div>

    <div style="background: white; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.02); overflow: hidden; border: 1px solid #f1f5f9;">
        <table style="width: 100%; border-collapse: collapse; text-align: left;">
            <thead>
                <tr style="border-bottom: 1px solid #e2e8f0; background-color: #ffffff;">
                    <th style="padding: 16px 24px; font-weight: 600; color: #475569; font-size: 0.95rem; width: 5%;">#</th>
                    <th style="padding: 16px 24px; font-weight: 600; color: #475569; font-size: 0.95rem; width: 20%;">Category</th>
                    <th style="padding: 16px 24px; font-weight: 600; color: #475569; font-size: 0.95rem; width: 20%;">Name</th>
                    <th style="padding: 16px 24px; font-weight: 600; color: #475569; font-size: 0.95rem; width: 15%;">Total</th>
                    <th style="padding: 16px 24px; font-weight: 600; color: #475569; font-size: 0.95rem; width: 10%;">Repair</th>
                    <th style="padding: 16px 24px; font-weight: 600; color: #475569; font-size: 0.95rem; width: 15%;">Lending</th>
                    <th style="padding: 16px 24px; font-weight: 600; color: #475569; font-size: 0.95rem; width: 15%;">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($items as $index => $item)
                    <tr style="border-bottom: 1px solid #f8fafc; transition: background-color 0.2s;">
                        <td style="padding: 16px 24px; color: #334155; font-size: 0.95rem;">
                            {{ $index + 1 }}
                        </td>
                        <td style="padding: 16px 24px; color: #334155; font-size: 0.95rem;">
                            {{ $item->category->name }}
                        </td>
                        <td style="padding: 16px 24px; color: #0f172a; font-weight: 500; font-size: 0.95rem;">
                            {{ $item->name }}
                        </td>
                        <td style="padding: 16px 24px; color: #334155; font-size: 0.95rem;">
                            {{ $item->total }}
                        </td>
                        <td style="padding: 16px 24px; color: #334155; font-size: 0.95rem;">
                            {{ $item->repair }}
                        </td>
                        <td style="padding: 16px 24px; font-size: 0.95rem;">
                            <span style="color: {{ $item->lending_id > 0 ? '#0284c7' : '#334155' }}; text-decoration: {{ $item->lending_id > 0 ? 'underline' : 'none' }};">
                                {{ $item->lending_id }}
                            </span>
                        </td>
                        <td style="padding: 16px 24px;">
                            <a href="{{ route('items.edit', $item->id) }}" style="background-color: #7c3aed; color: white; text-decoration: none; padding: 8px 20px; border-radius: 6px; font-weight: 500; font-size: 0.9rem; transition: opacity 0.2s; display: inline-block;">
                                Edit
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" style="padding: 30px; text-align: center; color: #94a3b8; font-size: 0.95rem;">
                            Belum ada data barang (items).
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
