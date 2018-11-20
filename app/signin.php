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
        header('location: authenticated/home');
      } else {
        header('location: signin');
      }
    }
  }

}
?>


<!DOCTYPE html>
<html style="color: #1e2833;">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>fllevent</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Aldrich">
    <link rel="stylesheet" href="https://unpkg.com/@bootstrapstudio/bootstrap-better-nav/dist/bootstrap-better-nav.min.css">
    <link rel="stylesheet" href="assets/css/Login-Form-Dark.css">
    <link rel="stylesheet" href="assets/css/styles.css">

    <link rel="icon" 
      type="image/png" 
      href="assets/img/favicon.png">
</head>

<body>
    <div class="login-dark">
        <form method="post" style="background-color: #1e2833;color: #ffffff;" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <h2 class="sr-only">Login Form</h2>
            <div class="illustration"><a href="/" class="home"><i class="fa fa-user-o"></i></a>
                <h1>Sign In</h1>
            </div>
            <div class="form-group"><input class="form-control" type="text" name="userName" required="" placeholder="User Name" autofocus=""></div>
            <div class="form-group"><input class="form-control" type="password" name="password" required="" placeholder="Password" minlength="5"></div>
            <div class="form-group"><button class="btn btn-primary btn-block" type="submit">Log In</button></div><a href="register" class="forgot">Not a User Sign Up</a></form>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>