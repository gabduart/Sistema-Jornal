<?php 
  include_once("../../include/conn.php")
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Painel do Administrador | Cadastro de Usuários</title>

  <link rel="stylesheet" href="../style.css">

  <!--BOOTSTRAP-->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

  <!--MASK JQUERY-->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
</head>
<body class="bg-dark p-5 mx-5" data-bs-theme="dark">
  <form action="processa/proc_cadUsuario.php" method="post" class="row g-3">
    <div class="col-md-6">
      <label for="inputEmail" class="form-label">Email</label>
      <input type="email" class="form-control" id="inputEmail" name="inputEmail">
    </div>

    <div class="col-md-6">
      <label for="inputPassword" class="form-label">Senha</label>
      <input type="password" class="form-control" id="inputPassword" name="inputPassword">
    </div>

    <div class="col-6">
      <label for="inputName" class="form-label">Nome</label>
      <input type="text" class="form-control" id="inputName" name="inputName">
    </div>

    <div class="col-6">
      <label for="inputBirth" class="form-label">Data de Nascimento</label>
      <input type="date" class="form-control" id="inputBirth" name="inputBirth">
    </div>
    
    <div class="col-6">
      <label for="inputAddress" class="form-label">Endereço</label>
      <input type="text" class="form-control" id="inputAddress" name="inputAddress" placeholder="Rua, Número, Apartamento, Bairro, Cidade - Estado, CEP">
    </div>

    <div class="col-6">
      <label for="inputPhone" class="form-label">Telefone Celular</label>
      <input type="text" class="form-control" id="inputPhone" name="inputPhone" placeholder="(XX) x xxxx-xxxx">
    </div>

    <div class="col-12">
      <button type="submit" class="btn btn-primary w-100">Cadastrar</button>
    </div>
  </form>

  <!--BOOTSTRAP-->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

  <script>
    $(document).ready(function(){
      $('#inputPhone').mask('(00) 0 0000-0000');
    });
  </script>
</body>
</html>