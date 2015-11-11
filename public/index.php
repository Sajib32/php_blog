 <?php
 include_once 'H:\xampp\htdocs\final_attempt_blog\classes\class.user.php';
    $user = new User;
	$posts = $user->selectAllPosts();
?>
   <html> 
   <body>
    <div class="container">
        <div class="row">
            <div class="col-sm-8 blog-main">
			<?php while($post = $posts->fetch_assoc()){ ?>
                <div class="blog-post">
                    <h2 class="blog-post-title">
                        <a href= "post.php?id=<?php echo $post['id'] ;?>"><?php   echo $post['title'] ?></a>
                    </h2>
                    <p class="blog-post-meta"><?php  echo $user->blog_time_format( $post['postTime'] ) ?>  by <a href="author.php?id=<?php echo $post['user_id'] ?>">
                    <?php echo $user->selectName($post['user_id']);  ?> </a></p>
                    
                    <?php
                        $readmore = substr($post['content'], 0, 2)."<p><a href= \"post.php?id={$post['id']}\" class=\"btn btn-success\"> Readmore.. </a></p>";
echo $readmore;        
                    ?>
                         
					
                </div><!-- /.blog-post -->
				<br>
				<br>
			<?php } ?>
            </div><!-- /.blog-main -->
    <!--        Side bar    -->
            
        </div>
    </div>

</body>
</html>