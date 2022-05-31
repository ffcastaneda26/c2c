<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Inventory;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class Inventories extends Component
{
    use WithPagination;

    public $makes;
    public $search_makes;
    public $make = [];
    public $vehicle_show;
    public $vehicle_id = null;

    protected $listeners = ['mount'];

    public function mount($vehicle_id=null){
        $this->vehicle_show = Inventory::where('id', $vehicle_id)->get();
    }

    public function render()
    {
        return view('livewire.inventory');
    }

    public function fill_makes(){
        $sql = 'SELECT DISTINCT make,count(*) as total FROM inventories WHERE make IS NOT NULL GROUP BY make ORDER BY make';
        $this->makes=DB::select($sql);
    }
}
