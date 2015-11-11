<?php
    session_start();
    include_once 'H:\xampp\htdocs\final_attempt_blog\classes\class.user.php';
    $user = new User;
    if(isset($_SESSION['uid']) || isset($_COOKIE['remember']))
    {
        header("Location:home.php");
    }

    if(isset($_POST['btn-login']))
    {

        $uname = $_POST['txt_uname_email'];
        $umail = $_POST['txt_uname_email'];
        $upass = $_POST['txt_password'];
        
        $login = $user->check_login($umail,$upass);
        if($login)
        {
            if(isset($_POST['remember']))
        {
            setcookie('remember', $_POST['txt_uname_email'], time() + 400);
        }
            header("Location:home.php");
        }
        else
        {
            $error = "Wrong username or password !";
        }	
    }
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Login : cleartuts</title>
<link rel="stylesheet" href="../styles/css/bootstrap.min.css" type="text/css"  />
<link rel="stylesheet" href="../styles/style.css" type="text/css"  />
</head>
<body>
<div class="container">
    	<div class="form-container">
        <form method="post" action="login.php">
            <h2>Sign in.</h2><hr />
            <?php
			if(isset($error))
			{
					 ?>
                     <div class="alert alert-danger">
                        <i class="glyphicon glyphicon-warning-sign"></i> &nbsp; <?php echo $error; ?> !
                     </div>
                     <?php
			}
			?>
            <div class="form-group">
            	<input type="text" class="form-control" name="txt_uname_email" placeholder="Username or E mail ID" required />
            </div>
            <div class="form-group">
            	<input type="password" class="form-control" name="txt_password" placeholder="Your Password" required />
            </div>
        <label class="checkbox pull-left"><br>
            <input type="checkbox" value="1" name="remember">
            Remember me
        </label>
            <div class="clearfix"></div><hr />
            <div class="form-group">
            	<button type="submit" name="btn-login" class="btn btn-block btn-primary">
                	<i class="glyphicon glyphicon-log-in"></i>&nbsp;SIGN IN
                </button>
            </div>
            <br />
            <label>Don't have account yet ! <a href="sign-up.php">Sign Up</a></label>
        </form>
       </div>
</div>

</body>
</html>