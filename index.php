<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>From Login</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="mycss.css">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <!-- script php dan mysql -->

  <?php 
//error_reporting(0);
include 'config.php';

if(!isset($_SESSION['username'] )== 0) {
  header('Location: home.php');
}

if(isset($_POST['login'])) {
  $username = $_POST['username'];
  $password = md5($_POST['password']."ALS52KAO09");

  try {
    $sql = "SELECT * FROM users WHERE username = :username AND password = :password";
    $stmt = $connect->prepare($sql);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $password);
    $stmt->execute();

    $count = $stmt->rowCount();
    if($count == 1) {
      $_SESSION['username'] = $username;
      header("Location: home.php");
      return;
    }else{
      echo "Anda tidak dapat login";
    }
  }
  catch(PDOException $e) {
    echo $e->getMessage();
  }
}

?>
  <!-- end script php dan mysql -->
  <body>
        <div class = "container">
              <div class="wrapper">
                          <form action="" method="post" name="Login_Form" class="form-signin">       
                              <h3 class="form-signin-heading">Welcome Back! Please Sign In</h3>
                                <hr class="colorgraph"><br>
                                
                              <input type="text" class="form-control" name="username" placeholder="Username" required="" autofocus="" />
                              </br>
                              <input type="password" class="form-control" name="password" placeholder="Password" required=""/>          
                             
                              
                              <button class="btn btn-lg btn-primary btn-block"  name="login" value="Login" type="Submit">Login</button>        
                          <br><a href="register.php">Register</a>
                          
                          </form>

              </div>
    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>