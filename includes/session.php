<?php

class Session
{
  private $logged_in=false;
  public $user_id;
  public $msg;
  
  function __construct()
  {
    session_start();
	$this->check_message();
	$this->check_login();
	if($this->logged_in)
	{
	  //actions if person is logged in
	}
	else
	{
	 //actions if person is not logged in
	}
  }
  public function is_logged_in()
  {
   return $this->logged_in;
  }
  public function login($user)
  {
   if($user)
   {
    $this->user_id = $_SESSION['user_id']=$user->id;
	$this->logged_in=true;
   }
  }
  
  public function check_login()
  {
   if(isset($_SESSION['user_id']))
   { $this->user_id= $_SESSION['user_id'];
     $this->logged_in =true;
   }
   else
   {
    unset($this->user_id);
	$this->logged_in=false;
   }
  }
  public function logout()
  {
   unset($_SESSION['user_id']);
   unset($this->user_id);
   $this->logged_in = false;
  }
  public function message($msg="")
  {
   if(!empty($msg))
   {
     $_SESSION['message']=$msg;
   }
   else
   {
     return $this->msg;
   }
  }
  private function check_message()
  {
   if(isset($_SESSION['message']))
   {
     $this->msg=$_SESSION['message'];
	 unset($_SESSION['message']);
   }
   else
   {
    $this->msg="";
   }
  
  }
  
  
}
$session = new Session();


?>