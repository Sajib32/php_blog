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
    echo "userId:",$userName,"<br>";
    $userId = $userName;
    $catId = $_GET['id'];
    echo $catId;
$folder_name = $user->folder_name_by_folder_id($catId);
print_r($folder_name);
    $result = $user->fetching_from_post_using_folder_user_id($catId, $userId);
    
?>
<html>
    <head>
        <link rel="stylesheet" href="../styles/css/bootstrap.min.css" type="text/css"  />
        <link rel="stylesheet" href="../styles/style.css" type="text/css"  />
        <script>
        function check_delete(){
            return confirm('Are you sure you want to delete this entry');
        }
    </script>
    </head>
    <body>
        <div class="container">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h1>Folder :: <?php echo  $folder_name; ?></h1>
        </div>
        <div class="panel-body">
            <?php
            $hasAnyPost = true;
            if($result->num_rows == 0){
                echo "<p class='alert alert-info'>You didn't keep any post in this folder</p>";
            $hasAnyPost = false;
            }
            ?>
            <?php
                if($hasAnyPost){?>
                    <table class="table table-striped">
                <thead>
                <tr>
                    <th>Title</th>
                    <th>Published On</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php while($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><a href="editPost.php?id=<?php echo $row['id'] ?>"><?php echo $row['title'] ?></a></td>
                    <td><?php echo $row['postTime'] ?></td>
                    <td><a href="editPost.php?postId=<?php echo $row['id'].'&&'."catId=".$row['cat_id']; ?>">Edit</a> | <a onclick="return check_delete()"  href="deletePost.php?id=<?php echo $row['id'] ?>">Delete</a></td>
                </tr>
                <?php } ?>
                </tbody>
            </table>
                <?php } ?>
        

        </div>
    </div>
</div>
  <link rel="stylesheet" href="../styles/js/bootstrap.js" type="text/css"  />
   <script src="../styles/js/jquery-1.11.3.js"></script>
    </body>
</html>