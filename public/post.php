<?php
include_once 'H:\xampp\htdocs\final_attempt_blog\classes\class.user.php';

if(isset($_GET['id'])){
    $id = $_GET['id'];
}
$obj = new user;
$post = $obj->post_from_post_table_using_post_id($id);
?>
<html> 
<body>
<div class="container">
    <div class="row">
        <div class="col-sm-8 blog-main">
                <div class="blog-post">
                    <h2 class="blog-post-title"><?php   echo $post['title'] ?></h2>
                    <p class="blog-post-meta"><?php  echo $obj->blog_time_format( $post['postTime'] ) ?>  by
                    <a href="author.php?id=<?php echo $post['user_id'] ?>"> 
					<?php echo $obj->selectName($post['user_id']);  ?> </a></p>
                    <p> <?php  echo $post['content']  ?>  </p>
                </div><!-- /.blog-post -->
                <br>
                <br>
        </div><!-- /.blog-main -->
   
    </div>
</div>

<script src="../style/js/jquery-1.11.3.js"></script>
<script src="../style/js/bootstrap.js"></script>
</body>
</html>