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

$("#btnId").click(function (e) {

    e.preventDefault();
    var termo = $("#termo").val();
    var nome = $("#nome").val();
    var idade = $("#idade").val();
    var cpf = $("#cpf").val();
    var sexo = $("#sexo").val();
    var cidade = $("#cidade").val();
    var estado = $("#estado").val();

    $.ajax({
        url: "cliente/search.php",
        type: 'post',
        data: {
            search_term: termo,
            search_name: nome,
            search_age: idade,
            search_cpf: cpf,
            search_gender: sexo,
            search_city: cidade,
            search_state: estado
        },
        beforeSend: function () {
            $("#resultado").html("BUSCANDO...");
        }
    })
    .done(function (data) {
        data = JSON.parse(data);
        if(data.status == "success"){
            var html = "";
            for(var i = 0; i<data.clientes.length; i++){
                var cliente = data.clientes[i];
                html+="<tr><td>"+cliente.nome+"</td><td>"
                                +cliente.idade+"</td><td>"
                                +cliente.cpf+"</td><td>"
                                +cliente.sexo+"</td><td>"
                                +cliente.cidade+"</td><td>"
                                +cliente.estado+"</td><td>"
                                +"<a href='update.php?id="+cliente.id+"'>Alterar</td><td>"
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