<?php
 include_once 'H:\xampp\htdocs\final_attempt_blog\template\finalDesign\classes\class.user.php';

if(isset($_GET['id'])){
    $id = $_GET['id'];
}
$user = new user;
$post = $user->post_from_post_table_using_post_id($id);
$categoriesList = $user->categoriesLists();
include 'header.php';
?>
<section id="inner-headline">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<ul class="breadcrumb">
					<li><a href="#"><i class="fa fa-home"></i></a><i class="icon-angle-right"></i></li>
					<li class="active">Single Post</li>
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
								<h3><?php echo $post['title'] ?></h3>
							</div>
						</div>
						<p>
							<?php
								echo $post['content'];
							?>
						</p>
						<div class="bottom-article">
							<ul class="meta-post">
								<li><i class="icon-calendar"></i><a href="#"><?php  echo $user->blog_time_format( $post['postTime'] ) ?></a></li>
								<li><i class="icon-user"></i><a href="#"><a href="author.php?id=<?php echo $post['user_id'] ?>">
                    <?php echo $user->selectName($post['user_id']);  ?> </a></a></li>
								<li><i class="icon-comments"></i><a href="#">4 Comments</a></li>
							</ul>
									
						</div>
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
					 <?php while($row = $categoriesList->fetch_assoc()) { ?>
						
						<li><i class="icon-angle-right"></i><a href="#"><?php echo $row['cat_name']; ?></a><span> (20)</span></li>
						
					 <?php } ?> 	
					</ul>
				</div>
				<div class="widget">
					<h5 class="widgetheading">Latest posts</h5>
					<ul class="recent">
						<li>
						
						<h6><a href="#">Lorem ipsum dolor sit</a></h6>
						<p>
							 Mazim alienum appellantur eu cu ullum officiis pro pri
						</p>
						</li>
						<li>
						<h6><a href="#">Maiorum ponderum eum</a></h6>
						<p>
							 Mazim alienum appellantur eu cu ullum officiis pro pri
						</p>
						</li>
						<li>
						<h6><a href="#">Et mei iusto dolorum</a></h6>
						<p>
							 Mazim alienum appellantur eu cu ullum officiis pro pri
						</p>
						</li>
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
	include_once 'footer.php';
?>
?>