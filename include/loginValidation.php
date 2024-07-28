<?php 
  //  If the Post is not empty and the email or password is empty, returns to the index page
  if (!empty($_POST) AND (empty($_POST["email"]) OR empty($_POST["password"]))) {
    echo "
      <META HTTP-EQUIV=REFRESH CONTENT='0;URL=../index.html'>
      <script type='text/javascript'>
        alert('Preencha todos os campos!');
      </script>
    ";
    exit;
  } 
  else {
    require_once("conn.php");

    $email = $_POST["email"];
    $password = $_POST["password"];

    try {
      // Using 'prepared statements' to avoid SQL injection
      $stmt = $conn->prepare("SELECT id, nome, email, senha_hash, salt, data_nascimento, data_registro, status, tipo_usuario, foto_perfil FROM usuarios WHERE email = ?");
      $stmt->bind_param("s", $email);
      $stmt->execute();
      $stmt->store_result();

      // Checks if it found a user with the email provided
      if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $nome, $email, $senha_hash, $salt, $data_nascimento, $data_registro, $status, $tipo_usuario, $foto_perfil);
        $stmt->fetch();

        $passWithSalt = $password . $salt;

        // Check password
        if (password_verify($passWithSalt, $senha_hash)) {
          // Starts the session if isn't already started
          if (!isset($_SESSION)) {
            session_start();
          }

          // Sets session variables
          $_SESSION['userID'] = $id;
          $_SESSION['userName'] = $nome;
          $_SESSION['userEmail'] = $email;
          $_SESSION['userBirth'] = $data_nascimento;
          $_SESSION['userRegister'] = $data_registro;
          $_SESSION['userStatus'] = $status;
          $_SESSION['userType'] = $tipo_usuario;
          $_SESSION['userPhoto'] = $foto_perfil;

          echo "
            <META HTTP-EQUIV=REFRESH CONTENT='0;URL=../pages/home.php'>
            <script type='text/javascript'>
              alert('Login realizado com sucesso!');
            </script>
          ";
        } 
        else {
          echo "
            <META HTTP-EQUIV=REFRESH CONTENT='0;URL=../index.html'>
            <script type='text/javascript'>
              alert('Senha incorreta!');
            </script>
          ";
        }
      } 
      else {
        echo "
          <META HTTP-EQUIV=REFRESH CONTENT='0;URL=../index.html'>
          <script type='text/javascript'>
            alert('Email não encontrado!');
          </script>
        ";
      }

      $stmt->close();
    } catch (Exception $e) {
      echo "
        <META HTTP-EQUIV=REFRESH CONTENT='0;URL=../index.html'>
        <script type='text/javascript'>
          alert('Erro ao processar sua solicitação. Tente novamente mais tarde.');
        </script>
      ";
      error_log($e->getMessage());
    }

    $conn->close();
  }
?>