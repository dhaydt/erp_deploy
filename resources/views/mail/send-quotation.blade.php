
<style>
    html,body { padding: 0; margin:0; }
    th, td{
        padding-top: 7px;
        padding-bottom: 7px;
        padding-left: 10px;
        padding-right: 10px;
    }
</style>
<div style="font-family:Arial,Helvetica,sans-serif; line-height: 1.5; font-weight: normal; font-size: 15px; color: #2F3044; min-height: 100%; margin:0; padding:0; width:100%; background-color:#edf2f7">
	<table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse:collapse;margin:0 auto; padding:0; max-width:700px">
		<tbody>
			<tr>
				<td align="center" valign="center" style="text-align:center; padding: 40px">
					<a href="{{ url('') }}" rel="noopener" target="_blank">
						<img alt="Logo" src="{{ asset('/assets/images/icon.png') }}" style="height: 200px; object-fit: contain"/>
					</a>
				</td>
			</tr>
			<tr>
				<td align="left" valign="center">
					<div style="text-align:left; margin: 0 20px; padding: 40px; background-color:#ffffff; border-radius: 6px">
						<!--begin:Email content-->
						<div style="padding-bottom: 30px; font-size: 17px;">
                            <strong>PT.Mitra Global kencana</strong>
						</div>
                        <div>
                            <span>Kepada Yth:</span><br>
                            <strong>Bp.Hartono</strong><br>
                            <span>Jl.Kusuma Atmaja No.27</span><br>
                            <span>Menteng, Jakarta Pusat</span> <br>
                        </div>
                        <br>
                        <div>
                            <span style="font-weight: bold">Up : {{ $quotation->laporanPekerjaan->customer->nama }}</span><br>
                            <span style="font-weight: bold">Email : {{ $quotation->laporanPekerjaan->customer->email }}</span><br>
                            <span style="font-weight: bold">No Hp : {{ $quotation->laporanPekerjaan->customer->no_hp }}</span><br>
                            <span style="font-weight: bold">Alamat : {{ $quotation->laporanPekerjaan->customer->alamat }}</span><br>
                        </div>
                        <br>
                        <div>
                            <span>Dengan Hormat,</span><br>
                            <span>Bersama ini kami ajukan penawaran harga sebagai berikut: </span>
                            <br>
                            <br>
                            <table>
                                <thead style="border: 1px solid black">
                                    <th>No.</th>
                                    <th>Barang</th>
                                    <th>Harga</th>
                                    <th>Qty</th>
                                    <th>Satuan</th>
                                    <th>Deskripsi</th>
                                    <th>Subtotal</th>
                                </thead>
                                <tbody style="border: 1px solid black">
                                    @php
                                        $subTotal = 0;
                                    @endphp
                                    @foreach ($quotation->quotationDetail as $index => $item)
                                        @php
                                            $subTotal += $item->subTotal;
                                        @endphp
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $item->barang->nama }}</td>
                                            <td>{{ $item->harga_formatted }}</td>
                                            <td>{{ $item->qty }}</td>
                                            <td>{{ $item->satuan->nama_satuan }}</td>
                                            <td>{{ $item->deskripsi }}</td>
                                            <td>{{ $item->sub_total_formatted }}</td>
                                        </tr>
                                    @endforeach
                                    @php
                                        $total = $subTotal + (10/100*$subTotal);
                                    @endphp
                                    <tr>
                                        <td colspan="6" style="font-style: italic; text-align: center; font-weight: bold">Sub Total</td>
                                        <td style="font-weight: bold">{{ 'Rp.' . number_format($subTotal,0,',','.') }}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="6" style="font-style: italic; text-align: center; font-weight: bold">PPN 10%</td>
                                        <td style="font-weight: bold">{{ 'Rp.' . number_format(10/100*$subTotal,0,',','.') }}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="6" style="font-style: italic; text-align: center; font-weight: bold">PPN 10%</td>
                                        <td style="font-weight: bold">{{ 'Rp.' . number_format($total,0,',','.') }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <br>
                        <div>
                            <span>Keterangan : </span><br>
                            {{ $quotation->keterangan }}
                            <br>
                            <br>
                            <span>Atas perhatiannya kami ucapkan terima kasih.</span>
                        </div>
                        <br>
                        <div>
                            <span>Hormat kami,</span><br>
                            <span style="font-weight: bold">PT.Mitra Global Kencana</span>
                            <div style="height: 100px; width: 100px"></div><br>
                            <span style="font-weight: bold; "><u>Nama Penanda Tangan</u></span><br>
                            <span>Marketing Service</span>
                        </div>
                        <br>
                        <br>
						<div style="padding-bottom: 30px">Quotation Sudah dikirim silahkan check file berikut.</div>
                        <div style="display: flex; justify-content: space-evenly">
                            <a href="{{ url('/management-tugas/export/' . $quotation->id_laporan_pekerjaan) }}" style="padding: 10px; border: 1px solid black; border-radius: 10px; display: flex; align-items: center; text-decoration: none">
                                <img src="{{ asset('/assets/images/icon_pdf.svg') }}" alt="" style="height: 25px; width: 25px; object-fit: contain; margin-right: 10px">
                                <span>Quotation</span>
                            </a>
                            <a href="{{ config('app.asset_url') . '/storage ' . $quotation->file }}" style="padding: 10px; border: 1px solid black; border-radius: 10px; display: flex; align-items: center; text-decoration: none">
                                <img src="{{ asset('/assets/images/icon_file.svg') }}" alt="" style="height: 25px; width: 25px; object-fit: contain; margin-right: 10px">
                                <span>File</span>
                            </a>
                        </div>
						<!--end:Email content-->
						<div style="padding-bottom: 10px">Kind regards,
						<br>PT.Mitra Global Kencana.
						<tr>
							<td align="center" valign="center" style="font-size: 13px; text-align:center;padding: 20px; color: #6d6e7c;">
								<p>PT.Mitra Global Kencana</p>
								<p>Copyright ©
								<a href="{{ url('') }}" rel="noopener" target="_blank">Dokgo</a>.</p>
							</td>
						</tr></br></div>
					</div>
				</td>
			</tr>
		</tbody>
	</table>
</div>
