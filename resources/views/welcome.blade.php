<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script>

    <script>

        function setup() {
            $('#address_informations *').attr('disabled', 'disabled');
            $("#cep").mask("00000-000");

        }

        function ajaxsearch_cep() {
            var cep = document.getElementById('cep').value;
            if (cep.length != 9) {
                alert('CEP Inválido!');
                return;
            }
            $.ajax({
                'processing': true,
                'serverSide': false,
                type: 'GET',
                data: {
                    cep: cep
                },
                url: '/query_cep',
                success: function (data) {
                    switch(data['code']){
                        case 0:
                            data = JSON.parse(data['response']);

                            document.getElementById('logradouro').value = data['logradouro'];
                            document.getElementById('complemento').value = data['complemento'];
                            document.getElementById('bairro').value = data['bairro'];
                            document.getElementById('localidade').value = data['localidade'];
                            document.getElementById('uf').value = data['uf'];
                            document.getElementById('unidade').value = data['unidade'];
                            document.getElementById('ibge').value = data['ibge'];
                            document.getElementById('gia').value = data['gia'];

                            break;
                        case 1:
                            alert('CEP não encontrado.');
                            break;
                        case 2:
                            alert('Requisicao mal formatada.');
                            break;
                        default:
                            alert('Erro desconhecido.');
                    }
                }
            });
        }
    </script>

</head>
<body onload="setup()">
    <div class="jumbotron text-center">
        <h1>Brazilian CEP API Example</h1>
        <p>Using Laravel and PHP.</p>
    </div>
    <div class="content">
        <form>
            <div class="text-center">
                <label class="m-md-1" for="cep">CEP: </label>
                <input class="m-md-4" type="text" id="cep" name="cep" pattern="[0-9]{5}-[0-9]{3}" >
                <input class="button" type="button" value="search" onclick="ajaxsearch_cep()">
            </div>

            <hr>
            <div class="form-row" id="address_informations">
                <div class="form-group col-md-6">
                    <label for="logradouro">Logradouro</label>
                    <input type="text" class="form-control" id="logradouro" placeholder="Logradouro">
                </div>
                <div class="form-group col-md-2">
                    <label for="bairro">Bairro</label>
                    <input type="text" class="form-control" id="bairro" placeholder="Bairro">
                </div>
                <div class="form-group col-md-2">
                    <label for="localidade" >Localidade</label>
                    <input type="text" class="form-control" id="localidade" placeholder="Localidade">
                </div>
                <div class="form-group col-md-2">
                    <label for="uf ">UF</label>
                    <input type="text" class="form-control" id="uf" placeholder="UF">
                </div>
                <div class="form-group col-md-2">
                    <label for="ibge ">IBGE</label>
                    <input type="text" class="form-control" id="ibge" placeholder="IBGE">
                </div>
                <div class="form-group col-md-6">
                    <label for="complemento ">Complemento</label>
                    <input type="text" class="form-control" id="complemento" placeholder="complemento">
                </div>
                <div class="form-group col-md-2">
                    <label for="gia ">GIA</label>
                    <input type="text" class="form-control" id="gia" placeholder="GIA">
                </div>
                <div class="form-group col-md-2">
                    <label for="unidade ">Unidade</label>
                    <input type="text" class="form-control" id="unidade" placeholder="Unidade">
                </div>
            </div>
        </form>
    </div>
</body>
</html>
