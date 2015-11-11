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
				setcookie('remember', $_POST['txt_uname_email'], time() + 1000);
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
<html lang="en">
<head>
<meta charset="utf-8">
<title>My Blog</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<!-- css -->
<link href="css/bootstrap.min.css" rel="stylesheet" />
<link href="css/fancybox/jquery.fancybox.css" rel="stylesheet">
<link href="css/flexslider.css" rel="stylesheet" />
<link href="css/style1.css" rel="stylesheet" />

<!-- Theme skin -->
<link href="skins/default.css" rel="stylesheet" />


<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

</head>
<body>
<div id="wrapper">
	<!-- start header -->
	<header>
        <div class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="index.html">echo<span> "M</span>onirul's<span> W</span>oRlD";</a>
                </div>
                <div class="navbar-collapse collapse ">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="index.html">Home</a></li>
                        <li><a href="portfolio.html">Portfolio</a></li>
                        <li><a href="blog.html">Users Posts</a></li>
                        <li><a href="contact.html">Contact</a></li>
						<li><a href="sign-up.php">Register</a></li>
                    </ul>
                </div>
            </div>
        </div>
	</header>
	<!-- end header -->
<section id="inner-headline">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<ul class="breadcrumb">
					<li><a href="#"><i class="fa fa-home"></i></a><i class="icon-angle-right"></i></li>
					<li class="active">Login</li>
				</ul>
			</div>
		</div>
	</div>
</section>

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
<?php
	include 'footer.php';
?>