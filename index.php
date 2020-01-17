<?php 
    include("header.php");
?>

    <form id="formId">
        <input type="text" id="nome" placeholder="nome" autofocus required>
        <input type="text" id="idade" placeholder="idade" required>
        <input type="text" id="cpf" placeholder="cpf" required>
        <input type="text" id="sexo" placeholder="sexo" required>
        <input type="text" id="cidade" placeholder="cidade" required>
        <input type="text" id="estado" placeholder="estado" required>
        <input type="submit" id="enviar">
    </form>

    <p id="resultado"></p>

<?php
    include("footer.php");
?>

    
