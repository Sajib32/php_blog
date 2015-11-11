<?php 
session_start();
$checkUser = false;
if(isset($_SESSION['uid'])){
    $checkUser = true;
}else if (isset($_COOKIE['remember'])){
    $checkUser = true;
}
    if (isset($_GET['q'])){
        $user->user_logout();
        header("location:login.php");
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
						<?php 
							if($checkUser){
								echo "<li><a href=\"admin\dashboard.php\">Dashboard</a></li>";
								echo "<li><a href=\"home.php?q=logout\">Logout</a></li>";
							}else{
								echo "<li><a href=\"sign-up.php\">Register</a></li>";
								echo "<li><a href=\"login.php\">Login</a></li>";
							}
						 ?>
                    </ul>
                </div>
            </div>
        </div>
	</header>
	<!-- end header -->