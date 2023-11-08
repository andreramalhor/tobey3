<?php

use Illuminate\Support\Facades\Route;

use App\Livewire\Atendimento\Pessoa;
use App\Livewire\Cadastro\Categoria;
use App\Livewire\Comercial\Lead;
use App\Livewire\Comercial\Lead\{Index, Criar, Empresa, Atender, Dashboard, Comissao};
use App\Livewire\Financeiro\{Lancamento};
use App\Livewire\Financeiro\Lancamento\{Lancamentodashboard, Lancamentocriar, Lancamentolistar};
use App\Livewire\Ferramenta\Kanban\{Kanbancriar, Kanbanlistar};
use App\Livewire\Ferramenta\Todo\{Todoarchive, Todoedit, Todoshow, Todolist};
use App\Livewire\Configuracao\{Usuario};
use App\Livewire\StudentsComponent;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('students', StudentsComponent::class);
Route::get('/comercial/dashboard', Dashboard::class)->name('com.leads.dashboard');


Route::get('/', function ()
{
    return redirect()->route('login');
});

Route::group(['middleware' => 'auth', 'prefix' => '/atendimento'], function()
{
    Route::get('/pessoas',              Pessoa::class)              ->name('atd.pessoas');
    Route::get('/clientes',             Pessoa::class)              ->name('atd.clientes');

    // Route::get('/clientes', Pessoa::class)->name('atd.clientes');
});


Route::group(['middleware' => 'auth', 'prefix' => '/cadastro'], function()
{
    Route::get('/categorias',           Categoria::class)           ->name('cad.categorias');
});

Route::group(['middleware' => 'auth', 'prefix' => '/comercial'], function()
{
    Route::get('/leads',                Lead::class)                ->name('com.leads');
    Route::get('/comissoes',            Comissao::class)            ->name('com.leads.comissoes');
    // Route::get('/dashoboard',           Dashboard::class)           ->name('com.leads.dashboard');
    // Route::get('/leads/atender',        Empresa::class)             ->name('com.leads.empresa');
    // Route::get('/leads/atender/{id}',   Atender::class)             ->name('com.leads.atender');
    // Route::get('/leads',                Criar::class)               ->name('com.leads.criar');
    // Route::get('/leads',                Index::class)               ->name('com.leads');

});

Route::group(['middleware' => 'auth', 'prefix' => '/financeiro'], function()
{
    Route::get('/lancamentos',          Lancamento::class)          ->name('fin.lancamentos');
    Route::get('/dashoboard',           Lancamentodashboard::class) ->name('fin.lancamentos.dashboard');
    // Route::get('/lancamentos',          Lancamentolistar::class)    ->name('fin.lancamentos.listar');
    Route::get('/lancamentos/criar',    Lancamentocriar::class)     ->name('fin.lancamentos.criar');
});

Route::group(['middleware' => 'auth', 'prefix' => '/ferramenta'], function()
{
    Route::get('/kanban',               Kanbanlistar::class)        ->name('fer.kanban.listar');

    Route::get('/todo',                 Todoarchive::class)         ->name('fer.todo.listar12');
    Route::get('/todo/archive',         Todoedit::class)            ->name('archive');
    Route::get('/todo/todo/{id}',       Todoshow::class)            ->name('todo');
    // Route::get('/todo/todo/{id}/edit',  Todolist::class)            ->name('todo.edit');
    Route::get('/todo',                 Todolist::class)            ->name('fer.todo.listar');
});

Route::group(['middleware' => 'auth', 'prefix' => '/configuracao'], function()
{
    Route::get('/usuarios',             Usuario::class)             ->name('cfg.usuarios');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function ()
{
    Route::get('/dashboard', function ()
    {
        return view('dashboard');
    })->name('dashboard');
});
