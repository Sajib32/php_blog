<?php
    session_start();
    include_once 'H:\xampp\htdocs\final_attempt_blog\classes\class.user.php';
    $user = new User();
    if(!isset($_SESSION['uid']) && !isset($_COOKIE['remember']))
    {
        header("Location:login.php");
    }
    
    if(isset($_SESSION['uid']))
    {
        $uid = $_SESSION['uid'];
    }
                      
    //$uid = $_SESSION['uid'];
     $categories = $user->selectedCategories();
     if(isset($_POST['submit'])){
        $catName = $_POST['categoryName'];
        $user->insert_into_categories_table($catName);
    }
    if (isset($_GET['q'])){
        $user->user_logout();
        header("location:login.php");
    }
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <title>Home</title>
		<style>
    		body{
    			font-family:Arial, Helvetica, sans-serif;
    		}
    		h1{
    		    font-family:'Georgia', Times New Roman, Times, serif;
    		}
		</style>
    </head>

    <body>
        <div id="container">
            <div id="header">
                <a href="home.php?q=logout">LOGOUT</a>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h1>Folder</h1>
                </div>
                <div class="panel-body">
                    <ul>
                        <?php while($allCategories = $categories->fetch_assoc()) {?>
                        <li><a href="viewCategoriesPost.php?id=<?php echo $allCategories['id'] ?>"><?php echo $allCategories['cat_name'] ?></a></li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
            <div id="main-body">
    			<br/><br/><br/><br/>
    			<h1>
               <?php
                if(isset($_COOKIE['remember']))
                    {
                        echo $_COOKIE['remember'];       
                    }
                else
                {
                    $user->get_fullname($uid);
                }
                ?>
                  
    			</h1>	
            </div>
            <div>
                <a href="newPost.php">Create Post</a><br>
                <a href="newCategory.php">Create Category</a>
                <form method="post">
                    <div class="form-group">
                        <label for="new_folder">Create a New folder</label>
                        <input type="text" name="categoryName" class="form-control">
                    </div>
                    <div class="form-group">
                        <input type="submit" name="submit" class="btn btn-success" value="create folder">
                    </div>
                </form>
            </div>
            <div id="footer"></div>
        </div>
    </body>
</html>
