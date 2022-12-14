<div>
    <div class="card shadow-sm">
        <div class="card-header">
            <h3 class="card-title">
                Data Management Tugas
            </h3>
            <div class="card-toolbar">
                <button class="mx-2 btn btn-sm btn-outline btn-outline-warning btn-acitve-light-warning mx-2" data-bs-toggle="tooltip" data-bs-placement="top" title="Filter Data" wire:click="$emit('onClickFilter')">
                    <i class="fas fa-filter"></i> Filter
                </button>
                <button class="btn btn-sm btn-outline btn-outline-primary mx-2" wire:click="$emit('onClickTambah')">
                    <i class="bi bi-plus-circle"></i> Tambah
                </button>
            </div>
        </div>
        <div class="card-body">
            @include('helper.alert-message')
            <div class="text-center">
                @include('helper.simple-loading', ['target' => 'cari,hapusManagementTugas', 'message' => 'Memuat
                data...'])
            </div>
            <div class="row mb-5 justify-content-between">
                <div class="col-md-3 col-6">
                    @include('helper.form-pencarian', ['model' => 'cari'])
                </div>
                <div class="col-md text-end">
                    <button class="btn btn-sm btn-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Kirim Semua Ke Daftar Tugas" wire:click="$emit('onClickSendAll')">
                        <i class="fa-solid fa-share-from-square"></i> Send All
                    </button>
                </div>
            </div>

            {{-- <div class="table-responsive"> --}}
                <div class="tables w-100" style="position: relative !important">
                    <table class="table table-rounded table-striped border gy-7 gs-7">
                        <thead>
                            <tr class="fw-semibold fs-6 text-gray-800 border-bottom border-gray-200 sticky">
                                <th>No</th>
                                <th>Nomor Pekerjaan</th>
                                <th>Project</th>
                                <th>No.MFG</th>
                                <th>Pekerja</th>
                                <th>Tanggal Pekerjaan</th>
                                <th>Jam Mulai</th>
                                <th>Jam Selesai</th>
                                <th>Periode</th>
                                <th>Status</th>
                                <th>Aksi</th>
                                <th>Customer</th>
                                <th>Form</th>
                                <th>Jumlah Service</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($listLaporanPekerjaan) > 0)
                            @foreach ($listLaporanPekerjaan as $index => $item)
                            <tr>
                                <td>{{ ($page - 1) * $total_show + $index + 1 }}</td>
                                <td>{{ $item->kode_pekerjaan }}</td>
                                <td>{{ $item->project ? $item->project->nama : '-' }}</td>
                                <td>{{ $item->project ? $item->project->no_mfg : '-' }}</td>
                                <td>
                                    @foreach ($item->teknisi as $nama)
                                    {{ $nama->user ? $nama->user->name : '-' }},
                                    @endforeach
                                </td>
                                <td>{{ Carbon\Carbon::parse($item->tanggal_pekerjaan)->locale('id')->isoFormat('DD/MM/YYYY') ?? '-' }}</td>
                                <td>{{ $item->jam_mulai_formatted ?? '-' }}</td>
                                <td>
                                    @if ($item->jam_selesai)
                                        {{ $item->jam_selesai_formatted ?? '-' }}
                                    @elseif($item->tanggal_estimasi)
                                        {{ date('d-m-Y H:i', strtotime($item->tanggal_estimasi)) }}
                                    @endif
                                </td>
                                <td>
                                    @if ($item->is_emergency_call == 1)
                                        <span class="badge badge-warning">Laporan Pekerjaan</span>
                                    @else
                                    {{ $item->periode }} Bulan
                                    @endif</td>
                                <td>
                                    @if ($item->signature != null && $item->jam_selesai != null)
                                        <span class="badge badge-success">Selesai</span>
                                    @elseif(count($item->teknisi) > 0 && $item->jam_mulai != null)
                                        <span class="badge badge-warning">Sedang Dikerjakan</span>
                                    @else
                                        <span class="badge badge-secondary">Belum Dikerjakan</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('management-tugas.export', ['id' => $item->id]) }}"
                                            class="btn btn-sm btn-icon btn-warning" data-bs-toggle="tooltip"
                                            data-bs-placement="top" title="Cetak Management Tugas">
                                            <i class="bi bi-printer"></i>
                                        </a>
                                        @if ($item->jam_selesai == null && $item->signatur == null)
                                        <button class="btn btn-sm btn-icon btn-success" data-bs-toggle="tooltip"
                                            data-bs-placement="top" title="Edit Management Tugas"
                                            wire:click="$emit('onClickEdit', {{ $item->id }})">
                                            <i class="bi bi-pencil-square"></i>
                                        </button>
                                        <button class="btn btn-sm btn-icon btn-danger" data-bs-toggle="tooltip"
                                            data-bs-placement="top" title="Hapus Management Tugas"
                                            wire:click="$emit('onClickHapus', {{ $item->id }})">
                                            <i class="bi bi-trash-fill"></i>
                                        </button>
                                        <button class="btn btn-sm btn-icon btn-info" data-bs-toggle="tooltip"
                                            data-bs-placement="top" title="Atur Jadwal Tugas"
                                            wire:click="$emit('onClickAturJadwal', {{ $item->id }})">
                                            <i class="bi bi-stopwatch"></i>
                                        </button>
                                        @endif
                                        @if ($item->dikirim == 0)
                                            <button class="btn btn-sm btn-icon btn-warning" data-bs-toggle="tooltip"
                                                data-bs-placement="top" title="Kirim ke daftar tugas"
                                                wire:click="$emit('onClickKirim', {{ $item->id }})">
                                                <i class="bi bi-send"></i>
                                            </button>
                                        @endif
                                        <a href="{{ route('management-tugas.detail', ['id' => $item->id]) }}"
                                            class="btn btn-sm btn-icon btn-primary" data-bs-toggle="tooltip"
                                            data-bs-placement="top" title="Lihat Detail Pekerjaan">
                                            <i class="bi bi-eye-fill"></i>
                                        </a>
                                    </div>
                                </td>
                                <td>{{ $item->customer->nama }}</td>
                                <td>{{ $item->formMaster->nama }} ({{ $item->formMaster->kode }})</td>
                                <td>
                                    @php
                                    $jumlahService = 0;
                                    foreach($item->formMaster->templatePekerjaan as $templatePekerjaan){
                                        foreach ($templatePekerjaan->detail as $detail) {
                                            $jumlahService ++;
                                        }
                                    }

                                    echo $jumlahService;
                                    @endphp
                                </td>
                            </tr>
                            @endforeach
                            @else
                            <tr>
                                <td colspan="16" class="text-center text-gray-500">Tidak ada data</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            {{-- </div> --}}
            <div class="text-center">{{ $listLaporanPekerjaan->links() }}</div>
        </div>
    </div>

    <div wire:ignore.self class="modal fade" tabindex="-1" id="modal_filter">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Filter Data</h3>

                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <span class="svg-icon svg-icon-1">
                            <i class="bi bi-x-circle"></i>
                        </span>
                    </div>
                    <!--end::Close-->
                </div>

                <div class="modal-body">
                    @include('helper.alert-message')
                    <div class="text-center">
                        @include('helper.simple-loading', ['target' => 'simpanMetodePembayaran', 'message' => 'Menyimpan data ...'])
                    </div>
                    <div class="mb-5">
                        <label for="" class="form-label">Tanggal Pekerjaan</label>
                        <input type="date" class="form-control form-control-solid" name="tanggal_pekerjaan" wire:model="tanggal_pekerjaan" data-dropdown-parent="#modal_filter" placeholder="Pilih Tanggal" autocomplete="off" required>
                        @error('tanggal_pekerjaan')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-5">
                        <label for="" class="form-label">Project</label>
                        <select name="id_project" wire:model="id_project" class="form-select form-select-solid" data-control="select2" data-dropdown-parent="#modal_filter" data-placeholder="Pilih">
                            <option value="">Pilih</option>
                            @foreach ($listProject as $item)
                                <option value="{{ $item->id }}">{{ $item->kode }} - {{ $item->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-5">
                        <label for="" class="form-label">Status Pekerjaan</label>
                        <select name="status_pekerjaan" wire:model="status_pekerjaan" class="form-select form-select-solid" data-control="select2" data-dropdown-parent="#modal_filter" data-placeholder="Pilih">
                            <option value="">Pilih</option>
                            <option value="0">Belum Dikerjakan</option>
                            <option value="1">Sedang Dikerjakan</option>
                            <option value="2">Selesai</option>
                        </select>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-light" wire:click="clearFilter" data-bs-dismiss="modal">Clear</button>
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal"><i class="fas fa-search"></i> Cari</button>
                </div>
            </div>
        </div>
    </div>
</div>

@push('js')
<script>
        $(document).ready(function () {
        });

        window.addEventListener('contentChange', function(){
            $('select[name="status_pekerjaan"]').select2();
        })

        $('select[name="status_pekerjaan"]').on('change', function(){
            @this.set('status_pekerjaan', $(this).val())
        })

        Livewire.on('finishRefreshData', (status, message) => {
            $('.modal').modal('hide')
            alertMessage(status, message)
        })

        Livewire.on('onClickTambah', () => {
            $('#modal_form').modal('show')
        })

        Livewire.on('onClickEdit', (id) => {
            Livewire.emit('setDataManagementTugas', id);
            $('#modal_form').modal('show')
        })
        Livewire.on('onClickKirim', (id) => {
            Livewire.emit('setKirim', id);
        })

        Livewire.on('onClickHapus', async (id) => {
            const response = await alertConfirm("Peringatan !", "Apakah kamu yakin ingin menghapus management tugas ?")
            if(response.isConfirmed == true){
                Livewire.emit('hapusManagementTugas', id)
            }
        })

        Livewire.on('onClickAturJadwal', (id) => {
            Livewire.emit('setDataLaporanPekerjaan', id)
            $('#modal_atur_jadwal').modal('show');
        })

        Livewire.on('onClickFilter', () => {
            $('#modal_filter').modal('show')
        })

        Livewire.on('onClickSendAll', async () => {
            const response = await alertConfirmCustom('Peringatan !', "Apakah kamu yakin ingin mengirim semua data yang belum masuk daftar tugas ke daftar tugas ?", 'Ya, Kirim')
            if(response.isConfirmed == true){
                Livewire.emit('sendAllData')
            }
        })
</script>
@endpush
