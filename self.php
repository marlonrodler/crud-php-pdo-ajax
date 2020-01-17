<?php 
    include("header.php");
?>

    <table id="table_id">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Idade</th>
                <th>CPF</th>
                <th>Sexo</th>
                <th>Cidade</th>
                <th>Estado</th>
                <th>Deletar</th>
            </tr>
        </thead>
        <tbody id="tbody_id">

        </tbody>
    </table>

    <p id="resultado"></p>

    
<?php
    include("footer.php");
?>

<script> 
    var id = "<?php print $_GET["id"]; ?>";
    $.ajax({
        url: "cliente/self.php",
        type: 'post',
        data: {
            id: id
        },
        beforeSend: function () {
            $("#resultado").html("ENVIANDO...");
        }
    })
    .done(function (data) {
        data = JSON.parse(data);
        if(data.status == "success"){
            var html = "";
            var cliente = data.cliente;
            html+="<tr><td><a href='self.php?id="+cliente.id+"'>"+cliente.nome+"</td><td>"
                                +cliente.idade+"</td><td>"
                                +cliente.cpf+"</td><td>"
                                +cliente.sexo+"</td><td>"
                                +cliente.cidade+"</td><td>"
                                +cliente.estado+"</td></tr>"
            $("#resultado").html("");
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
    
