<?php

require './App/Class/Produto.php';

$obj = new Produto();

$result = $obj ->buscar();

//transformar array em json
echo json_encode($result);

