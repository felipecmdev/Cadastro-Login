<?php
$succes = 0;
$user = 0;

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    include 'connect.php';
    
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    
    if(empty($username) || empty($password)) {
        echo "Nome de usuário ou senha não podem estar vazios.";
        exit;
    }

    if (strlen($password) < 8) {
        echo "A senha precisa ter pelo menos 8 caracteres.";
        exit;
    }

    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    try {
        $stmt = $con->prepare("INSERT INTO registration (username, password) VALUES (?, ?)");
        $stmt->bind_param("ss", $username, $hashed_password);

        $stmt->execute();

        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Sucesso! </strong>  Usuário foi cadastrado.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>';
    } catch (mysqli_sql_exception $e) {
        if (strpos($e->getMessage(), 'Duplicate entry') !== false) {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Opa! </strong>  Usuário já existe.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>';
        } else {
            echo "Erro ao realizar o cadastro.";
        }
    }
}

?>




<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <script
        src="https://code.jquery.com/jquery-3.7.1.js"
        integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>
        
    <title>Página de cadastro</title>
  </head>
  <body>
    <h1 class="text-center">Cadastre-se no nosso site</h1>
    <div class="container mt-5">
    <form action="sign.php" method="post" onsubmit="return validateForm()">
  <div class="form-group">
    <label for="exampleInputUsername1">Nome</label> 
    <input type="text" class="form-control" id="username" placeholder="Insira seu nome de usuário" name="username" required>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Senha</label>
    <input type="password" class="form-control" id="password" placeholder="Insira sua senha" name="password" required>
    <div class="container">
      <div class="row">
        <div class="col text-center">
            <button type="submit" class="btn btn-primary w-50 mt-3">Cadastrar</button> 
        </div>
      </div>
    </div>
    
    <div class="container">
        <div class="row">
         <div class="col text-center">
         <a href="login.php" class="btn btn-primary w-50 mt-1">Já possuí um cadastro? Faça login aqui!</a>
          </div>
        </div>
    </div>



</form>

<script type="text/javascript">
  function validateForm() {
    var username = $('#username').val();
    var password = $('#password').val();

    if (username.trim() === "" || password.trim() === "") {
      alert("Nome de usuário e senha não podem estar vazios.");
      return false;
    }

    if (password.length < 8) {
      alert("A senha precisa ter no mínimo 8 caracteres.");
      return false;
    }

    return true;
  }
</script>

  </body>
</html>