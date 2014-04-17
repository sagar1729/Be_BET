<?php 
require_once("database.php");
class User
{
 protected static $table_name="users"; 
 protected static $db_fileds=array('id','username','password','first_name','last_name');
 
 public $id;
 public $username;
 public $password;
 public $first_name;
 public $last_name;
 
 
 public static function find_all()
  {
   return self::find_by_sql("select * from ".self::$table_name);
  }
  
  public static function find_by_id($id=0)
  {
  
  $result_array = self::find_by_sql("select * from ".self::$table_name. " where id={$id} limit 1");
   return !empty($result_array)? array_shift($result_array) : false;
  }
  
  public static function find_by_sql($sql="")
  {
    global $database;
   $result_set = $database->query($sql);
   $object_array = array();
   while($row=$database->fetch_array($result_set))
   { $object_array[]= self::instantiate($row);
   }
   return $object_array;
  } 
  
  public static function authenticate($username,$password)
  { global $database;
    
    $username= $database->escape_value($username);
    $password= $database->escape_value($password);
	$sql = "SELECT * from ".self::$table_name;
	$sql .= " where username='{$username}' ";
	$sql .= " and password='{$password}' ";
	$sql .= " limit 1";
	$result_array = self::find_by_sql($sql);
	return !empty($result_array)? array_shift($result_array) : false;
  }
  private static function instantiate($record)
  {
    $object=new self;
	foreach($record as $attribute=>$value)
	{ if($object->has_attribute($attribute))
	  { $object->$attribute=$value;
	  }
	}
	return $object;
 }
 
  private function has_attribute($attribute)
  {
    
	return array_key_exists($attribute,$this->attributes());
  }
  
  protected function attributes()
  {
    $attributes=array();
	foreach(self::$db_fileds as $field)
	{
	  if(property_exists($this,$field))
	  {
	    $attributes[$field]=$this->$field;
	  }
	}
	return $attributes;
  }
  protected function sanitized_attributes()
  {
   global $database;
   $clean_attributes = array();
   foreach($this->attributes() as $key => $value)
   { $clean_attributes[$key]=$database->escape_value($value);
      
   }
   return $clean_attributes;
  }
 	
  public function full_name() {
    if(isset($this->first_name) && isset($this->last_name)) {
      return $this->first_name . " " . $this->last_name;
    } else {
      return "";
    }
  }
  
  public function create()
  {
   global $database;
   $attributes = $this->sanitized_attributes();
   $sql=" INSERT INTO ".self::$table_name." (";
   $sql .=join( ", ",array_keys($attributes));
   $sql .= ") VALUES('";
   $sql .= join("', '",array_values($attributes));
   $sql .= "')";
   if($database->query($sql))
   {
    $this->id=$database->insert_id();
	return true;
   }
   else
   {
   return false;
   }
   
  
  }

  public function update()
  {
    global $database;
	$attributes=$this->sanitized_attributes();
	$attributes_pairs=array();
	foreach($attributes as $key=>$value)
	{ $attribute_pairs[]="{$key}='{$value}'";
	}
	$sql = "UPDATE ".self::$table_name." SET ";
	$sql .= join(", ",$attribute_pairs);
	$sql .= " WHERE id=".$database->escape_value($this->id);
	$database->query($sql);
	return($database->affected_rows() == 1) ?true:false;
  }
  
  public function delete()
  {
    global $database;
	$sql=" DELETE from ".self::$table_name." ";
	$sql .=" WHERE id=".$database->escape_value($this->id);
	$sql .= " LIMIT 1";
	$database->query($sql);
	return($database->affected_rows()==1)?true:false;
  }
  public function save()
  {
    global $database;
	return isset($this->id)? $this->update():$this->create();
  }
  
  
}

$user = new User();
?>
