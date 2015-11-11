<?php

include 'H:\xampp\htdocs\final_attempt_blog\dbconfig.php';

class User
{
    public $db;
    public function __construct()
    {
        $this->db = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
        
        if(mysqli_connect_error())
        {
            echo "Error: Could not dbect to database";
            exit;
        }
    }
    
    /** registration process **/
    public function reg_user($uname,$upass, $umail)
    {			
        $password = md5($upass);
        $sql="SELECT * FROM users WHERE user_name='$uname' OR email='$umail'";

        //checking if the username or email is available in db
        $check =  $this->db->query($sql) ;
        $count_row = $check->num_rows;

        //if the username is not in db then insert to the table
        if ($count_row == 0){
            $sql1="INSERT INTO users(user_name,email,password) 
                    VALUES('$uname', '$umail', '$password')";
            $result = mysqli_query($this->db,$sql1) or die(mysqli_dbect_errno()."Data cannot inserted");
            return $result;
        }
			
    }
    
    public function check_login($umail, $upass)
    {
        	
        $password = md5($upass);
    
        $sql2="SELECT id from users WHERE email='$umail' or user_name='$umail' and password='$password'";
			
//checking if the username is available in the table
        	$result = $this->db->query($sql2);
        	$user_data = $result->fetch_assoc();
        	$count_row = $result->num_rows;

        if ($count_row > 0) {
            // this login var will use for the session thing
            $_SESSION['login'] = true; 
            $_SESSION['uid'] = $user_data['id'];
            return true;
        }
        else{
            return false;
        }
    }
    
        	/*** for showing the username or fullname ***/
    	public function get_fullname($uid){
    		$sql3="SELECT user_name FROM users WHERE id = $uid";
	        $result = mysqli_query($this->db,$sql3);
	        $user_data = mysqli_fetch_array($result);
	        echo $user_data['user_name'];
    	}
    /*** starting the session ***/
	    public function get_session(){    
	        return $_SESSION['login'];
	    }

	    public function user_logout() {
	        $_SESSION['login'] = false;
            session_unset();
	        session_destroy();
            setcookie('remember',"",time()-1000);
            header("Location:../login.php");
	    }
    
    /*CRUD Options starts*/
    public function insertData($catId,$title,$content,$uId)
        {
            $sql = "INSERT INTO posts (title,content,cat_id,user_id) VALUES('$title','$content','$catId','$uId')";
            //$res = $this->db->query($sql);
            //print_r($res);
            if($this->db->query($sql) == TRUE) 
            {
                return "New record created successfully";
            }
        }
        
        public function showAllPost()
        {
            $sql = "SELECT posts.id,posts.title,posts.content, posts.cat_id FROM posts
			JOIN categories ON posts.cat_id=categories.id";
            $res = $this->db->query($sql);
            if($res->num_rows > 0)
            {     
                while($row=$res->fetch_assoc())
                {
                   
                    echo "<li><h2 class=\"skills-title\"><a href=\"viewPost.php?catId={$row["cat_id"]}&&postId={$row["id"]}\">{$row['title']}</a></h2>
                        <p>{$row['content']}<button><a href=\"#\" class=\"readmore\">read more</a></button></p></li>";
    
                }

            }
            //return $r;
        }
		
		public function showUsersAllPost($userId)
        {
            $sql = "SELECT posts.id,posts.title,posts.content, posts.cat_id FROM posts
			JOIN categories ON posts.cat_id=categories.id and user_id = $userId";
            $res = $this->db->query($sql);
            if($res->num_rows > 0)
            {     
                while($row=$res->fetch_assoc())
                {
                   
                    echo "<li><h2 class=\"skills-title\"><a href=\"viewPost.php?catId={$row["cat_id"]}&&postId={$row["id"]}\">{$row['title']}</a></h2>
                        <p>{$row['content']}<button><a href=\"#\" class=\"readmore\">read more</a></button></p></li>";
    
                }
            }
            //return $r;
        }
        
        public function viewDetails($cat_id, $post_id)
        {
            $sql = "SELECT * FROM posts WHERE id=$post_id and cat_id=$cat_id";
            $res = $this->db->query($sql);
            if($res->num_rows > 0)
            {
                
                while($row=$res->fetch_assoc())
                {   
                   // echo $row["title"],"<br>",$row["content"];
                    //echo "<a href=\"editPost.php?catId={$row["cat_id"]}&&postId={$row["id"]}\">Edit</a>","<br>";
                    //echo "<a href=\"deletePost.php?postId={$row["id"]}\">Delete</a>";
					echo "<h2 class=\"skills-title\"><a href=\"viewPost.php?catId={$row["cat_id"]}&&postId={$row["id"]}\">{$row['title']}</a></h2>
                        <p>{$row['content']}</p>";
					echo "<button><a href=\"editPost.php?catId={$row["cat_id"]}&&postId={$row["id"]}\">Edit</a></button>";
					echo "<button><a href=\"deletePost.php?postId={$row["id"]}\">Delete</a></button>";
                    
                }
            }
			else{
				echo "<h2 class=\"skills-title\">you have no posts yet</h2>";
			}
        }
		
		public function viewAll()
		{
			$sql = "SELECT posts.id,posts.title,posts.content, posts.cat_id FROM posts
			JOIN categories ON posts.cat_id=categories.id";
            $res = $this->db->query($sql);
            if($res->num_rows > 0)
            {     
                while($row=$res->fetch_assoc())
                {
                   
                    echo "<li><h2 class=\"skills-title\"><a href=\"view.php?catId={$row["cat_id"]}&&postId={$row["id"]}\">{$row['title']}</a></h2>
                        <p>{$row['content']}</li>";
    
                }
            }
		}
        

        
        public function allCategories()
        {
            $sql = "SELECT * FROM categories";
            $res = $this->db->query($sql);
            
            if($res->num_rows > 0)
            {
                while($row=$res->fetch_assoc())
                {
                     echo "<option value=\"{$row['id']}\">{$row['cat_name']}</option>";  
                }
            }
            
        }
    
        public function selectedCategories()
        {
            $sql = "SELECT * FROM categories";
            return $this->db->query($sql);
        }
    
        public function insert_into_categories_table($catName)
        {
            if(!empty($catName)){
                $sql = "INSERT INTO categories(cat_name) VALUES ('$catName')";
                if($this->db->query($sql)){
                    header('Location:home.php');
                }
            }
        }
        
        public function selectedDropDown($cat_id)
        {
            $sql = "SELECT * FROM categories";
            $res = $this->db->query($sql); 
            if($res->num_rows > 0)
            {
                while($row=$res->fetch_assoc())
                {
                    if($cat_id==$row['id']){
                        echo "<option selected value=\"{$row['id']}\">{$row['cat_name']}</option>";
                        continue;
                    }
                    echo "<option value=\"{$row['id']}\">{$row['cat_name']}</option>";
                }
            }
            
        }
        

        
        public function deletePost($deleteId)
        {
            $sql = "DELETE FROM posts WHERE id = '$deleteId'";
            if($this->db->query($sql)==true)
            {
                echo "<h4 align =\"center\">your post is deleted</h4>";
            }
            else
            {
                echo "Not deleted";
            }
        }
        
        public function selectCategories()
        {
            $catSql = "SELECT * FROM categories";
            
            $res = $this->db->query($catSql);
            
            if($res->num_rows > 0)
            {
                while($row=$res->fetch_assoc())
                {
                    echo "<li><div class=\"progress\">
                            <div class=\"progress-bar\"><a href=\"categoriesPost.php?id={$row["id"]}\">{$row['cat_name']}</div>
                        </div></li>";
             
                }
            }
        }
        
        public function showCatPosts($catPost)
        {
            $sql = "SELECT posts.id,posts.title,posts.content, posts.cat_id,posts.postTime, posts.user_id FROM posts 
			JOIN categories ON posts.cat_id=categories.id WHERE categories.id = '$catPost' ORDER BY title DESC";            
            $res = $this->db->query($sql);          
            return $res;
        }
        public function select_user_by_username($userName) {
            $sql = "SELECT * FROM users WHERE user_name = '$userName'";
            $result = $this->db->query($sql);
            $row =  $result->fetch_assoc();
            return $row['id'];
        }
    
    /////////
        public function fetching_from_post_using_folder_user_id($catId, $userId){
            $sql = "SELECT * FROM posts WHERE user_id = '$userId' and cat_id = '$catId'";
            $result = $this->db->query($sql);
            return $result;
        }

        public function folder_name_by_folder_id($catId) {
            $sql = "SELECT * FROM categories WHERE id = '$catId'";
            $result = $this->db->query($sql);
            $row = $result->fetch_assoc();
            return $row['cat_name'];
        }
    
    // edit
    public function editPost($cat_id, $post_id)
        {
            $sql = "SELECT * FROM posts WHERE id='$post_id' and cat_id='$cat_id'";
            $res = $this->db->query($sql);
            if($res->num_rows > 0)
            {
                
                while($row=$res->fetch_assoc())
                {   
                    $title = $row["title"];
                    $content = $row["content"];
                    $cat_id = $row["cat_id"];
                }
            }
            return array('title'=>$title, 'content'=>$content, 'catId'=>$cat_id);
        }
    
    // Update
        public function updatePostDetails($title,$content,$userId,$catId,$pId)
        {
        $updateSql = "UPDATE posts SET
          title='$title',content='$content',user_id = '$userId',
              cat_id = '$catId'
          WHERE id = '$pId'";
        
            if($this->db->query($updateSql)==true) 
            {
                //$pId = $cdb->conn->insert_id;
                header("Location:home.php");
            }       
        }
    
    // delele
        public function delete($id) {
        $sql = "DELETE FROM posts WHERE id = '$id'";
        if($this->db->query($sql)){
            header('Location:home.php');
        }
    }
    
    // all post
    public function selectAllPosts()
    {
        $sql = "SELECT * FROM posts ORDER BY postTime DESC";
        $result = $this->db->query($sql);
        return $result;
    }
    
    public function blog_time_format($time){
        $time = strtotime($time);
        return date('M d, Y', $time);
    }
    
    public function post_from_post_table_using_post_id($id){
       $sql = "SELECT * FROM posts WHERE id = '$id'";
        $result = $this->db->query($sql);
        $row = $result->fetch_assoc();
        return $row;
    }
    
    public function selectName($id) {
       //$sql = "SELECT user_name FROM posts WHERE user_id = '$id'";
        
        $sql = "SELECT * FROM users JOIN posts
        ON users.id = posts.user_id
        WHERE posts.user_id = '$id'";
        $result = $this->db->query($sql);
        $row = $result->fetch_assoc();
        return $row['user_name'];   
    }
	
	// categoriesLists
	public function categoriesLists()
	{
		$sql = "SELECT * FROM categories";
		$result = $this->db->query($sql);
		return $result;
	}
	
	public function latestPosts()
	{
		$sql = "SELECT * FROM posts ORDER BY postTime DESC LIMIT 5";
		$result = $this->db->query($sql);
		return $result;
	}
	public function find_id($userId)
	{
		$sql = "SELECT id FROM users WHERE user_name = '$userId'";
		$result = $this->db->query($sql);
		return $result;
	}
}
?>