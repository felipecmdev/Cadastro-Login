<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include 'connect.php';
    
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    
    if (empty($username) || empty($password)) {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Erro!</strong> Nome de usuário ou senha não podem estar vazios.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
              </div>';
        exit;
    }

    try {
        $stmt = $con->prepare("SELECT * FROM registration WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if (password_verify($password, $row['password'])) {
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Sucesso!</strong> Login efetuado com sucesso.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                      </div>';
                      session_start();
                      $_SESSION['username'] = $username;
                      header('location:home.php');
            } else {
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Erro!</strong> Senha incorreta.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                      </div>';
            }
        } else {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Erro!</strong> Nome de usuário não encontrado.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                  </div>';
        }
    } catch (mysqli_sql_exception $e) {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Erro!</strong> Ocorreu um erro ao processar sua solicitação.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
              </div>';
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
        
    <title>Login Page</title>
  </head>
  <body>
    <h1 class="text-center">Faça login no nosso site</h1>
    <div class="container mt-5">
    <form action="login.php" method="post" onsubmit="return validateForm()">
      <div class="form-group">
        <label for="exampleInputUsername1">Nome</label>
        <input type="text" class="form-control" id="username" placeholder="Insira seu nome de usuário" name="username" required>
      </div>
      <div class="form-group">
        <label for="exampleInputPassword1">Senha</label>
        <input type="password" class="form-control" id="password" placeholder="Insira sua senha" name="password" required>
      </div>
      <div class="container">
        <div class="row">
         <div class="col text-center">
         <button type="submit" class="btn btn-primary w-50">Login</button>
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
