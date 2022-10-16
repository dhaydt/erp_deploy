<!DOCTYPE html>
<html lang="en">
    @include('pdf_view.head')
<body class="p-10">
    @include('pdf_view.header')
    <div class="text-center fw-bold mb-10" style="font-size: 13pt">Laporan Pekerjaan</div>
    <div class="mb-10">
        <div style="float: left; width: 50%">
            <div class="table-responsive">
                <table>
                    <tr>
                        <td>Nomor Form</td>
                        <td>: Nomor Form</td>
                    </tr>
                    <tr>
                        <td>Pelanggan</td>
                        <td>: <span class="fw-bold">{{ $laporanPekerjaan->customer->nama }}</span></td>
                    </tr>
                    <tr>
                        <td>Nama Project</td>
                        <td>: <span class="fw-bold">{{ $laporanPekerjaan->project->nama }}</span></td>
                    </tr>
                    <tr>
                        <td>Kode Project</td>
                        <td>: <span class="fw-bold">{{ $laporanPekerjaan->project->kode }}</span></td>
                    </tr>
                    <tr>
                        <td>Alamat Project</td>
                        <td>: <span class="fw-bold">{{ $laporanPekerjaan->project->alamat }}</span></td>
                    </tr>
                </table>
            </div>
        </div>
        <div style="float: right; width: 50%">
            <div class="table-responsive">
                <table>
                    <tr>
                        <td>Merk</td>
                        <td>: <span class="fw-bold">{{ $laporanPekerjaan->merk->nama_merk }}</span></td>
                    </tr>
                    <tr>
                        <td>No. Lift</td>
                        <td>: <span class="fw-bold">{{ $laporanPekerjaan->nomor_lift }}</span></td>
                    </tr>
                </table>
            </div>
            <div class="table-responsive">
                <table>
                    <tr>
                        <td colspan="2" class="d-flex align-items-center">
                            <div style="float: left; width: 15px; height: 15px; border: 1px solid black" class="mx-2"></div>
                            <div class="mx-2" style="padding-left: 20px">Peminjaman suku cadang .... hari</div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" class="d-flex align-items-center">
                            <div style="float: left; width: 15px; height: 15px; border: 1px solid black" class="mx-2"></div>
                            <div class="mx-2" style="padding-left: 20px">Panggilan Darurat (Emergency Call)</div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" class="d-flex align-items-center">
                            <div style="float: left; width: 15px; height: 15px; border: 1px solid black;" class="mx-2"></div>
                            <div class="mx-2" style="padding-left: 20px">Surver / General Check Up / Modernisasi</div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" class="d-flex align-items-center">
                            <div style="float: left; width: 15px; height: 15px; border: 1px solid black" class="mx-2"></div>
                            <div class="mx-2" style="padding-left: 20px">Pemasangan / ....</div>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <div class="mb-10">
        <div class="py-3 px-5" style="border: 1px solid black; border-top-left-radius: 10px; border-top-right-radius: 10px">
            Catatan Teknisi dan Keterangan Pekerja :
        </div>
        <div class="py-3 px-5" style="border: 1px solid black; border-bottom-left-radius: 10px; border-bottom-right-radius: 10px; height: 100px;">
            {{ $laporanPekerjaan->keterangan }}
        </div>
    </div>
    <div class="mb-10">
        <div class="py-3 px-5" style="border: 1px solid black; border-top-left-radius: 10px; border-top-right-radius: 10px">
            Catatan Pelanggan :
        </div>
        <div class="py-3 px-5" style="border: 1px solid black; border-bottom-left-radius: 10px; border-bottom-right-radius: 10px; height: 100px">
            {{ $laporanPekerjaan->catatan_pelanggan }}
        </div>
    </div>
    <br>
    <div class="table-responsive">
        <table class="table">
            <tr style="width: 30%">
                <td>Tanggal : {{ $laporanPekerjaan->jam_mulai ? date('Y-m-d', strtotime($laporanPekerjaan->jam_mulai)) : null }}</td>
                <td>Jam Datang : {{ $laporanPekerjaan->jam_mulai ? date('H:i', strtotime($laporanPekerjaan->jam_mulai)) : null }}</td>
                <td>Jam Selesai : {{ $laporanPekerjaan->jam_selesai ? date('H:i', strtotime($laporanPekerjaan->jam_selesai)) : null }}</td>
            </tr>
            <tr style="width: 30%">
                <td>Diketahui Oleh,</td>
                <td>Diketahui Oleh,</td>
                <td>Diketahui Oleh,</td>
            </tr>
            <tr style="width: 30%">
                <td class="fw-bold">Kepala Teknik Divisi</td>
                <td class="fw-bold">Teknisi</td>
                <td class="fw-bold">Pelanggan</td>
            </tr>
            <tr style="width: 30%">
                <td>
                    <div style="height: 100px"></div>
                </td>
                <td>
                    <div style="height: 100px"></div>
                </td>
                <td>
                    <div style="height: 100px">
                        @if ($laporanPekerjaan->signature)
                            <img src="{{ asset('storage' . $laporanPekerjaan->signature) }}" height="100px" width="100" style="object-fit: contain" alt="">
                        @endif
                    </div>
                </td>
            </tr>
            <tr style="width: 30%">
                <td>Nama:</td>
                <td>Nama: {{ $laporanPekerjaan->user->name }}</td>
                <td>Nama: {{ $laporanPekerjaan->customer->nama }}</td>
            </tr>
        </table>
    </div>
    <div class="page-break"></div>
    @include('pdf_view.header')
    <div class="text-center fw-bold mb-10" style="font-size: 13pt">Laporan Perawatan Lift</div>
    <div class="mb-10">
        <div style="float: left; width: 50%">
            <div class="table-responsive">
                <table>
                    <tr>
                        <td>Nomor Form</td>
                        <td>: Nomor Form</td>
                    </tr>
                    <tr>
                        <td>Pelanggan</td>
                        <td>: <span class="fw-bold">{{ $laporanPekerjaan->customer->nama }}</span></td>
                    </tr>
                    <tr>
                        <td>Nama Project</td>
                        <td>: <span class="fw-bold">{{ $laporanPekerjaan->project->nama }}</span></td>
                    </tr>
                    <tr>
                        <td>Kode Project</td>
                        <td>: <span class="fw-bold">{{ $laporanPekerjaan->project->kode }}</span></td>
                    </tr>
                    <tr>
                        <td>Alamat Project</td>
                        <td>: <span class="fw-bold">{{ $laporanPekerjaan->project->alamat }}</span></td>
                    </tr>
                </table>
            </div>
        </div>
        <div style="float: right; width: 50%">
            <div class="table-responsive">
                <table>
                    <tr>
                        <td>Perawatan Ke</td>
                        <td>:</td>
                    </tr>
                    <tr>
                        <td>MFG No.</td>
                        <td>: <span class="fw-bold">{{ $laporanPekerjaan->project->no_mfg }}</span></td>
                    </tr>
                    <tr>
                        <td>No Unit</td>
                        <td>: <span class="fw-bold">{{ $laporanPekerjaan->project->no_unit }}</span></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <div class="table-responsive">
        <table class="table">
            <thead style="border: 1px solid black">
                <tr>
                    <td rowspan="2" class="align-items-center">NO</td>
                    <td rowspan="2" class="align-items-center">URAIAN PEKERJAAN</td>
                    <td rowspan="2" class="align-items-center">KONDISI</td>
                    <td rowspan="1" colspan="5" class="text-center align-items-center">CHECKLIST</td>
                    <td rowspan="2" class="align-items-center">KETERANGAN</td>
                </tr>
                <tr>
                    <td>1 Bulan</td>
                    <td>2 Bulan</td>
                    <td>3 Bulan</td>
                    <td>6 Bulan</td>
                    <td>1 Tahun</td>
                </tr>
            </thead>
            <tbody style="border: 1px solid black">
                @foreach ($listTemplatePekerjaan as $item)
                    <tr>
                        <td></td>
                        <td class="fw-bold">{{ $item->nama_pekerjaan }}</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>{{ $item->keterangan }}</td>
                    </tr>
                    @foreach ($item->detail as $index => $detail)
                        @php
                            $laporanPekerjaanChecklist = count($laporanPekerjaan->laporanPekerjaanChecklist) > 0 ? $laporanPekerjaan->laporanPekerjaanChecklist : null;
                            if ($laporanPekerjaanChecklist) {
                                $laporanPekerjaanChecklist = $laporanPekerjaanChecklist->where('id_template_pekerjaan_detail', $detail->id)->first();
                            }
                        @endphp
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $detail->nama_pekerjaan }}</td>
                            <td>
                                {{ $laporanPekerjaanChecklist ? $laporanPekerjaanChecklist->kondisi->keterangan : null }}
                            </td>
                            <td @if($detail->checklist_1_bulan == 0) style="background-color: black" @endif>

                            </td>
                            <td @if($detail->checklist_2_bulan == 0) style="background-color: black" @endif>

                            </td>
                            <td @if($detail->checklist_3_bulan == 0) style="background-color: black" @endif>

                            </td>
                            <td @if($detail->checklist_6_bulan == 0) style="background-color: black" @endif>

                            </td>
                            <td @if($detail->checklist_1_tahun == 0) style="background-color: black" @endif>

                            </td>
                            <td>
                                {{ $laporanPekerjaanChecklist ? $laporanPekerjaanChecklist->keterangan : null }}
                            </td>
                        </tr>
                    @endforeach
                @endforeach
            </tbody>
        </table>
    </div>
    <br>
    <br>
    <div>
        <div style="float: left; width: 50%">
            <span>Dilaksanakan Oleh :</span><br>
            <span class="fw-bold">Teknisi</span><br>
            <div style="height: 100px"></div><br>
            <span>Nama : {{ $laporanPekerjaan->user->name }}</span>
        </div>
        <div style="float: right; width: 50%">
            <span>Diketahui Oleh :</span><br>
            <span class="fw-bold">Pelanggan</span><br>
            <div style="height: 100px">
                @if ($laporanPekerjaan->signature)
                    <img src="{{ asset('storage' . $laporanPekerjaan->signature) }}" height="100" width="100" style="object-fit: contain" alt="">
                @endif
            </div><br>
            <span>Nama : {{ $laporanPekerjaan->user->name }}</span>
        </div>
    </div>
</body>
</html>