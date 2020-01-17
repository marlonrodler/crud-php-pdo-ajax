<?php 
    include("header.php");
?>

    <form id="formSelect">
        <input type="text" id="nome" placeholder="nome" autofocus>
        <input type="text" id="idade" placeholder="idade">
        <input type="text" id="cpf" placeholder="cpf">
        <input type="text" id="sexo" placeholder="sexo">
        <input type="text" id="cidade" placeholder="cidade">
        <input type="text" id="estado" placeholder="estado">
        <input type="submit" id="enviar">
    </form>

    <p id="resultado"></p>

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

<?php
    include("footer.php");
?>

<script>
$.ajax({
    url: "cliente/search.php",
    type: 'post',
    data: {
        search_term: ""
    },
    beforeSend: function () {
        $("#resultado").html("ENVIANDO...");
    }
})
.done(function (data) {
    data = JSON.parse(data);
    if(data.status == "success"){
        var html = "";
        for(var i = 0; i<data.clientes.length; i++){
            var cliente = data.clientes[i];
            html+="<tr><td><a href='self.php?id="+cliente.id+"'>"+cliente.nome+"</td><td>"
                            +cliente.idade+"</td><td>"
                            +cliente.cpf+"</td><td>"
                            +cliente.sexo+"</td><td>"
                            +cliente.cidade+"</td><td>"
                            +cliente.estado+"</td><td>"
                            +"<button onclick='deleteClient("+cliente.id+");'>Deletar</button></td></tr>"
        }
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

    
