<div>
    @include('helper.alert-message')
    <div class="text-center">
        @include('helper.simple-loading', ['target' => 'cari,hapusBarang', 'message' => 'Memuat data...'])
    </div>
    <div class="row mb-5">
        <div class="col-md-3">
            @include('helper.form-pencarian', ['model' => 'cari'])
        </div>
        <div class="col-md text-end">
            <button type="button" class="btn btn-sm btn-outline btn-outline-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Tambah Data Barang" wire:click="changeTambahBarang">
                <i class="bi bi-plus-circle"></i> Tambah
            </button>
        </div>
    </div>
    @if ($tambahBarang)
    <form action="#" method="POST" wire:submit.prevent="simpanDataBarang">
        <div class="row mb-5">
            <div class="col-md-6 mb-5">
                <label for="" class="form-label required">Barang / Sparepart</label>
                <select name="id_barang" wire:model="id_barang" class="form-select form-select-solid" data-control="select2" data-placeholder="Pilih" required>
                    <option value="">Pilih</option>
                    @foreach ($listBarang as $item)
                        <option value="{{ $item->id }}">{{ $item->nama }}</option>
                    @endforeach
                </select>
                @error('id_barang')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="col-md-6">
                <label for="" class="form-label required">Qty / Jumlah</label>
                <input type="number" class="form-control form-control-solid" name="qty" wire:model="qty" placeholder="Masukkan jumlah" required>
                @error('qty')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>
        <div class="row mb-5">
            <div class="col-md-6">
                <div class="row mb-5">
                    <div class="col-md-4 col-4">
                        SKU
                    </div>
                    <div class="col-md-8 col-8">
                        : <span class="fw-bold">{{ $barang ? $barang->sku : null }}</span>
                    </div>
                </div>
                <div class="row mb-5">
                    <div class="col-md-4 col-4">
                        Nama Barang
                    </div>
                    <div class="col-md-8 col-8">
                        : <span class="fw-bold">{{ $barang ? $barang->nama : null }}</span>
                    </div>
                </div>
                <div class="row mb-5">
                    <div class="col-md-4 col-4">
                        Stock
                    </div>
                    <div class="col-md-8 col-8">
                        : <span class="fw-bold">{{ $barang ? $barang->stock : null }}</span>
                    </div>
                </div>
                <div class="row mb-5">
                    <div class="col-md-4 col-4">
                        Harga
                    </div>
                    <div class="col-md-8 col-8">
                        : <span class="fw-bold">{{ $barang ? $barang->harga_formatted : null }}</span>
                    </div>
                </div>
                <div class="row mb-5">
                    <div class="col-md-4 col-4">
                        Satuan
                    </div>
                    <div class="col-md-8 col-8">
                        : <span class="fw-bold">{{ $barang && $barang->satuan ? $barang->satuan->nama_satuan : null }}</span>
                    </div>
                </div>
                <div class="row mb-5">
                    <div class="col-md-4 col-4">
                        Merk
                    </div>
                    <div class="col-md-8 col-8">
                        : <span class="fw-bold">{{ $barang && $barang->merk ? $barang->merk->nama_merk : null }}</span>
                    </div>
                </div>
                <div class="row mb-5">
                    <div class="col-md-4 col-4">
                        Tipe Barang
                    </div>
                    <div class="col-md-8 col-8">
                        : <span class="fw-bold">{{ $barang && $barang->tipeBarang ? $barang->tipeBarang->tipe_barang : null }}</span>
                    </div>
                </div>
                <div class="row mb-5">
                    <div class="col-md-4 col-4">
                        Deskripsi
                    </div>
                    <div class="col-md-8 col-8">
                        : <span class="fw-bold">{{ $barang ? $barang->deskripsi : null }}</span>
                    </div>
                </div>
                <div class="row mb-5">
                    <div class="col-md-4 col-4">
                        Sub Total
                    </div>
                    <div class="col-md-8 col-8">
                        : <span class="fw-bold">
                            @if ($qty && $barang)
                                {{ 'Rp. ' . number_format($barang->harga * $qty,0,',','.') }}
                            @endif
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-md-6 text-end">
                <button type="submit" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Simpan Data">
                    <i class="bi bi-save"></i> Simpan
                </button>
            </div>
        </div>
    </form>
    @endif
    <div class="table-responsive">
        <table class="table table-rounded table-striped border gy-7 gs-7">
            <thead>
                <tr class="fw-semibold fs-6 text-gray-800 border-bottom border-gray-200">
                    <th>No</th>
                    <th>SKU</th>
                    <th>Nama Barang</th>
                    <th>Harga</th>
                    <th>Qty</th>
                    <th>Satuan</th>
                    <th>Deskripsi</th>
                    <th>Subtotal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @if (count($quotation->quotationDetail) > 0)
                    @php
                        $subTotal = 0;
                    @endphp
                    @foreach ($quotation->quotationDetail as $index => $item)
                    @php
                        $subTotal += $item->harga * $item->qty;
                    @endphp
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $item->barang->sku }}</td>
                            <td>{{ $item->barang->nama }}</td>
                            <td>{{ $item->harga_formatted }}</td>
                            <td>{{ $item->qty }}</td>
                            <td>{{ $item->satuan->nama_satuan }}</td>
                            <td>{{ $item->deskripsi ?? '-' }}</td>
                            <td>{{ $item->sub_total_formatted }}</td>
                            <td>
                                <div class="btn-group">
                                    <button class="btn btn-sm btn-icon btn-success" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Detail Quotation" wire:click="setDataBarang({{ $item->id }})">
                                        <i class="bi bi-pencil-square"></i>
                                    </button>
                                    <button class="btn btn-sm btn-icon btn-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus Detail Quotation" wire:click="$emit('onClickHapus', {{ $item->id }})">
                                        <i class="bi bi-trash-fill"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    @php
                        $ppn = 10/100*$subTotal;
                        $total = $ppn + $subTotal;
                    @endphp
                    <tr>
                        <td colspan="6" class="text-center fw-bold fst-italic">Sub Total</td>
                        <td colspan="2" class="fw-bold">{{ 'Rp. ' . number_format($subTotal,0,',','.') }}</td>
                    </tr>
                    <tr>
                        <td colspan="6" class="text-center fw-bold fst-italic">PPN 10%</td>
                        <td colspan="2" class="fw-bold">{{ 'Rp. ' . number_format($ppn,0,',','.') }}</td>
                    </tr>
                    <tr>
                        <td colspan="6" class="text-center fw-bold fst-italic">Total</td>
                        <td colspan="2" class="fw-bold">{{ 'Rp. ' . number_format($total,0,',','.') }}</td>
                    </tr>
                @else
                    <tr>
                        <td colspan="8" class="text-center text-gray-500">Tidak ada data</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>

@push('js')
    <script>
        $(document).ready(function () {
            refreshSelect()
        });

        window.addEventListener('contentChange', function(){
            refreshSelect()
        })

        function refreshSelect(){
            $('select[name="id_barang"]').select2()
            $('select[name="id_barang"]').on('change', function(){
                @this.set('id_barang', $(this).val())
            })
        }

        Livewire.on('onClickHapus', async (id) => {
            const response = await alertConfirm('Peringatan !', 'Apakah kamu yakin ingin menghapus data ?');
            if(response.isConfirmed == true){
                Livewire.emit('hapusDataBarang', id)
            }
        })

        Livewire.on('finishRefreshBarang', (status, message) => {
            alertMessage(status, message)
        })
    </script>
@endpush
