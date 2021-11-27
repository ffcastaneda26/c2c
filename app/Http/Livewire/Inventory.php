<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class Inventory extends Component
{
    use WithPagination;

    public $makes;
    public $search_makes;
    public $make = [];

    public function mount(){
        $this->fill_makes();
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
