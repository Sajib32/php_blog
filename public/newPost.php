<?php
    session_start(); 
    include_once 'H:\xampp\htdocs\final_attempt_blog\classes\class.user.php';
    $user = new User;
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

    $userId = $user->select_user_by_username($userName);
    echo $userName;
   

    if(isset($_GET['submit']))
    {
        $title = $_GET['title'];
        $content = $_GET['content'];
        $uId = $_GET['userId'];
        echo $title,$uId;
        $catId = $_GET['category'];
        echo $catId,$content;
        $message = $user->insertData($catId,$title,$content,$uId);
    }

?>
   <html>
    <body>
<!--
       <div>
           <?php
                echo $user->showAllPost();   
           ?>       
           
       </div>
-->
           
        <div class="panel-body">
            <form method="get" action="">
                <?php
                    if(isset($message)){
                        echo "<h1 class='alert-success'> $message </h1>";
                    }
                ?>
               <input type="hidden" name="userId" value="<?php echo $userName; ?>">
                Title:
                <input type="text" name="title">
                <br>
                Content:
                <textarea name="content" rows="10" cols="25"></textarea> 
                <br>
                Category:
                <select name="category">
                    <?php
                        $user->allCategories();
                    ?>
                </select>
                <br>
    
                <button type="submit" name="submit">Submit</button>
            </form>
        </div>  
        
        <div>
            <h1>Categories Posts:</h1>
            <?php  
                $user->selectCategories();
            ?>
        </div>      
    </body>
</html>