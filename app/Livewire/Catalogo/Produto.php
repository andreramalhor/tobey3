<?php

namespace App\Livewire\Catalogo;

use Livewire\Attributes\Rule;
use App\Models\Catalogo\Produto as DBProduto;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Intervention\Image\Facades\Image;

class Produto extends Component
{
    use WithFileUploads;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $pesquisar = '';

    #[Rule('required|min:3')]
    public $nome;
    public $apelido;
    public $dt_nascimento;
    public $email;
    public $sexo;
    public $cpf;
    public $instagram;
    public $observacao;
    public $ddd;
    public $telefone;
    public $cep;
    public $logradouro;
    public $numero;
    public $bairro;
    public $cidade;
    public $uf = 'MG';

    #[Rule('image|nullable')]
    public $foto;

    public $produto = [];
    public $modalType;
    public $produtoId;

    protected $listeners = ['chamarMetodo' => 'remove'];

    public function create()
    {
        $this->reset();
        $this->openModal('store');
    }

    public function openModal($type)
    {
        $this->modalType = $type;
        $this->resetValidation();
    }

    public function closeModal()
    {
        $this->modalType = '';
    }

    public function store()
    {
        $this->validate();

        $produto = DBProduto::create([
            'apelido'       => $this->nome,
            'nome'          => $this->nome,
            'dt_nascimento' => $this->dt_nascimento,
            'email'         => $this->email,
            'sexo'          => $this->sexo,
            'cpf'           => $this->cpf,
            'instagram'     => $this->instagram,
            'observacao'    => $this->observacao,
            'id_criador'    => auth()->user()->id,
            'ddd'           => $this->ddd,
            'telefone'      => $this->telefone,
            'cep'           => $this->cep,
            'logradouro'    => $this->logradouro,
            'numero'        => $this->numero,
            'bairro'        => $this->bairro,
            'cidade'        => $this->cidade,
            'uf'            => $this->uf,
        ]);

        if($this->foto)
        {
            $nomearquivo = $produto->id.'.png';

            $img = Image::make($this->foto);
            $img->resize(320, 320);
            $img->save('stg/img/prod/' . $nomearquivo);
        }

        $this->dispatch('swal:alert', [
            'title'     => 'Criado!',
            'text'      => 'Produto cadastrada com sucesso!',
            'icon'      => 'success',
            'iconColor' => 'green',
        ]);

        $this->resetExcept('produtoId');
        $this->closeModal();
    }

    public function show($id)
    {
        $this->produto = DBProduto::findOrFail($id);

        $this->openModal('show');
    }

    public function edit($id)
    {
        $produto = DBProduto::findOrFail($id);
        $this->produtoId      = $id;
        $this->apelido       = $produto->nome;
        $this->nome          = $produto->nome;
        $this->dt_nascimento = $produto->dt_nascimento;
        $this->email         = $produto->email;
        $this->sexo          = $produto->sexo;
        $this->cpf           = $produto->cpf;
        $this->instagram     = $produto->instagram;
        $this->observacao    = $produto->observacao;
        $this->ddd           = $produto->ddd;
        $this->telefone      = $produto->telefone;
        $this->cep           = $produto->cep;
        $this->logradouro    = $produto->logradouro;
        $this->numero        = $produto->numero;
        $this->bairro        = $produto->bairro;
        $this->cidade        = $produto->cidade;
        $this->uf            = $produto->uf;
        $this->foto          = $produto->srcFoto;
        $this->openModal('store');
    }

    public function update()
    {
        if ($this->produtoId)
        {
            $produto = DBProduto::findOrFail($this->produtoId);
            $produto->update([
                'apelido'       => $this->nome,
                'nome'          => $this->nome,
                'dt_nascimento' => $this->dt_nascimento,
                'email'         => $this->email,
                'sexo'          => $this->sexo,
                'cpf'           => $this->cpf,
                'instagram'     => $this->instagram,
                'observacao'    => $this->observacao,
                'id_criador'    => auth()->user()->id,
                'ddd'           => $this->ddd,
                'telefone'      => $this->telefone,
                'cep'           => $this->cep,
                'logradouro'    => $this->logradouro,
                'numero'        => $this->numero,
                'bairro'        => $this->bairro,
                'cidade'        => $this->cidade,
                'uf'            => $this->uf,
            ]);

            if($this->foto)
            {
                $nomearquivo = $produto->id.'.png';

                $img = Image::make($this->foto);
                $img->resize(320, 320);
                $img->save('stg/img/prod/' . $nomearquivo);
            }

            $this->dispatch('swal:alert', [
                'title'     => 'Atualizado!',
                'text'      => 'Produto atualizada com sucesso!',
                'icon'      => 'success',
                'iconColor' => 'green',
            ]);

            $this->closeModal();
            $this->reset();
        }
    }

    public function delete($id)
    {
        $produto = DBProduto::find($id);

        $this->dispatch('swal:confirm', [
            'title'        => $produto->nome,
            'text'         => 'Tem certeza que quer deletar a produto?',
            'icon'         => 'warning',
            'iconColor'    => 'orange',
            'idEvent'      => $produto->id,
        ]);
    }

    public function remove($id)
    {
        $produto = DBProduto::find($id);

        $filePath = public_path("stg/img/prod/{$produto->id}.png");
        if (file_exists($filePath))
        {
            unlink($filePath);
            $texto = 'Produto e foto deletada com sucesso!';
        }

        $produto->delete();

        $this->dispatch('swal:alert', [
            'title'         => 'Deletado!',
            'text'          => $texto ?? 'Produto deletada com sucesso!',
            'icon'          => 'success',
            'iconColor'     => 'green',
        ]);

        $this->resetExcept('produtoId');
    }

    public function listar()
    {
        $produtos = DBProduto::
                            procurar($this->pesquisar)->
                            paginate(10);

        return $produtos;
    }

    public function render()
    {
        $produtos = $this->listar();

        return view('livewire/catalogo/produto/index', [
            'produtos' => $produtos,
        ])->layout('layouts/app');
    }
}
