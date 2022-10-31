<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\PreOrder as ModelsPreOrder;
use Carbon\Carbon;
use Livewire\Component;

class PreOrder extends Component
{
    public $listPreOrder;
    public function render()
    {
        $this->listPreOrder = [];
        $tempPreOrder = ModelsPreOrder::orderBy('created_at', 'DESC')->get();
        foreach ($tempPreOrder as $item) {
            if($item->metodePembayaran){
                $expired_pembayaran = Carbon::parse($item->created_at)->addDay($item->metodePembayaran->nilai);
                if($expired_pembayaran <= now()){
                    array_push($this->listPreOrder, $item);
                }
            }
        }
        return view('livewire.dashboard.pre-order');
    }

    public function mount(){

    }
}
