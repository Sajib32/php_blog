<?php

class Main
{
    private $db;
    function __construct($DB_con)
    {
        $this->db = $DB_con;
    }
    
    public function select_users()
    {
        $sql = "SELECT user_name, email FROM users";
        $result = $this->db->query($sql);
        $row=$result->fetch_assoc();
        return $row;
    }
    
    public function login($uname,$umail,$upass)
	{
		try
		{
			$stmt = $this->db->prepare("SELECT * FROM users WHERE user_name=:uname OR email=:umail LIMIT 1");
			$stmt->execute(array(':uname'=>$uname, ':umail'=>$umail));
            
			$userRow=$stmt->fetch(PDO::FETCH_ASSOC);
			print_r(password_verify($upass, $userRow['password']));
            if($stmt->rowCount() > 0)
			{
				if(password_verify($upass, $userRow['password']))
				{
                    print_r(password_verify($upass, $userRow['password']));
					$_SESSION['user_session'] = $userRow['user_id'];
					return true;
				}
				else
				{
					return false;
				}
			}
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}
    
    public function redirect($url)
	{
		header("Location: $url");
	}
    
    public function is_loggedin()
	{
		if(isset($_SESSION['user_session']))
		{
			return true;
		}
	}
    
    public function register($uname,$umail,$upass)
	{
        $new_password = password_hash($upass, PASSWORD_DEFAULT);

        $stmt = $this->db->query("INSERT INTO users(user_name,email,password) 
                                                   VALUES('$uname', '$umail', '$new_password')");
	

        return $stmt;	
						
	}
	
}

?>