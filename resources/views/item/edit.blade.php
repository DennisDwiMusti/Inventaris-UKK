@extends('templates.app')

@section('content')
<div style="padding: 24px; max-width: 800px; margin: 0 auto; font-family: 'Inter', sans-serif;">
    <div style="background: white; padding: 40px; border-radius: 20px; box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.05); border: 1px solid #e2e8f0;">

        <div style="margin-bottom: 32px;">
            <h2 style="color: #0f172a; font-size: 1.5rem; font-weight: 800; margin: 0 0 8px 0; letter-spacing: -0.025em;">Edit Item Forms</h2>
            <p style="color: #64748b; font-size: 0.95rem; margin: 0;">Harap perbarui data barang dengan teliti.</p>
        </div>

        @if(session('error'))
            <div style="background-color: #fee2e2; color: #b91c1c; padding: 16px 20px; border-radius: 10px; margin-bottom: 24px; border: 1px solid #fecaca; font-weight: 500;">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('items.update', $item->id) }}" method="POST">
            @csrf
            @method('PUT')

            <span id="current-repair" style="display:none;">{{ $item->repair }}</span>
            <span id="current-lending" style="display:none;">{{ $item->lending_id }}</span>

            <div style="margin-bottom: 24px;">
                <label style="display: block; color: #475569; font-size: 0.9rem; font-weight: 600; margin-bottom: 8px;">Nama Barang</label>
                <input type="text" name="name" value="{{ old('name', $item->name) }}" required
                       style="width: 100%; padding: 12px 16px; font-size: 0.95rem; border-radius: 10px; outline: none; border: 1px solid #e2e8f0; color: #1e293b;">
            </div>

            <div style="margin-bottom: 24px;">
                <label style="display: block; color: #475569; font-size: 0.9rem; font-weight: 600; margin-bottom: 8px;">Kategori</label>
                <div style="position: relative;">
                    <select name="category_id" required style="width: 100%; padding: 12px 16px; font-size: 0.95rem; border-radius: 10px; outline: none; appearance: none; background: white; cursor: pointer; border: 1px solid #e2e8f0; color: #1e293b;">
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ old('category_id', $item->category_id) == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                        @endforeach
                    </select>
                    <i class="fas fa-chevron-down" style="position: absolute; right: 16px; top: 16px; color: #94a3b8; font-size: 0.8rem; pointer-events: none;"></i>
                </div>
            </div>

            <div style="margin-bottom: 24px;">
                <div style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 8px;">
                    <label style="color: #475569; font-size: 0.9rem; font-weight: 600;">Total Stok Keseluruhan</label>
                    <span style="font-size: 0.8rem; color: #64748b;">(Sedang dipinjam: {{ $item->lending_id }} unit)</span>
                </div>
                <div style="display: flex; border-radius: 10px; overflow: hidden; border: 1px solid #e2e8f0;">
                    <input type="number" id="input-total" name="total" value="{{ old('total', $item->total) }}" required min="{{ $item->repair + $item->lending_id }}"
                           style="flex-grow: 1; padding: 12px 16px; font-size: 0.95rem; border: none; outline: none; background: transparent; color: #1e293b;">
                    <div style="background-color: #f8fafc; padding: 12px 18px; color: #94a3b8; font-size: 0.9rem; font-weight: 600; border-left: 1px solid #e2e8f0;">item</div>
                </div>
            </div>

            <div style="margin-bottom: 32px;">
                <div style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 8px;">
                    <label style="color: #475569; font-size: 0.9rem; font-weight: 600;">
                        Tambah Laporan Barang Rusak
                    </label>
                    <span id="max-broke-info" style="color: #059669; font-weight: 600; font-size: 0.8rem;">
                        Tersedia: 0 unit
                    </span>
                </div>
                <div style="display: flex; border-radius: 10px; overflow: hidden; border: 1px solid #e2e8f0;">
                    <input type="number" id="input-broke" name="new_broke_item" value="0" min="0"
                           style="flex-grow: 1; padding: 12px 16px; font-size: 0.95rem; border: none; outline: none; background: transparent; color: #1e293b;">
                    <div style="background-color: #f8fafc; padding: 12px 18px; color: #94a3b8; font-size: 0.9rem; font-weight: 600; border-left: 1px solid #e2e8f0;">item</div>
                </div>
                <p style="font-size: 0.8rem; color: #94a3b8; margin-top: 6px; margin-bottom: 0;">
                    Saat ini sudah ada <b>{{ $item->repair }}</b> barang yang tercatat rusak.
                </p>
            </div>

            <div style="display: flex; justify-content: flex-end; gap: 12px; padding-top: 24px; border-top: 1px solid #f1f5f9;">
                <a href="{{ route('items.index') }}" style="background-color: #f8fafc; color: #64748b; text-decoration: none; padding: 12px 28px; border-radius: 10px; font-size: 0.95rem; font-weight: 600; border: 1px solid #e2e8f0;">Batal</a>
                <button type="submit" style="background-color: #4f46e5; color: white; border: none; padding: 12px 32px; border-radius: 10px; font-size: 0.95rem; font-weight: 600; cursor: pointer; transition: all 0.2s; box-shadow: 0 4px 12px rgba(79, 70, 229, 0.2);">Update</button>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const totalInput = document.getElementById('input-total');
        const brokeInput = document.getElementById('input-broke');
        const maxBrokeInfo = document.getElementById('max-broke-info');

        const currentRepair = parseInt(document.getElementById('current-repair').innerText);
        const currentLending = parseInt(document.getElementById('current-lending').innerText);

        function calculateMaxAvailable() {
            const currentTotal = parseInt(totalInput.value) || 0;

            let available = currentTotal - currentRepair - currentLending;
            if (available < 0) available = 0;

            brokeInput.max = available;
            maxBrokeInfo.innerText = `Sisa tersedia: ${available} unit`;

            if (available === 0) {
                maxBrokeInfo.style.color = '#ef4444';
            } else {
                maxBrokeInfo.style.color = '#059669';
            }

            if (parseInt(brokeInput.value) > available) {
                brokeInput.value = available;
            }
        }

        calculateMaxAvailable();

        totalInput.addEventListener('input', calculateMaxAvailable);

        brokeInput.addEventListener('input', function() {
            const max = parseInt(this.max);
            const val = parseInt(this.value);

            if (val > max) {
                this.value = max;
                alert('⚠️ Peringatan: Tidak bisa memasukkan barang rusak melebihi stok yang tersedia (' + max + ' unit).');
            }
        });
    });
</script>
@endsection
