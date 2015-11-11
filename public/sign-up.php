<?php

include_once 'H:\xampp\htdocs\final_attempt_blog\classes\class.user.php';
$user = new User;



if(isset($_POST['btn-signup']))
{
	$uname = trim($_POST['txt_uname']);
	$umail = trim($_POST['txt_umail']);
	$upass = trim($_POST['txt_upass']);	
	
	if($uname=="")	{
		$error[] = "provide username !";	
	}
	else if($umail=="")	{
		$error[] = "provide email id !";	
	}
	else if(!filter_var($umail, FILTER_VALIDATE_EMAIL))	{
	    $error[] = 'Please enter a valid email address !';
	}
	else if($upass=="")	{
		$error[] = "provide password !";
	}
	else if(strlen($upass) < 6){
		$error[] = "Password must be atleast 6 characters";	
	}
	else
	{   
        $sql="SELECT * FROM users WHERE user_name='$uname' OR email='$umail'";
        $check =  $user->db->query($sql) ;
        $row = $check->fetch_assoc();
      
        if($row['user_name']==$uname) {
            $error[] = "sorry username already taken !";
        }
        else if($row['email']==$umail) {
            $error[] = "sorry email id already taken !";
        }
        else
        {
            $register = $user->reg_user($uname,$upass, $umail);
            if($register)	
                {
                    header("Location:sign-up.php?joined");
                }
                else
                {
                    $error[] = "Sorry username or email already exists";	
                }
        }
	}
}

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Sign up : cleartuts</title>
<link rel="stylesheet" href="../styles/css/bootstrap.min.css" type="text/css"  />
<link rel="stylesheet" href="../styles/style.css" type="text/css"  />
</head>
<body>
<div class="container">
    	<div class="form-container">
        <form method="post">
            <h2>Sign up.</h2><hr />
            <?php
			if(isset($error))
			{
			 	foreach($error as $error)
			 	{
					 ?>
                     <div class="alert alert-danger">
                        <i class="glyphicon glyphicon-warning-sign"></i> &nbsp; <?php echo $error; ?>
                     </div>
                     <?php
				}
			}
			else if(isset($_GET['joined']))
			{
				 ?>
                 <div class="alert alert-info">
                      <i class="glyphicon glyphicon-log-in"></i> &nbsp; Successfully registered <a href='login.php'>login</a> here
                 </div>
                 <?php
			}
			?>
            <div class="form-group">
            <input type="text" class="form-control" name="txt_uname" placeholder="Enter Username" value="<?php if(isset($error)){echo $uname;}?>" />
            </div>
            <div class="form-group">
            <input type="text" class="form-control" name="txt_umail" placeholder="Enter E-Mail ID" value="<?php if(isset($error)){echo $umail;}?>" />
            </div>
            <div class="form-group">
            	<input type="password" class="form-control" name="txt_upass" placeholder="Enter Password" />
            </div>
            <div class="clearfix"></div><hr />
            <div class="form-group">
            	<button type="submit" class="btn btn-block btn-primary" name="btn-signup">
                	<i class="glyphicon glyphicon-open-file"></i>&nbsp;SIGN UP
                </button>
            </div>
            <br />
            <label>have an account ! <a href="login.php">Sign In</a></label>
        </form>
       </div>
</div>

</body>
</html>