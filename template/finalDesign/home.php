<?php
 include_once 'H:\xampp\htdocs\final_attempt_blog\template\finalDesign\classes\class.user.php';
    $user = new User;
	$posts = $user->selectAllPosts();
	$categoriesList = $user->categoriesLists();
	$latest = $user->latestPosts();
	if (isset($_GET['q'])){
        $user->user_logout();
        header("location:login.php");
    }
include 'header.php';
?>
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
			  <?php while($post = $posts->fetch_assoc()){ ?>
				<article>
				
						<div class="post-image">
							<div class="post-heading">
								<h3><a href= "post.php?id=<?php echo $post['id'] ;?>"><?php echo $post['title'] ?></a></h3>
							</div>
						</div>
						<p>
							<?php
								if(substr($post['content'], 0, 20))
								{
									echo substr($post['content'], 0, 20) . "...";
								} 
							?>
						</p>
						<div class="bottom-article">
							<ul class="meta-post">
								<li><i class="icon-calendar"></i><a href="#"><?php  echo $user->blog_time_format( $post['postTime'] ) ?></a></li>
								<li><i class="icon-user"></i><a href="#"><a href="author.php?id=<?php echo $post['user_id'] ?>">
                    <?php echo $user->selectName($post['user_id']);  ?> </a></a></li>
								<li><i class="icon-comments"></i><a href="#">4 Comments</a></li>
							</ul>
						<?php
							$readmore = "<a href= \"post.php?id={$post['id']}\" class=\"pull-right\">Continue reading<i class=\"icon-angle-right\"></i></a>";
							echo $readmore;       
						?>						
						</div>
				</article>
			  <?php } ?>
				
				
				<div id="pagination">
					<span class="all">Page 1 of 3</span>
					<span class="current">1</span>
					<a href="#" class="inactive">2</a>
					<a href="#" class="inactive">3</a>
				</div>
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
					 <?php while($row = $categoriesList->fetch_assoc()) { ?>
						
						<li><i class="icon-angle-right"></i><a href="viewCatPosts.php?id=<?php echo $row['id'] ?>">
						<?php echo $row['cat_name']; ?></a></li>
						
					 <?php } ?> 	
					</ul>
				</div>
				<div class="widget">
					<h5 class="widgetheading">Latest posts</h5>
					<ul class="recent">
						
						<?php while($row = $latest->fetch_assoc()) { ?>
						<li>
						
						<h6><a href="#"><?php echo $row['title']; ?></a></h6>
						<p>
							 <?php echo substr($row['content'],0,20).".."; ?>
						</p>
						</li>
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
include 'footer.php';
?>