<?php

$userName = $password = $repeatPassword = "";

$userName_err = $password_err = $repeatPassword_err = "";

if($_SERVER["REQUEST_METHOD"] == "POST") {

    if(empty(trim($_POST["username"]))) {
        $userName_err = 'Please enter user name.';
    } else {
        $userName = trim($_POST["username"]);
    }

    if(empty(trim($_POST['password']))){
        $password_err = 'Please enter your password.';
    } else{
        $password = trim($_POST['password']);
    }

    if(empty(trim($_POST['repeatpassword']))){
        $password_err = 'Please enter your repeatpassword.';
    } else{
        $password = trim($_POST['repeatpassword']);
    }

    if ($_POST["password"] != $_POST["repeatpassword"]) {
        $password_err = "please match passwords";
        $repeatPassword_err = "please match passwords";
    }

    if(empty($userName_err) && empty($password_err) && empty($repeatPassword_err)) {
        $registerUrl = 'http://10.5.0.4:8000/api/v1/user/newuser';
        $registerData = array('UserName' => $userName,
                              'Password' => $password,
                              'Level' => 1, 
                              );
    
        // use 1 'http' even if you send the request to https://...
        $registeroptions = array(
          'http' => array(
              'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
              'method'  => 'POST',
              'content' => http_build_query($registerData)
          )
        );
        $registerContext  = stream_context_create($registeroptions);
        $registerResult = @file_get_contents($registerUrl, false, $registerContext);

        $registerResult = json_decode($registerResult, true);

        // var_dump($registerResult);

        header('location: signin');
     }
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>fllevent</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Aldrich">
    <link rel="stylesheet" href="assets/css/Login-Form-Dark.css">
    <link rel="stylesheet" href="assets/css/styles.css">

    <link rel="icon" 
      type="image/png" 
      href="assets/img/favicon.png">
</head>

<body>
    <div class="login-dark">
        <form method="post" style="background-color: #1e2833;color: #ffffff;" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
            <h2 class="sr-only">Login Form</h2>
            <div class="illustration"><a href="/" class="home"><i class="fa fa-user-o"></i></a>
                <h1>Register</h1>
            </div>
            <div class="form-group">
            <input class="form-control" type="username" name="username" required="" placeholder="User Name" autofocus="" autocomplete="off">
            </div>
            <div class="form-group">
            <input class="form-control" type="password" name="password" required="" placeholder="Password" minlength="5" autocomplete="off">
            <input class="form-control" type="password" name="repeatpassword" required="" placeholder="Repeat Password" minlength="5" autocomplete="off">
            </div>
            <div class="form-group"><button class="btn btn-primary btn-block" type="submit">Log In</button></div><a href="signin" class="forgot">Already a user Sign In</a></form>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script></body>

</html>