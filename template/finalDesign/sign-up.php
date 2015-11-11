<?php

include_once 'H:\xampp\htdocs\final_attempt_blog\classes\class.user.php';
$user = new User;

if(isset($_POST['btn-signup']))
{
	$uname = trim($_POST['txt_uname']);
	$umail = trim($_POST['txt_umail']);
	$upass = trim($_POST['txt_upass']);	
	
	if($uname=="")	{
		$error[] = "provide username !";	
	}
	else if($umail=="")	{
		$error[] = "provide email id !";	
	}
	else if(!filter_var($umail, FILTER_VALIDATE_EMAIL))	{
	    $error[] = 'Please enter a valid email address !';
	}
	else if($upass=="")	{
		$error[] = "provide password !";
	}
	else if(strlen($upass) < 6){
		$error[] = "Password must be atleast 6 characters";	
	}
	else
	{   
        $sql="SELECT * FROM users WHERE user_name='$uname' OR email='$umail'";
        $check =  $user->db->query($sql) ;
        $row = $check->fetch_assoc();
      
        if($row['user_name']==$uname) {
            $error[] = "sorry username already taken !";
        }
        else if($row['email']==$umail) {
            $error[] = "sorry email id already taken !";
        }
        else
        {
            $register = $user->reg_user($uname,$upass, $umail);
            if($register)	
                {
                    header("Location:sign-up.php?joined");
                }
                else
                {
                    $error[] = "Sorry username or email already exists";	
                }
        }
	}
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Moderna - Bootstrap 3 flat corporate template</title>
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
                        <li class="active"><a href="home.php">Home</a></li>
                        <li><a href="#">Portfolio</a></li>
                        <li><a href="#">Users Posts</a></li>
                        <li><a href="#">Contact</a></li>
						<li><a href="login.php">Login</a></li>
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
					<li class="active">Sign Up/Register</li>
				</ul>
			</div>
		</div>
	</div>
</section>
<div class="container">
    	<div class="form-container">
        <form method="post">
            <h2>Sign up.</h2><hr />
            <?php
			if(isset($error))
			{
			 	foreach($error as $error)
			 	{
					 ?>
                     <div class="alert alert-danger">
                        <i class="glyphicon glyphicon-warning-sign"></i> &nbsp; <?php echo $error; ?>
                     </div>
                     <?php
				}
			}
			else if(isset($_GET['joined']))
			{
				 ?>
                 <div class="alert alert-info">
                      <i class="glyphicon glyphicon-log-in"></i> &nbsp; Successfully registered <a href='login.php'>login</a> here
                 </div>
                 <?php
			}
			?>
            <div class="form-group">
            <input type="text" class="form-control" name="txt_uname" placeholder="Enter Username" value="<?php if(isset($error)){echo $uname;}?>" />
            </div>
            <div class="form-group">
            <input type="text" class="form-control" name="txt_umail" placeholder="Enter E-Mail ID" value="<?php if(isset($error)){echo $umail;}?>" />
            </div>
            <div class="form-group">
            	<input type="password" class="form-control" name="txt_upass" placeholder="Enter Password" />
            </div>
            <div class="clearfix"></div><hr />
            <div class="form-group">
            	<button type="submit" class="btn btn-block btn-primary" name="btn-signup">
                	<i class="glyphicon glyphicon-open-file"></i>&nbsp;SIGN UP
                </button>
            </div>
            <br />
            <label>have an account ! <a href="login.php">Sign In</a></label>
        </form>
       </div>
</div>
<?php
	include 'footer.php';
?>