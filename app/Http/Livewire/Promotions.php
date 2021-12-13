<?php

namespace App\Http\Livewire;
/**+--------------------------------------------------------------------+
 * | Fecha      | Autor |       Observaciones                           |
 * +------------+-------+-----------------------------------------------+
 * | 13-dic-21  | MANN   | Creacion de Componente Promociones           |
 * +------------+---------------------------+---------------------------+
 */


use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\Promotion;


class Promotions extends Component {
    use WithPagination;
    use WithFileUploads;

    public $name,$image, $description, $imagex;
    public $search;
    public $record_id;
    public $searchTerm;
    public $isOpen = 0;
    private $pagination = 5;

    // Revisa que tenga acceso
    public function mount()
    {
        /* $this->manage_title = "Manage Promotions";
        $this->create_button_label = "Create Promotion";
        $this->search_label = "Promotion";
        $this->view_form    = 'livewire.vips.form';
        $this->view_table   = 'livewire.vips.table';
        $this->view_list    = 'livewire.vips.list'; */
    }


	public function render() {
        $searchTerm = '%'.$this->search.'%';
        return view('livewire.index', [
            'records' => Promotion::where('name','like', $searchTerm)->paginate($this->pagination)
        ]);
	}


	private function resetInputFields() {
        $this->record_id = Null;
        $this->name = Null;
		$this->description = Null;
        $this->image = Null;
	}


	public function store() {
		$this->validate([
            'name' => 'required|min:3|max:30',
            'description' => 'required|min:3|max:200',
            ]);

            if ($this->imagex) {
                $this->image = $this->imagex;
                $fileImage = $this->image->Store('public/images/promotions');
            } else {
                $fileImage = $this->image;
            }

        Promotion::updateOrCreate(['id' => $this->record_id], [
            'name'   => $this->name,
            'description'   => $this->description,
            'image'      => $fileImage,
		]);

        session()->flash('message',
        $this->record_id ? 'Promotion Updated Successfully.' : 'Promotion Created Successfully.');

    $this->closeModal();
    $this->resetInputFields();
	}


	public function edit($id) {
        $this->resetInputFields();
		$record = Promotion::findOrFail($id);
        $this->record_id = $id;
        $this->name = $record->name;
		$this->description = $record->description;
        $this->image = $record->image;
		$this->openModal();
	}


    public function delete($id)
    {
        Promotion::find($id)->delete();
        session()->flash('message', 'Promotion Deleted Successfully.');
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