<?php
/*
* Access to user table
*/
class user{

    protected  static $instance;

    function __construct()
    {
        
    }

    public static function action()
    {
        if(!self::$instance)
        {
            self::$instance = new self();

        }

        return self::$instance;
    }

    public function create($POST)
    {
        $errors=array();
        $arr['name']=ucwords($POST['name']);
        $arr['email']=$POST['email'];
        $arr['password']=$POST['password'];
        $arr['gender']=$POST['gender'];
        $arr['created_on']=date('Y-m-d h:i:s');

        if(empty($POST['name']) || !preg_match("/^[a-zA-Z]+$/", $arr['name']))
        {
            $errors[]="Name can only have letters and spaces".'<br>';
        }

        if(!filter_var($arr['email'], FILTER_VALIDATE_EMAIL))
        {
            $errors[]="Please enter valid email".'<br>';
        }

        if(empty($arr['password']) && strlen($arr['password']) < 4)
        {
            $errors[]="Please enter password and atleast 4 characters".'<br>';
        }

        if($arr['gender'] == "--Select Gender--" || ($arr['gender'] != "Female" && $arr['gender'] != "Male" ))
        {
            $errors[]="Please enter valid gender".'<br>';
        }

        //save to databse
        if(count($errors) == 0)
        {
            return DB::table('users')->insert($arr);
        }
        return $errors;
    }

    public function login($POST)
    {
        $errors=array();
        $arr['email']=$POST['email'];
        $password=$POST['password'];
        
        if(!filter_var($arr['email'], FILTER_VALIDATE_EMAIL))
        {
            $errors[]="Please enter valid email".'<br>';
        }

        if(empty($password))
        {
            $errors[]="Please enter password".'<br>';
        }
        
        //read from databse
        $logindata= DB::table('users')->select()->where("email = :email",$arr);
        if(is_array($logindata))
        {
            $data = $logindata[0];
            if($data->password == $password)
            {
                $ses = new Session();
                $ses->regenerateSession();
                $arr['name']=$data->name;
                $arr['email']=$data->email;
                $arr['gender']=$data->gender;
                $arr['user_id']=$data->id;
                $arr['LOGGED_IN']=1;
                $ses->setSession('USERDETAILS', $arr);
                return true;
            }
        }
        $errors[] = "Wrong email or password!";
        return $errors;
    }

    public function is_logged_in()
    {

        $ses = new Session();
        if($ses->exitSession('USERDETAILS'))
        {
            $data=$ses->getSession('USERDETAILS');
            $email=$data['email'];
            //read from databse
            $logindata= $this->get_by_email($email);
            if(is_array($logindata))
            {
                $data = $logindata[0];
                
                return $data;
                
            }
        }

        return false;
    }

    public function update_by_id($array, $id)
    {
        return DB::table('users')->update($array)->where("id=:id", ["id"=>$id]);
    }

    // public function getAll()
    // {
    //     $data= DB::table('users')->select()->all();
    //     return $data;
    // }

    // public function getByPk($id)
    // {
    //     $data= DB::table('users')->select()->where("id =:id", ["id"=>$id]);
    //     return $data;
    // }

    // public function getByemail($email)
    // {
    //     $data= DB::table('users')->select()->where("email =:email", ["email"=>$email]);
    //     return $data;
    // }

    public function __call($function, $params)
    {
        $value  = $params[0];
        $column = str_replace("get_by_", "", $function);
        $column = addslashes($column);

        return DB::table('users')->select()->where($column ." =:". $column, [$column=>$value]);
    }

    
} 
?>