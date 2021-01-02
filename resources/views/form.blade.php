@extends('layout')

@section('title', 'Cadastro de Cliente')

@section('top')

@endsection

@section('content')
<div class="col-12 m-2 p-0">
    <a href="<?= url('/'); ?>">Voltar</a>
</div>
<form class="row" method="post" action="{{ route('cliente.store') }}">
@csrf
<div class="card">
    <div class="card-header">
        <div class="row">
        <div class="col-6">
            <h5>Cadastro de cliente</h5>
        </div>
        <div class="col-6 text-right">
            <button type="submit" class="btn btn-primary text-right">Salvar</button>
        </div>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <input type="hidden" class="form-control" id="id" name="id" value="{{ @$cliente->id ? $cliente->id : old('id') }}">
            <div class="col-md-12">
                <label for="nome" class="form-label">Nome *</label>
                <input type="text" class="form-control @error('nome') is-invalid @enderror" id="nome" name="nome" value="{{ @$cliente->nome ? $cliente->nome : old('nome') }}">
            </div>
            <div class="col-md-12 mt-2">
                <label for="dataNascimento" class="form-label">Data de nascimento *</label>
                <input type="text" class="form-control @error('dataNascimento') is-invalid @enderror" id="dataNascimento" name="dataNascimento" value="{{ @$cliente->data_nascimento ? $cliente->data_nascimento : old('dataNascimento') }}" data-mask="00/00/0000">
            </div>
            <div class="col-md-12 mt-2">
                <label for="sexo" class="form-label">Sexo *</label>
                <select class="form-control @error('sexo') is-invalid @enderror" id="sexo" name="sexo" value="{{ @$cliente->sexo ? $cliente->sexo : old('sexo') }}">
                    <option value="">-- Selecione --</option>
                    <option value="M">Masculino</option>
                    <option value="F">Feminino</option>
                </select>
            </div>

            <div class="card col-11 p-0 m-4">
                <h6 class="card-header">Dados de endereço</h6>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-3">
                            <input type="text" class="form-control" id="inputBuscaCep" placeholder="Digite o número do cep">
                        </div>
                        <div class="col-sm-7">
                            <button class="btn btn-primary btn-buscacep" onClick="buscaCep()">Buscar CEP</button>
                        </div>
                    </div>
                    <div class="col-md-12 mt-4">
                        <label for="cep" class="form-label">CEP</label>
                        <input type="text" class="form-control" id="cep" name="cep" value="{{ @$cliente->cep ? $cliente->cep : old('cep') }}">
                    </div>
                    <div class="col-md-12 mt-2">
                        <label for="endereco" class="form-label">Endereço</label>
                        <input type="text" class="form-control" id="endereco" name="endereco" value="{{ @$cliente->endereco ? $cliente->endereco : old('endereco') }}">
                    </div>
                    <div class="col-md-12 mt-2">
                        <label for="numero" class="form-label">Número</label>
                        <input type="text" class="form-control" id="numero" name="numero" value="{{ @$cliente->numero ? $cliente->numero : old('numero') }}">
                    </div>
                    <div class="col-md-12 mt-2">
                        <label for="complemento" class="form-label">Complemento</label>
                        <input type="text" class="form-control" id="complemento" name="complemento" value="{{ @$cliente->complemento ? $cliente->complemento : old('complemento') }}">
                    </div>
                    <div class="col-md-12 mt-2">
                        <label for="bairro" class="form-label">Bairro</label>
                        <input type="text" class="form-control" id="bairro" name="bairro" value="{{ @$cliente->bairro ? $cliente->bairro : old('bairro') }}">
                    </div>
                    <div class="col-md-12 mt-2">
                        <label for="estado" class="form-label">Estado</label>
                        <input type="text" class="form-control" id="estado" name="estado" value="{{ @$cliente->estado ? $cliente->estado : old('estado') }}">
                    </div>
                    <div class="col-md-12 mt-2">
                        <label for="cidade" class="form-label">Cidade</label>
                        <input type="text" class="form-control" id="cidade" name="cidade" value="{{ @$cliente->cidade ? $cliente->cidade : old('cidade') }}">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</form>
@endsection

<script>
    function buscaCep() {
        event.preventDefault();

        let cep = $("#inputBuscaCep").val();

        if (cep == '') {
            alert("Digite o número do CEP!");
            return false;
        }
            
        $(".btn-buscacep").attr("disabled", true).text("Aguarde...");

        $.ajax({
            type:'get',
            url: 'http://viacep.com.br/ws/'+cep+'/json/',
            data: {},
            dataType: 'jsonp',
            crossDomain: true,
            contentType: "application/json",
            success: function(data) {
                if (data.cep == ''){
                    alert("CEP não localizado.")
                    return false;   
                }

                $("#inputBuscaCep").val('');
                $(".btn-buscacep").attr("disabled", false).text("Buscar CEP");
                $("#cep").val(data.cep);
                $("#numero").focus();
                $("#endereco").val(data.logradouro);
                $("#complemento").val(data.complemento);
                $("#bairro").val(data.bairro);
                $("#estado").val(data.uf);
                $("#cidade").val(data.localidade);
            },
            error: function(){
                $(".btn-buscacep").attr("disabled", false).text("Buscar CEP");
                $("#inputBuscaCep").val('');
                alert("CEP não localizado.");
                
                return false;
            }
        });
    }
</script>