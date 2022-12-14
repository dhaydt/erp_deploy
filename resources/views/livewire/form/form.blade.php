<div>
    <div wire:ignore.self class="modal fade form-master" tabindex="-1" id="modal_form_master">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Form</h3>

                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <span class="svg-icon svg-icon-1">
                            <i class="bi bi-x-circle"></i>
                        </span>
                    </div>
                    <!--end::Close-->
                </div>

                <form action="#" wire:submit.prevent="simpanForm">
                    <div class="modal-body">
                        @include('helper.alert-message')
                        <div class="text-center">
                            @include('helper.simple-loading', ['target' => 'simpanForm', 'message' => 'Menyimpan data ...'])
                        </div>
                        <div class="mb-5">
                            <label for="" class="form-label required">Kode Form</label>
                            <input type="text" class="form-control form-control-solid" name="kode" wire:model="kode" placeholder="Masukkan kode form" required>
                            @error('kode')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-5">
                            <label for="" class="form-label required">Nama</label>
                            <input type="text" class="form-control form-control-solid" name="nama" wire:model="nama" placeholder="Masukkan nama form" required>
                            @error('nama')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-5 col-md-12">
                            <label for="" class="form-label required">Periode Pekerjaan</label>
                            <select name="periode_master" wire:model="periode_master" class="form-select form-select-solid" data-control="select2" data-dropdown-parent="#modal_form_master" data-placeholder="Pilih Periode" multiple required>
                                <option value="">Pilih</option>
                                @for($i = 1; $i <= 12; $i++)
                                    <option value="{{ $i }}">{{ $i }} Bulan</option>
                                @endfor
                            </select>
                            @error('periode')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        {{-- <div class="mb-5">
                            <label for="" class="form-label">Keterangan</label>
                            <textarea name="keterangan" wire:model="keterangan" class="form-control form-control-solid" placeholder="Masukkan keterangan"></textarea>
                            @error('keterangan')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div> --}}
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary"><i class="bi bi-box-arrow-down"></i> Simpan</button>
                    </div>
                </form>
            </div>
        </div>
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
            $('select[name="periode_master"]').select2()

            $('select[name="periode_master"]').on('change', function(){
                @this.set('periode_master', $(this).val())
            })
        }

        Livewire.on('finishSimpanData', (status, message) => {
            $('.modal').modal('hide')
            alertMessage(status, message)
        })
    </script>
@endpush
