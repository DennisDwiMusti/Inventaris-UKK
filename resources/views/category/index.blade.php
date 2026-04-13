@extends('templates.app')

@section('content')
    @if(session('success'))
        <div style="background-color: #d1fae5; color: #065f46; padding: 12px 20px; border-radius: 6px; margin-bottom: 24px; border-left: 4px solid #10b981;">
            {{ session('success') }}
        </div>
    @endif

    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
        <div>
            <h3 style="color: #1e293b; font-size: 1.4rem; font-weight: 600; margin: 0 0 6px 0;">Categories Table</h3>
            <p style="color: #64748b; font-size: 0.95rem; margin: 0;">
                Add, delete, update <span style="color: #db2777;">.categories</span>
            </p>
        </div>
        <div>
            <a href="{{ route('categories.create') }}" style="background-color: #10b981; color: white; text-decoration: none; padding: 10px 20px; border-radius: 6px; font-weight: 500; display: inline-flex; align-items: center; gap: 8px; box-shadow: 0 2px 4px rgba(16, 185, 129, 0.2); transition: opacity 0.2s;">
                <i class="fas fa-plus"></i> Add
            </a>
        </div>
    </div>

    <div style="background: white; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.02); overflow: hidden; border: 1px solid #f1f5f9;">
        <table style="width: 100%; border-collapse: collapse; text-align: left;">
            <thead>
                <tr style="border-bottom: 1px solid #e2e8f0; background-color: #ffffff;">
                    <th style="padding: 16px 24px; font-weight: 600; color: #475569; font-size: 0.95rem; width: 5%;">#</th>
                    <th style="padding: 16px 24px; font-weight: 600; color: #475569; font-size: 0.95rem; width: 25%;">Name</th>
                    <th style="padding: 16px 24px; font-weight: 600; color: #475569; font-size: 0.95rem; width: 25%;">Division PJ</th>
                    <th style="padding: 16px 24px; font-weight: 600; color: #475569; font-size: 0.95rem; width: 20%;">Total Items</th>
                    <th style="padding: 16px 24px; font-weight: 600; color: #475569; font-size: 0.95rem; width: 25%;">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($categories as $index => $category)
                    <tr style="border-bottom: 1px solid #f8fafc; transition: background-color 0.2s;">
                        <td style="padding: 16px 24px; color: #334155; font-size: 0.95rem;">
                            {{ $index + 1 }}
                        </td>
                        <td style="padding: 16px 24px; color: #0f172a; font-weight: 500; font-size: 0.95rem;">
                            {{ $category->name }}
                        </td>
                        <td style="padding: 16px 24px; color: #334155; font-size: 0.95rem;">
                            {{ $category->division }}
                        </td>
                        <td style="padding: 16px 24px; color: #334155; font-size: 0.95rem;">
                            {{ $category->{'total-items'} }}
                        </td>
                        <td style="padding: 16px 24px; display: flex; gap: 8px;">
                            <a href="{{ route('categories.edit', $category->id) }}" style="background-color: #7c3aed; color: white; text-decoration: none; padding: 8px 20px; border-radius: 6px; font-weight: 500; font-size: 0.9rem; transition: opacity 0.2s; display: inline-block;">
                                Edit
                            </a>

                            </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" style="padding: 30px; text-align: center; color: #94a3b8; font-size: 0.95rem;">
                            Belum ada data kategori.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
