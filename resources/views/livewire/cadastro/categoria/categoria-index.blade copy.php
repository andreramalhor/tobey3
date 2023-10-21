<div>
    <div class="container mt-5">
        <div class="row mb-5">
            <div class="col-md-12 text-center">
                <h3><strong>Cadastro</strong></h3>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 style="float: left;"><strong>Categorias</strong></h5>
                        <button class="btn btn-sm btn-primary" style="float: right;" data-bs-toggle="modal" data-bs-target="#addStudentModal">Nova categoria</button>
                    </div>
                    <div class="card-body">
                        @if (session()->has('success'))
                            <div class="alert alert-success text-center">{{ session('success') }}</div>
                        @endif

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Tipo</th>
                                    <th>Nome</th>
                                    <th>Descrição</th>
                                    <th style="text-align: center;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($categorias->count() > 0)
                                    @foreach ($categorias as $categoria)
                                        <tr>
                                            <td>{{ $categoria->id }}</td>
                                            <td>{{ $categoria->tipo }}</td>
                                            <td>{{ $categoria->nome }}</td>
                                            <td>{{ $categoria->descricao }}</td>
                                            <td style="text-align: center;">
                                                @livewire('cadastro.categoria.categoria-edit', ['categoria' => $categoria], key($categoria->id))
                                                <button class="btn btn-sm btn-secondary" wire:click="viewStudentDetails({{ $categoria->id }})">View</button>
                                                <button class="btn btn-sm btn-primary" wire:click="editStudents({{ $categoria->id }})">Edit</button>
                                                <button class="btn btn-sm btn-danger" wire:click="deleteConfirmation({{ $categoria->id }})">Delete</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="4" style="text-align: center;"><small>No Student Found</small></td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @livewire('cadastro.categoria.categoriaStore')
    </div>
</div>

@push('js')
    <script>
        window.addEventListener('close-modal', event =>{
            $('#addStudentModal').modal('hide');
            $('#editStudentModal').modal('hide');
            $('#deleteStudentModal').modal('hide');
        });

        window.addEventListener('show-edit-categoria-modal', event =>{
            $('#editStudentModal').modal('show');
        });

        window.addEventListener('show-delete-confirmation-modal', event =>{
            $('#deleteStudentModal').modal('show');
        });

        window.addEventListener('show-view-categoria-modal', event =>{
            $('#viewStudentModal').modal('show');
        });
    </script>
@endpush
