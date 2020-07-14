<?php 
session_start();

function sql_open() {
  $handle = new SQLite3('/db/website.db');
  return $handle;
}

function on_login($username, $password) {
  $db_handle = sql_open();
  $password = md5($password);

  $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";

  $user = $db_handle->querySingle($query, true);
  
  if (empty($user)) {
?>
    <div class="alert">
      <p>Wrong username / password. Try again.</p>
    </div>
<?
    return;
  }
  $_SESSION['user'] = $user['username'];
  $_SESSION['is_admin'] = $user['is_admin'];
  header("Location: /index.php");
}

function onPost() {
  if (empty($_REQUEST['uname']) || empty($_REQUEST['psw'])) {
?>
    <div class="alert">
      <p>The username and password must be set.</p>
    </div>
<?
    return;
  }
  $username = $_REQUEST['uname'];
  $password = $_REQUEST['psw'];

  on_login($username, $password);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  onPost();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" href="css/styles.css">
</head>
<body>
  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <div class="container">
      <label for="uname"><b>Username</b></label>
      <input type="text" placeholder="Enter Username" name="uname" required>

      <label for="psw"><b>Password</b></label>
      <input type="password" placeholder="Enter Password" name="psw" required>

      <button type="submit">Login</button>
    </div>
  </form>

<a href="index.php">Back</a>
</body>
</html>