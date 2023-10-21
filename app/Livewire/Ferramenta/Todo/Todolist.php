<?php

namespace App\Livewire\Ferramenta\Todo;

use App\Models\Ferramenta\Todo;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class Todolist extends Component
{
    
    protected $listeners = [
        'archive'
    ];
    
    public string $filter = 'all';
    public Collection $todos;
    public Collection $doneTodos;
    public Collection $inProgressTodos;

    public function archive(int $id)
    {
        $todo = Todo::findOrFail($id);
        $todo->is_archived = true;
        $todo->save();

        Session::flash('dispatchable',[
            'swal:alert',
            [
                'type' => 'success',
                'message' => 'Task Archived!',
            ]
        ]);

        return redirect()->route('index');
    }


    public function mount()
    {
        $this->todos = Todo::orderBy('due_date', 'asc')->todoStatus()->get();
        $this->doneTodos = Todo::orderBy('due_date', 'asc')->doneStatus()->get();
        $this->inProgressTodos = Todo::orderBy('due_date', 'asc')->inProgressStatus()->get();

        if (Session::has('dispatchable')) {
            $this->dispatch(...(Session::get('dispatchable')));
        }
    }

    public function render()
    {
        $tarefas = Todo::
                        query()->
                        when($this->filter == 'feito', fn($q) => $q->where('status', true))->
                        when($this->filter == 'pendente', fn($q) => $q->where('status', true))->
                        when($this->filter == 'em_andamento', fn($q) => $q->where('status', false))->
                        where('id_pessoa', '=', auth()->user()->id )->
                        get();

        return view('livewire/ferramenta/todo/index', [
            'tarefas' => $tarefas
        ])->layout('layouts/app');
    }

    // public function filtrar( $status = 'all')
    // {
        // $this->filter = $status;

        // $tarefas = Todo::
        //                 query()->
        //                 when($this->filter == 'feito', fn($q) => $q->where('status', true))->
        //                 when($this->filter == 'pendente', fn($q) => $q->where('status', true))->
        //                 when($this->filter == 'em_andamento', fn($q) => $q->where('status', false))->
        //                 where('id_pessoa', '=', auth()->user()->id )->
        //                 get();

        // return $tarefas;
    // }
}
