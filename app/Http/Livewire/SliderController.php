<?php

namespace App\Http\Livewire;

use App\Models\Inventory;
use Livewire\Component;

class SliderController extends Component
{
    public $vehicle;


    public function mount($vehicle_id=null) {
        if($vehicle_id){
            $this->vehicle = Inventory::where('id',$vehicle_id)->whereNotNull('images')->first();
        }

    }
    public function render()
    {
        return view('livewire.slider-controller');
    }
}
