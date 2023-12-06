<?php

use Illuminate\Support\Facades\Route;

use App\Livewire\Atendimento\Pessoa;
use App\Livewire\Catalogo\{Categoria, Servico, Produto, Compra};
use App\Livewire\Comercial\Lead;
use App\Livewire\Comercial\Lead\{Index, Criar, Empresa, Atender, Dashboard, Comissao};
use App\Livewire\Financeiro\{Lancamento, Banco};
use App\Livewire\Financeiro\Lancamento\{Lancamentodashboard, Lancamentocriar, Lancamentolistar};
use App\Livewire\Ferramenta\Kanban\{Kanbancriar, Kanbanlistar};
use App\Livewire\Ferramenta\Todo\{Todoarchive, Todoedit, Todoshow, Todolist};
use App\Livewire\Configuracao\{Usuario, Sistema};
use App\Livewire\StudentsComponent;
use App\Livewire\Counter;


use App\Http\Controllers\pdv\{CaixasController, VendasController, VendaController};
use App\Http\Controllers\Atendimento\{PessoasController, AgendaController, AgendamentosController};
use App\Http\Controllers\Configuracao\{ContabilController, ComissaoController, SistemaController, MensagemController};
use App\Http\Controllers\Contabilidade\{ContasController, DREController, FluxoCaixaController};
use App\Http\Controllers\Comercial\{ComercialController, CRMController, LeadsController, PortfolioController};
use App\Http\Controllers\Ferramenta\{MensagemController as mensagemfdERR, TarefaController, KanbanController, TestesController};
use App\Http\Controllers\Pedagogico\{PedagogicoController};
use App\Http\Controllers\Financeiro\{BancoController, LancamentosController, AReceberController, ComprasController};
use App\Http\Controllers\relatorio\{RelatoriosController};
use App\Http\Controllers\Charts\{ChartsController};
use App\Http\Controllers\Financial\{BillsController};
use App\Http\Controllers\Clientes\{ClientesController};
use App\Http\Controllers\Sistema\{ACLController};
use App\Http\Controllers\Cadastro\{CatalogoController, ServicosProdutosController};


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


Route::group(['middleware' => 'auth', 'prefix' => '/catalogo'], function()
{
    Route::get('/categorias',           Categoria::class)           ->name('cat.categorias');
    Route::get('/servicos',             Servico::class)             ->name('cat.servicos');
    Route::get('/produtos',             Produto::class)             ->name('cat.produtos');
    Route::get('/compra-de-produtos',   Compra::class)              ->name('cat.compras');
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
    Route::get('/bancos',               Banco::class)               ->name('fin.bancos');
    Route::get('/dashoboard',           Lancamentodashboard::class) ->name('fin.lancamentos.dashboard');
    // Route::get('/lancamentos',          Lancamentolistar::class)    ->name('fin.lancamentos.listar');
    Route::get('/lancamentos/criar',    Lancamentocriar::class)     ->name('fin.lancamentos.criar');
});

Route::group(['middleware' => 'auth', 'prefix' => '/ferramenta'], function()
{
    Route::get('/kanban',               Counter::class)        ->name('fer.kanban.listar');
    // Route::get('/kanban',               Kanbanlistar::class)        ->name('fer.kanban.listar');

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



    Route::get('/caixa/reopen/{id}',     [CaixasController::class, 'reopen'])                     ->name('pdv.caixas.reabrir');

    
    Route::group(['prefix' => '/',], function() {
    
        // ATENDIMENTO
        Route::group(['prefix' => '/atendimento'], function() {
            Route::any('/pessoa/avatar',                             [PessoasController::class, 'avatar'])                          ->name('pessoa.avatar')                       ->middleware('auth');
            Route::get('/pessoa/proximosaniversariantes',            [PessoasController::class, 'proximosaniversariantes'])         ->name('pessoa.proximosaniversariantes')      ->middleware('auth');
            Route::get('/pessoa/profExec/{serv}',                    [PessoasController::class, 'profExec'])                        ->name('pessoa.profExec')                     ->middleware('auth');
            Route::post('/pessoa/triate',                            [PessoasController::class, 'triate'])                          ->name('pessoa.triate')                       ->middleware('auth');
            Route::get('/pessoa/clientesVIP',                        [PessoasController::class, 'clientesVIP'])                     ->name('pessoa.clientesVIP')                  ->middleware('auth');
            Route::get('/pessoa/influencers',                        [PessoasController::class, 'influencers'])                     ->name('pessoa.influencers')                  ->middleware('auth');
            Route::get('/pessoa/colaboradores',                      [PessoasController::class, 'colaboradores'])                   ->name('pessoa.colaboradores')                ->middleware('auth');
            Route::get('/pessoa/jsonColaboradores',                  [PessoasController::class, 'jsonColaboradores'])               ->name('pessoa.jsonColaboradores')            ->middleware('auth');
            Route::get('/pessoa/profissionais',                      [PessoasController::class, 'profissionais'])                   ->name('pessoa.profissionais')                ->middleware('auth');
            Route::post('/pessoa/adicionarTipo/{id}',                [PessoasController::class, 'adicionarTipo'])                   ->name('pessoa.adicionarTipo')                ->middleware('auth');
            Route::post('/pessoa/removerTipo/{id}',                  [PessoasController::class, 'removerTipo'])                     ->name('pessoa.removerTipo')                  ->middleware('auth');
            Route::post('/pessoa/find/{id}',                         [PessoasController::class, 'find'])                            ->name('pessoa.find')                         ->middleware('auth');
            Route::post('/pessoa/ativarPessoa/{id}',                 [PessoasController::class, 'ativarPessoa'])                    ->name('pessoa.ativarPessoa')                 ->middleware('auth');
            Route::get('/pessoas/carregar',                          [PessoasController::class, 'carregar'])                        ->name('atd.pessoas.carregar');
    
            Route::get('/pessoas/searchPerson',                       [PessoasController::class, 'searchPerson'])                  ->name('people.searchPerson');
            Route::get('/pessoas/typePerson',                         [PessoasController::class, 'typePerson'])                    ->name('people.typePerson');
            Route::get('/pessoas/changeTypePerson',                   [PessoasController::class, 'changeTypePerson'])              ->name('people.changeTypePerson');
      
            
        });
    
        // COMISSÕES
        Route::group(['prefix' => '/comissoes'], function() {
            Route::get('/pagas',                                     [ContabilController::class, 'pagas'])                        ->name('com.pagas')                           ->middleware('auth');
            Route::get('/abertas',                                   [ComissaoController::class, 'abertas'])                      ->name('com.abertas')                         ->middleware('auth');
            Route::get('/widget',                                    [ComissaoController::class, 'comissoes_widget'])             ->name('com.comissoes.widget')                ->middleware('auth');
        });
        
        
        // CONTABILIDADE
        Route::group(['prefix' => '/contabilidade'], function() {
            Route::get('/contas',                                    [ContasController::class, 'contas'])                        ->name('con.contas')                          ->middleware('auth');
            Route::get('/contas/plucar',                             [ContasController::class, 'contas_plucar'])                 ->name('con.contas.plucar')                   ->middleware('auth');
            Route::get('/contas/tabelar',                            [ContasController::class, 'contas_tabelar'])                ->name('con.contas.tabelar')                  ->middleware('auth');
            Route::get('/contas/mostrar/{id}',                       [ContasController::class, 'contas_mostrar'])                ->name('con.contas.mostrar')                  ->middleware('auth');
            Route::get('/contas/adicionar',                          [ContasController::class, 'contas_adicionar'])              ->name('con.contas.adicionar')                ->middleware('auth');
            Route::post('/contas/gravar',                            [ContasController::class, 'contas_gravar'])                 ->name('con.contas.gravar')                   ->middleware('auth');
            Route::get('/contas/editar/{id}',                        [ContasController::class, 'contas_editar'])                 ->name('con.contas.editar')                   ->middleware('auth');
            Route::put('/contas/atualizar/{id}',                     [ContasController::class, 'contas_atualizar'])              ->name('con.contas.atualizar')                ->middleware('auth');
            Route::delete('/contas/excluir/{id}',                    [ContasController::class, 'contas_excluir'])                ->name('con.contas.excluir')                  ->middleware('auth');
            Route::post('/contas/restaurar/{id}',                    [ContasController::class, 'contas_restaurar'])              ->name('con.contas.restaurar')                ->middleware('auth');
            
            Route::get('/dre',                                       [DREController::class, 'dre'])                              ->name('con.dre')                             ->middleware('auth');
            Route::get('/dre/plucar',                                [DREController::class, 'dre_plucar'])                       ->name('con.dre.plucar')                      ->middleware('auth');
            Route::get('/dre/tabelar',                               [DREController::class, 'dre_tabelar'])                      ->name('con.dre.tabelar')                     ->middleware('auth');
            Route::get('/dre/mostrar/{id}',                          [DREController::class, 'dre_mostrar'])                      ->name('con.dre.mostrar')                     ->middleware('auth');
            Route::get('/dre/adicionar',                             [DREController::class, 'dre_adicionar'])                    ->name('con.dre.adicionar')                   ->middleware('auth');
            Route::post('/dre/gravar',                               [DREController::class, 'dre_gravar'])                       ->name('con.dre.gravar')                      ->middleware('auth');
            Route::get('/dre/editar/{id}',                           [DREController::class, 'dre_editar'])                       ->name('con.dre.editar')                      ->middleware('auth');
            Route::put('/dre/atualizar/{id}',                        [DREController::class, 'dre_atualizar'])                    ->name('con.dre.atualizar')                   ->middleware('auth');
            Route::delete('/dre/excluir/{id}',                       [DREController::class, 'dre_excluir'])                      ->name('con.dre.excluir')                     ->middleware('auth');
            Route::post('/dre/restaurar/{id}',                       [DREController::class, 'dre_restaurar'])                    ->name('con.dre.restaurar')                   ->middleware('auth');
        
            Route::get('/fluxo_caixa',                               [FluxoCaixaController::class, 'fluxo_caixa'])               ->name('con.fluxo_caixa')                     ->middleware('auth');
            Route::get('/fluxo_caixa/plucar',                        [FluxoCaixaController::class, 'fluxo_caixa_plucar'])        ->name('con.fluxo_caixa.plucar')              ->middleware('auth');
            Route::get('/fluxo_caixa/tabelar',                       [FluxoCaixaController::class, 'fluxo_caixa_tabelar'])       ->name('con.fluxo_caixa.tabelar')             ->middleware('auth');
            Route::get('/fluxo_caixa/mostrar/{id}',                  [FluxoCaixaController::class, 'fluxo_caixa_mostrar'])       ->name('con.fluxo_caixa.mostrar')             ->middleware('auth');
            Route::get('/fluxo_caixa/adicionar',                     [FluxoCaixaController::class, 'fluxo_caixa_adicionar'])     ->name('con.fluxo_caixa.adicionar')           ->middleware('auth');
            Route::post('/fluxo_caixa/gravar',                       [FluxoCaixaController::class, 'fluxo_caixa_gravar'])        ->name('con.fluxo_caixa.gravar')              ->middleware('auth');
            Route::get('/fluxo_caixa/editar/{id}',                   [FluxoCaixaController::class, 'fluxo_caixa_editar'])        ->name('con.fluxo_caixa.editar')              ->middleware('auth');
            Route::put('/fluxo_caixa/atualizar/{id}',                [FluxoCaixaController::class, 'fluxo_caixa_atualizar'])     ->name('con.fluxo_caixa.atualizar')           ->middleware('auth');
            Route::delete('/fluxo_caixa/excluir/{id}',               [FluxoCaixaController::class, 'fluxo_caixa_excluir'])       ->name('con.fluxo_caixa.excluir')             ->middleware('auth');
            Route::post('/fluxo_caixa/restaurar/{id}',               [FluxoCaixaController::class, 'fluxo_caixa_restaurar'])     ->name('con.fluxo_caixa.restaurar')           ->middleware('auth');
        });
        
        
        
        
        Route::group(['prefix' => '/comercial'], function() {
            Route::get('/contratos',                                 [ComercialController::class, 'contratos'])                      ->name('com.contratos')                       ->middleware('auth');
            Route::get('/contratos/tabelar',                         [ComercialController::class, 'contratos_tabelar'])              ->name('com.contratos.tabelar')               ->middleware('auth');
            Route::get('/contratos/mostrar/{id}',                    [ComercialController::class, 'contratos_mostrar'])              ->name('com.contratos.mostrar')               ->middleware('auth');
            Route::get('/contratos/adicionar',                       [ComercialController::class, 'contratos_adicionar'])            ->name('com.contratos.adicionar')             ->middleware('auth');
            Route::post('/contratos/gravar',                         [ComercialController::class, 'contratos_gravar'])               ->name('com.contratos.gravar')                ->middleware('auth');
            Route::get('/contratos/editar/{id}',                     [ComercialController::class, 'contratos_editar'])               ->name('com.contratos.editar')                ->middleware('auth');
            Route::put('/contratos/atualizar/{id}',                  [ComercialController::class, 'contratos_atualizar'])            ->name('com.contratos.atualizar')             ->middleware('auth');
            Route::delete('/contratos/excluir/{id}',                 [ComercialController::class, 'contratos_excluir'])              ->name('com.contratos.excluir')               ->middleware('auth');
            Route::post('/contratos/restaurar/{id}',                 [ComercialController::class, 'contratos_restaurar'])            ->name('com.contratos.restaurar')             ->middleware('auth');
    
            Route::post('/contratos/resumo',                         [ComercialController::class, 'contratos_resumo'])               ->name('com.contratos.resumo')                ->middleware('auth');
    
            Route::get('/contratos/etapa_cliente',                   [ComercialController::class, 'contratos_etapa_cliente'])        ->name('com.contratos.etapa_cliente')         ->middleware('auth');
            Route::get('/contratos/etapa_servprod',                  [ComercialController::class, 'contratos_etapa_servprod'])       ->name('com.contratos.etapa_servprod')        ->middleware('auth');
            Route::get('/contratos/etapa_pagamento',                 [ComercialController::class, 'contratos_etapa_pagamento'])      ->name('com.contratos.etapa_pagamento')       ->middleware('auth');
    
    
            Route::get('/crm',                                       [CRMController::class, 'crm'])                                  ->name('com.crm')                             ->middleware('auth');
            Route::get('/crm/tabelar',                               [CRMController::class, 'crm_tabelar'])                          ->name('com.crm.tabelar')                     ->middleware('auth');
            Route::get('/crm/mostrar/{id}',                          [CRMController::class, 'crm_mostrar'])                          ->name('com.crm.mostrar')                     ->middleware('auth');
            Route::get('/crm/adicionar',                             [CRMController::class, 'crm_adicionar'])                        ->name('com.crm.adicionar')                   ->middleware('auth');
            Route::post('/crm/gravar',                               [CRMController::class, 'crm_gravar'])                           ->name('com.crm.gravar')                      ->middleware('auth');
            Route::get('/crm/editar/{id}',                           [CRMController::class, 'crm_editar'])                           ->name('com.crm.editar')                      ->middleware('auth');
            Route::put('/crm/atualizar/{id}',                        [CRMController::class, 'crm_atualizar'])                        ->name('com.crm.atualizar')                   ->middleware('auth');
            Route::delete('/crm/excluir/{id}',                       [CRMController::class, 'crm_excluir'])                          ->name('com.crm.excluir')                     ->middleware('auth');
            Route::post('/crm/restaurar/{id}',                       [CRMController::class, 'crm_restaurar'])                        ->name('com.crm.restaurar')                   ->middleware('auth');
        });
    
    
        Route::group(['prefix' => '/ferramenta'], function() {
            Route::get('/mensagens',                                 [MensagemController::class, 'mensagens'])                      ->name('frm.mensagens')                       ->middleware('auth');
            Route::get('/mensagens/widget',                          [MensagemController::class, 'mensagens_widget'])               ->name('frm.mensagens.widget')                ->middleware('auth');
            Route::get('/mensagens/tabelar',                         [MensagemController::class, 'mensagens_tabelar'])              ->name('frm.mensagens.tabelar')               ->middleware('auth');
            Route::get('/mensagens/mostrar/{id}',                    [MensagemController::class, 'mensagens_mostrar'])              ->name('frm.mensagens.mostrar')               ->middleware('auth');
            Route::get('/mensagens/adicionar',                       [MensagemController::class, 'mensagens_adicionar'])            ->name('frm.mensagens.adicionar')             ->middleware('auth');
            Route::post('/mensagens/gravar',                         [MensagemController::class, 'mensagens_gravar'])               ->name('frm.mensagens.gravar')                ->middleware('auth');
            Route::get('/mensagens/editar/{id}',                     [MensagemController::class, 'mensagens_editar'])               ->name('frm.mensagens.editar')                ->middleware('auth');
            Route::put('/mensagens/atualizar/{id}',                  [MensagemController::class, 'mensagens_atualizar'])            ->name('frm.mensagens.atualizar')             ->middleware('auth');
            Route::delete('/mensagens/excluir/{id}',                 [MensagemController::class, 'mensagens_excluir'])              ->name('frm.mensagens.excluir')               ->middleware('auth');
            
    
            Route::get('/tarefa/list',                               [TarefaController::class, 'list'])                             ->name('tarefa.list')                         ->middleware('auth');
            Route::resource('/tarefa',                                TarefaController::class)                                                                                   ->middleware('auth');


    
            // Route::get('/kanban',                                    [KanbanController::class, 'kanban'])                         ->name('frm.kanban')                            ->middleware('auth');
            // Route::get('/kanban/tabelar',                            [KanbanController::class, 'kanban_tabelar'])                 ->name('frm.kanban.tabelar')                    ->middleware('auth');
            // Route::get('/kanban/mostrar/{id}',                       [KanbanController::class, 'kanban_mostrar'])                 ->name('frm.kanban.mostrar')                    ->middleware('auth');
            // Route::get('/kanban/adicionar',                          [KanbanController::class, 'kanban_adicionar'])               ->name('frm.kanban.adicionar')                  ->middleware('auth');
            // Route::post('/kanban/gravar',                            [KanbanController::class, 'kanban_gravar'])                  ->name('frm.kanban.gravar')                     ->middleware('auth');
            // Route::get('/kanban/editar/{id}',                        [KanbanController::class, 'kanban_editar'])                  ->name('frm.kanban.editar')                     ->middleware('auth');
            // Route::put('/kanban/atualizar/{id}',                     [KanbanController::class, 'kanban_atualizar'])               ->name('frm.kanban.atualizar')                  ->middleware('auth');
            // Route::delete('/kanban/excluir/{id}',                    [KanbanController::class, 'kanban_excluir'])                 ->name('frm.kanban.excluir')                    ->middleware('auth');
            // Route::post('/kanban/restaurar/{id}',                    [KanbanController::class, 'kanban_restaurar'])               ->name('frm.kanban.restaurar')                  ->middleware('auth');
    
            Route::get('/testes',                                    [TestesController::class, 'testes'])                         ->name('frm.testes')                            ->middleware('auth');
            Route::get('/testes/tabelar',                            [TestesController::class, 'testes_tabelar'])                 ->name('frm.testes.tabelar')                    ->middleware('auth');
            Route::get('/testes/mostrar/{id}',                       [TestesController::class, 'testes_mostrar'])                 ->name('frm.testes.mostrar')                    ->middleware('auth');
            Route::get('/testes/adicionar',                          [TestesController::class, 'testes_adicionar'])               ->name('frm.testes.adicionar')                  ->middleware('auth');
            Route::post('/testes/gravar',                            [TestesController::class, 'testes_gravar'])                  ->name('frm.testes.gravar')                     ->middleware('auth');
            Route::get('/testes/editar/{id}',                        [TestesController::class, 'testes_editar'])                  ->name('frm.testes.editar')                     ->middleware('auth');
            Route::put('/testes/atualizar/{id}',                     [TestesController::class, 'testes_atualizar'])               ->name('frm.testes.atualizar')                  ->middleware('auth');
            Route::delete('/testes/excluir/{id}',                    [TestesController::class, 'testes_excluir'])                 ->name('frm.testes.excluir')                    ->middleware('auth');
            Route::post('/testes/restaurar/{id}',                    [TestesController::class, 'testes_restaurar'])               ->name('frm.testes.restaurar')                  ->middleware('auth');
    
            Route::post('/erros/informar/',                          [TestesController::class, 'erros_informar'])                 ->name('frm.erros.informar')                    ->middleware('auth');
        });
    
        Route::group(['prefix' => '/pedagogico'], function() {
            Route::get('/cursos',                                    [PedagogicoController::class, 'cursos'])                    ->name('ped.cursos')                            ->middleware('auth');
            Route::get('/cursos/tabelar',                            [PedagogicoController::class, 'cursos_tabelar'])            ->name('ped.cursos.tabelar')                    ->middleware('auth');
            Route::get('/cursos/mostrar/{id}',                       [PedagogicoController::class, 'cursos_mostrar'])            ->name('ped.cursos.mostrar')                    ->middleware('auth');
            Route::get('/cursos/adicionar',                          [PedagogicoController::class, 'cursos_adicionar'])          ->name('ped.cursos.adicionar')                  ->middleware('auth');
            Route::post('/cursos/gravar',                            [PedagogicoController::class, 'cursos_gravar'])             ->name('ped.cursos.gravar')                     ->middleware('auth');
            Route::get('/cursos/editar/{id}',                        [PedagogicoController::class, 'cursos_editar'])             ->name('ped.cursos.editar')                     ->middleware('auth');
            Route::put('/cursos/atualizar/{id}',                     [PedagogicoController::class, 'cursos_atualizar'])          ->name('ped.cursos.atualizar')                  ->middleware('auth');
            Route::delete('/cursos/excluir/{id}',                    [PedagogicoController::class, 'cursos_excluir'])            ->name('ped.cursos.excluir')                    ->middleware('auth');
            Route::post('/cursos/restaurar/{id}',                    [PedagogicoController::class, 'cursos_restaurar'])          ->name('ped.cursos.restaurar')                  ->middleware('auth');
    
            Route::get('/modulos',                                   [PedagogicoController::class, 'modulos'])                   ->name('ped.modulos')                           ->middleware('auth');
            Route::get('/modulos/tabelar',                           [PedagogicoController::class, 'modulos_tabelar'])           ->name('ped.modulos.tabelar')                   ->middleware('auth');
            Route::get('/modulos/mostrar/{id}',                      [PedagogicoController::class, 'modulos_mostrar'])           ->name('ped.modulos.mostrar')                   ->middleware('auth');
            Route::get('/modulos/adicionar',                         [PedagogicoController::class, 'modulos_adicionar'])         ->name('ped.modulos.adicionar')                 ->middleware('auth');
            Route::post('/modulos/gravar',                           [PedagogicoController::class, 'modulos_gravar'])            ->name('ped.modulos.gravar')                    ->middleware('auth');
            Route::get('/modulos/editar/{id}',                       [PedagogicoController::class, 'modulos_editar'])            ->name('ped.modulos.editar')                    ->middleware('auth');
            Route::put('/modulos/atualizar/{id}',                    [PedagogicoController::class, 'modulos_atualizar'])         ->name('ped.modulos.atualizar')                 ->middleware('auth');
            Route::delete('/modulos/excluir/{id}',                   [PedagogicoController::class, 'modulos_excluir'])           ->name('ped.modulos.excluir')                   ->middleware('auth');
            Route::post('/modulos/restaurar/{id}',                   [PedagogicoController::class, 'modulos_restaurar'])         ->name('ped.modulos.restaurar')                 ->middleware('auth');
    
            Route::get('/turmas',                                    [PedagogicoController::class, 'turmas'])                    ->name('ped.turmas')                            ->middleware('auth');
            Route::get('/turmas/tabelar',                            [PedagogicoController::class, 'turmas_tabelar'])            ->name('ped.turmas.tabelar')                    ->middleware('auth');
            Route::get('/turmas/pegar',                              [PedagogicoController::class, 'turmas_pegar'])              ->name('ped.turmas.pegar')                      ->middleware('auth');
            Route::get('/turmas/mostrar/{cod}',                      [PedagogicoController::class, 'turmas_mostrar'])            ->name('ped.turmas.mostrar')                    ->middleware('auth');
            Route::get('/turmas/adicionar',                          [PedagogicoController::class, 'turmas_adicionar'])          ->name('ped.turmas.adicionar')                  ->middleware('auth');
            Route::post('/turmas/gravar',                            [PedagogicoController::class, 'turmas_gravar'])             ->name('ped.turmas.gravar')                     ->middleware('auth');
            Route::get('/turmas/editar/{cod}',                       [PedagogicoController::class, 'turmas_editar'])             ->name('ped.turmas.editar')                     ->middleware('auth');
            Route::put('/turmas/atualizar/{cod}',                    [PedagogicoController::class, 'turmas_atualizar'])          ->name('ped.turmas.atualizar')                  ->middleware('auth');
            Route::delete('/turmas/excluir/{cod}',                   [PedagogicoController::class, 'turmas_excluir'])            ->name('ped.turmas.excluir')                    ->middleware('auth');
            Route::post('/turmas/restaurar/{cod}',                   [PedagogicoController::class, 'turmas_restaurar'])          ->name('ped.turmas.restaurar')                  ->middleware('auth');
            Route::get('/turmas/pesquisar',                          [PedagogicoController::class, 'turmas_pesquisar'])          ->name('ped.turmas.pesquisar')                  ->middleware('auth');
            Route::get('/turmas/plucar',                             [PedagogicoController::class, 'turmas_plucar'])             ->name('ped.turmas.plucar')                     ->middleware('auth');
    
            Route::get('/projecao',                                  [PedagogicoController::class, 'projecao'])                  ->name('ped.projecao')                          ->middleware('auth');
        });
    
        Route::group(['prefix' => '/financeiro2'], function() {
    
    
    
            Route::get('/vale',                                      [LancamentoController::class, 'vale'])                         ->name('lancamento.vale')                     ->middleware('auth');
            Route::post('/vale',                                     [LancamentoController::class, 'lancar_vale'])                  ->name('lancamento.lancar_vale')              ->middleware('auth');
            Route::get('/pao',                                       [LancamentoController::class, 'pao'])                          ->name('lancamento.pao')                      ->middleware('auth');
            Route::post('/pao',                                      [LancamentoController::class, 'lancar_pao'])                   ->name('lancamento.lancar_pao')               ->middleware('auth');
            Route::get('/d_gerais',                                  [LancamentoController::class, 'd_gerais'])                     ->name('lancamento.d_gerais')                 ->middleware('auth');
            Route::post('/lancar_d_gerais',                          [LancamentoController::class, 'lancar_d_gerais'])              ->name('lancamento.lancar_d_gerais')          ->middleware('auth');
    
            Route::get('/transferencia',                             [LancamentoController::class, 'transferencia'])                ->name('lancamento.transferencia')            ->middleware('auth');
            Route::post('/transferencia',                            [LancamentoController::class, 'lancar_transferencia'])         ->name('lancamento.lancar_transferencia')     ->middleware('auth');
    
            Route::get('/r_gerais',                                  [LancamentoController::class, 'r_gerais'])                     ->name('lancamento.r_gerais')                 ->middleware('auth');
            Route::post('/r_gerais',                                 [LancamentoController::class, 'lancar_r_gerais'])              ->name('lancamento.lancar_r_gerais')          ->middleware('auth');
    
            Route::any('/lancamento/filtrar',                        [LancamentoController::class, 'filtrar'])                      ->name('lancamento.filtrar')                  ->middleware('auth');
            Route::resource('/lancamento',                            LancamentoController::class)                                                                            ->middleware('auth');
    
            Route::post('/cartoes/confirmados',                      [LancamentoController::class, 'cartoesconfirmados'])           ->name('lancamentos.cartoesconfirmados')      ->middleware('auth');
            Route::post('/cartoes/confirmar',                        [LancamentoController::class, 'confirmarCartoes'])             ->name('lancamentos.confirmarCartoes')        ->middleware('auth');
            Route::get('/cartoes/confirmar',                         [LancamentoController::class, 'recebimentoCartoes'])           ->name('lancamentos.recebimentoCartoes')      ->middleware('auth');
            Route::get('/cartoes/recebimento',                       [LancamentoController::class, 'recebimento_cartoes'])          ->name('fin.recebimento_cartoes')             ->middleware('auth');
    
            Route::post('/comissao/criarAjuste',                     [ComissaoController::class, 'criarAjuste'])                  ->name('comissao.criarAjuste')                ->middleware('auth');
            Route::post('/comissoes/',                               [ComissaoController::class, 'pagamentoComissoes'])           ->name('comissao.pagamentoComissoes')         ->middleware('auth');
            Route::get('/comissao/pago/{id}/{lancamento}',           [ComissaoController::class, 'pagoProfissional'])             ->name('comissao.pagoProfissional')           ->middleware('auth');
            Route::get('/comissao/pagar/{id}',                       [ComissaoController::class, 'pagarProfissional'])            ->name('comissao.pagarProfissional')          ->middleware('auth');
            Route::get('/comissao/pagamento',                        [ComissaoController::class, 'pagamentos'])                   ->name('comissao.pagamento')                  ->middleware('auth');
            Route::get('/comissao/editar/{id}',                      [ComissaoController::class, 'editarComissao'])               ->name('comissao.editarComissao')             ->middleware('auth');
            Route::post('/comissao/update',                          [ComissaoController::class, 'updateComissao'])               ->name('comissoes.updateComissao')            ->middleware('auth');
    
    
            Route::get('/banco/transferencia/{id}',                  [BancoController::class, 'transferencia'])                     ->name('fin.banco.transferencia')             ->middleware('auth'); // VER NECESSIDADE
            Route::get('/banco/aberto/{id}',                         [BancoController::class, 'CaixaAberto'])                       ->name('fin.banco.CaixaAberto')               ->middleware('auth'); // VER NECESSIDADE
        });
    
        Route::group(['prefix' => '/configuracao'], function() {
            Route::get('/contabil/dre',                              [ContabilController::class, 'dre'])                          ->name('contabil.dre')                        ->middleware('auth');
            Route::post('/contabil/search/',                         [ContabilController::class, 'search'])                       ->name('contabil.search')                     ->middleware('auth');
            Route::resource('/contabil',                              ContabilController::class)                                                                                ->middleware('auth');
    
            Route::post('/comissao/configurar',                      [ComissaoController::class, 'configurarTodas'])              ->name('comissao.configurar')                 ->middleware('auth');
            Route::resource('/comissao',                              ComissaoController::class)                                                                            ->middleware('auth');
    
            
            Route::get('/load_TiposDePessoas',                       [SistemaController::class, 'load_TiposDePessoas'])           ->name('sistema.load_TiposDePessoas')         ->middleware('auth');
            Route::post('/store_TiposDePessoas',                     [SistemaController::class, 'store_TiposDePessoas'])          ->name('sistema.store_TiposDePessoas')        ->middleware('auth');
            Route::post('/delete_TiposDePessoas/{id}',               [SistemaController::class, 'delete_TiposDePessoas'])         ->name('sistema.delete_TiposDePessoas')       ->middleware('auth');
    
            Route::get('/load_Bancos',                               [SistemaController::class, 'load_Bancos'])                   ->name('sistema.load_Bancos')                 ->middleware('auth');
            Route::post('/store_Bancos',                             [SistemaController::class, 'store_Bancos'])                  ->name('sistema.store_Bancos')                ->middleware('auth');
            Route::post('/delete_Bancos/{id}',                       [SistemaController::class, 'delete_Bancos'])                 ->name('sistema.delete_Bancos')               ->middleware('auth');
    
            Route::get('/load_Marcas',                               [SistemaController::class, 'load_Marcas'])                   ->name('sistema.load_Marcas')                 ->middleware('auth');
            Route::post('/store_Marcas',                             [SistemaController::class, 'store_Marcas'])                  ->name('sistema.store_Marcas')                ->middleware('auth');
            Route::post('/delete_Marcas/{id}',                       [SistemaController::class, 'delete_Marcas'])                 ->name('sistema.delete_Marcas')               ->middleware('auth');
    
            Route::get('/load_Categorias',                           [SistemaController::class, 'load_Categorias'])               ->name('sistema.load_Categorias')             ->middleware('auth');
            Route::post('/store_Categorias',                         [SistemaController::class, 'store_Categorias'])              ->name('sistema.store_Categorias')            ->middleware('auth');
            Route::post('/delete_Categorias/{id}',                   [SistemaController::class, 'delete_Categorias'])             ->name('sistema.delete_Categorias')           ->middleware('auth');
    
            Route::get('/load_Funcoes',                              [SistemaController::class, 'load_Funcoes'])                  ->name('sistema.load_Funcoes')                ->middleware('auth');
            Route::post('/store_Funcoes',                            [SistemaController::class, 'store_Funcoes'])                 ->name('sistema.store_Funcoes')               ->middleware('auth');
            Route::post('/delete_Funcoes/{id}',                      [SistemaController::class, 'delete_Funcoes'])                ->name('sistema.delete_Funcoes')              ->middleware('auth');
    
            
/**/        Route::get('/opcoes-sistema',                             Sistema::class)                                             ->name('cfg.sistema');

            Route::resource('/sistema',                               SistemaController::class)                                                                             ->middleware('auth');
    
            Route::get('/mensagens',                                 [MensagemController::class, 'mensagens'])                    ->name('cfg.mensagens')                       ->middleware('auth');
            Route::get('/mensagens/tabelar',                         [MensagemController::class, 'mensagens_tabelar'])            ->name('cfg.mensagens.tabelar')               ->middleware('auth');
            Route::get('/mensagens/mostrar/{id}',                    [MensagemController::class, 'mensagens_mostrar'])            ->name('cfg.mensagens.mostrar')               ->middleware('auth');
            Route::get('/mensagens/adicionar',                       [MensagemController::class, 'mensagens_adicionar'])          ->name('cfg.mensagens.adicionar')             ->middleware('auth');
            Route::post('/mensagens/gravar',                         [MensagemController::class, 'mensagens_gravar'])             ->name('cfg.mensagens.gravar')                ->middleware('auth');
            Route::get('/mensagens/editar/{id}',                     [MensagemController::class, 'mensagens_editar'])             ->name('cfg.mensagens.editar')                ->middleware('auth');
            Route::put('/mensagens/atualizar/{id}',                  [MensagemController::class, 'mensagens_atualizar'])          ->name('cfg.mensagens.atualizar')             ->middleware('auth');
            Route::delete('/mensagens/excluir/{id}',                 [MensagemController::class, 'mensagens_excluir'])            ->name('cfg.mensagens.excluir')               ->middleware('auth');
            Route::post('/mensagens/restaurar/{id}',                 [MensagemController::class, 'mensagens_restaurar'])          ->name('cfg.mensagens.restaurar')             ->middleware('auth');
            Route::get('/mensagens/plucar',                          [MensagemController::class, 'mensagens_plucar'])             ->name('cfg.mensagens.plucar')                ->middleware('auth');
            Route::post('/mensagens/preencher',                      [MensagemController::class, 'mensagens_preencher'])          ->name('cfg.mensagens.preencher')             ->middleware('auth');
        });
    
    
       
    
        Route::group(['prefix' => '/relatorio'], function() {
            Route::match(['get', 'post'], '/vendas',                 [RelatoriosController::class, 'vendas'])                        ->name('relatorio.vendas')                    ->middleware('auth');
            Route::match(['get', 'post'], '/vendas_xxx',             [RelatoriosController::class, 'vendas_xxx'])                    ->name('relatorio.vendas_xxx')                ->middleware('auth');
            Route::match(['get', 'post'], '/vendas_yyy',             [RelatoriosController::class, 'vendas_yyy'])                    ->name('relatorio.vendas_yyy')                ->middleware('auth');
            Route::match(['get', 'post'], '/clientes_aaa',           [RelatoriosController::class, 'clientes_aaa'])                  ->name('relatorio.clientes_aaa')              ->middleware('auth');
            Route::match(['get', 'post'], '/comissoes',              [RelatoriosController::class, 'comissoes'])                     ->name('relatorio.comissoes')                 ->middleware('auth');
            Route::match(['get', 'post'], '/devedores',              [RelatoriosController::class, 'devedores'])                     ->name('relatorio.devedores')                 ->middleware('auth');
            Route::match(['get', 'post'], '/comCredito',             [RelatoriosController::class, 'comCredito'])                    ->name('relatorio.comCredito')                ->middleware('auth');
            Route::match(['get', 'post'], '/aniversariantes',        [RelatoriosController::class, 'aniversariantes'])               ->name('relatorio.aniversariantes')           ->middleware('auth');
            Route::match(['get', 'post'], '/nf_cartoes',             [RelatoriosController::class, 'nf_cartoes'])                    ->name('relatorio.nf_cartoes')                ->middleware('auth');
            Route::match(['get', 'post'], '/lista_espera_noivas',    [RelatoriosController::class, 'lista_espera_noivas'])           ->name('relatorio.lista_espera_noivas')       ->middleware('auth');
    
            Route::any('/inventory',                                 [RelatoriosController::class, 'inventory'])                     ->name('relatorio.inventory')                 ->middleware('auth'); // OK
    
            Route::resource('/relatorio',                             RelatoriosController::class)                                                                             ->middleware('auth');
        });
    
        Route::group(['prefix' => '/chart'], function() {
            Route::any('/cartoes_semanal',                           [ChartsController::class, 'cartoes_semanal'])                      ->name('chart.cartoes_semanal')               ->middleware('auth');
            Route::any('/vendas',                                    [ChartsController::class, 'vendas'])                               ->name('chart.vendas')                        ->middleware('auth');
    
    
            Route::post('/cartoes/confirmados',                      [LancamentoController::class, 'cartoesconfirmados'])           ->name('lancamentos.cartoesconfirmados')      ->middleware('auth');
            Route::post('/cartoes/confirmar',                        [LancamentoController::class, 'confirmarCartoes'])             ->name('lancamentos.confirmarCartoes')        ->middleware('auth');
            Route::get('/cartoes/confirmar',                         [LancamentoController::class, 'recebimentoCartoes'])           ->name('lancamentos.recebimentoCartoes')      ->middleware('auth');
        });
    
    
    
    
        // =======================================================================================================================================================================================
    
    
        Route::group(['prefix' => '/pessoas'], function() {
            Route::post('/gravar',                                    [PessoasController::class, 'gravar'])                            ->name('pessoas.gravar')                      ->middleware('auth');
            Route::get('/cadastrar',                                  [PessoasController::class, 'cadastrar'])                         ->name('pessoas.cadastrar')                   ->middleware('auth');
    
            Route::get('/todos',                                      [PessoasController::class, 'todos'])                             ->name('pessoas.todos')                       ->middleware('auth');
            Route::get('/todos/listar',                               [PessoasController::class, 'todos_listar'])                      ->name('pessoas.todos.listar')                ->middleware('auth');
    
    
    
            Route::post('/clientes/gravar',                           [PessoasController::class, 'clientes_gravar'])                   ->name('pessoas.clientes.gravar')             ->middleware('auth');
            Route::get('/clientes/adicionar',                         [PessoasController::class, 'clientes_adicionar'])                ->name('pessoas.clientes.adicionar')          ->middleware('auth');
            Route::get('/clientes/listar',                            [PessoasController::class, 'clientes_listar'])                   ->name('pessoas.clientes.listar')             ->middleware('auth');
            Route::get('/clientes',                                   [PessoasController::class, 'clientes'])                          ->name('pessoas.clientes')                    ->middleware('auth');
    
    
            Route::get('/cliente/dashboard',                          [PessoasController::class, 'clientes_dashboard'])                ->name('pessoas.clientes.dashboard')          ->middleware('auth');
            Route::get('/cliente/todos_clientes',                     [PessoasController::class, 'todos_clientes'])                    ->name('pessoas.clientes.todos_clientes')     ->middleware('auth');
    
            Route::get('/pessoas/changeTypePerson',                   [PessoasController::class, 'changeTypePerson'])                  ->name('pessoas.changeTypePerson')            ->middleware('auth');
        });
    
    
        Route::group(['prefix' => '/financial'], function() {
    
            Route::get('/bills/create',                              [BillsController::class, 'create'])                             ->name('bills.create')                        ->middleware('auth');
            Route::any('/bills/load',                                [BillsController::class, 'load'])                               ->name('bills.load')                          ->middleware('auth');
            Route::resource('/bills',                                 BillsController::class)                                                                                  ->middleware('auth');
        });
    
        Route::group(['prefix' => '/dashboard'], function() {
            Route::match(['get', 'post'], '/soma_informacao',        [ClientesController::class, 'soma_informacao'])                  ->name('dashboard.soma_informacao')           ->middleware('auth');
            Route::match(['get', 'post'], '/chart_acoes_lead',       [ClientesController::class, 'chart_acoes_lead'])                 ->name('dashboard.chart_acoes_lead')          ->middleware('auth');
            Route::match(['get', 'post'], '/chart_engajamento',      [ClientesController::class, 'chart_engajamento'])                ->name('dashboard.chart_engajamento')         ->middleware('auth');
            Route::match(['get', 'post'], '/chart_cliques',          [ClientesController::class, 'chart_cliques'])                    ->name('dashboard.chart_cliques')             ->middleware('auth');
            Route::match(['get', 'post'], '/chart_mensagensRec',     [ClientesController::class, 'chart_mensagensRec'])               ->name('dashboard.chart_mensagensRec')        ->middleware('auth');
            Route::match(['get', 'post'], '/chart_valorGasto',       [ClientesController::class, 'chart_valorGasto'])                 ->name('dashboard.chart_valorGasto')          ->middleware('auth');
            Route::match(['get', 'post'], '/chart_estDiaaDia',       [ClientesController::class, 'chart_estDiaaDia'])                 ->name('dashboard.chart_estDiaaDia')          ->middleware('auth');
            Route::match(['get', 'post'], '/chart_dados_complem',    [ClientesController::class, 'chart_mes_dados_complem'])          ->name('dashboard.chart_mes_dados_complem')   ->middleware('auth');
            Route::match(['get'], '/crm',                            [CRMController::class, 'dash_page_crm'])                        ->name('dashboard.page_crm')                  ->middleware('auth');
            Route::match(['get'], '/crm_dados',                      [CRMController::class, 'dash_page_crm_dados'])                  ->name('dashboard.page_crm_dados')            ->middleware('auth');
            Route::match(['get'], '/crm_dados_funnel',               [CRMController::class, 'page_crm_dados_funnel'])                ->name('dashboard.page_crm_dados_funnel')     ->middleware('auth');
        });
    
    
    
    
    
        Route::group(['prefix' => '/pessoas'], function() {
            Route::get('/equipe/listar',                             [PessoasController::class, 'equipe_listar'])                  ->name('pessoas.equipe.listar')               ->middleware('auth');
            Route::get('/equipe/pesquisar/{id}',                     [PessoasController::class, 'equipe_pesquisar'])               ->name('pessoas.equipe.pesquisar')            ->middleware('auth');
    
            Route::get('/todos/listar',                              [PessoasController::class, 'pessoas_listar'])                 ->name('pessoas.todos.listar')                ->middleware('auth');
        });
    
    
        // =============================================================================================================================================================================================  FINALIZADO
    
        Route::group(['prefix' => '/cadastro'], function() {
            // Route::get('/categorias',                                [CatalogoController::class, 'categorias'])                       ->name('cat.categorias')                        ->middleware('auth');
            Route::get('/categorias/tabelar',                        [CatalogoController::class, 'categorias_tabelar'])               ->name('cat.categorias.tabelar')                ->middleware('auth');
            Route::get('/categorias/mostrar/{id}',                   [CatalogoController::class, 'categorias_mostrar'])               ->name('cat.categorias.mostrar')                ->middleware('auth');
            Route::get('/categorias/adicionar',                      [CatalogoController::class, 'categorias_adicionar'])             ->name('cat.categorias.adicionar')              ->middleware('auth');
            Route::post('/categorias/gravar',                        [CatalogoController::class, 'categorias_gravar'])                ->name('cat.categorias.gravar')                 ->middleware('auth');
            Route::get('/categorias/editar/{id}',                    [CatalogoController::class, 'categorias_editar'])                ->name('cat.categorias.editar')                 ->middleware('auth');
            Route::put('/categorias/atualizar/{id}',                 [CatalogoController::class, 'categorias_atualizar'])             ->name('cat.categorias.atualizar')              ->middleware('auth');
            Route::delete('/categorias/excluir/{id}',                [CatalogoController::class, 'categorias_excluir'])               ->name('cat.categorias.excluir')                ->middleware('auth');
            Route::post('/categorias/restaurar/{id}',                [CatalogoController::class, 'categorias_restaurar'])             ->name('cat.categorias.restaurar')              ->middleware('auth');
            Route::get('/categorias/plucar',                          [CatalogoController::class, 'categorias_plucar'])                 ->name('cat.categorias.plucar')                  ->middleware('auth');
    
            Route::get('/categorias/{id}/produtos',                  [CatalogoController::class, 'categorias_produtos'])              ->name('cat.categorias.produtos')               ->middleware('auth');
            Route::get('/categorias/{id}/produtos/tabelar',          [CatalogoController::class, 'categorias_produtos_tabelar'])      ->name('cat.categorias.produtos.tabelar')       ->middleware('auth');
            Route::post('/categorias/produtos/adicionar/{id}',       [CatalogoController::class, 'categorias_produtos_adicionar'])    ->name('cat.categorias.produtos.adicionar')     ->middleware('auth');
            Route::post('/categorias/produtos/remover/{id}',         [CatalogoController::class, 'categorias_produtos_remover'])      ->name('cat.categorias.produtos.remover')       ->middleware('auth');
    
            Route::get('/categorias/{id}/servicos',                  [CatalogoController::class, 'categorias_servicos'])              ->name('cat.categorias.servicos')               ->middleware('auth');
            Route::get('/categorias/{id}/servicos/tabelar',          [CatalogoController::class, 'categorias_servicos_tabelar'])      ->name('cat.categorias.servicos.tabelar')       ->middleware('auth');
            Route::post('/categorias/servicos/adicionar/{id}',       [CatalogoController::class, 'categorias_servicos_adicionar'])    ->name('cat.categorias.servicos.adicionar')     ->middleware('auth');
            Route::post('/categorias/servicos/remover/{id}',         [CatalogoController::class, 'categorias_servicos_remover'])      ->name('cat.categorias.servicos.remover')       ->middleware('auth');
    
            Route::get('/categorias/{id}/consumos',                  [CatalogoController::class, 'categorias_consumos'])              ->name('cat.categorias.consumos')               ->middleware('auth');
            Route::get('/categorias/{id}/consumos/tabelar',          [CatalogoController::class, 'categorias_consumos_tabelar'])      ->name('cat.categorias.consumos.tabelar')       ->middleware('auth');
            Route::post('/categorias/consumos/adicionar/{id}',       [CatalogoController::class, 'categorias_consumos_adicionar'])    ->name('cat.categorias.consumos.adicionar')     ->middleware('auth');
            Route::post('/categorias/consumos/remover/{id}',         [CatalogoController::class, 'categorias_consumos_remover'])      ->name('cat.categorias.consumos.remover')       ->middleware('auth');
    
            Route::get('/{servprod}',                               [CatalogoController::class, 'servprod'])                        ->name('cat.servprod')                         ->middleware('auth');
            Route::get('/{servprod}/tabelar',                       [CatalogoController::class, 'servprod_tabelar'])                ->name('cat.servprod.tabelar')                 ->middleware('auth');
            Route::get('/{servprod}/mostrar/{id}',                  [CatalogoController::class, 'servprod_mostrar'])                ->name('cat.servprod.mostrar')                 ->middleware('auth');
            Route::any('/{servprod}/validar',                       [CatalogoController::class, 'servprod_validar'])                ->name('cat.servprod.validar')                 ->middleware('auth');
            Route::get('/{servprod}/adicionar',                     [CatalogoController::class, 'servprod_adicionar'])              ->name('cat.servprod.adicionar')               ->middleware('auth');
            Route::post('/{servprod}/gravar',                       [CatalogoController::class, 'servprod_gravar'])                 ->name('cat.servprod.gravar')                  ->middleware('auth');
            Route::post('/{servprod}/avatar',                       [CatalogoController::class, 'servprod_avatar'])                 ->name('cat.servprod.avatar')                  ->middleware('auth');
            Route::post('/{servprod}/avatar/remove',                [CatalogoController::class, 'servprod_avatar_remove'])          ->name('cat.servprod.avatar_remove')           ->middleware('auth');
            Route::get('/{servprod}/editar/{id}',                   [CatalogoController::class, 'servprod_editar'])                 ->name('cat.servprod.editar')                  ->middleware('auth');
            Route::put('/{servprod}/atualizar/{id}',                [CatalogoController::class, 'servprod_atualizar'])              ->name('cat.servprod.atualizar')               ->middleware('auth');
            Route::delete('/{servprod}/excluir/{id}',               [CatalogoController::class, 'servprod_excluir'])                ->name('cat.servprod.excluir')                 ->middleware('auth');
            Route::post('/{servprod}/restaurar/{id}',               [CatalogoController::class, 'servprod_restaurar'])              ->name('cat.servprod.restaurar')               ->middleware('auth');
            
            Route::get('/produtos/listar',                           [CatalogoController::class, 'produtos_listar'])                  ->name('cat.servprod.listar')                   ->middleware('auth');
            Route::get('/produtos/plucar',                            [CatalogoController::class, 'produtos_plucar'])                   ->name('cat.servprod.plucar')                    ->middleware('auth');
            Route::get('/produtos/paginar',                          [CatalogoController::class, 'produtos_paginar'])                 ->name('cat.servprod.paginar')                  ->middleware('auth');
    
            Route::get('/produtos/{id}/extrato',                     [CatalogoController::class, 'produtos_extrato'])                 ->name('cat.servprod.extrato.tabelar')          ->middleware('auth');
            Route::get('/produtos/listar',                           [CatalogoController::class, 'produtos_listar'])                  ->name('cat.servprod.listar')                   ->middleware('auth');
            Route::get('/produtos/listar_compras',                   [CatalogoController::class, 'produtos_listar_compras'])          ->name('cat.servprod.listar_compras')           ->middleware('auth');
            Route::get('/produtos/pesquisar/{id}',                   [CatalogoController::class, 'produtos_pesquisar'])               ->name('cat.servprod.pesquisar')                ->middleware('auth');
    
            // Route::get('/produtos',                                  [CatalogoController::class, 'produtos'])                         ->name('cat.produtos')                          ->middleware('auth');
            Route::get('/produtos/tabelar',                          [CatalogoController::class, 'produtos_tabelar'])                 ->name('cat.produtos.tabelar')                  ->middleware('auth');
            Route::get('/produtos/mostrar/{id}',                     [CatalogoController::class, 'produtos_mostrar'])                 ->name('cat.produtos.mostrar')                  ->middleware('auth');
            Route::get('/produtos/adicionar',                        [CatalogoController::class, 'produtos_adicionar'])               ->name('cat.produtos.adicionar')                ->middleware('auth');
            Route::post('/produtos/gravar',                          [CatalogoController::class, 'produtos_gravar'])                  ->name('cat.produtos.gravar')                   ->middleware('auth');
            Route::get('/produtos/editar/{id}',                      [CatalogoController::class, 'produtos_editar'])                  ->name('cat.produtos.editar')                   ->middleware('auth');
            Route::put('/produtos/atualizar/{id}',                   [CatalogoController::class, 'produtos_atualizar'])               ->name('cat.produtos.atualizar')                ->middleware('auth');
            Route::delete('/produtos/excluir/{id}',                  [CatalogoController::class, 'produtos_excluir'])                 ->name('cat.produtos.excluir')                  ->middleware('auth');
            
            Route::post('/servicos/restaurar/{id}',                  [CatalogoController::class, 'servicos_restaurar'])               ->name('cat.servicos.restaurar')                ->middleware('auth');
            // Route::get('/servicos',                                  [CatalogoController::class, 'servicos'])                         ->name('cat.servicos')                          ->middleware('auth');
            Route::get('/servicos/tabelar',                          [CatalogoController::class, 'servicos_tabelar'])                 ->name('cat.servicos.tabelar')                  ->middleware('auth');
            Route::get('/servicos/mostrar/{id}',                     [CatalogoController::class, 'servicos_mostrar'])                 ->name('cat.servicos.mostrar')                  ->middleware('auth');
            Route::get('/servicos/adicionar',                        [CatalogoController::class, 'servicos_adicionar'])               ->name('cat.servicos.adicionar')                ->middleware('auth');
            Route::post('/servicos/gravar',                          [CatalogoController::class, 'servicos_gravar'])                  ->name('cat.servicos.gravar')                   ->middleware('auth');
            Route::get('/servicos/editar/{id}',                      [CatalogoController::class, 'servicos_editar'])                  ->name('cat.servicos.editar')                   ->middleware('auth');
            Route::put('/servicos/atualizar/{id}',                   [CatalogoController::class, 'servicos_atualizar'])               ->name('cat.servicos.atualizar')                ->middleware('auth');
            Route::delete('/servicos/excluir/{id}',                  [CatalogoController::class, 'servicos_excluir'])                 ->name('cat.servicos.excluir')                  ->middleware('auth');
            Route::post('/servicos/restaurar/{id}',                  [CatalogoController::class, 'servicos_restaurar'])               ->name('cat.servicos.restaurar')                ->middleware('auth');
    
            Route::get('/servicos/listar',                           [CatalogoController::class, 'servicos_listar'])                  ->name('cat.servicos.listar')                   ->middleware('auth');
            Route::get('/servicos/plucar',                            [CatalogoController::class, 'servicos_plucar'])                   ->name('cat.servicos.plucar')                    ->middleware('auth');
            Route::get('/servicos/paginar',                          [CatalogoController::class, 'servicos_paginar'])                 ->name('cat.servicos.paginar')                  ->middleware('auth');
            Route::get('/servico/encontrar/{id}',                    [CatalogoController::class, 'servicos_encontrar'])               ->name('cat.servicos.encontrar');
    
            Route::get('/servicos/{id}/extrato',                     [CatalogoController::class, 'servicos_extrato'])                 ->name('cat.servicos.extrato.tabelar')          ->middleware('auth');
            Route::get('/servicos/listar',                           [CatalogoController::class, 'servicos_listar'])                  ->name('cat.servicos.listar')                   ->middleware('auth');
            Route::get('/servicos/pesquisar/{id}',                   [CatalogoController::class, 'servicos_pesquisar'])               ->name('cat.servicos.pesquisar')                ->middleware('auth');
            
            Route::get('/servprod/executor/{id_servprod}',           [CatalogoController::class, 'colaborador_executor'])             ->name('cat.servprod.executor')                 ->middleware('auth');
            Route::get('/servprod/buscar/{id_servprod}',             [CatalogoController::class, 'servprod_buscar'])                  ->name('cat.servprod.buscar')                   ->middleware('auth');
            
            Route::get('/consumos',                                  [CatalogoController::class, 'consumos'])                         ->name('cat.consumos')                          ->middleware('auth');
            Route::get('/consumos/tabelar',                          [CatalogoController::class, 'consumos_tabelar'])                 ->name('cat.consumos.tabelar')                  ->middleware('auth');
            Route::get('/consumos/mostrar/{id}',                     [CatalogoController::class, 'consumos_mostrar'])                 ->name('cat.consumos.mostrar')                  ->middleware('auth');
            Route::get('/consumos/adicionar',                        [CatalogoController::class, 'consumos_adicionar'])               ->name('cat.consumos.adicionar')                ->middleware('auth');
            Route::post('/consumos/gravar',                          [CatalogoController::class, 'consumos_gravar'])                  ->name('cat.consumos.gravar')                   ->middleware('auth');
            Route::get('/consumos/editar/{id}',                      [CatalogoController::class, 'consumos_editar'])                  ->name('cat.consumos.editar')                   ->middleware('auth');
            Route::put('/consumos/atualizar/{id}',                   [CatalogoController::class, 'consumos_atualizar'])               ->name('cat.consumos.atualizar')                ->middleware('auth');
            Route::delete('/consumos/excluir/{id}',                  [CatalogoController::class, 'consumos_excluir'])                 ->name('cat.consumos.excluir')                  ->middleware('auth');
            Route::post('/consumos/restaurar/{id}',                  [CatalogoController::class, 'consumos_restaurar'])               ->name('cat.consumos.restaurar')                ->middleware('auth');
    
            Route::get('/consumos/listar',                           [CatalogoController::class, 'consumos_listar'])                  ->name('cat.consumos.listar')                   ->middleware('auth');
            Route::get('/consumos/plucar',                            [CatalogoController::class, 'consumos_plucar'])                   ->name('cat.consumos.plucar')                    ->middleware('auth');
            Route::get('/consumos/paginar',                          [CatalogoController::class, 'consumos_paginar'])                 ->name('cat.consumos.paginar')                  ->middleware('auth');
    
            Route::get('/consumos/{id}/extrato',                     [CatalogoController::class, 'consumos_extrato'])                 ->name('cat.consumos.extrato.tabelar')          ->middleware('auth');
            Route::get('/consumos/listar',                           [CatalogoController::class, 'consumos_listar'])                  ->name('cat.consumos.listar')                   ->middleware('auth');
            Route::get('/consumos/pesquisar/{id}',                   [CatalogoController::class, 'consumos_pesquisar'])               ->name('cat.consumos.pesquisar')                ->middleware('auth');
    
    
    
            Route::get('/servprod/plucar',                            [CatalogoController::class, 'servprod_plucar'])                   ->name('cat.servprod.plucar')                    ->middleware('auth');
            Route::get('/servprod/procurar/{id}',                    [CatalogoController::class, 'servprod_procurar'])                ->name('cat.servprod.procurar')                 ->middleware('auth');
            Route::get('/servprod/{id}/executor',                    [CatalogoController::class, 'servprod_executor'])                ->name('cat.servprod.executor')                 ->middleware('auth');
            Route::get('/comissao/buscar/{id_profexec}/{id_servprod}',  [CatalogoController::class, 'comissao_buscar'])                  ->name('cat.comissao.buscar')                   ->middleware('auth');
    
    
    
            Route::get('/produtos/procurarProduto',                  [ServicosProdutosController::class, 'procurarProduto'])          ->name('produtos.procurarProduto');
            Route::get('/produtos/mudarFornecedorProduto',           [ServicosProdutosController::class, 'mudarFornecedorProduto'])   ->name('produtos.mudarFornecedorProduto');
            Route::get('/produtos/fornecedoresProduto/{id}',         [ServicosProdutosController::class, 'fornecedoresProduto'])      ->name('produtos.fornecedoresProduto');
            
        });
    
        Route::group(['prefix' => '/financeiro'], function()
        {
            Route::resource('/dividas',                              LancamentosController::class)                                                                           ->middleware('auth'); // OK
            
    
            Route::get('/dashboard',                                 [LancamentosController::class, 'dashboard'])                   ->name('fin.dashboard')                       ->middleware('auth');
            Route::get('/dashboard_saldo_final_c6',                  [LancamentosController::class, 'dashboard_saldo_final_c6'])    ->name('fin.dashboard_saldo_final_c6')        ->middleware('auth');
            Route::get('/dashboard_saldo_final_asaas',               [LancamentosController::class, 'dashboard_saldo_final_asaas']) ->name('fin.dashboard_saldo_final_asaas')     ->middleware('auth');
            Route::get('/dashboard_saldo_final_geral',               [LancamentosController::class, 'dashboard_saldo_final_geral']) ->name('fin.dashboard_saldo_final_geral')     ->middleware('auth');
    
            // Route::get('/bancos',                                    [LancamentosController::class, 'bancos'])                      ->name('fin.bancos')                          ->middleware('can:Bancos.Menu');
            Route::get('/bancos/tabelar',                            [LancamentosController::class, 'bancos_tabelar'])              ->name('fin.bancos.tabelar')                  ->middleware('can:Bancos.Menu');
            Route::get('/bancos/mostrar/{id}',                       [LancamentosController::class, 'bancos_mostrar'])              ->name('fin.bancos.mostrar')                  ->middleware('can:Bancos.Visualizar');
            Route::get('/bancos/adicionar',                          [LancamentosController::class, 'bancos_adicionar'])            ->name('fin.bancos.adicionar')                ->middleware('can:Bancos.Criar');
            Route::post('/bancos/gravar',                            [LancamentosController::class, 'bancos_gravar'])               ->name('fin.bancos.gravar')                   ->middleware(['can:Bancos.Editar']);
            Route::get('/bancos/editar/{id}',                        [LancamentosController::class, 'bancos_editar'])               ->name('fin.bancos.editar')                   ->middleware('can:Bancos.Editar');
            Route::put('/bancos/atualizar/{id}',                     [LancamentosController::class, 'bancos_atualizar'])            ->name('fin.bancos.atualizar')                ->middleware('can:Bancos.Editar');
            Route::delete('/bancos/excluir/{id}',                    [LancamentosController::class, 'bancos_excluir'])              ->name('fin.bancos.excluir')                  ->middleware('can:Bancos.Excluir');
            Route::post('/bancos/restaurar/{id}',                    [LancamentosController::class, 'bancos_restaurar'])            ->name('fin.bancos.restaurar')                ->middleware(['can:Bancos.Excluir']);
            Route::get('/bancos/plucar',                              [LancamentosController::class, 'bancos_plucar'])              ->name('fin.bancos.plucar')                    ->middleware(['auth']);
    
            Route::get('/bancos/{id}/extrato',                       [LancamentosController::class, 'bancos_extrato'])              ->name('fin.bancos.extrato.tabelar')          ->middleware('can:Bancos.Visualizar');
            Route::get('/bancos/saldos',                             [BancoController::class, 'bancos_saldos_widgets'])             ->name('fin.bancos.saldos.widgets')           ->middleware('auth');
            
            Route::get('/lancamentos',                               [LancamentosController::class, 'lancamentos'])                 ->name('fin.lancamentos')                     ->middleware('auth');
            Route::get('/lancamentos/adicionar/{d}',                 [LancamentosController::class, 'lancamentos_adicionar'])       ->name('fin.lancamentos.adicionar')           ->middleware('auth');
            Route::get('/lancamentos/tabelar',                       [LancamentosController::class, 'lancamentos_tabelar'])         ->name('fin.lancamentos.tabelar')             ->middleware('auth');
            Route::get('/lancamentos/mostrar/{id}',                  [LancamentosController::class, 'lancamentos_mostrar'])         ->name('fin.lancamentos.mostrar')             ->middleware('auth');
            Route::get('/lancamentos/mostrar_modal/{id}',            [LancamentosController::class, 'lancamentos_mostrar_modal'])   ->name('fin.lancamentos.mostrar_modal')       ->middleware('auth');
            Route::post('/lancamentos/confirmar/{id}',               [LancamentosController::class, 'lancamentos_confirmar'])       ->name('fin.lancamentos.confirmar')           ->middleware('auth');
            Route::get('/lancamentos/contrato/mensalidades/{id}',    [LancamentosController::class, 'lancamentos_mensalidades'])    ->name('fin.lancamentos.mensalidades')        ->middleware('auth');
            Route::get('/lancamentos/contrato/faturas/{id}',         [LancamentosController::class, 'lancamentos_faturas'])         ->name('fin.lancamentos.faturas')             ->middleware('auth');
    
            Route::post('/lancamentos/entrada',                      [LancamentosController::class, 'lancamentos_entrada'])         ->name('fin.lancamentos.entrada')             ->middleware('auth');
            Route::post('/lancamentos/saida',                        [LancamentosController::class, 'lancamentos_saida'])           ->name('fin.lancamentos.saida')               ->middleware('auth');
            Route::post('/lancamentos/transferencia',                [LancamentosController::class, 'lancamentos_transferencia'])   ->name('fin.lancamentos.transferencia')       ->middleware('auth');
    
            Route::post('/lancamentos/gravar',                       [LancamentosController::class, 'lancamentos_gravar'])          ->name('fin.lancamentos.gravar')              ->middleware('auth');
            Route::get('/lancamentos/editar/{id}',                   [LancamentosController::class, 'lancamentos_editar'])          ->name('fin.lancamentos.editar')              ->middleware('auth');
            Route::put('/lancamentos/atualizar/{id}',                [LancamentosController::class, 'lancamentos_atualizar'])       ->name('fin.lancamentos.atualizar')           ->middleware('auth');
            Route::delete('/lancamentos/excluir/{id}',               [LancamentosController::class, 'lancamentos_excluir'])         ->name('fin.lancamentos.excluir')             ->middleware('auth');
            Route::post('/lancamentos/restaurar/{id}',               [LancamentosController::class, 'lancamentos_restaurar'])       ->name('fin.lancamentos.restaurar')           ->middleware('auth');
            
            Route::get('/lancamentos/lancar_despesas',               [LancamentosController::class, 'lancamentos_l_despesas'])      ->name('fin.lancamentos.despesas')            ->middleware('auth');
            Route::get('/lancamentos/lancar_receitas',               [LancamentosController::class, 'lancamentos_l_receitas'])      ->name('fin.lancamentos.receitas')            ->middleware('auth');
            Route::get('/lancamentos/lancar_transferencias',         [LancamentosController::class, 'lancamentos_l_transferencias'])->name('fin.lancamentos.transferencias')      ->middleware('auth');
    
            Route::any('/lancamentos/despesas_mes',                  [LancamentosController::class, 'lancamentos_despesas_mes'])    ->name('fin.lancamentos.despesas_mes_widget')->middleware('auth');
    
            
            Route::get('/comissoes',                                 [LancamentosController::class, 'comissoes'])                      ->name('fin.comissoes')                    ->middleware('auth');
            Route::get('/comissoes/tabelar',                         [LancamentosController::class, 'comissoes_tabelar'])              ->name('fin.comissoes.tabelar')            ->middleware('auth');
            Route::get('/comissoes/abert_prof',                      [LancamentosController::class, 'comissoes_abert_prof'])           ->name('fin.comissoes.abert_prof')         ->middleware('auth');
            Route::get('/comissoes/fechd_prof',                      [LancamentosController::class, 'comissoes_fechd_prof'])           ->name('fin.comissoes.fechd_prof')         ->middleware('auth');
            Route::get('/comissoes/profissional/aberto/{id}',        [LancamentosController::class, 'comissoes_prof_abert'])           ->name('fin.comissoes.prof_abert')         ->middleware('auth');
            Route::get('/comissoes/profissional/fechado/{id}',       [LancamentosController::class, 'comissoes_prof_fechd'])           ->name('fin.comissoes.prof_fechd')         ->middleware('auth');
            Route::get('/comissoes/profissional/quitado/{id_quitado}',[LancamentosController::class, 'comissoes_prof_quitada'])        ->name('fin.comissoes.prof_quitada')       ->middleware('auth');
            Route::get('/comissoes/mostrar/{id}',                    [LancamentosController::class, 'comissoes_mostrar'])              ->name('fin.comissoes.mostrar')            ->middleware('auth');
            Route::get('/comissoes/adicionar',                       [LancamentosController::class, 'comissoes_adicionar'])            ->name('fin.comissoes.adicionar')          ->middleware('auth');
            Route::post('/comissoes/gravar',                         [LancamentosController::class, 'comissoes_gravar'])               ->name('fin.comissoes.gravar')             ->middleware('auth');
            Route::get('/comissoes/editar/{id}',                     [LancamentosController::class, 'comissoes_editar'])               ->name('fin.comissoes.editar')             ->middleware('auth');
            Route::put('/comissoes/atualizar/{id}',                  [LancamentosController::class, 'comissoes_atualizar'])            ->name('fin.comissoes.atualizar')          ->middleware('auth');
            Route::delete('/comissoes/excluir/{id}',                 [LancamentosController::class, 'comissoes_excluir'])              ->name('fin.comissoes.excluir')            ->middleware('auth');
            Route::post('/comissoes/restaurar/{id}',                 [LancamentosController::class, 'comissoes_restaurar'])            ->name('fin.comissoes.restaurar')          ->middleware('auth');
            Route::get('/comissoes/plucar',                           [LancamentosController::class, 'comissoes_plucar'])                ->name('fin.comissoes.plucar')              ->middleware('auth');
            Route::post('/comissoes/pagar/{id}',                     [LancamentosController::class, 'comissoes_pagar'])                ->name('fin.comissoes.pagar')              ->middleware('auth');
            
    
    
            Route::get('/contasinterna',                             [LancamentosController::class, 'contas_internass'])                ->name('fin.contas_internas')              ->middleware('auth');
            Route::get('/contasinterna/tabelar',                     [LancamentosController::class, 'contas_internass_tabelar'])        ->name('fin.contas_internas.tabelar')      ->middleware('auth');
            Route::get('/contasinterna/mostrar/{id}',                [LancamentosController::class, 'contas_internass_mostrar'])        ->name('fin.contas_internas.mostrar')      ->middleware('auth');
            Route::get('/contasinterna/adicionar',                   [LancamentosController::class, 'contas_internass_adicionar'])      ->name('fin.contas_internas.adicionar')    ->middleware('auth');
            Route::post('/contasinterna/gravar',                     [LancamentosController::class, 'contas_internass_gravar'])         ->name('fin.contas_internas.gravar')       ->middleware('auth');
            Route::get('/contasinterna/editar/{id}',                 [LancamentosController::class, 'contas_internass_editar'])         ->name('fin.contas_internas.editar')       ->middleware('auth');
            Route::put('/contasinterna/atualizar/{id}',              [LancamentosController::class, 'contas_internass_atualizar'])      ->name('fin.contas_internas.atualizar')    ->middleware('auth');
            Route::delete('/contasinterna/excluir/{id}',             [LancamentosController::class, 'contas_internass_excluir'])        ->name('fin.contas_internas.excluir')      ->middleware('auth');
            Route::post('/contasinterna/restaurar/{id}',             [LancamentosController::class, 'contas_internass_restaurar'])      ->name('fin.contas_internas.restaurar')    ->middleware('auth');
            Route::get('/contasinterna/plucar',                       [LancamentosController::class, 'contas_internass_plucar'])          ->name('fin.contas_internas.plucar')        ->middleware('auth');
            
            
    
            Route::get('/a_receber',                                 [AReceberController::class, 'a_receber'])                         ->name('fin.contas_a_receber')             ->middleware('auth');
            Route::get('/a_receber/tabelar',                         [AReceberController::class, 'a_receber_tabelar'])                 ->name('fin.contas_a_receber.tabelar')     ->middleware('auth');
            Route::get('/a_receber/mostrar/{id}',                    [AReceberController::class, 'a_receber_mostrar'])                 ->name('fin.contas_a_receber.mostrar')     ->middleware('auth');
            Route::get('/a_receber/adicionar',                       [AReceberController::class, 'a_receber_adicionar'])               ->name('fin.contas_a_receber.adicionar')   ->middleware('auth');
            Route::post('/a_receber/gravar',                         [AReceberController::class, 'a_receber_gravar'])                  ->name('fin.contas_a_receber.gravar')      ->middleware('auth');
            Route::get('/a_receber/editar/{id}',                     [AReceberController::class, 'a_receber_editar'])                  ->name('fin.contas_a_receber.editar')      ->middleware('auth');
            Route::put('/a_receber/atualizar/{id}',                  [AReceberController::class, 'a_receber_atualizar'])               ->name('fin.contas_a_receber.atualizar')   ->middleware('auth');
            Route::delete('/a_receber/excluir/{id}',                 [AReceberController::class, 'a_receber_excluir'])                 ->name('fin.contas_a_receber.excluir')     ->middleware('auth');
            Route::post('/a_receber/restaurar/{id}',                 [AReceberController::class, 'a_receber_restaurar'])               ->name('fin.contas_a_receber.restaurar')   ->middleware('auth');
            Route::get('/a_receber/selecionar/{id}',                 [AReceberController::class, 'a_receber_selecionar'])              ->name('fin.contas_a_receber.selecionar')  ->middleware('auth');
            Route::post('/a_receber/confirmar',                      [AReceberController::class, 'a_receber_confirmar'])               ->name('fin.contas_a_receber.confirmar')   ->middleware('auth');
            Route::get('/a_receber/plucar',                           [AReceberController::class, 'a_receber_plucar'])                   ->name('fin.contas_a_receber.plucar')       ->middleware('auth');
            Route::get('/a_receber/por_aluno/{id}',                  [AReceberController::class, 'a_receber_por_aluno'])               ->name('fin.contas_a_receber.por_aluno')   ->middleware('auth');
            
            
    
    
            Route::get('/contratos',                                 [LancamentosController::class, 'contratos'])                   ->name('fin.contratos')                       ->middleware('auth');
    
    
    
            Route::get('/compras',                                    [ComprasController::class, 'index'])                      ->name('fin.compras')                          ->middleware('auth');

            Route::get('/compra/produto/{id}',                        [LancamentosController::class, 'comprasPorProduto'])            ->name('compra.porproduto')                    ->middleware('auth');
    
    
    
                 Route::get('/compra/load',                               [ComprasController::class, 'load'])                           ->name('compra.load')                          ->middleware('auth');
            Route::any('/compra/pagamentos/',                        [ComprasController::class, 'pagamentos'])                    ->name('compras.pagamentos')                    ->middleware('auth');
            Route::get('/compra/fornecedores/',                      [ComprasController::class, 'fornecedores'])                  ->name('purcharses.provider')                   ->middleware('auth');
            Route::get('/compra/confirmacao',                        [ComprasController::class, 'confirmacao'])                   ->name('compras.confirmacao')                   ->middleware('auth');
            Route::get('/compra/edit/{id}',                          [ComprasController::class, 'edit'])                          ->name('compras.edit')                          ->middleware('auth');
         
    
            Route::get('/rec_cartoes',                               [LancamentosController::class, 'rec_cartoes'])                 ->name('fin.rec_cartoes')                         ->middleware('auth');
            Route::get('/rec_cartoes/tabelar',                       [LancamentosController::class, 'rec_cartoes_tabelar'])         ->name('fin.rec_cartoes.tabelar')                 ->middleware('auth');
            Route::get('/rec_cartoes/mostrar/{id}',                  [LancamentosController::class, 'rec_cartoes_mostrar'])         ->name('fin.rec_cartoes.mostrar')                 ->middleware('auth');
            Route::get('/rec_cartoes/adicionar',                     [LancamentosController::class, 'rec_cartoes_adicionar'])       ->name('fin.rec_cartoes.adicionar')               ->middleware('auth');
            Route::post('/rec_cartoes/gravar',                       [LancamentosController::class, 'rec_cartoes_gravar'])          ->name('fin.rec_cartoes.gravar')                  ->middleware('auth');
            Route::get('/rec_cartoes/editar/{id}',                   [LancamentosController::class, 'rec_cartoes_editar'])          ->name('fin.rec_cartoes.editar')                  ->middleware('auth');
            Route::put('/rec_cartoes/atualizar/{id}',                [LancamentosController::class, 'rec_cartoes_atualizar'])       ->name('fin.rec_cartoes.atualizar')               ->middleware('auth');
            Route::delete('/rec_cartoes/excluir/{id}',               [LancamentosController::class, 'rec_cartoes_excluir'])         ->name('fin.rec_cartoes.excluir')                 ->middleware('auth');
            Route::post('/rec_cartoes/confirmar_sel',                [LancamentosController::class, 'rec_cartoes_confirmar_sel'])   ->name('fin.rec_cartoes.confirmar_sel')           ->middleware('auth');
            Route::post('/rec_cartoes/confirmar',                    [LancamentosController::class, 'rec_cartoes_confirmar'])       ->name('fin.rec_cartoes.confirmar')               ->middleware('auth');
            Route::get('/rec_cartoes/widgets',                       [LancamentosController::class, 'rec_cartoes_widgets'])         ->name('fin.rec_cartoes.widgets')                 ->middleware('auth');
        });
    
    
        
        Route::group(['prefix' => '/financial'], function()
        {
      
          Route::get('/bills/create',                              [BillsController::class, 'create'])                             ->name('bills.create');
          Route::any('/bills/load',                                [BillsController::class, 'load'])                               ->name('bills.load');                     
          Route::resource('/bills',                                BillsController::class);
        });
        
      
        Route::group(['prefix' => '/comercial'], function() {
            // Route::get('/crm2',                                      [CRMController::class, 'crm'])                                   ->name('com.kanban')                            ->middleware('auth');
            
            Route::get('/leads',                                      [LeadsController::class, 'leads'])                              ->name('com.leads')                             ->middleware('auth');
            Route::get('/leads/ficha',                                [LeadsController::class, 'leads_ficha'])                        ->name('com.leads.ficha')                       ->middleware('auth');
            Route::get('/leads/tabelar',                              [LeadsController::class, 'leads_tabelar'])                      ->name('com.leads.tabelar')                     ->middleware('auth');
            Route::get('/leads/mostrar/{id}',                         [LeadsController::class, 'leads_mostrar'])                      ->name('com.leads.mostrar')                     ->middleware('auth');
            Route::get('/leads/adicionar',                            [LeadsController::class, 'leads_adicionar'])                    ->name('com.leads.adicionar')                   ->middleware('auth');
            Route::post('/leads/create',                              [LeadsController::class, 'leads_create'])                       ->name('com.leads.create');
            Route::post('/leads/create1',                             [LeadsController::class, 'leads_create1'])                      ->name('com.leads.create1')                     ->middleware('auth');
            Route::get('/leads/adicionar-fornecedor',                 [LeadsController::class, 'leads_adicionar_fornecedor'])         ->name('com.leads.adicionar-fornecedor')        ->middleware('auth');
            Route::post('/leads/create2',                             [LeadsController::class, 'leads_create2'])                      ->name('com.leads.create2')                     ->middleware('auth');
            Route::post('/leads/gravar',                              [LeadsController::class, 'leads_gravar'])                       ->name('com.leads.gravar')                      ->middleware('auth');
            Route::get('/leads/editar/{id}',                          [LeadsController::class, 'leads_editar'])                       ->name('com.leads.editar')                      ->middleware('auth');
            Route::put('/leads/atualizar/{id}',                       [LeadsController::class, 'leads_atualizar'])                    ->name('com.leads.atualizar')                   ->middleware('auth');
            Route::put('/leads/confirmar_edicao/{id}',                [LeadsController::class, 'leads_confirmar_edicao'])             ->name('com.leads.confirmar_edicao')            ->middleware('auth');
            Route::delete('/leads/excluir/{id}',                      [LeadsController::class, 'leads_excluir'])                      ->name('com.leads.excluir')                     ->middleware('auth');
            Route::post('/leads/restaurar/{id}',                      [LeadsController::class, 'leads_restaurar'])                    ->name('com.leads.restaurar')                   ->middleware('auth');
    
            Route::get('/leads/1_empresas',                           [LeadsController::class, 'leads_empresas'])                     ->name('com.leads.1_empresas')                  ->middleware('auth');
            Route::get('/leads/2_produtos/{id}',                      [LeadsController::class, 'leads_produtos'])                     ->name('com.leads.2_produtos')                  ->middleware('auth');
            Route::get('/leads/3_leads/{id}',                         [LeadsController::class, 'leads_clientes'])                     ->name('com.leads.3_leads')                     ->middleware('auth');
            Route::get('/leads/3_leads_procurar/{id}',                [LeadsController::class, 'leads_procurar'])                     ->name('com.leads.3_leads_procurar')            ->middleware('auth');
            Route::get('/leads/tabelar',                              [LeadsController::class, 'leads_tabelar'])                      ->name('com.leads.tabelar')                     ->middleware('auth');
            Route::get('/leads/tabelar',                              [LeadsController::class, 'leads_tabelar'])                      ->name('com.leads.tabelar')                     ->middleware('auth');
    
            Route::get('/portfolio',                                  [PortfolioController::class, 'portfolio'])                      ->name('com.portfolio')                         ->middleware('auth');
            Route::get('/portfolio/ficha',                            [PortfolioController::class, 'portfolio_ficha'])                ->name('com.portfolio.ficha')                   ->middleware('auth');
            Route::get('/portfolio/tabelar',                          [PortfolioController::class, 'portfolio_tabelar'])              ->name('com.portfolio.tabelar')                 ->middleware('auth');
            Route::get('/portfolio/mostrar/{slug}',                   [PortfolioController::class, 'portfolio_mostrar'])              ->name('com.portfolio.mostrar')                 ->middleware('auth');
            Route::get('/portfolio/adicionar',                        [PortfolioController::class, 'portfolio_adicionar'])            ->name('com.portfolio.adicionar')               ->middleware('auth');
            Route::post('/portfolio/create',                          [PortfolioController::class, 'portfolio_create'])               ->name('com.portfolio.create')                  ->middleware('auth');
            Route::get('/portfolio/adicionar-fornecedor',             [PortfolioController::class, 'portfolio_adicionar_fornecedor']) ->name('com.portfolio.adicionar-fornecedor')    ->middleware('auth');
            Route::post('/portfolio/create2',                         [PortfolioController::class, 'portfolio_create2'])              ->name('com.portfolio.create2')                 ->middleware('auth');
            Route::post('/portfolio/gravar',                          [PortfolioController::class, 'portfolio_gravar'])               ->name('com.portfolio.gravar')                  ->middleware('auth');
            Route::get('/portfolio/editar/{id}',                      [PortfolioController::class, 'portfolio_editar'])               ->name('com.portfolio.editar')                  ->middleware('auth');
            Route::put('/portfolio/atualizar/{id}',                   [PortfolioController::class, 'portfolio_atualizar'])            ->name('com.portfolio.atualizar')               ->middleware('auth');
            Route::put('/portfolio/confirmar_edicao/{id}',            [PortfolioController::class, 'portfolio_confirmar_edicao'])     ->name('com.portfolio.confirmar_edicao')        ->middleware('auth');
            Route::delete('/portfolio/excluir/{id}',                  [PortfolioController::class, 'portfolio_excluir'])              ->name('com.portfolio.excluir')                 ->middleware('auth');
            Route::post('/portfolio/restaurar/{id}',                  [PortfolioController::class, 'portfolio_restaurar'])            ->name('com.portfolio.restaurar')               ->middleware('auth');
        });
    
        Route::group(['prefix' => '/pdv'], function()
        {
            Route::get('/caixa/aberto/{id}',                         [CaixasController::class, 'locais'])                                   ->name('pdv.caixas.locais')                        ->middleware('auth');
            Route::post('/caixas/atualizarContadores',               [CaixasController::class, 'atualizarContadores'])                      ->name('caixa.atualizarContadores')           ->middleware('auth');
    
            Route::get('/caixa/close/{id}',                          [CaixasController::class, 'close'])                                    ->name('pdv.caixas.close')                         ->middleware('auth');
            Route::patch('/caixa/closed/{id}',                       [CaixasController::class, 'closed'])                                   ->name('pdv.caixas.closed')                        ->middleware('auth');
    
            Route::get('/caixa/reopen/{id}',                         [CaixasController::class, 'reopen'])                                   ->name('pdv.caixas.reopen')                        ->middleware('auth');
    
            Route::patch('/caixa/validated/{id}',                    [CaixasController::class, 'validated'])                                ->name('caixa.validated')                     ->middleware('auth');
    
            Route::any('/caixa/filtrar',                             [CaixasController::class, 'filtrar'])                                  ->name('caixa.filtrar')                       ->middleware('auth');
            Route::post('/caixa/store',                              [CaixasController::class, 'store'])                                    ->name('caixa.store')                         ->middleware('auth');
            Route::get('/caixa/find/{id}',                           [CaixasController::class, 'find'])                                     ->name('caixa.find')                          ->middleware('auth');
            Route::post('/caixa/procurar',                           [CaixasController::class, 'procurar'])                                 ->name('caixa.procurar')                      ->middleware('auth');
            
    
            Route::get('/caixas',                                     [CaixasController::class, 'caixas'])                                  ->name('pdv.caixas')                            ->middleware('auth');
            Route::any('/caixas/tabelar',                             [CaixasController::class, 'caixas_tabelar'])                          ->name('pdv.caixas.tabelar')                    ->middleware('auth');
            Route::get('/caixas/mostrar/{id}',                        [CaixasController::class, 'caixas_mostrar'])                          ->name('pdv.caixas.mostrar')                    ->middleware('auth');
            Route::get('/caixas/criar',                               [CaixasController::class, 'caixas_adicionar'])                        ->name('pdv.caixas.adicionar')                  ->middleware('auth');
            Route::get('/caixas/pagar/{id}',                          [CaixasController::class, 'caixas_pagar'])                            ->name('pdv.caixas.pagar')                      ->middleware('auth');
            Route::post('/caixas/pago/{id}',                          [CaixasController::class, 'caixas_pago'])                             ->name('pdv.caixas.pago')                       ->middleware('auth');
            Route::post('/caixas/gravar',                             [CaixasController::class, 'caixas_gravar'])                           ->name('pdv.caixas.gravar')                     ->middleware('auth');
            Route::get('/caixas/editar/{id}',                         [CaixasController::class, 'caixas_editar'])                           ->name('pdv.caixas.editar')                     ->middleware('auth');
            Route::get('/caixas/editar/{id}',                         [CaixasController::class, 'caixas_editar'])                           ->name('pdv.caixas.editar2')                    ->middleware('auth');
            Route::put('/caixas/atualizar/{id}',                      [CaixasController::class, 'caixas_atualizar'])                        ->name('pdv.caixas.atualizar')                  ->middleware('auth');
            Route::delete('/caixas/excluir/{id}',                     [CaixasController::class, 'caixas_excluir'])                          ->name('pdv.caixas.excluir')                    ->middleware('auth');
            Route::post('/caixas/restaurar/{id}',                     [CaixasController::class, 'caixas_restaurar'])                        ->name('pdv.caixas.restaurar')                  ->middleware('auth');
            
    
            Route::get('/caixas/confirma/{id}',                       [CaixasController::class, 'confirm'])                                 ->name('pdv.caixas.confirmar')                  ->middleware('auth');
            Route::get('/caixas/close/{id}',                          [CaixasController::class, 'close'])                                   ->name('pdv.caixas.fechar')                     ->middleware('auth');
            Route::patch('/caixas/closed/{id}',                       [CaixasController::class, 'closed'])                                  ->name('pdv.caixas.fechado')                    ->middleware('auth');
            Route::get('/caixa/reopen/{id}',                          [CaixasController::class, 'reopen'])                                  ->name('pdv.caixas.reabrir')                     ->middleware('auth');
            Route::get('/caixa/imprimir/{id}',                        [CaixasController::class, 'caixas_imprimir'])                         ->name('pdv.caixas.imprimir')                    ->middleware('auth');
    
    
            Route::get('/vendas',                                     [VendasController::class, 'vendas'])                                  ->name('pdv.vendas')                            ->middleware('auth');
            Route::any('/vendas/tabelar',                             [VendasController::class, 'vendas_tabelar'])                          ->name('pdv.vendas.tabelar')                    ->middleware('auth');
            Route::get('/vendas/mostrar/{id}',                        [VendasController::class, 'vendas_mostrar'])                          ->name('pdv.vendas.mostrar')                    ->middleware('auth');
            Route::get('/vendas/criar',                               [VendasController::class, 'vendas_adicionar'])                        ->name('pdv.vendas.adicionar')                  ->middleware('auth');
            Route::get('/vendas/pagar/{id}',                          [VendasController::class, 'vendas_pagar'])                            ->name('pdv.vendas.pagar')                      ->middleware('auth');
            Route::post('/vendas/pago/{id}',                          [VendasController::class, 'vendas_pago'])                             ->name('pdv.vendas.pago')                       ->middleware('auth');
            Route::post('/vendas/gravar',                             [VendasController::class, 'vendas_gravar'])                           ->name('pdv.vendas.gravar')                     ->middleware('auth');
            Route::get('/vendas/editar/{id}',                         [VendasController::class, 'vendas_editar'])                           ->name('pdv.vendas.editar')                     ->middleware('auth');
            Route::get('/vendas/editar/{id}',                         [VendasController::class, 'vendas_editar'])                           ->name('pdv.vendas.editar2')                    ->middleware('auth');
            Route::put('/vendas/atualizar/{id}',                      [VendasController::class, 'vendas_atualizar'])                        ->name('pdv.vendas.atualizar')                  ->middleware('auth');
            Route::delete('/vendas/excluir/{id}',                     [VendasController::class, 'vendas_excluir'])                          ->name('pdv.vendas.excluir')                    ->middleware('auth');
            Route::post('/vendas/restaurar/{id}',                     [VendasController::class, 'vendas_restaurar'])                        ->name('pdv.vendas.restaurar')                  ->middleware('auth');
            Route::get('/vendas/imprimir/{id}',                       [VendasController::class, 'vendas_imprimir'])                         ->name('pdv.vendas.imprimir')                   ->middleware('auth');
            
            Route::any('/vendas/resumo',                              [VendasController::class, 'vendas_resumo'])                           ->name('pdv.vendas.resumo')                     ->middleware('auth');
            
            Route::get('/vendas/etapa_cliente',                       [VendasController::class, 'vendas_etapa_cliente'])                    ->name('pdv.vendas.etapa_cliente')              ->middleware('auth');
            Route::get('/vendas/etapa_servprod',                      [VendasController::class, 'vendas_etapa_servprod'])                   ->name('pdv.vendas.etapa_servprod')             ->middleware('auth');
            Route::get('/vendas/etapa_pagamento',                     [VendasController::class, 'vendas_etapa_pagamento'])                  ->name('pdv.vendas.etapa_pagamento')            ->middleware('auth');
    
            Route::get('/vendas/modal/{id}',                          [VendaController::class, 'modal'])                                    ->name('pdv.vendas.modal')                           ->middleware('auth');
            Route::get('/venda/produto/{id}',                         [VendaController::class, 'vendasPorProduto'])                         ->name('pdv.vendas.porproduto')                      ->middleware('auth');
            Route::any('/venda/faturamento_widget',                   [VendasController::class, 'vendas_faturamento_mes_widget'])           ->name('pdv.vendas.faturamento_mes_widget')          ->middleware('auth');
    
    
        });
    
        Route::group(['prefix' => '/atendimento'], function() {
            Route::get('/pessoas',                                   [PessoasController::class, 'pessoas'])                        ->name('atd.pessoas')                         ->middleware('auth');
            Route::get('/pessoas/tabelar',                           [PessoasController::class, 'pessoas_tabelar'])                ->name('atd.pessoas.tabelar')                 ->middleware('auth');
            Route::get('/pessoas/mostrar/{id}',                      [PessoasController::class, 'pessoas_mostrar'])                ->name('atd.pessoas.mostrar')                 ->middleware('auth');
            Route::get('/pessoas/adicionar',                         [PessoasController::class, 'pessoas_adicionar'])              ->name('atd.pessoas.adicionar')               ->middleware('auth');
            Route::post('/pessoas/gravar',                           [PessoasController::class, 'pessoas_gravar'])                 ->name('atd.pessoas.gravar')                  ->middleware('auth');
            Route::post('/pessoas/avatar',                           [PessoasController::class, 'pessoas_avatar'])                 ->name('atd.pessoas.avatar')                  ->middleware('auth');
            Route::post('/pessoas/avatar/remove',                    [PessoasController::class, 'pessoas_avatar_remove'])          ->name('atd.pessoas.avatar_remove')           ->middleware('auth');
            Route::any('/pessoas/validar/{id}',                      [PessoasController::class, 'pessoas_validar'])                ->name('atd.pessoas.validar')                 ->middleware('auth');
            Route::get('/pessoas/editar/{id}',                       [PessoasController::class, 'pessoas_editar'])                 ->name('atd.pessoas.editar')                  ->middleware('auth');
            Route::put('/pessoas/atualizar/{id}',                    [PessoasController::class, 'pessoas_atualizar'])              ->name('atd.pessoas.atualizar')               ->middleware('auth');
            Route::delete('/pessoas/excluir/{id}',                   [PessoasController::class, 'pessoas_excluir'])                ->name('atd.pessoas.excluir')                 ->middleware('auth');
            Route::post('/pessoas/restaurar/{id}',                   [PessoasController::class, 'pessoas_restaurar'])              ->name('atd.pessoas.restaurar')               ->middleware('auth');
            Route::get('/pessoas/procurar/{id}',                     [PessoasController::class, 'pessoas_procurar'])               ->name('atd.pessoas.procurar')                ->middleware('auth');
            Route::get('/pessoas/listar_compras',                    [PessoasController::class, 'pessoas_listar_fornecedores'])    ->name('atd.pessoas.listar_fornecedores')     ->middleware('auth');    // usado na parte de compras do fornecedores
    
            Route::post('/pessoas/funcoes/{id}',                     [PessoasController::class, 'pessoas_funcoes'])                ->name('atd.pessoas.funcoes')                   ->middleware('auth');
    
            Route::get('/pessoas/pesquisar',                         [PessoasController::class, 'pessoas_pesquisar'])              ->name('atd.pessoas.pesquisar')               ->middleware('auth');
            Route::get('/pessoas/{id}/alterar_senha',                [PessoasController::class, 'pessoas_equipe_alterar_senha'])   ->name('atd.equipe.alterar_senha')            ->middleware('auth Senha');
            Route::post('/pessoas/{id}/verificar_senha',             [PessoasController::class, 'pessoas_equipe_verificar_senha']) ->name('atd.equipe.verificar_senha')          ->middleware(['auth Senha']);
            Route::get('/pessoas/{id}/trocar_senha',                 [PessoasController::class, 'pessoas_equipe_trocar_senha'])    ->name('atd.equipe.trocar_senha')             ->middleware('auth Senha');
    
            Route::get('/pessoas/plucar',                             [PessoasController::class, 'pessoas_plucar'])                  ->name('atd.pessoas.plucar')                   ->middleware('auth');
            Route::get('/pessoas/sistema',                           [PessoasController::class, 'pessoas_sistema'])                ->name('atd.pessoas.sistema')                 ->middleware('auth');
            Route::get('/pessoas/agenda/parceiras',                  [PessoasController::class, 'pessoas_agenda_parceiras'])       ->name('atd.pessoas.parceiras')               ->middleware('auth');
            Route::get('/pessoas/agenda/ordem',                      [PessoasController::class, 'pessoas_agenda_ordem'])           ->name('atd.pessoas.agenda_ordem')            ->middleware('auth');
            Route::post('/pessoas/agenda/ordem/salvar',              [PessoasController::class, 'pessoas_agenda_ordem_salvar'])    ->name('atd.pessoas.agenda_ordem_salvar')     ->middleware('auth');
            Route::put('/pessoas/produto_comissao',                  [PessoasController::class, 'pessoas_produto_comissao'])       ->name('atd.pessoas.produto_comissao')        ->middleware('auth');
            Route::get('/pessoas/pesquisar_usuario/{username}',      [PessoasController::class, 'pessoas_usuario_verificar'])      ->name('atd.pessoas.pesquisar_usuario')       ->middleware('auth');
            Route::any('/pessoas/contar',                            [PessoasController::class, 'pessoas_contar'])                 ->name('atd.pessoas.contar')                  ->middleware('auth');
            Route::any('/pessoas/widget',                            [PessoasController::class, 'pessoas_widget'])                 ->name('atd.pessoas.widget')                  ->middleware('auth');
            
            Route::get('/pessoas/vendas/{id}',                       [PessoasController::class, 'pessoas_vendas'])                 ->name('atd.pessoas.vendas')                  ->middleware('auth');
            Route::get('/pessoas/agendamentos/{id}',                 [PessoasController::class, 'pessoas_agendamentos'])           ->name('atd.pessoas.agendamentos')            ->middleware('auth');
    
            Route::get('/pessoas/modal/{id}',                        [PessoasController::class, 'modal'])                          ->name('atd.pessoas.modal')                   ->middleware('auth');
    
            Route::get('/parceiros/plucar',                           [PessoasController::class, 'parceiros_plucar'])                ->name('atd.parceiros.plucar')                 ->middleware('auth');
            Route::get('/parceiros/servicos/{id_profexec}',      [PessoasController::class, 'parceiros_servicos'])             ->name('atd.parceiros.servicos')              ->middleware('auth');
    
            Route::get('/equipe',                                     [PessoasController::class, 'equipe'])                        ->name('atd.equipe')                         ->middleware('auth');
            Route::get('/equipe/tabelar',                             [PessoasController::class, 'equipe_tabelar'])                ->name('atd.equipe.tabelar')                 ->middleware('auth');
            Route::get('/equipe/mostrar/{id}',                        [PessoasController::class, 'equipe_mostrar'])                ->name('atd.equipe.mostrar')                 ->middleware('auth');
            Route::get('/equipe/adicionar',                           [PessoasController::class, 'equipe_adicionar'])              ->name('atd.equipe.adicionar')               ->middleware('auth');
            Route::post('/equipe/gravar',                             [PessoasController::class, 'equipe_gravar'])                 ->name('atd.equipe.gravar')                  ->middleware('auth');
            Route::delete('/equipe/excluir/{id}',                     [PessoasController::class, 'equipe_excluir'])                ->name('atd.equipe.excluir')                 ->middleware('auth');
            Route::post('/equipe/restaurar/{id}',                     [PessoasController::class, 'equipe_restaurar'])              ->name('atd.equipe.restaurar')               ->middleware('auth');
    
            Route::get('/clientes',                                   [PessoasController::class, 'clientes'])                      ->name('atd.clientes')                       ->middleware('auth');
            Route::get('/clientes/tabelar',                           [PessoasController::class, 'clientes_tabelar'])              ->name('atd.clientes.tabelar')               ->middleware('auth');
            Route::get('/clientes/mostrar/{id}',                      [PessoasController::class, 'clientes_mostrar'])              ->name('atd.clientes.mostrar')               ->middleware('auth');
            Route::get('/clientes/adicionar',                         [PessoasController::class, 'clientes_adicionar'])            ->name('atd.clientes.adicionar')             ->middleware('auth');
            Route::post('/clientes/gravar',                           [PessoasController::class, 'clientes_gravar'])               ->name('atd.clientes.gravar')                ->middleware('auth');
            Route::delete('/clientes/excluir/{id}',                   [PessoasController::class, 'clientes_excluir'])              ->name('atd.clientes.excluir')               ->middleware('auth');
    
    
            Route::get('/contatos',                                   [PessoasController::class, 'contatos'])                      ->name('atd.contatos')                       ->middleware('auth');
            Route::get('/contatos/tabelar',                           [PessoasController::class, 'contatos_tabelar'])              ->name('atd.contatos.tabelar')               ->middleware('auth');
            Route::get('/contatos/mostrar/{id}',                      [PessoasController::class, 'contatos_mostrar'])              ->name('atd.contatos.mostrar')               ->middleware('auth');
            Route::get('/contatos/adicionar',                         [PessoasController::class, 'contatos_adicionar'])            ->name('atd.contatos.adicionar')             ->middleware('auth');
            Route::post('/contatos/gravar',                           [PessoasController::class, 'contatos_gravar'])               ->name('atd.contatos.gravar')                ->middleware('auth');
            Route::delete('/contatos/excluir/{id}',                   [PessoasController::class, 'contatos_excluir'])              ->name('atd.contatos.excluir')               ->middleware('auth');
    
    
            Route::get('/tipos',                                      [PessoasController::class, 'tipos'])                         ->name('atd.tipos')                          ->middleware('auth');
            Route::get('/tipos/tabelar',                              [PessoasController::class, 'tipos_tabelar'])                 ->name('atd.tipos.tabelar')                  ->middleware('auth');
            Route::get('/tipos/mostrar/{id}',                         [PessoasController::class, 'tipos_mostrar'])                 ->name('atd.tipos.mostrar')                  ->middleware('auth');
            Route::get('/tipos/adicionar',                            [PessoasController::class, 'tipos_adicionar'])               ->name('atd.tipos.adicionar')                ->middleware('auth');
            Route::post('/tipos/gravar',                              [PessoasController::class, 'tipos_gravar'])                  ->name('atd.tipos.gravar')                   ->middleware('auth');
            Route::delete('/tipos/excluir/{id}',                      [PessoasController::class, 'tipos_excluir'])                 ->name('atd.tipos.excluir')                  ->middleware('auth');
    
    
            Route::get('/agendas',                                    [PessoasController::class, 'agendamentos'])                  ->name('atd.agendamentos')                  ->middleware('auth');
            Route::get('/agendas/planilhar',                          [PessoasController::class, 'agendamentos_planilhar'])        ->name('atd.agendamentos.planilhar')        ->middleware('auth');
            Route::get('/agendas/tabelar',                            [PessoasController::class, 'agendamentos_tabelar'])          ->name('atd.agendamentos.tabelar')          ->middleware('auth');
            Route::get('/agendas/tabelar2',                            [PessoasController::class, 'agendamentos_tabelar2'])        ->name('atd.agendamentos.tabelar2')          ->middleware('auth');
            Route::get('/agendas/mostrar/{id}',                       [PessoasController::class, 'agendamentos_mostrar'])          ->name('atd.agendamentos.mostrar')          ->middleware('auth');
            Route::get('/agendas/adicionar',                          [PessoasController::class, 'agendamentos_adicionar'])        ->name('atd.agendamentos.adicionar')        ->middleware('auth');
            Route::get('/agendas/adicionar_l',                        [PessoasController::class, 'agendamentos_adicionar_l'])      ->name('atd.agendamentos.adicionar_l')      ->middleware('auth');
            Route::post('/agendas/criar',                             [PessoasController::class, 'agendamentos_criar'])            ->name('atd.agendamentos.criar')            ->middleware('auth');
            Route::post('/agendas/gravar',                            [PessoasController::class, 'agendamentos_gravar'])           ->name('atd.agendamentos.gravar')           ->middleware('auth');
            Route::post('/agendas/gravar_lote',                       [PessoasController::class, 'agendamentos_gravar_lote'])      ->name('atd.agendamentos.gravar_lote')      ->middleware('auth');
            Route::post('/agendas/avatar',                            [PessoasController::class, 'agendamentos_avatar'])           ->name('atd.agendamentos.avatar')           ->middleware('auth');
            Route::post('/agendas/avatar/remove',                     [PessoasController::class, 'agendamentos_avatar_remove'])    ->name('atd.agendamentos.avatar_remove')    ->middleware('auth');
            Route::any('/agendas/validar/{id}',                       [PessoasController::class, 'agendamentos_validar'])          ->name('atd.agendamentos.validar')          ->middleware('auth');
            Route::get('/agendas/editar/{id}',                        [PessoasController::class, 'agendamentos_editar'])           ->name('atd.agendamentos.editar')           ->middleware('auth');
            Route::put('/agendas/atualizar/{id}',                     [PessoasController::class, 'agendamentos_atualizar'])        ->name('atd.agendamentos.atualizar')        ->middleware('auth');
            Route::delete('/agendas/excluir/{id}',                    [PessoasController::class, 'agendamentos_excluir'])          ->name('atd.agendamentos.excluir')          ->middleware('auth');
            Route::post('/agendas/restaurar/{id}',                    [PessoasController::class, 'agendamentos_restaurar'])        ->name('atd.agendamentos.restaurar')        ->middleware('auth');
    
            Route::get('/agendas/modal/{tipo}',                       [PessoasController::class, 'agendamentos_modal'])            ->name('atd.agendamentos.restaurar')        ->middleware('auth');
            Route::get('/agendas/fixas',                              [PessoasController::class, 'agendamentos_fixas'])            ->name('atd.agendamentos.fixas')            ->middleware('auth');
            Route::post('/agendas/fixas/deletar',                     [PessoasController::class, 'agendamentos_fixas_deletar'])    ->name('atd.agendamentos.fixas_deletar')    ->middleware('auth');
    
    
            Route::get('/agendas/carregar',                           [PessoasController::class, 'agendamentos_carregar'])         ->name('atd.agendamentos.carregar');
            Route::get('/agendamentos/meus',                          [PessoasController::class, 'agendamentos_meus'])             ->name('atd.agendamentos.meus');
            Route::get('/pessoas/agenda/minha',                       [PessoasController::class, 'pessoas_agenda_minha'])          ->name('atd.pessoas.agenda_minha')            ->middleware('auth');
            Route::put('/atualizar',                                  [AgendaController::class, 'agendas_update'])                  ->name('agenda.update');
            Route::get('/profissionalProduto/{id}',                   [PessoasController::class, 'profissionalProduto'])            ->name('agenda.profissionalProduto');
    
    
            Route::get('/agendamentos/widget',                        [AgendamentosController::class, 'agendamentos_widget'])       ->name('atd.agendamentos.widget')             ->middleware('auth');
            Route::any('/agendamentos/widget',                        [AgendamentosController::class, 'agendamentos_semana_widget'])->name('atd.agendamentos.semana_widget')      ->middleware('auth');
    
        });
    
    
        Route::group(['prefix' => '/sistema'], function()
        {
            Route::get('/usuarios',                                  [ACLController::class, 'usuarios'])                               ->name('acl.usuarios')                        ->middleware('auth');
            Route::any('/usuarios/tabelar',                          [ACLController::class, 'usuarios_tabelar'])                       ->name('acl.usuarios.tabelar')                ->middleware('auth');
            Route::get('/usuarios/mostrar/{id}',                     [ACLController::class, 'usuarios_mostrar'])                       ->name('acl.usuarios.mostrar')                ->middleware('auth');
            Route::get('/usuarios/adicionar',                        [ACLController::class, 'usuarios_adicionar'])                     ->name('acl.usuarios.adicionar')              ->middleware('auth');
            Route::post('/usuarios/gravar',                          [ACLController::class, 'usuarios_gravar'])                        ->name('acl.usuarios.gravar')                 ->middleware('auth');
            Route::get('/usuarios/editar/{id}',                      [ACLController::class, 'usuarios_editar'])                        ->name('acl.usuarios.editar')                 ->middleware('auth');
            Route::put('/usuarios/atualizar/{id}',                   [ACLController::class, 'usuarios_atualizar'])                     ->name('acl.usuarios.atualizar')              ->middleware('auth');
            Route::put('/usuarios/remover/{id}',                     [ACLController::class, 'usuarios_remover'])                       ->name('acl.usuarios.remover')                ->middleware('auth');
    
            Route::get('/permissoes',                                [ACLController::class, 'permissoes'])                             ->name('acl.permissoes')                      ->middleware('auth');
            Route::any('/permissoes/tabelar',                        [ACLController::class, 'permissoes_tabelar'])                     ->name('acl.permissoes.tabelar')              ->middleware('auth');
            Route::get('/permissoes/mostrar/{id}',                   [ACLController::class, 'permissoes_mostrar'])                     ->name('acl.permissoes.mostrar')              ->middleware('auth');
            Route::get('/permissoes/adicionar',                      [ACLController::class, 'permissoes_adicionar'])                   ->name('acl.permissoes.adicionar')            ->middleware('auth');
            Route::post('/permissoes/gravar',                        [ACLController::class, 'permissoes_gravar'])                      ->name('acl.permissoes.gravar')               ->middleware('auth');
            Route::get('/permissoes/editar/{id}',                    [ACLController::class, 'permissoes_editar'])                      ->name('acl.permissoes.editar')               ->middleware('auth');
            Route::put('/permissoes/atualizar/{id}',                 [ACLController::class, 'permissoes_atualizar'])                   ->name('acl.permissoes.atualizar')            ->middleware('auth');
    
            Route::get('/funcoes',                                   [ACLController::class, 'funcoes'])                                ->name('acl.funcoes')                         ->middleware('auth');
            Route::get('/funcoes/tabelar',                           [ACLController::class, 'funcoes_tabelar'])                        ->name('acl.funcoes.tabelar')                 ->middleware('auth');
            Route::get('/funcoes/mostrar/{id}',                      [ACLController::class, 'funcoes_mostrar'])                        ->name('acl.funcoes.mostrar')                 ->middleware('auth');
            Route::get('/funcoes/adicionar',                         [ACLController::class, 'funcoes_adicionar'])                      ->name('acl.funcoes.adicionar')               ->middleware('auth');
            Route::post('/funcoes/gravar',                           [ACLController::class, 'funcoes_gravar'])                         ->name('acl.funcoes.gravar')                  ->middleware('auth');
            Route::get('/funcoes/editar/{id}',                       [ACLController::class, 'funcoes_editar'])                         ->name('acl.funcoes.editar')                  ->middleware('auth');
            Route::put('/funcoes/atualizar/{id}',                    [ACLController::class, 'funcoes_atualizar'])                      ->name('acl.funcoes.atualizar')               ->middleware('auth');
            Route::delete('/funcoes/excluir/{id}',                   [ACLController::class, 'funcoes_excluir'])                        ->name('acl.funcoes.excluir')                 ->middleware('auth');
    
            Route::post('/funcoes/permissoes/{id}',                  [ACLController::class, 'funcoes_permissoes'])                     ->name('acl.funcoes.permissoes')              ->middleware('auth');
            Route::get('/funcoes/{id}/usuarios/tabelar',             [ACLController::class, 'funcoes_usuarios_tabelar'])               ->name('acl.funcoes.usuarios.tabelar')        ->middleware('auth');
            Route::post('/funcoes/usuarios/adicionar/{id}',          [ACLController::class, 'funcoes_usuarios_adicionar'])             ->name('acl.funcoes.usuarios.adicionar')      ->middleware('auth');
            Route::post('/funcoes/usuarios/remover/{id}',            [ACLController::class, 'funcoes_usuarios_remover'])               ->name('acl.funcoes.usuarios.remover')        ->middleware('auth');
    
    
    
    
    
            Route::post('/list_FormasDePagamentos',                  [SistemaController::class, 'list_FormasDePagamentos'])       ->name('sistema.list_FormasDePagamentos')     ->middleware('auth');
            Route::get('/load_FormasDePagamentos',                   [SistemaController::class, 'load_FormasDePagamentos'])       ->name('sistema.load_FormasDePagamentos')     ->middleware('auth');
            Route::post('/store_FormasDePagamentos',                 [SistemaController::class, 'store_FormasDePagamentos'])      ->name('sistema.store_FormasDePagamentos')    ->middleware('auth');
            Route::post('/delete_FormasDePagamentos/{id}',           [SistemaController::class, 'delete_FormasDePagamentos'])     ->name('sistema.delete_FormasDePagamentos')   ->middleware('auth');
    
        });
    

    });
    