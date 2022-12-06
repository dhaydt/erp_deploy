<?php

namespace App\Http\Livewire\Laporan;

use App\Models\CalenderPenagihan;
use App\Models\PreOrder;
use App\Models\SupplierOrder;
use Livewire\Component;

class Kalender extends Component
{
    public $listeners = [
        'simpanCalenderPenagihan',
        'updateCalenderPenagihan'
    ];
    public $showForm = false;

    public $id_calender_penagihan;
    public $id_accounts;
    public $tipe;
    public $description;
    public $tanggal;
    public $listCalenderPenagihan;
    public $listAccounts;

    public $listEvents = [];
    public function render()
    {
        if($this->tipe != null){
            if ($this->tipe == 1) {
                $this->listAccounts = PreOrder::whereHas('quotation', function($query){
                    $query->whereHas('laporanPekerjaan', function($query){
                        $query->where('signature', '!=', null)
                        ->where('jam_selesai', '!=', null);
                    });
                })->where('status', '!=', 3)->orderBy('updated_at', 'DESC')->get();
            }elseif($this->tipe == 2){
                $this->listAccounts = SupplierOrder::where('status_pembayaran', '!=',2)
                ->where('status_order', '!=', 0)
                ->whereHas('supplier')
                ->get();
            }
        }else{
            $this->listAccounts = [];
        }

        $this->listCalenderPenagihan = CalenderPenagihan::get();
        foreach ($this->listCalenderPenagihan as $item) {
            if($item->tanggal != null){
                $title = $item->tipe == 1 ? "Receivable" : "Payable";
                if($item->tipe == 1){
                    $title = $title . " - " . $item->preOrder->no_ref;
                }else{
                    $title = $title . " - " . $item->supplierOrder->no_ref;
                }
                array_push($this->listEvents, collect([
                    'title' => $title,
                    'start' => date('Y-m-d', strtotime($item->tanggal)),
                    'description' => "Testing",
                    'className' => 'fc-event-solid-danger fc-event-light',
                ]));
            }
        }
        $this->dispatchBrowserEvent('contentChange');
        return view('livewire.laporan.kalender');
    }

    public function simpanCalenderPenagihan(){
        $this->validate([
            'id_accounts' => 'required|numeric',
            'tipe' => 'required|numeric',
            'tanggal' => 'nullable|string',
            'description' => 'nullable|string',
        ]);

        CalenderPenagihan::updateOrCreate([
            'id' => $this->id_calender_penagihan
        ], [
            'id_accounts' => $this->id_accounts,
            'tipe' => $this->tipe,
            'description' => $this->description,
            'tanggal' => $this->tanggal
        ]);

        $message = "Berhasil menyimpan data";
        $this->resetInputFields();
        return session()->flash('success', $message);
    }

    public function resetInputFields(){
        $this->id_accounts = null;
        $this->tipe = null;
        $this->tanggal = null;
        $this->description = null;
    }

    public function updateCalenderPenagihan($id, $tanggal){
        $calenderPenagihan = CalenderPenagihan::find($id);
        if(!$calenderPenagihan){
            $message = "Data tidak ditemukan";
            return session()->flash('fail', $message);
        }

        $calenderPenagihan->update([
            'tanggal' => date('Y-m-d', strtotime($tanggal))
        ]);

        $message = "Berhasil mengupdate data";
        return session()->flash('success', $message);
    }
}