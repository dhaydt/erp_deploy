<?php

namespace App\Http\Livewire\Supplier;

use App\Models\SupplierOrder;
use Livewire\Component;
use Livewire\WithPagination;

class OrderPayable extends Component
{
    use WithPagination;
    public $paginationTheme = 'bootstrap';
    public $total_show = 10;
    public $cari;

    protected $listSupplierOrder;
    public function render()
    {
        $this->listSupplierOrder = SupplierOrder::where('status_pembayaran', '!=',2)
        ->where('status_order', '!=', 0)
        ->where(function($query){
            $query->where('keterangan', 'LIKE', '%' . $this->cari . '%')
            ->whereHas('supplier', function($query){
                $query->where('name', 'LIKE', '%' . $this->cari . '%');
            })->orWhereHas('tipePembayaran', function($query){
                $query->where('nama_tipe', 'LIKE', '%' . $this->cari . '%');
            })->orWhereHas('metodePembayaran', function($query){
                $query->where('nama_metode', 'LIKE', '%' . $this->cari . '%');
            })->orWhereHas('user', function($query){
                $query->where('name', 'LIKE', '%' . $this->cari . '%');
            });
        })->paginate($this->total_show);

        $data['listSupplierOrder'] = $this->listSupplierOrder;
        return view('livewire.supplier.order-payable', $data);
    }

    public function mount(){

    }
}
