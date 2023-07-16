<?php
/*
flush
set value in array
get
set
destroy same as a flush
remove
*/

/*
* work with session variable
*/

class Session{

    
    private function sessionStart()
    {
       if(!isset($_SESSION))
        {
            session_start();
        }
    }

    public function flush()
    {
        $this->sessionStart();
        session_destroy();
    }

    public function setSession($mykey, $myvalue='')
    {
        
        $this->sessionStart();
        if(is_string($mykey))
        {
            $_SESSION[$mykey] = $myvalue;
           
        }
        elseif(is_array($mykey))
        {
            foreach($mykey as $key=>$value)
            {
                $_SESSION[$key]=$value;
            }
        }
    }

    public function getSession($key)
    {
        $this->sessionStart();
        if(isset($_SESSION[$key]))
        {
            return $_SESSION[$key];
        }
        return false;
        
    }

    public function exitSession($key)
    {
        $this->sessionStart();
        if(isset($_SESSION[$key]))
        {
            return $_SESSION[$key];
        }
        
    }

    public function sessionRemove($key)
    {
        $this->sessionStart();
        if(isset($_SESSION[$key]))
        {
            unset($_SESSION[$key]);
            return true;
        }
        return false;
    }

    public function regenerateSession()
    {
        session_regenerate_id();
    }
}
?>