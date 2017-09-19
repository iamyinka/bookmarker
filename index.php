<?php

// Start Session
session_start();

if (isset($_POST['submit'])) {
  $name = $_POST['name'];
  $url = $_POST['url'];
  # code...
  if ($name == '' || $url == '') {
    # code...
    $error = "One or more fields empty.";
    $errorMsg = "<div class='alert alert-danger'>" .$error. "</div>";
    $_SESSION['errorMsg'] = $errorMsg;
    header("Location: index.php");
    exit();
  }

  if (isset($_POST['name'])) {
    # code...
    if (isset($_SESSION['bookmarks'])) {
      # code...
      $_SESSION['bookmarks'][$_POST['name']] = $_POST['url'];
    } else {
      $_SESSION['bookmarks'] = array($_POST['name'] =>  $_POST['url']);
    }
  }

}

if (isset($_GET['action']) && $_GET['action'] == 'delete') {
  # code...
  unset($_SESSION['bookmarks'][$_GET['name']]);
  header("Location: index.php");
  exit();
}

if (isset($_GET['action']) && $_GET['action'] == 'deleteAll') {
  # code...
  unset($_SESSION['bookmarks']);
  header("Location: index.php");
  exit();
}

// unset($_SESSION['errorMsg']);
// var_dump($_SESSION);
// if (isset($_POST['submit'])) {
//   # code...
//   if (isset($_SESSION['bookmarks'])) {
//     # code...
//     $_SESSION['bookmarks']['name'] = $_POST['name'];
//   }
// }

?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bookmarker :: Using PHP Sessions</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.2/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style media="screen">
      body {
        background-color: lightblue;
      }

      .navbar {
        border-radius: 0;
      }

      form {
        margin-bottom: 20px;
      }
    </style>
  </head>
  <body>

    <nav class="navbar navbar-inverse" role="navigation">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Book-Maker</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="navbar">
          <ul class="nav navbar-nav">
            <li class="active"><a href="#">Home</a></li>
            <li><a href="#"></a></li>

          </ul>

          <ul class="nav navbar-nav navbar-right">
            <li><a href="index.php?action=deleteAll">Clear All</a></li>

          </ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>

    <div class="container">
      <div class="row">
        <div class="col-md-7">
          <form class="" action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
            <div class="form-group">
              <input type="text" class="form-control" id="name" placeholder="Website Name" name="name">
            </div>

            <div class="form-group">
              <input type="text" class="form-control" id="url" placeholder="Website URL" name="url">
            </div>

            <input type="submit" name="submit" value="Bookmark" class="btn btn-primary btn-block">
          </form>

          <?php
            if (isset($_SESSION['errorMsg'])) {
              # code...
              echo $_SESSION['errorMsg'];
              unset($_SESSION['errorMsg']);
            }
           ?>
        </div>

        <div class="col-md-5">
          <ul class="list-group">
            <?php if (isset($_SESSION['bookmarks'])) { ?>
              <?php foreach ( $_SESSION['bookmarks'] as $name => $url): ?>
                <li class="list-group-item"><a href="<?php echo $url; ?>" target="_blank"><?php echo $name; ?></a> <a href="index.php?action=delete&name=<?php echo $name; ?>" class="close" data-target="close"> x </a></li>
              <?php endforeach; ?>
            <?php }; ?>
          </ul>
        </div>
      </div>
    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  </body>
</html>
