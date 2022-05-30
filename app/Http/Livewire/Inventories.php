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
    public $vehicle_id;


    public function mount(){
        $this->vehicle_show = Inventory::where('id', $this->vehicle_id)->first();
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
