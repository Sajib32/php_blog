<?php
    session_start(); 
    include_once 'H:\xampp\htdocs\final_attempt_blog\classes\class.user.php';
    if(!isset($_SESSION['uid']) && !isset($_COOKIE['remember']))
    {
        header("Location:login.php");
    }
    
    if(isset($_SESSION['uid']))
    {
        $userName = $_SESSION['uid'];
    }
    else 
    {
        $userName = $_COOKIE['remember'];
        echo $_COOKIE['remember'];
    }
echo $userName;
    $user = new User;
    $post_id = $_GET['postId'];
    $cat_id = $_GET['catId'];
    echo $post_id,"<br>";
    echo $cat_id;
    $r = $user->editPost($cat_id, $post_id);
    $title = $r['title'];
    $content = $r['content'];
    $catId = $r['catId'];
    $pId = $_GET['postId'];
    echo $title;
    //echo $pId;

    if(isset($_POST['update'])) 
    {
        $title = $_POST['title'];
        $content = $_POST['content'];
        $userId = $userName;
        $catId = $_POST['category'];
        $pId = $_POST['postId'];
        
        echo $title,"<br>";
        echo $content,"<br>";
        echo $userId,"<br>";
        echo $catId,"<br>";
        echo $pId;
        
        $updatePost = $user->updatePostDetails($title,$content,$userId,$catId,$pId);
    }
    
?>
<html>
<body>
   <div class="panel-body">
        <form method="post" action="">
               <input type="hidden" name="postId" value="<?php echo $pId; ?>">
                Title:
                <input type="text" name="title" value="<?php echo $title; ?>">
                <br>
                Content:
                <textarea name="content" rows="10" cols="25"><?php echo $content; ?></textarea> 
                <br>
                Category:
                <select name="category">
                    <?php
                        $user->selectedDropDown($cat_id);
                    ?>
                </select>
                <br>
                <button type="update" name="update">Update</button>
            </form>
    </div> 
</body>
</html>