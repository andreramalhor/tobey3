<div>
    <section class="content pt-3">
        <div class="container-fluid">
            <!-- include('livewire.comercial.lead.adicionar') -->
            <!-- include('livewire.comercial.lead.atender') -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Leads</h3>
                    <div class="card-tools" style="display: inline-flex;">
                        <input type="text" name="pesquisa" wire:model.live="pesquisa" class="form-control form-control-sm" placeholder="Pesquisar"> &nbsp;
                        <button type="button" class="btn btn-sm btn-default" data-bs-toggle="modal" data-bs-target="#modal-adicionar"><i class="fas fa-plus"></i></button> &nbsp;
                        <button type="button" class="btn btn-sm btn-default" data-bs-toggle="modal" data-bs-target="#modal-criar-atender-lead"><i class="fas fa-plus"></i></button> &nbsp;
                        <button type="button" class="btn btn-sm btn-default" data-bs-toggle="modal" data-bs-target="#modal-atender"><i class="fas fa-minus  "></i></button>
                        <button type="button" class="btn btn-sm btn-default" data-bs-toggle="modal" data-bs-target="#modal-cadastrar-novo-lead"><i class="fas fa-minus  "></i></button>
                    </div>
                </div>
                <div class="card-body p-0">
                    @if( \Auth::User()->kjahdkwkbewtoip->contains('nome', 'Sócio') )
                    <div class="col-4">
                        <div class="form-group">
                            <label>File input</label>
                            <form wire:submit.prevent="submit" method="post" enctype="multipart/form-data">
                                <div class="input-group">
                                    @csrf
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input @error('file') is-invalid @enderror" wire:model="file">
                                        <label class="custom-file-label">Selecione o arquivo</label>
                                    </div>
                                    <div class="input-group-append">
                                        <button type="submit" class="input-group-text" wire:target="submit">Enviar</button>
                                    </div>
                                    @error('file') {{ $message }}@enderror
                                </div>
                            </form>
                        </div>
                    </div>
                    @endif

                    @if(session()->has('message'))
                        <div class="alert alert-success text-center">{{ session('message') }}</div>
                    @endif

                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="p-4">#</th>
                                    <th scope="col" class="px-4 py-3">Nome</th>
                                    <th scope="col" class="px-4 py-3">Telefone</th>
                                    <th scope="col" class="px-4 py-3">Última Conversa</th>
                                    <th scope="col" class="px-4 py-3">Dt Última Conversa</th>
                                    <th scope="col" class="px-4 py-3"><i class="fas fa-ellipsis-h"></i></th>
                                </tr>
                            </thead>
                            <tbody>
                            @forelse($leads as $lead)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <td class="w-3 p-2 text-center">{{ $lead->id }}</td>
                                    <th scope="row" class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $lead->nome }}</th>
                                    <td class="px-4 py-2">{{ $lead->telefone }}</td>
                                    <td class="px-4 py-2">{{ $lead->ultimo_atendimento->conversa ?? '' }}</td>
                                    <td class="px-4 py-2">{{ isset($lead->ultimo_atendimento->created_at) ? \Carbon\Carbon::parse($lead->ultimo_atendimento->created_at)->format('d/m/Y H:i') : '' }}
                                    <td class="px-4 py-2">
                                        <a href="" wire:click.prevent="atender({{ $lead->id }})" data-bs-toggle="modal" data-bs-target="#modal-atender-lead" class="badge bg-success">Atender</a>
                                        {{-- <a href="" wire:click.prevent="editar({{ $lead->id }})" class="badge bg-warning">Editar</a> --}}
                                        {{-- <a href="" wire:click.prevent="excluir({{ $lead->id }})" class="badge bg-danger">Excluir</a> --}}
                                    </td>
                                </tr>
                            @empty
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <th scope="row" colspan="6" class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white text-center">Não há resultados para essa pesquisa.</th>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                        <nav aria-label="Page navigation example" class="m-3">
                            {{ $leads->links() }}
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        @livewire('comercial.lead.criarAtender')
    </div>
</section>
