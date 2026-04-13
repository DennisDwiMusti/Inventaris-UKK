@extends('templates.app')

@section('content')
<div style="background: white; padding: 40px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.02); max-width: 1000px; margin: 0 auto; border: 1px solid #f1f5f9;">

    <h2 style="color: #0f172a; font-size: 1.4rem; font-weight: 600; margin-top: 0; margin-bottom: 8px;">Edit Item Forms</h2>
    <p style="color: #64748b; font-size: 0.95rem; margin-bottom: 30px;">
        Please <span style="color: #db2777;">.fill-all</span> input form with right value.
    </p>

    <form action="{{ route('items.update', $item->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div style="margin-bottom: 24px;">
            <label style="display: block; color: #0f172a; font-size: 1rem; margin-bottom: 10px;">Name</label>
            <input type="text" name="name" value="{{ old('name', $item->name) }}" placeholder="Komputer"
                   style="width: 100%; padding: 14px 16px; font-size: 0.95rem; border-radius: 4px; outline: none; border: 1px solid #e2e8f0; color: #333;">
            @error('name')
                <div style="color: #ef4444; font-size: 0.9rem; margin-top: 8px;">{{ $message }}</div>
            @enderror
        </div>

        <div style="margin-bottom: 24px;">
            <label style="display: block; color: #0f172a; font-size: 1rem; margin-bottom: 10px;">Category</label>
            <select name="category_id" style="width: 100%; padding: 14px 16px; font-size: 0.95rem; border-radius: 4px; outline: none; appearance: none; background: transparent; cursor: pointer; border: 1px solid #e2e8f0; color: #333;">
                <option value="" disabled>Pilih Category</option>

                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ old('category_id', $item->category_id) == $cat->id ? 'selected' : '' }}>
                        {{ $cat->name }}
                    </option>
                @endforeach
            </select>
            @error('category_id')
                <div style="color: #ef4444; font-size: 0.9rem; margin-top: 8px;">{{ $message }}</div>
            @enderror
        </div>

        <div style="margin-bottom: 24px;">
            <label style="display: block; color: #0f172a; font-size: 1rem; margin-bottom: 10px;">Total</label>
            <div style="display: flex; border-radius: 4px; overflow: hidden; border: 1px solid #e2e8f0;">
                <input type="number" name="total" value="{{ old('total', $item->total) }}" placeholder="130"
                       style="flex-grow: 1; padding: 14px 16px; font-size: 0.95rem; border: none; outline: none; background: transparent; color: #333;">
                <div style="background-color: #f1f5f9; padding: 14px 18px; color: #94a3b8; font-size: 0.95rem; border-left: 1px solid #e2e8f0;">
                    item
                </div>
            </div>
            @error('total')
                <div style="color: #ef4444; font-size: 0.9rem; margin-top: 8px;">{{ $message }}</div>
            @enderror
        </div>

        <div style="margin-bottom: 30px;">
            <label style="display: block; color: #0f172a; font-size: 1rem; margin-bottom: 10px;">
                New Broke Item <span style="color: #eab308; font-size: 0.9rem;">(currently: {{ $item->repair }})</span>
            </label>
            <div style="display: flex; border-radius: 4px; overflow: hidden; border: 1px solid #e2e8f0;">
                <input type="number" name="new_broke_item" value="0" min="0"
                       style="flex-grow: 1; padding: 14px 16px; font-size: 0.95rem; border: none; outline: none; background: transparent; color: #333;">
                <div style="background-color: #f1f5f9; padding: 14px 18px; color: #94a3b8; font-size: 0.95rem; border-left: 1px solid #e2e8f0;">
                    item
                </div>
            </div>
            @error('new_broke_item')
                <div style="color: #ef4444; font-size: 0.9rem; margin-top: 8px;">{{ $message }}</div>
            @enderror
        </div>

        <div style="display: flex; justify-content: flex-end; gap: 12px; margin-top: 40px;">
            <a href="{{ route('items.index') }}" style="background-color: #9ca3af; color: white; text-decoration: none; padding: 12px 28px; border-radius: 4px; font-size: 0.95rem; font-weight: 500; transition: opacity 0.2s;">
                Cancel
            </a>
            <button type="submit" style="background-color: #6d28d9; color: white; border: none; padding: 12px 28px; border-radius: 4px; font-size: 0.95rem; font-weight: 500; cursor: pointer; transition: opacity 0.2s;">
                Update
            </button>
        </div>
    </form>
</div>
@endsection
