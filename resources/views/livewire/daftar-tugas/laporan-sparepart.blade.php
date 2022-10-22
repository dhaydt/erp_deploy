<div>
    <div class="card shadow-sm">
        <div class="card-header">
            <h3 class="card-title">
                Laporan Penggunaan Barang
            </h3>
            <div class="card-toolbar">
                <button class="btn btn-sm btn-outline btn-outline-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Tambah Spareparts" wire:click="changeTambahBarang">
                    <i class="bi bi-plus-circle"></i> Tambah
                </button>
            </div>
        </div>
        <div class="card-body">
            @if ($tambahBarang)
                <form action="#" method="POST" wire:submit.prevent="simpanLaporanPekerjaanBarang">
                    <div class="text-center">
                        @include('helper.simple-loading', ['target' => 'simpanLaporanPekerjaanBarang', 'message' => 'Sedang menyimpan data ...'])
                    </div>
                    <div class="row">
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
                        <div class="col-md-6">
                            <div class="row mb-5">
                                <div class="mb-5">
                                    <label for="" class="form-label required">Barang / Sparepart</label>
                                    <select name="id_barang" wire:model="id_barang" class="form-select form-select-solid" data-control="select2" data-placeholder="Pilih Barang" required>
                                        <option value="">Pilih</option>
                                        @foreach ($listBarang as $item)
                                            <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                        @endforeach
                                    </select>
                                    @error('id_barang')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mb-5">
                                    <label for="" class="form-label required">Jumlah / Qty</label>
                                    <input type="number" class="form-control form-control-solid" name="qty" wire:model="qty" placeholder="Masukkan jumlah" required>
                                    @error('qty')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mb-5">
                                    <label for="" class="form-label">Catatan Teknisi</label>
                                    <textarea name="catatan_teknisi" wire:model="catatan_teknisi" class="form-control form-control-solid" placeholder="Masukkan catatan"></textarea>
                                    @error('catatan_teknisi')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mb-5">
                                    <label for="" class="form-label">Keterangan Customer</label>
                                    <textarea name="keterangan_customer" wire:model="keterangan_customer" class="form-control form-control-solid" placeholder="Masukkan catatan"></textarea>
                                    @error('keterangan_customer')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="row justify-content-end mb-5">
                                <div class="text-end">
                                    <button type="submit" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Simpan Barang Ke Laporan">
                                        <i class="fa-solid fa-floppy-disk"></i> Simpan
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            @endif
            @include('helper.alert-message')
            <div class="text-center">
                @include('helper.simple-loading', ['target' => 'cari,hapusBarang', 'message' => 'Memuat data...'])
            </div>
            <div class="row mb-5">
                <div class="col-md-3">
                    @include('helper.form-pencarian', ['model' => 'cari'])
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-rounded table-striped border gy-7 gs-7">
                 <thead>
                  <tr class="fw-semibold fs-6 text-gray-800 border-bottom border-gray-200">
                   <th>No</th>
                   <th>Nama Barang</th>
                   <th>Tipe Barang</th>
                   <th>Harga</th>
                   <th>Satuan</th>
                   <th>Qty</th>
                   <th>Catatan Teknisi</th>
                   <th>Keterangan Customer</th>
                   <th>Status</th>
                   <th>Aksi</th>
                  </tr>
                 </thead>
                 <tbody>
                    @if (count($listLaporanPekerjaanBarang) > 0)
                        @foreach ($listLaporanPekerjaanBarang as $index => $item)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $item->barang->nama }}</td>

                                <td>{{ $item->barang->tipeBarang->tipe_barang }}</td>
                                <td>{{ $item->barang->harga_formatted }}</td>
                                <td>{{ $item->barang->satuan->nama_satuan }}</td>
                                <td>{{ $item->qty }}</td>
                                <td>{{ $item->catatan_teknisi }}</td>
                                <td>{{ $item->keterangan_customer }}</td>
                                <td><?= $item->status_formatted ?></td>
                                <td>
                                    <div class="btn-group">
                                        @if ($item->status == 0 || $item->status == 1)
                                            <button class="btn btn-sm btn-icon btn-success" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit" wire:click="$emit('onClickEditBarang', {{ $item->id }})">
                                                <i class="bi bi-pencil-square"></i>
                                            </button>
                                            <button class="btn btn-sm btn-icon btn-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus" wire:click="$emit('onClickHapusBarang', {{ $item->id }})">
                                                <i class="bi bi-trash-fill"></i>
                                            </button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="10" class="text-center text-gray-500">Tidak ada data</td>
                        </tr>
                    @endif
                 </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@push('js')
    <script>
        $(document).ready(function () {
        });

        window.addEventListener('contentChange', function(){
            $('select[name="id_barang"]').select2();
            $('select[name="id_barang"]').on('change', function(){
                @this.set('id_barang', $(this).val())
            })
        })


        Livewire.on('onClickEditBarang', (id) => {
            Livewire.emit('setDataLaporanPekerjaanBarang', id)
            @this.set('tambahBarang', true)
        })

        Livewire.on('onClickHapusBarang', async(id) => {
            const response = await alertConfirm('Peringatan !', "Apakah kamu yakin ingin menghapus barang ?")
            if(response.isConfirmed == true){
                Livewire.emit('hapusLaporanPekerjaanBarang', id)
            }
        })

        Livewire.on("finishSimpanData", (status, message) => {
            alertMessage(status, message);
        })
    </script>
@endpush
