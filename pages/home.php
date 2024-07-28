<?php 
  // The session needs to be started on each different page
  if (!isset($_SESSION)) session_start();
    
  // Checks that there is no session variable that identifies the user
  if (!isset($_SESSION['userID'])) {
      // Destroy the session for security
      session_destroy();
      // Redirects the visitor back to login
      header("Location: ../index.html"); 
      exit;
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>InfoAtual | Home</title>
  <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
  <p>Entrada permitida</p>
  <a href='../include/logout.php'>Logout</a>
</body>
</html>