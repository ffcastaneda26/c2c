<?php

namespace App\Http\Livewire;
/**+--------------------------------------------------------------------+
 * | Fecha      | Autor |       Observaciones                           |
 * +------------+-------+-----------------------------------------------+
 * | 13-dic-21  | MANN  | Creacion de Componente Promociones            |
 * | 16-dic-21  | FCO   | Mover las vistas a carpeta promotions         |
 * | 22-dic-21  | FCO   | Agregar idioma manejo de imagen en promotions |
 * +------------+---------------------------+---------------------------+
 */


use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\Promotion;
use Illuminate\Support\Facades\App;

class Promotions extends Component {
    use WithPagination;
    use WithFileUploads;

    public $name, $image, $description, $imagex, $language;
    public $search;
    public $record_id;
    public $searchTerm;
    public $isOpen = 0;
    private $pagination = 5;

    // Revisa que tenga acceso
    public function mount()
    {

    }


	public function render() {
        $searchTerm = '%'.$this->search.'%';
        return view('livewire.promotions.index', [
            'records' => Promotion::where('name','like', $searchTerm)->paginate($this->pagination)
        ]);
	}


	private function resetInputFields() {
        $this->record_id = Null;
        $this->reset('name','description','image','language');
	}


	public function store() {

        if(App::isLocale('en')){
            $this->validate(Promotion::rules($this->record_id), Promotion::$english_messages);
        }else{
            $this->validate(Promotion::rules($this->record_id), Promotion::$spanish_messages);
        }


        if ($this->imagex) {
            $this->image = $this->imagex;
            $fileImage = $this->image->Store('public/images/promotions');
        } else {
            $fileImage = $this->image;
        }

        Promotion::updateOrCreate(['id' => $this->record_id], [
            'name'          => $this->name,
            'description'   => $this->description,
            'image'         => $fileImage,
            'language'      => $this->language,
		]);

        session()->flash('message',
        $this->record_id ? 'Promotion Updated Successfully.' : 'Promotion Created Successfully.');

    $this->closeModal();
        $this->resetInputFields();
	}


	public function edit($id) {
        $this->resetInputFields();
		$record = Promotion::findOrFail($id);
        $this->record_id    = $id;
        $this->name         = $record->name;
		$this->description  = $record->description;
        $this->image        = $record->image;
        $this->language     = $record->language;
		$this->openModal();
	}


    public function delete(Promotion $promotion)
    {
        $promotion->delete();
        session()->flash('message', __('Promotion Deleted Successfully.'));
    }

    public function create()
    {
        $this->resetInputFields();
        $this->openModal();
    }


    public function openModal()
    {
        $this->isOpen = true;
    }


    public function closeModal()
    {
        $this->isOpen = false;
    }

     //permite la búsqueda cuando se navega entre el paginado
     public function updatingSearch(): void
     {
      $this->gotoPage(1);
    }
}
