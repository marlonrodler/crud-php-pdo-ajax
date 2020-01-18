<?php 
    include("header.php");
?>

<div class="container">

    <div class="row justify-content-center my-4 col-12">
        <h3>Alterar Cliente</h3>
    </div>

    <form id="formUpdate">

        <div class="form-row">

            <div class="form-group col-sm-6">
                <label for="nome">Seu nome</label>
                <input type="text" id="nome" placeholder="nome" class="form-control" autofocus required>
            </div>

            <div class="form-group col-sm-2">
                <label for="idade">Sua idade</label>
                <input type="text" id="idade" placeholder="idade" class="form-control" required>
            </div>

            <div class="form-group col-sm-4">
                <label for="cpf">Seu CPF</label>
                <input type="text" id="cpf" placeholder="cpf" class="form-control" required>
            </div>

            </div>


            <div class="form-row">

            <div class="form-group col-2">
                <label for="sexo">Seu Sexo</label>
                <input type="text" id="sexo" placeholder="sexo" class="form-control" required>
            </div>

            <div class="form-group col-6">
                <label for="cidade">Sua cidade</label>
                <input type="text" id="cidade" placeholder="cidade" class="form-control" required>
            </div>

            <div class="form-group col-4">
                <label for="estado">Seu estado</label>
                <input type="text" id="estado" placeholder="estado" class="form-control" required>
            </div>

            </div>

            <div class="form-row ml-0 mt-3">

            <div class="form-group mr-3">
                <input type="submit" id="enviar" class="btn btn-primary">
            </div>

            <div class="form-group">
                <a class="btn btn-secondary text-white" onclick="voltarSearch();">Voltar</a>
            </div>

        </div>

    </form>

</div>

<div class="container">

    <div class="row justify-content-center my-4 col-12">
        <p id="resultado"></p>
    </div>
    
</div>

<?php
    include("footer.php");
?>

<script> 
    var updateId = "<?php print $_GET["id"]; ?>";
    $.ajax({
        url: "cliente/self.php",
        type: 'post',
        data: {
            id: updateId //1º key php, 2º valor a passar
        },
        beforeSend: function () {
            $("#resultado").html("ENVIANDO...");
        }
    })
    .done(function (data) {
        data = JSON.parse(data);
        if(data.status == "success"){
            var cliente = data.cliente;
            $("#nome").val(cliente.nome);
            $("#idade").val(cliente.idade);
            $("#cpf").val(cliente.cpf);
            $("#sexo").val(cliente.sexo);
            $("#cidade").val(cliente.cidade);
            $("#estado").val(cliente.estado);
            $("#resultado").html("");
        }else{
            $("#resultado").html("");
            alert(data.msg);
        }
    })
    .fail(function (jqXHR, textStatus, msg) {
        alert(msg);
    });


    
    
</script>
    
