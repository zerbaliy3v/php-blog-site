<?php include "../include/db.php"; ?>
<?php session_start(); ?>

<?php

if (isset($_POST['login'])) {
  $username = stripslashes($_POST['username']);
  $username = mysqli_real_escape_string($conn, $username);
  $password = stripslashes($_POST['password']);
  $password = mysqli_real_escape_string($conn, $password);
  $query = "SELECT * FROM users WHERE username='$username' and password='$password'";
  $result = mysqli_query($conn, $query);
  $rows = mysqli_num_rows($result);
  if ($rows == 1) {
    $_SESSION['username'] = $username;
    header("Location: index.php");
    exit();
  } else {
    echo "<script>alert('Username or Password is incorrect.')</script>";
  }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Admin - Login</title>

  <!-- Bootstrap core CSS-->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">
  <style>
    .card {
      margin: 0 auto;
      /* Added */
      float: none;
      /* Added */
      margin-bottom: 10px;
      /* Added */
    }
  </style>

</head>



<body class="bg-dark">

  <div class="container">
    <div class="card card-login mx-auto mt-5 ">
      <div class="card-header">Login</div>
      <div class="card-body">
        <form action="" method="post">
          <div class="form-group">
            <div class="form-label-group">
              <input type="text" id="inputUsername" name="username" class="form-control" placeholder="Username"
                required="required" autofocus="autofocus">
              <label for="inputUsername">Username</label>
            </div>
          </div>
          <div class="form-group">
            <div class="form-label-group">
              <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password"
                required="required">
              <label for="inputPassword">Password</label>
            </div>
          </div>
          <button class="btn btn-primary btn-block" name="login" type="submit">Login</button>
        </form>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

</body>

</html>