<?php

$userName = $password = "";

$userName_err = $password_err = "";

if($_SERVER["REQUEST_METHOD"] == "POST") {

  if(empty(trim($_POST["userName"]))){
    $userName_err = 'Please enter userName.';
  } else{
    $userName = trim($_POST["userName"]);
  }

  if(empty(trim($_POST['password']))){
    $password_err = 'Please enter your password.';
  } else{
    $password = trim($_POST['password']);
  }
  
  if(empty($userName_err) && empty($password_err)) {
    $url = 'http://10.5.0.4:8000/login';
    $data = array('username' => $userName, 'password' => $password);

    // use 1 'http' even if you send the request to https://...
    $options = array(
      'http' => array(
          'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
          'method'  => 'POST',
          'content' => http_build_query($data)
      )
    );
    $context  = stream_context_create($options);
    $result = @file_get_contents($url, false, $context);
    if ($result === FALSE) {$userName_err = "User Name or Password not found";}

    $result = json_decode($result, true);

    if ($result['token'] != "") {
      session_start();
      $_SESSION['username'] = $userName;
      $_SESSION['level'] = 0;
      $_SESSION['token'] = $result['token'];

      if($_SESSION['level'] == 0) {
        header('location: authorized/home');
      } else {
        header('location: signin');
      }
    }
  }

}

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="img/favicon.png">

    <title>Sign In</title>

    <!-- Bootstrap core CSS -->
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">

    <!-- Custom styles for this template -->
    <link href="css/signin.css" rel="stylesheet">

    <link rel="icon" 
      type="image/png" 
      href="img/favicon.png">
  </head>

 <body class="text-center">
    <form class="form-signin" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
      <img class="mb-4" src="img/logo.png" alt="" width="172" height="172">
      <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
      <div class="form-group <?php echo (!empty($userName_err)) ? 'has-error' : ''; ?>">
        <label>User Name</label>
        <input type="text" name="userName"class="form-control" value="<?php echo $userName; ?>" required autofocus>
        <span class="help-block"><?php echo $userName_err; ?></span>
       </div>  
      <!-- <label for="inputEmail" class="sr-only">Username</label>
      <input id="inputEmail" class="form-control" placeholder="Email address" required autofocus> -->
      <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
        <label>Password</label>
        <input type="password" name="password" class="form-control">
        <span class="help-block"><?php echo $password_err; ?></span>
      </div>
      <div class="form-group">
        <input type="submit" class="btn btn-lg btn-primary btn-block" value="Login">
      </div>
      <p>Don't have an account? <a href="#signup.ph">Sign up now</a>.</p>
      <p class="mt-5 mb-3 text-muted">&copy; 2018</p>
    </form>
  </body>
</html>
