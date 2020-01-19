<?php 
    include("header.php");
?>

    <div class="container">
        
        <div class="row justify-content-center my-4 col-12">
            <h3>Pesquisar Cliente</h3>
        </div>
        
            <div id="formSelect" class="row justify-content-center col-12">

                    <div id="defaultSearch">

                        <div class="form-group">

                            <input type="text" id="termo" placeholder="Buscar" class="form-control" required autofocus>
                            <a href="search.php" class="float-right">Refresh</a>

                        </div>

                    </div>

                    <div id="advancedSearch" style="display: none">

                        <div class="form-row">

                            <div class="form-group col-sm-6">
                                <input type="text" id="nome" placeholder="nome" class="form-control" autofocus required>
                            </div>

                            <div class="form-group col-sm-2">
                                <input type="text" id="idade" placeholder="idade" class="form-control" required>
                            </div>

                            <div class="form-group col-sm-4">
                                <input type="text" id="cpf" placeholder="cpf" class="form-control" required>
                            </div>

                        </div>

                    
                        <div class="form-row">

                            <div class="form-group col-sm-2">
                                <input type="text" id="sexo" placeholder="sexo" class="form-control" required>
                            </div>

                            <div class="form-group col-sm-6">
                                <input type="text" id="cidade" placeholder="cidade" class="form-control" required>
                            </div>

                            <div class="form-group col-sm-4">
                                <input type="text" id="estado" placeholder="estado" class="form-control" required>
                            </div>

                        </div>
                        <a href="search.php" class="float-right">Refresh</a>


                    </div>

                    

                    <div class="form-row mt-3 justify-content-center col-12">

                        <div class="form-group">

                                <a href="" class="my-4 col-12" onclick="openFilter(this,event);">Filtro Avançado</a>
                                
                        </div>

                        <div class="form-group mr-3">

                            <input type="submit" class="btn btn-primary ml-1" id="btnId" value="Buscar">

                        </div>
                            
                        <div class="form-group">

                            <input type="submit" id="enviar" class="btn btn-secondary" value="Voltar" onclick="voltarPg();">
                            
                        </div>
                            
                    </div>

            </div>

    </div>

    <div class="container mt-5">
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
                            +"<a class='btn btn-warning' href='update.php?id="+cliente.id+"'>Alterar</td><td>"
                            +"<button class='btn btn-danger' onclick='deleteClient("+cliente.id+");'>Deletar</button></td></tr>"
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

    
