<?php 
session_start();
    include_once 'H:\xampp\htdocs\final_attempt_blog\classes\class.user.php';
    $user = new User();
	$checkUser = false;
    if(!isset($_SESSION['uid']) && !isset($_COOKIE['remember']))
    {
        header("Location:../login.php");
    }
    
    if(isset($_SESSION['uid']))
    {
        $uid = $_SESSION['uid'];
		$checkUser = true;
    }
	else if (isset($_COOKIE['remember'])){
		$checkUser = true;
	} 
                      
    //$uid = $_SESSION['uid'];
     $categories = $user->selectedCategories();
     if(isset($_POST['submit'])){
        $catName = $_POST['categoryName'];
        $catInsert = $user->insert_into_categories_table($catName);
		$message = "Category created successfully.";
    }
	
    if (isset($_GET['q'])){
        $user->user_logout();
        header("location:../login.php");
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>My Blog</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<!-- css -->
<link href="../css/bootstrap.min.css" rel="stylesheet" />
<link href="../css/flexslider.css" rel="stylesheet" />
<link href="../css/style1.css" rel="stylesheet" />

<!-- Theme skin -->
<link href="../skins/default.css" rel="stylesheet" />

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
                    <a class="navbar-brand" href="dashboard.php">Welcome, 
					<?php
					if(isset($_COOKIE['remember']))
                    {
                        echo $_COOKIE['remember'];       
                    }
					else
					{
						$user->get_fullname($uid);
					}

				?></a>
                </div>
                <div class="navbar-collapse collapse ">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="../home.php">Blogs</a></li>
						<?php 
							if($checkUser){
								echo "<li><a href=\"#\">Dashboard</a></li>";
							}else{
								echo "<li><a href=\"sign-up.php\">Register</a></li>";
								echo "<li><a href=\"login.php\">Login</a></li>";
							}
						 ?>						 
                        <li><a href="dashboard.php?q=logout">Logout</a></li>
						
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
					<li class="active">Blog</li>
				</ul>
			</div>
		</div>
	</div>
</section>

<section id="content">
	<div class="container">
		<div class="row">
			<div class="col-lg-8">
				<article>
					
						<div class="post-image">
							<div class="post-heading">
								<h4>You can create your own category here:</h4>
									<?php
										if(isset($message)){
											echo "<div class='alert alert-success'><strong>Success!</strong> $message </div>";
										}
									?>
									<form method="post">
										<div class="form-group">
										  <label for="new category">Category Name:</label>
										  <input type="text" name="categoryName" class="form-control" id="usr">
										</div>
										<div class="form-group">
											<input type="submit" name="submit" class="btn btn-success" value="create category">
										</div>
									</form>
									<h4>Write your thoughts or ideas here:<a href="newPost.php">Create Post</h4>
							</div>
						</div>
						<p>
							
						</p>
						
				</article>
	
			</div>
			<div class="col-lg-4">
				<aside class="right-sidebar">
				<div class="widget">
					<form class="form-search">
						<input class="form-control" type="text" placeholder="Search..">
					</form>
				</div>
				<div class="widget">
					<h5 class="widgetheading">Categories</h5>
					<ul class="cat">
						<?php while($allCategories = $categories->fetch_assoc()) {?>
						<li><i class="icon-angle-right"></i><a href="#"><a href="viewCategoriesPost.php?id=<?php echo $allCategories['id'] ?>"><?php echo $allCategories['cat_name'] ?></a></li>
                        <?php } ?>
					</ul>
				</div>
				<div class="widget">
					<h5 class="widgetheading">Popular tags</h5>
					<ul class="tags">
						<li><a href="#">Web design</a></li>
						<li><a href="#">Trends</a></li>
						<li><a href="#">Technology</a></li>
						<li><a href="#">Internet</a></li>
						<li><a href="#">Tutorial</a></li>
						<li><a href="#">Development</a></li>
					</ul>
				</div>
				</aside>
			</div>
		</div>
	</div>
	</section>
	<?php
		include_once "../footer.php";
	?>