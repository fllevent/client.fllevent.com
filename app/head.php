<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Fll Event</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">

    <!-- Custom styles for this template -->
    <link href="css/navbar.css" rel="stylesheet">

    <link rel="icon" 
      type="image/png" 
      href="img/logo_only.png">

  </head>

  <body>
    
    <nav class="navbar navbar-expand-md navbar-dark bg-dark">
      <a class="navbar-brand" href="home.php">LMR App</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample04" aria-controls="navbarsExample04" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarsExample04">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a class="nav-link" href="home.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="timeclock.php">Time Clock</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="scouting.php">Scouting</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="management.php">Management Tool</a>
          </li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $_SESSION['username']?></a>
            <div class="dropdown-menu" aria-labelledby="dropdown01">
              <a class="dropdown-item" href="#settings">Settings</a>
              <a class="dropdown-item" href="help.php">Help</a>
              <a class="dropdown-item" href="logout.php">LogOut</a>
            </div>
          </li>
        </ul>
      </div>
    </nav>