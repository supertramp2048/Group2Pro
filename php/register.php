<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <link rel="stylesheet" href="../styles/register.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />
  <title>Register</title>
</head>
<body>
  <div class="container">
    <!-- Ảnh bên trái -->
    <div class="image-section"></div>

    <!-- Form bên phải -->
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" class="register-form">
      <div id="signup-title">Sign Up</div>
      <div class="input-box">
        <i class="fas fa-user"></i> Username: <br />
        <input type="text" id="username" name="username" />
      </div>
      <div class="input-box">
        <i class="fas fa-envelope"></i> Email: <br />
        <input type="email" id="email" name="email" />
      </div>
      <div class="input-box">
        <i class="fas fa-lock"></i> Password: <br />
        <input type="password" id="password" name="password" />
      </div>
      <div class="input-box">
        <i class="fas fa-lock"></i> Re-enter Password: <br />
        <input type="password" id="repassword" name="repassword" />
      </div>
      <input type="submit" id="register-btn" name="register" value="Sign Up" />
      <div id="signup-recommend">
        Already have an account? <a href="login.php">Log in</a>
      </div>
    </form>
  </div>
</body>
</html>
<?php
include('database.php');
if(isset($_POST['register'])){
  $username = $_POST['username'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $repassword = $_POST['repassword'];

  if(empty($username) || empty($email) || empty($password) || empty($repassword)){
    echo "<script>alert('All fields are required');</script>";
    exit();
  }
  if(strlen($password) < 6){
    echo "<script>alert('Password must be at least 6 characters long');</script>";
    exit();
  }
  if($password !== $repassword){
    echo "<script>alert('Passwords do not match');</script>";
    exit();
  }

  // Check if user already exists
  $existingUser = $db->table('users')->where($username);
  if($existingUser){
    echo "<script>alert('User already exists');</script>";
    exit();
  }

  // Register new user
  $db->table('users')->insert([
    'UserName' => $username,
    'Email' => $email,
    'Password' => $password
  ]);
  header("Location: login.php");
  exit();
}

?>