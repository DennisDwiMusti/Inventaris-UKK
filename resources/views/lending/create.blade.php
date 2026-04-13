@extends('templates.app')

@section('content')
<div style="padding: 24px; max-width: 800px; margin: 0 auto; font-family: 'Inter', sans-serif;">
    <div style="background: white; padding: 40px; border-radius: 20px; box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.05); border: 1px solid #e2e8f0;">

        <div style="margin-bottom: 32px;">
            <h2 style="color: #0f172a; font-size: 1.5rem; font-weight: 800; margin: 0 0 8px 0; letter-spacing: -0.025em;">Lending Form</h2>
            <p style="color: #64748b; font-size: 0.95rem; margin: 0;">
                Sistem otomatis mengunci barang jika <span style="color: #ef4444; font-weight: 600;">stok habis</span> atau melampaui batas.
            </p>
        </div>

        @if(session('error'))
            <div style="background-color: #fee2e2; color: #b91c1c; padding: 16px 20px; border-radius: 10px; margin-bottom: 24px; border: 1px solid #fecaca; font-weight: 500;">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('lendings.store') }}" method="POST">
            @csrf

            <div style="margin-bottom: 24px;">
                <label style="display: block; color: #0f172a; font-size: 0.95rem; font-weight: 600; margin-bottom: 8px;">Nama Peminjam</label>
                <input type="text" name="name" value="{{ old('name') }}" placeholder="Contoh: Pak Acep" required
                       style="width: 100%; padding: 12px 16px; font-size: 0.95rem; border-radius: 10px; outline: none; border: 1px solid #e2e8f0; color: #1e293b; transition: all 0.2s;"
                       onfocus="this.style.borderColor='#4f46e5'; this.style.boxShadow='0 0 0 4px rgba(79, 70, 229, 0.1)'"
                       onblur="this.style.borderColor='#e2e8f0'; this.style.boxShadow='none'">
            </div>

            <div id="items-container">
                <div class="item-group" style="position: relative; margin-bottom: 24px; padding-bottom: 16px; border-bottom: 1px solid transparent;">

                    <button type="button" class="btn-delete-item" style="display: none; position: absolute; right: 0; top: 0; background: #fee2e2; color: #ef4444; border: none; width: 28px; height: 28px; border-radius: 6px; cursor: pointer; align-items: center; justify-content: center; z-index: 10;">
                        <i class="fas fa-times"></i>
                    </button>

                    <div style="margin-bottom: 16px;">
                        <label style="display: block; color: #0f172a; font-size: 0.95rem; font-weight: 600; margin-bottom: 8px;">Pilih Barang</label>
                        <select name="item_id[]" required class="item-select"
                                style="width: 100%; padding: 12px 16px; font-size: 0.95rem; border-radius: 10px; outline: none; background: white; cursor: pointer; border: 1px solid #e2e8f0; color: #1e293b;">
                            <option value="" disabled selected>-- Pilih Barang --</option>

                            @foreach($items as $item)
                                @php
                                    $available = $item->total - $item->repair - $item->lending_id;
                                @endphp

                                <option value="{{ $item->id }}" data-available="{{ $available }}" {{ $available <= 0 ? 'disabled' : '' }}>
                                    {{ $item->name }} (Sisa: {{ $available }} Unit)
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <div style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 8px;">
                            <label style="color: #0f172a; font-size: 0.95rem; font-weight: 600;">Jumlah Pinjam</label>
                            <span class="stock-info" style="font-size: 0.8rem; color: #10b981; font-weight: 600;">Pilih barang terlebih dahulu</span>
                        </div>
                        <input type="number" name="total_items[]" placeholder="0" required min="1" class="item-total-input"
                               style="width: 100%; padding: 12px 16px; font-size: 0.95rem; border-radius: 10px; outline: none; border: 1px solid #e2e8f0; color: #1e293b;">
                    </div>
                </div>
            </div>

            <button type="button" id="btn-add-more" style="background: none; border: none; color: #4f46e5; font-weight: 700; font-size: 0.95rem; cursor: pointer; display: flex; align-items: center; gap: 6px; margin-bottom: 24px; padding: 6px 12px; border-radius: 8px; transition: all 0.2s;" onmouseover="this.style.backgroundColor='#e0e7ff'" onmouseout="this.style.backgroundColor='transparent'">
                <i class="fas fa-plus-circle"></i> Tambah Barang Lain
            </button>

            <div style="margin-bottom: 32px;">
                <label style="display: block; color: #0f172a; font-size: 0.95rem; font-weight: 600; margin-bottom: 8px;">Tujuan Peminjaman (Ket.)</label>
                <textarea name="keterangan" rows="4" required placeholder="Contoh: Untuk ujian praktikum siswa kelas XII..."
                          style="width: 100%; padding: 12px 16px; font-size: 0.95rem; border-radius: 10px; outline: none; border: 1px solid #e2e8f0; color: #1e293b; resize: vertical; transition: all 0.2s;"
                          onfocus="this.style.borderColor='#4f46e5'; this.style.boxShadow='0 0 0 4px rgba(79, 70, 229, 0.1)'"
                          onblur="this.style.borderColor='#e2e8f0'; this.style.boxShadow='none'"></textarea>
            </div>

            <div style="display: flex; justify-content: flex-end; gap: 12px; border-top: 1px solid #f1f5f9; padding-top: 24px;">
                <a href="{{ route('lendings.index') }}" style="background-color: #f8fafc; color: #64748b; text-decoration: none; padding: 12px 28px; border-radius: 10px; font-size: 0.95rem; font-weight: 600; border: 1px solid #e2e8f0; transition: all 0.2s;">
                    Batal
                </a>
                <button type="submit" style="background-color: #4f46e5; color: white; border: none; padding: 12px 32px; border-radius: 10px; font-size: 0.95rem; font-weight: 600; cursor: pointer; box-shadow: 0 4px 12px rgba(79, 70, 229, 0.25); transition: all 0.2s;">
                    Konfirmasi Pinjaman
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const container = document.getElementById('items-container');
        const btnAdd = document.getElementById('btn-add-more');

        btnAdd.addEventListener('click', function() {
            const firstGroup = container.querySelector('.item-group');
            const newGroup = firstGroup.cloneNode(true);

            newGroup.querySelector('select').value = '';
            newGroup.querySelector('input').value = '';
            newGroup.querySelector('input').removeAttribute('max');
            newGroup.querySelector('.stock-info').innerText = 'Pilih barang terlebih dahulu';
            newGroup.querySelector('.stock-info').style.color = '#10b981';

            newGroup.querySelector('.btn-delete-item').style.display = 'flex';
            newGroup.style.borderTop = '1px dashed #cbd5e1';
            newGroup.style.paddingTop = '24px';
            newGroup.style.marginTop = '8px';

            container.appendChild(newGroup);
        });

        container.addEventListener('click', function(e) {
            if (e.target.closest('.btn-delete-item')) {
                e.target.closest('.item-group').remove();
            }
        });

        container.addEventListener('change', function(e) {
            if (e.target.classList.contains('item-select')) {
                const select = e.target;
                const group = select.closest('.item-group');
                const input = group.querySelector('.item-total-input');
                const info = group.querySelector('.stock-info');

                const selectedOption = select.options[select.selectedIndex];
                const maxAvailable = parseInt(selectedOption.getAttribute('data-available'));

                if (!isNaN(maxAvailable)) {
                    input.max = maxAvailable;
                    input.placeholder = "Maks: " + maxAvailable;
                    info.innerText = "Sisa Stok: " + maxAvailable + " Unit";

                    info.style.color = maxAvailable < 5 ? '#ef4444' : '#059669';

                    if (parseInt(input.value) > maxAvailable) {
                        input.value = maxAvailable;
                    }
                }
            }
        });

        container.addEventListener('input', function(e) {
            if (e.target.classList.contains('item-total-input')) {
                const max = parseInt(e.target.max);
                const currentVal = parseInt(e.target.value);

                if (!isNaN(max) && currentVal > max) {
                    e.target.value = max;
                    alert('⚠️ Peringatan: Stok barang tidak mencukupi! Maksimal yang dapat dipinjam hanya ' + max + ' unit.');
                }
            }
        });
    });
</script>
@endsection
