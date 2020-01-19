$("#formId").submit(function (e) {

    e.preventDefault();

    var nome = $("#nome").val();
    var idade = $("#idade").val();
    var cpf = $("#cpf").val();
    var sexo = $("#sexo").val();
    var cidade = $("#cidade").val();
    var estado = $("#estado").val();

    $.ajax({
        url: "cliente/add.php",
        type: 'post',
        data: {
            nome: nome,
            idade: idade,
            cpf: cpf,
            sexo: sexo,
            cidade: cidade,
            estado: estado
        },
        beforeSend: function () {
            $("#resultado").html("ENVIANDO...");
        }
    })
    .done(function (data) {
        data = JSON.parse(data);
        if(data.status == "success"){
            $("#resultado").html(data.msg);
            $("#nome").val("");
            $("#idade").val("");
            $("#cpf").val("");
            $("#sexo").val("");
            $("#cidade").val("");
            $("#estado").val("");  
            $("#nome").focus();      
        }else{
            $("#resultado").html("");
            alert(data.msg);
        }
    })
    .fail(function (jqXHR, textStatus, msg) {
        alert(msg);
    });

})


//jQuery onde pega o id do btn do search.php sem precisar se do formulário

$("#btnId").click(function (e) {

    //faz com que a página n atualize
    e.preventDefault();

    //estou pegando os valores do html e passando para uma variável
    var termo = $("#termo").val();
    var nome = $("#nome").val();
    var idade = $("#idade").val();
    var cpf = $("#cpf").val();
    var sexo = $("#sexo").val();
    var cidade = $("#cidade").val();
    var estado = $("#estado").val();

    $.ajax({
        //URL para o qual vou enviar a solicitação
        url: "cliente/search.php",
        //O tipo de solicitação que estou fazendo POST ou GET
        type: 'post',
        // Os dados a serem enviados para o servidor, que no caso é o cliente/search.php
        data: {
            // o primeiro é a definição da variável que tenho no servidor e o
            //segundo é a variável que quero mandar para o mesmo
            search_term: termo,
            search_name: nome,
            search_age: idade,
            search_cpf: cpf,
            search_gender: sexo,
            search_city: cidade,
            search_state: estado
        },
        //uma funçao onde ela vai mostrar antes de enviar de realizar o serviço
        beforeSend: function () {
            $("#resultado").html("BUSCANDO...");
        }
    })
    //função de quando enviar para o servidor
    .done(function (data) {
        //transforma a variável(string) data em um JSON
        data = JSON.parse(data);
        //if comparando se for sucesso para realizar tais comandos
        if(data.status == "success"){
            //variável vazia
            var html = "";
            //for para percorres todo os clientes cadastrados e buscados pelo serviço
            for(var i = 0; i<data.clientes.length; i++){
                //variável que recebe o data.clientes
                var cliente = data.clientes[i];
                //concatenando o que a variável html irá valer para a pagina html
                html+="<tr><td><a href='self.php?id="+cliente.id+"'>"+cliente.nome+"</td><td>"
                                +cliente.idade+"</td><td>"
                                +cliente.cpf+"</td><td>"
                                +cliente.sexo+"</td><td>"
                                +cliente.cidade+"</td><td>"
                                +cliente.estado+"</td><td>"
                                +"<a class='btn btn-warning' href='update.php?id="+cliente.id+"'>Alterar</td><td>"
                                +"<button class='btn btn-danger' onclick='deleteClient("+cliente.id+");'>Deletar</button></td></tr>"
            }
            //passando o valor do resultado nulo
            $("#resultado").html("");
            //passando a variável html para uma tabela cujo o id é "tbody_id"
            $("#tbody_id").html(html);
        }
        //caso o if nao seja um sucesso, irá mostrar um msg de erro do servidor
        else{
            $("#resultado").html("");
            alert(data.msg);
        }
    })
    //função que se houver uma falha pega o erro do serviço
    .fail(function (jqXHR, textStatus, msg) {
        alert(msg);
    });

})


function deleteClient(id){
    var r = confirm("Deseja deletar?");
    if (!r) {
      return false;
    }
    $.ajax({
        url: "cliente/delete.php",
        type: 'post',
        data: {
            id: id
        },
        beforeSend: function () {
            $("#resultado").html("DELETANDO...");
        }
    })
    .done(function (data) {
        data = JSON.parse(data);
        if(data.status == "success"){
            $("#resultado").html("");
            alert(data.msg);
            location.reload();
        }else{
            $("#resultado").html("");
            alert(data.msg);
        }
    })
    .fail(function (jqXHR, textStatus, msg) {
        alert(msg);
    });    
}

$("#formUpdate").submit(function (e) {
    
    e.preventDefault();

    var nome = $("#nome").val();
    var idade = $("#idade").val();
    var cpf = $("#cpf").val();
    var sexo = $("#sexo").val();
    var cidade = $("#cidade").val();
    var estado = $("#estado").val();

    $.ajax({
        url: "cliente/update.php",
        type: 'post',
        data: {
            id: updateId,
            nome: nome,
            idade: idade,
            cpf: cpf,
            sexo: sexo,
            cidade: cidade,
            estado: estado
        },
        beforeSend: function () {
            $("#resultado").html("ENVIANDO...");
        }
    })
    .done(function (data) {
        data = JSON.parse(data);
        if(data.status == "success"){ 
            alert(data.msg);
            location.href = "search.php";
            $("#resultado").html("");
        }else{
            $("#resultado").html("");
            alert(data.msg);
        }
    })
    .fail(function (jqXHR, textStatus, msg) {
        alert(msg);
    });

})


var showFilter = false;

function openFilter(el,e){
    e.preventDefault();

    showFilter = !showFilter;
    var inputs;

    if(showFilter){
        inputs = $("#defaultSearch").children();
        $("#defaultSearch").css("display","none");
        $("#advancedSearch").css("display","block");
        $(el).html("Fechar filtro avançado");
    }else{  
        inputs = $("#advancedSearch").children();
        $("#defaultSearch").css("display","block");
        $("#advancedSearch").css("display","none");
        $(el).html("Filtro avançado");     
    }
    for(var i = 0; i < inputs.length; i++){
        var input = inputs[i];
        $(input).val("");
    }

}

function voltarPg(){
    window.location.href = "index.php"; 
}

function voltarSearch(){
    window.location.href = "search.php"; 
}