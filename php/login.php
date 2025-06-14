<?php
    header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Credentials: true");
    header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
    header('Access-Control-Allow-Headers: token, Content-Type')
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="stylesheet" href="../styles/login.css">
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
  <title>Login</title>
</head>
<body>
  <form action="<?php $_SERVER["PHP_SELF"]?>" method="post" class="login-form">
    <div id="login-title">Sign In</div>
      <div class="input-box"> <i class="fas fa-user"></i> Username: <br>
        <input type="text" id="username" name="username"> <br>
      </div>
      <div class="input-box"> <i class="fas fa-lock"></i> Password: <br>
        <input type="password" id="password" name="password"> <br>
      </div>
      <input type="submit" id="login-btn" name="login" value="Login">
      <p id="signup-recommend">Don't have an account yet? <a href="register.php">Sign Up</a></p>
    </form>
</body>
</html>
<?php
  include('database.php');
  if(isset($_POST['login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $user = $db->table('users')->where($username);
    if(!$user){
      echo "<script> alert('Invalid username or password');</script>";
      exit();
    }
    foreach($user as $u){
      if($password == $u['password']){
        if($u['admin'] == 1) {
          header("Location: http://localhost:8000/dashboard");
          exit();
        }
        else {
          session_start();
          $_SESSION['userName'] = $u['userName'];
          $_SESSION['userId'] = $u['id'];
          $token = bin2hex(random_bytes(16)); // tạo token giả
          // Chuyển hướng về Vue (ở localhost:5173) và truyền token trong URL
          $redirectUrl = 'http://localhost:5173/login?accessToken=' . $token;
          //echo "<script>window.location.href = '$redirectUrl';</script>";
          header("Location: $redirectUrl");
          exit();
        }
      } else {
        echo "<script>alert('Invalid username or password');</script>";
      }
   }
  } 
?>