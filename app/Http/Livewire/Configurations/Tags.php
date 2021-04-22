<?php

namespace App\Http\Livewire\Configurations;

use App\Models\Tag;
use Livewire\Component;
use Livewire\WithPagination;

class Tags extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $idTag, $name, $color;

    protected $rules = [
        'name' => ['required', 'string', 'min:5'],
        'color' => ['required'],
    ];

    protected $listeners = ['deleteTag'];

    public function clearVars()
    {
        $this->reset([
            'idTag', 'name', 'color'
        ]);
    }

    public function addTag()
    {
        $tag = new Tag();

        $this->idTag = $tag->id;
        $this->name = $tag->name;
        $this->color = $tag->color;

        $this->emit('addTagModal');
    }

    public function updateTag(Tag $tag)
    {
        $this->idTag = $tag->id;
        $this->name = $tag->name;
        $this->color = $tag->color;

        $this->emit('addTagModal');
    }

    public function save()
    {
        $this->validate();

        $data = [
            'name' => $this->name,
            'color' => $this->color,
        ];

        if ($this->idTag) {
            Tag::find($this->idTag)->update($data);
        } else {
            Tag::create($data);
        }

        $this->clearVars();
        $this->emit('hideModalTrigger');
    }

    public function deleteTag($id)
    {
        $tag = Tag::findOrFail($id);

        if (!$tag->tickets()->exists()) {
            $tag->delete();
        } else {
            $this->emit('LiveAlert', [
                'icon' => 'error',
                'title' => 'Error al eliminar',
                'message' => 'No se puede eliminar la etiqueta si tiene tickets activos.'
            ]);
        }
    }

    public function render()
    {
        return view('livewire.configurations.tags', [
            'tags' => Tag::simplePaginate(5),
        ]);
    }
}
