<?php 
session_start(); 
    include_once 'H:\xampp\htdocs\final_attempt_blog\classes\class.user.php';
    $user = new User;
	$id = $_GET['id'];
	$checkUser = false;
    if(!isset($_SESSION['uid']) && !isset($_COOKIE['remember']))
    {
        header("Location:../login.php");
    }
    if(isset($_SESSION['uid']))
    {
		$checkUser = true;
		$uid = $_SESSION['uid'];
        $userName = $_SESSION['uid'];
    }
    else 
    {
		$checkUser = true;
        $userName = $_COOKIE['remember'];
    }
	if (isset($_GET['q'])){
        $user->user_logout();
        header("location:../login.php");
    }
    //echo "userId:",$userName,"<br>";
    $userId = $userName;
	//echo $userId;
    $catId = $_GET['id'];
	//echo $catId;
	$category_name = $user->folder_name_by_folder_id($catId);
    $result = $user->fetching_from_post_using_folder_user_id($catId, $userId);
    $categories = $user->selectedCategories();
	
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

<script>
        function check_delete(){
            return confirm('Are you sure you want to delete this entry');
        }
		</script>
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
                    <a class="navbar-brand" href="#">Welcome, 
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
                        <li class="active"><a href="index.html">Blogs</a></li>
						<?php 
							if($checkUser){
								echo "<li><a href=\"#\">Dashboard</a></li>";
							}else{
								echo "<li><a href=\"sign-up.php\">Register</a></li>";
								echo "<li><a href=\"login.php\">Login</a></li>";
							}
						 ?>						 
                        <li><a href="viewCategoriesPost.php?q=logout">Logout</a></li>
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
								<h4>You are in category: <?php echo $category_name; ?></h4>
									
							</div>
						</div>
						<?php
							$hasAnyPost = true;
							if($result->num_rows == 0){
								echo "<p class='alert alert-info'>You didn't keep any post in this category.</p>";
							$hasAnyPost = false;
							}
						?>
						<?php if($hasAnyPost){?>
						<table class="table table-striped">
							<thead>
							  <tr>
								<th>Title</th>
								<th>Published On</th>
								<th>Actions</th>
							  </tr>
							</thead>
							<tbody>
							  <?php while($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><a href="editPost.php?id=<?php echo $row['id'] ?>"><?php echo $row['title'] ?></a></td>
                    <td><?php echo $row['postTime'] ?></td>
                    <td><a href="editPost.php?postId=<?php echo $row['id'].'&&'."catId=".$row['cat_id']; ?>">Edit</a> |
					<a onclick="return check_delete()"  href="deletePost.php?id=<?php echo $row['id'] ?>">Delete</a></td>
                </tr>
                <?php } ?>
                </tbody>
							</tbody>
						  </table>
						  <?php } ?>
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