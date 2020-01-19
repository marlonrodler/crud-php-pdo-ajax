<?php 
    include("header.php");
?>

<div class="container">
    <div class='row justify-content-center my-5' id="nomeCliente"></div>
    <table id="table_id" class="table">
        <thead>
            <tr>
                <th scope="col">Nome</th>
                <th scope="col">Idade</th>
                <th scope="col">CPF</th>
                <th scope="col">Sexo</th>
                <th scope="col">Cidade</th>
                <th scope="col">Estado</th>
                <th scope="col">Alterar</th>
                <th scope="col">Deletar</th>
            </tr>
        </thead>
        <tbody id="tbody_id">

        </tbody>
    </table>

    <p id="resultado"></p>
</div>
    
<?php
    include("footer.php");
?>

<script> 
    var selfId = "<?php print $_GET["id"]; ?>";
    $.ajax({
        url: "cliente/self.php",
        type: 'post',
        data: {
            id: selfId
        },
        beforeSend: function () {
            $("#resultado").html("ENVIANDO...");
        }
    })
    .done(function (data) {
        data = JSON.parse(data);
        if(data.status == "success"){
            var html = "";
            var divH3 ="";
            var cliente = data.cliente;
            divH3+="<h3>"+cliente.nome+"</h3>"
            html+="<tr><td>"+cliente.nome+"</td><td>"
                                +cliente.idade+"</td><td>"
                                +cliente.cpf+"</td><td>"
                                +cliente.sexo+"</td><td>"
                                +cliente.cidade+"</td><td>"
                                +cliente.estado+"</td><td>"
                                +"<a class='btn btn-warning' href='update.php?id="+cliente.id+"'>Alterar</td><td>"
                                +"<button class='btn btn-danger' onclick='deleteClient("+cliente.id+");'>Deletar</button></td><td>"
                                + "<a class='btn btn-secondary text-white' href='search.php'>Voltar</a></td></tr>"
            $("#resultado").html("");
            $("#nomeCliente").html(divH3);
            $("#tbody_id").html(html);
        }else{
            $("#resultado").html("");
            alert(data.msg);
        }
    })
    .fail(function (jqXHR, textStatus, msg) {
        alert(msg);
    });
</script>
    
