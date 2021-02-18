<?php
class DB
{
    private $dbHost = "localhost";
    private $dbUsername = "root";
    private $dbPassword = "";
    private $dbName = "attendance";
    private $db;
    public function __construct($DB_con)
    {
        //Connect to the database
        try{
            $DB_con = new PDO("mysql:host=".$this->dbHost.";dbname=".$this->dbName,$this->dbUsername,$this->dbPassword);
            $DB_con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $this->db = $DB_con;
        }
        catch(PDOException $e)
        {
            die("Failed to Connect with MYSQL: " . $e->getMessage());
        }
    }
    /**
     * Test and clean input data
     */
    public function testinput($data)
    {
        $data = htmlspecialchars($data);
        $data = stripslashes($data);
        $data = trim($data);
        return $data;
    }
    /**
     * Insert data into the database
     * @param string name of the table
     * @param array the data for inserting into the table
     */
    public function insert($table,$data)
    {
        if(!empty($data) && is_array($data))
        {
            $columns = '';
            $values = '';
            $i = 0;
            if(!array_key_exists('created',$data))
            {
                $data['created_at'] = date("Y-m-d H:i:s");
            }
            if(!array_key_exists('modified',$data))
            {
                $data['modified_at'] = date("Y-m-d H:i:s");
            }
            $columnString = implode(',',array_keys($data));
            $valueString = ":" .implode(',:',array_keys($data));
            $sql = "INSERT INTO ".$table." (".$columnString.") VALUES
            (".$valueString.")";
            $query = $this->db->prepare($sql);
            foreach($data as $key=>$val)
            {
                $query->bindValue(':'.$key,$val);
            }
            $insert = $query->execute();
            return $insert?$this->db->lastInsertId():false;
        }
        else
        {
            return false;
        }
    }
    public function checkRow($table,$conditions = array())
    {
        $sql = ' SELECT * FROM ' . $table;
        if(!empty($conditions) && is_array($conditions))
        {
            $columns = '';
            $values = '';
            $sql .= ' WHERE ';
            $keys = array_keys($conditions);
            for($i=0;$i<count($keys);$i++)
            {
                $pre = ($i > 0)?' AND ':'';
                $sql .= $pre . $keys[$i] .'=:' . $keys[$i];
          
            }
            $query = $this->db->prepare($sql);
            foreach($conditions as $key=>$val)
            {
                $query->bindValue(':'.$key,$val);
            }
            $query->execute();
            
            return $query->rowCount();
        }
    }
/**
 * Update data into the database
 * @param string name of the table
 * @param array the data for updating into the table
 * @param array where condition on updating data
 */
    public function update($table,$data,$conditions)
    {
        if(!empty($data) && is_array($data))
        {
            $colvalset= '';
            $whereSql= '';
            $i = 0;
            if(!array_key_exists('modified_at',$data))
            {
                $data['modified_at'] = date("Y-m-d H:i:s");
            }
            foreach($data as $key=>$val)
            {
                $pre = ($i > 0)?', ':'';
                $colvalset .=$pre.$key."='".$val."'";
                $i++;
            }
            if(!empty($conditions) && is_array($conditions))
            {
                $whereSql .=' WHERE ';
                $i = 0;
                foreach($conditions as $key => $value)
                {
                    $pre = ($i > 0)?' AND ':'';
                    $whereSql .=$pre.$key."='".$value."'";
                    $i++;
                }
            }
            $sql = "UPDATE ".$table." SET ".$colvalset.$whereSql;
            $query = $this->db->prepare($sql);
            $update = $query->execute();
            return $update?true:false;
        }
        else
        {
            return false;
        }

    }
    public function login($umail,$otp,$upass)
	{
		try
		{
            $pass = md5($upass);
			$stmt = $this->db->prepare("SELECT * FROM users WHERE email=:ema AND password=:pass LIMIT 1");
            $stmt->bindParam(":ema",$umail);
            $stmt->bindParam(":pass",$pass);
			$stmt->execute();
            $userRow=$stmt->fetch(PDO::FETCH_ASSOC);
            $tableName= 'users';
            $userData = array(
                'verified' => 1
            );
            $conditions = array(
                'email' => $umail
            );
            // echo  "<br>" . md5($upass) . "<br>";
            $update = $this->update($tableName,$userData,$conditions);
			if($stmt->rowCount() > 0 && $update)
			{
                // echo  "<br>" . md5($otp) . "<br>";
				if($userRow['verification_code']==md5($otp))
				{
					$_SESSION['user_session'] = $userRow['email'];
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

	public function is_loggedin()
	{
		if(isset($_SESSION['user_session']))
		{
			return true;
		}
	}

	public function redirect($url)
	{
		header("Location: $url");
	}

	public function logout()
	{
		session_destroy();
		unset($_SESSION['user_session']);
		return true;
	}

}
?>