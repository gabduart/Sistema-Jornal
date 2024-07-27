<?php 
  include_once("../../../include/conn.php");

  $email = $_POST["inputEmail"];
  $pass = $_POST["inputPassword"];
  $name = $_POST["inputName"];
  $birth = $_POST["inputBirth"];
  $address = $_POST["inputAddress"];
  $phone = $_POST["inputPhone"];

  $salt = bin2hex(random_bytes(16)); // Generates a 16 bytes (128 bits) salt
  $passWithSalt = $pass . $salt;

  // Password hash combined with bcrypt
  $opt = [
    'cost' => 12, // Processing cost, increases security
  ];

  $hash = password_hash($passWithSalt, PASSWORD_BCRYPT, $opt);

  // Using prepared statements to avoid SQL injection
  $sql = "INSERT INTO usuarios (nome, email, senha_hash, salt, data_nascimento, endereco, telefone) VALUES (?, ?, ?, ?, ?, ?, ?)";
  $stmt = $conn->prepare($sql);

  if (!$stmt) {
    die("Erro na preparação da declaração: " . $conn->error);
  }

  $stmt->bind_param("sssssss", $name, $email, $hash, $salt, $birth, $address, $phone);

  if ($stmt->execute()) {
    echo "
      <META HTTP-EQUIV=REFRESH CONTENT='0;URL=../../index.html'>
      <script type='text/javascript'>
        alert('Usuário cadastrado com sucesso!');
      </script>
    ";
  } else {
    echo "
      <META HTTP-EQUIV=REFRESH CONTENT='0;URL=../cadAnimal.php'>
      <script type='text/javascript'>
        alert('Erro ao cadastrar usuário: " . $stmt->error . "');
      </script>
    ";
  }

  $stmt->close();
  $conn->close();
?>