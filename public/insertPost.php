<?php
    include_once 'H:\xampp\htdocs\final_attempt_blog\classes\class.user.php';
    $user = new User;
    
    if(isset($_POST['submit']))
    {
        $title = $_POST['title']; 
        $content = $_POST['content'];
        $userId = $_POST['uId'];
        echo $userId;
        $catId = $_POST['category'];
        
        $empSql="INSERT INTO posts (title,content,cat_id,user_id) VALUES ('$title', '$content','$catId','$userId')";
        if($user->query($empSql)==true) {
            $newEmpId = $user->insert_id;
            echo "success";         
        }else{
            echo "false";
        }
    }
?>
<html>
    <head>
        <link rel="stylesheet"type="text/css"href="bootstrap.min.css"/>
    </head>

    <body>
                <div class = "row">
                    <div id="navbar" class="navbar-collapse collapse">
                        <ul class="nav navbar-nav">
                            <li class="active"><a href="index.php">Home</a></li>
                            <li><a href="#about">Blogs</a></li>
                        </ul>

                        <ul class="nav navbar-nav navbar-right">
                            <li class="active"><a href="registration.php">Create <span class="sr-only">(current)</span></a></li>
                            <li><a href="logIn.php"> Log Out </a></li>
                        </ul>

                    </div>
                </div>


        <div class = "container">
                   <div class="row">
            <div class="col-md-8 col-sm-6">
                <h2> Posts</h2>
                <ul>

						<?php
							$cdb->showAllPost();
						?>
                   
                </ul>


            </div> <!-- /.col-md-8 -->

        </div> <!-- /.row -->
         </div>
        </div>
                <div id="footer">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-8 col-xs-12 text-left">
                                <span>Copyright &copy; 2015 Cilent(V) Coders </span>
                            </div> <!-- /.text-center -->
                            <div class="col-md-4 hidden-xs text-right">
                                <a href="#top" id="go-top">Back to top</a>
                            </div> <!-- /.text-center -->
                        </div> <!-- /.row -->
                    </div> <!-- /.container -->
                </div>
    </body>
</html>