<?php

require './App/Class/Produto.php';

if(isset($_POST['enviar'])){

    $nome = $_POST['nome'];
    $marca = $_POST['marca'];
    $descricao = $_POST['descricao'];
    $modelo = $_POST['modelo'];
    $cor = $_POST['cor'];
    $tamanho = $_POST['tamanho'];
    $qtde = $_POST['qtde'];
    $preco = $_POST['preco'];
    $tipo = $_POST['tipo'];
    
    // verificando o ARRAY  $_FILES
    //print_r($_FILES);
    $arquivo = $_FILES['foto'];
    if ($arquivo['error']) die ("Falha ao enviar a foto");
    $pasta = './uploads/fotos/';
    $nome_foto = $arquivo['name'];
    $novo_nome = uniqid();
    $extensao = strtolower(pathinfo($nome_foto, PATHINFO_EXTENSION));

    if ($extensao != 'png' && $extensao != 'jpeg') die ("Extensão do arquivo inválida");
    $caminho = $pasta . $novo_nome . '.' . $extensao;
    $foto = move_uploaded_file($arquivo['tmp_name'], $caminho);

    // print_r($nome_foto);
    // echo '<br>';
    // echo $novo_nome;
    // echo '<br>';
    // echo "EXTENSAO DO ARQUiVO: " .$extensao;

    $objProd = new Produto();
    $objProd->foto = $caminho;
    $objProd->nome = $nome;
    $objProd->marca = $marca;
    $objProd->descricao = $descricao;
    $objProd->modelo = $modelo;
    $objProd->cor = $cor;
    $objProd->tamanho = $tamanho;
    $objProd->quantidade = $qtde;
    $objProd->preco = $preco;
    $objProd->id_tipo = $tipo;

    print_r($objProd);
    $res = $objProd->cadastrar();
    if($res){
        echo '<script> alert("Cadastrado com sucesso!") </script>';
    }else{
        echo '<script> alert("Error!") </script>';
    }
}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>HTML</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>    
    
    <link rel="stylesheet" type="text/css" href="./css/style.css">
</head>
<body>

	<header> 
		<div id="topo">
			<p id="off">Produtos de moda com até 50% OFF > </p>
		</div>
		<div id="lepolepo">

			<div id="logo">
				<img src="logobg.png">
			</div>

			<div id="buscar">
				<form>
					<input type="text" placeholder="O que você procura?">
				</form>
	
			</div>

			<div id="entrar">
				<a class="btn_entrar" href="https://www.google.com">Entrar</a>
			</div>
		
		</div>
	</header>

	<nav>
		<a class="menu" href="">HOME</a>
		<a class="menu" href="">PRODUTOS</a>
		<a class="menu" href="">OFERTAS</a>
		<a class="menu" href="">LOJAS PARCEIRAS</a>
	</nav>



<div class="container">
    <div class="row">
        <div class="col-12 p-3 text-center"><h1> Cadastrar Produto </h1></div>
    </div>

    <form method="POST" action="" enctype="multipart/form-data">
        <div class="row">
          <div class="col-md-6 mb-3">
            <label for="foto" class="form-label">Foto</label>
            <input type="file" name="foto" id="foto" class="form-control" required>
          </div>

          <div class="col-md-6 mb-3">
            <label for="nome" class="form-label"> Nome</label>
            <input
              type="text"
              class="form-control"
              id="nome"
              name="nome"
              placeholder="Nome do Produto"
              required
            />
          </div>
        </div>

        <div class="row">
    <div class="col-md-12 mb-3">
      <label for="bio" class="form-label">Descrição</label>
      <textarea
        class="form-control"
        name="descricao"
        id="descricao"
        placeholder="Descrição do Produto"
        rows="3">
    </textarea>
    </div>
  </div>

        <div class="row">
          <div class="col-md-4 mb-3">
            <label for="instagram" class="form-label"> Marca </label>
            <input
              type="text"
              class="form-control"
              id="marca"
              name="marca"
              placeholder="Marca"
              required
            />
          </div>
          <div class="col-md-4 mb-3">
            <label for="linkedin" class="form-label"> Modelo </label>
            <input
              type="text"
              class="form-control"
              id="modelo"
              name="modelo"
              placeholder="Model"
            />
          </div>
          <div class="col-md-4 mb-3">
            <label for="linkedin" class="form-label"> Cor </label>
            <input
              type="text"
              class="form-control"
              id="cor"
              name="cor"
              placeholder="Color"
            />
          </div>
        </div>

        <div class="row">

            <div class="col-md-3 mb-3">
                <label for="instagram" class="form-label"> Tamanho </label>
                <input
                  type="text"
                  class="form-control"
                  id="tamanho"
                  name="tamanho"
                  placeholder="Tamanho"
                  required
                />
              </div>


            <div class="col-md-3 mb-3">
              <label for="instagram" class="form-label"> Preço </label>
              <input
                type="text"
                class="form-control"
                id="preco"
                name="preco"
                placeholder="R$"
                required
              />
            </div>
            <div class="col-md-3 mb-3">
              <label for="linkedin" class="form-label"> Quantidade </label>
              <input
                type="text"
                class="form-control"
                id="qtde"
                name="qtde"
                placeholder="Qtde."
              />
            </div>
            <div class="col-md-3 mb-3">

                <label for="resp" class="form-label"> Tipo </label>
                <select class="form-select" name="tipo" id="tipo">
                  <!-- INSERIR FOR DO COLAB -->
                  <option value="x" selected disabled>Selecione o Tipo</option>
                  <option value="1" selected >Roupas</option>
                  <option value="2" selected >Calçados</option>
                  <option value="3" selected >Bonés</option>
                </select>
              
            </div>
          </div>

        <div class="row my-5">
            <div class="col-md-12 mb-3 d-flex justify-content-center">
                <button type="reset" id="cancelar" class="btn btn-secondary mx-3">Cancelar</button>
		        <button type="submit" name="enviar" id="enviar" class="btn btn-primary mx-3">Cadastrar</button>
            </div>
        </div>
      </form>
    
</div>


<footer>
		
    <p> Todos os direitos reservados ©Fábrica de Software 2025 </p>

</footer>



</body>
</html>