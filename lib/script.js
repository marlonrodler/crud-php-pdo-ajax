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

$("#formSelect").submit(function (e) {

    e.preventDefault();

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
            search_name: nome,
            search_age: idade,
            search_cpf: cpf,
            search_gender: sexo,
            search_city: cidade,
            search_state: estado
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
                html+="<tr><td>"+cliente.nome+"</td><td>"
                                +cliente.idade+"</td><td>"
                                +cliente.cpf+"</td><td>"
                                +cliente.sexo+"</td><td>"
                                +cliente.cidade+"</td><td>"
                                +cliente.estado+"</td></tr>"
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
    var r = confirm("Deletar?");
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
            $("#resultado").html("ENVIANDO...");
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



