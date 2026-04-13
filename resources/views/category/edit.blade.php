@extends('templates.app')

@section('content')
<div style="background: white; padding: 40px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.02); max-width: 1000px; margin: 0 auto; border: 1px solid #f1f5f9;">

    <h2 style="color: #0f172a; font-size: 1.4rem; font-weight: 600; margin-top: 0; margin-bottom: 8px;">Edit Category Forms</h2>
    <p style="color: #64748b; font-size: 0.95rem; margin-bottom: 30px;">
        Please <span style="color: #db2777;">.fill-all</span> input form with right value.
    </p>

    <form action="{{ route('categories.update', $category->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div style="margin-bottom: 24px;">
            <label style="display: block; color: #0f172a; font-size: 1rem; margin-bottom: 10px;">Name</label>
            <div style="position: relative;">
                <input type="text" name="name" value="{{ old('name', $category->name) }}" placeholder="Alat Dapur"
                       style="width: 100%; padding: 14px 16px; font-size: 0.95rem; border-radius: 4px; outline: none; transition: all 0.2s;
                              border: 1px solid {{ $errors->has('name') ? '#ef4444' : '#e2e8f0' }};
                              color: {{ $errors->has('name') ? '#ef4444' : '#333' }};">

                @error('name')
                    <i class="fas fa-exclamation-circle" style="position: absolute; right: 16px; top: 50%; transform: translateY(-50%); color: #ef4444; font-size: 1.1rem;"></i>
                @enderror
            </div>
            @error('name')
                <div style="color: #ef4444; font-size: 0.9rem; margin-top: 8px;">{{ $message }}</div>
            @enderror
        </div>

        <div style="margin-bottom: 30px;">
            <label style="display: block; color: #0f172a; font-size: 1rem; margin-bottom: 10px;">Division PJ</label>

            <div style="display: flex; border-radius: 4px; overflow: hidden; border: 1px solid {{ $errors->has('division') ? '#ef4444' : '#e2e8f0' }};">
                <div style="background-color: #f1f5f9; padding: 14px 18px; color: #94a3b8; border-right: 1px solid {{ $errors->has('division') ? '#ef4444' : '#e2e8f0' }};">
                    <i class="fas fa-user-cog"></i>
                </div>
                <div style="position: relative; flex-grow: 1;">
                    <select name="division" style="width: 100%; padding: 14px 16px; font-size: 0.95rem; border: none; outline: none; appearance: none; background: transparent; cursor: pointer; color: {{ $errors->has('division') ? '#ef4444' : '#333' }};">
                        <option value="" disabled>Select Division PJ</option>
                        <option value="Sarpras" {{ old('division', $category->division) == 'Sarpras' ? 'selected' : '' }}>Sarpras</option>
                        <option value="Tata Usaha" {{ old('division', $category->division) == 'Tata Usaha' ? 'selected' : '' }}>Tata Usaha</option>
                        <option value="Tefa" {{ old('division', $category->division) == 'Tefa' ? 'selected' : '' }}>Tefa</option>
                    </select>

                    @error('division')
                        <i class="fas fa-exclamation-circle" style="position: absolute; right: 16px; top: 50%; transform: translateY(-50%); color: #ef4444; font-size: 1.1rem;"></i>
                    @enderror
                </div>
            </div>
            @error('division')
                <div style="color: #ef4444; font-size: 0.9rem; margin-top: 8px;">{{ $message }}</div>
            @enderror
        </div>

        <div style="display: flex; justify-content: flex-end; gap: 12px; margin-top: 40px;">
            <a href="{{ route('categories.index') }}" style="background-color: #9ca3af; color: white; text-decoration: none; padding: 12px 28px; border-radius: 4px; font-size: 0.95rem; font-weight: 500; transition: opacity 0.2s;">
                Cancel
            </a>
            <button type="submit" style="background-color: #6d28d9; color: white; border: none; padding: 12px 28px; border-radius: 4px; font-size: 0.95rem; font-weight: 500; cursor: pointer; transition: opacity 0.2s;">
                Update
            </button>
        </div>
    </form>
</div>
@endsection
