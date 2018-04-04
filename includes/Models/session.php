<?php
class Session
{
    private $logged_in = false;
    public $user_id;

    function __construct()
    {
        session_start();
        $this->check_login();
    }

    public function is_logged_in()
    {
        return $this->logged_in;
    }

    public function login($log_in_user)
    {
        if($log_in_user != null)
        {
            $user_id = $_SESSION['user_id'] = $log_in_user->user_id;
            $this->logged_in = true;
        }
    }

    public function logout()
    {
        unset($_SESSION['user_id']);
        unset($_SESSION['email']);
        unset($user_id);
        $this->logged_in = false;
    }

    private function check_login()
    {
        if(isset($_SESSION['user_id']))
        {
            $this->user_id = $_SESSION['user_id'];
            $this->logged_in = true;
        }
        else
        {
            unset($this->user_id);
            unset($_SESSION['email']);
            $this->logged_in = false;
        }
    }
}
$session = new Session();
?>
