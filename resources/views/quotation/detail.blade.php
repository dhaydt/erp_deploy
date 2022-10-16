@extends('template.layout')
@section('content')
    <div class="card shadow-sm">
        <div class="card-header">
            <h3 class="card-title">
                Detail Quotation
            </h3>
            <div class="card-toolbar">
                <a href="{{ route('quotation.export', ['id' => $quotation->id]) }}" class="btn btn-sm btn-outline btn-outline-danger mx-2" data-bs-toggle="tooltip" data-bs-placement="top" title="Cetak PDF">
                    <i class="bi bi-printer"></i> Cetak
                </a>
                <a href="" class="btn btn-sm btn-outline btn-outline-primary mx-2" data-bs-toggle="tooltip" data-bs-placement="top" title="Kirim Quotation">
                    <i class="fa-solid fa-paper-plane"></i> Kirim
                </a>
            </div>
        </div>
        <div class="card-body">
            @if ($quotation->laporanPekerjaan)
            <div class="row mb-7">
                <div class="col-md-4 mb-10">
                    <div class="mb-5 fw-bold">
                        Customer
                    </div>
                    <div class="row mb-5">
                        <div class="col-md-4 col-4">
                            Nama
                        </div>
                        <div class="col-md-8 col-8 fw-bold">
                            : {{ $quotation->laporanPekerjaan->customer->nama }}
                        </div>
                    </div>
                    <div class="row mb-5">
                        <div class="col-md-4 col-4">
                            No HP
                        </div>
                        <div class="col-md-8 col-8 fw-bold">
                            : {{ $quotation->laporanPekerjaan->customer->no_hp }}
                        </div>
                    </div>
                    <div class="row mb-5">
                        <div class="col-md-4 col-4">
                            Email
                        </div>
                        <div class="col-md-8 col-8 fw-bold">
                            : {{ $quotation->laporanPekerjaan->customer->email }}
                        </div>
                    </div>
                    <div class="row mb-5">
                        <div class="col-md-4 col-4">
                            Alamat
                        </div>
                        <div class="col-md-8 col-8 fw-bold">
                            : {{ $quotation->laporanPekerjaan->customer->alamat }}
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-10">
                    <div class="mb-5 fw-bold">
                        Project
                    </div>
                    <div class="row mb-5">
                        <div class="col-md-4 col-4">
                            Nama
                        </div>
                        <div class="col-md-8 col-8 fw-bold">
                            : {{ $quotation->laporanPekerjaan->project->nama }}
                        </div>
                    </div>
                    <div class="row mb-5">
                        <div class="col-md-4 col-4">
                            Kode
                        </div>
                        <div class="col-md-8 col-8 fw-bold">
                            : {{ $quotation->laporanPekerjaan->project->kode }}
                        </div>
                    </div>
                    <div class="row mb-5">
                        <div class="col-md-4 col-4">
                            No Unit
                        </div>
                        <div class="col-md-8 col-8 fw-bold">
                            : {{ $quotation->laporanPekerjaan->project->no_unit }}
                        </div>
                    </div>
                    <div class="row mb-5">
                        <div class="col-md-4 col-4">
                            No MFG
                        </div>
                        <div class="col-md-8 col-8 fw-bold">
                            : {{ $quotation->laporanPekerjaan->project->no_mfg }}
                        </div>
                    </div>
                    <div class="row mb-5">
                        <div class="col-md-4 col-4">
                            Alamat
                        </div>
                        <div class="col-md-8 col-8 fw-bold">
                            : {{ $quotation->laporanPekerjaan->project->alamat }}
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-10">
                    <div class="mb-5 fw-bold">
                        Data Tambahan
                    </div>
                    <div class="row mb-5">
                        <div class="col-md-4 col-4">
                            Merk
                        </div>
                        <div class="col-md-8 col-8 fw-bold">
                            : {{ $quotation->laporanPekerjaan->merk->nama_merk }}
                        </div>
                    </div>
                    <div class="row mb-5">
                        <div class="col-md-4 col-4">
                            Nama Form
                        </div>
                        <div class="col-md-8 col-8 fw-bold">
                            : {{ $quotation->laporanPekerjaan->formMaster->nama }}
                        </div>
                    </div>
                    <div class="row mb-5">
                        <div class="col-md-4 col-4">
                            Kode Form
                        </div>
                        <div class="col-md-8 col-8 fw-bold">
                            : {{ $quotation->laporanPekerjaan->formMaster->kode }}
                        </div>
                    </div>
                    <div class="row mb-5">
                        <div class="col-md-4 col-4">
                            Nomor Lift
                        </div>
                        <div class="col-md-8 col-8 fw-bold">
                            : {{ $quotation->laporanPekerjaan->nomor_lift }}
                        </div>
                    </div>
                    <div class="row mb-5">
                        <div class="col-md-4 col-4">
                            Teknisi
                        </div>
                        <div class="col-md-8 col-8 fw-bold">
                            : {{ $quotation->laporanPekerjaan->user->name }}
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            @endif
            <ul class="nav nav-tabs nav-line-tabs mb-5 fs-6">
                <li class="nav-item">
                    <a class="nav-link active" data-bs-toggle="tab" href="#kt_tab_pane_1">Penawaran</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#kt_tab_pane_2">Quotation Send Log</a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="kt_tab_pane_1" role="tabpanel">
                    @livewire('quotation.detail', ['id_quotation' => $quotation->id])
                </div>
                <div class="tab-pane fade" id="kt_tab_pane_2" role="tabpanel">
                    @livewire('quotation.send-log', ['id_quotation' => $quotation->id])
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function () {

        });
    </script>
@endsection