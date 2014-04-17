<?php 
require_once("database.php");
class matches
{
 protected static $table_name="matches"; 
 protected static $db_fileds=array('id','teamA','teamB');
 
 public $id;
 public $teamA;
 public $teamB;
 
 private $temp_path;
 protected $upload_dir="images";
 public $errors=array();
 
 protected $upload_errors=array(
  UPLOAD_ERR_OK => "no errors",
  UPLOAD_ERR_INI_SIZE => "LARGER THAN UPLOAD_MAX_FILE SIZE",
  UPLOAD_ERR_FORM_SIZE => "LARGER THAN UPLOAD MAX FORM FILE SIZE",
  UPLOAD_ERR_PARTIAL => "PARTIAL UPLOAD",
  UPLOAD_ERR_NO_FILE => "NO FILE",
  UPLOAD_ERR_NO_TMP_DIR => "NO TEMPORARY DIRECTORY",
  UPLOAD_ERR_CANT_WRITE => "CANT WRITE TO DISK",
  UPLOAD_ERR_EXTENSION => "FILE STOPPED BY EXTENSION"
   );
 
 public function attach_file($file)
 {
   if(!$file || empty($file) || !is_array($file))
   { $this->errors[] = "No file was uploaded!";
     return false;
   }
   elseif($file['error']!=0)
   {
     $this->errors[] = $this->upload_errors[$file['error']];
	 return false;
   }
   else
   {
     $this->filename=basename($file['name']);
	 $this->temp_path=$file['tmp_name'];
	 $this->type=$file['type'];
	 $this->size=$file['size'];
	 return true;
   }
 }
 
 
 
 public static function find_all()
  {
   return self::find_by_sql("select * from ".self::$table_name);
  }
  
  public static function count_all()
  {
     global $database;
	 $sql= " SELECT COUNT(*) FROM ".self::$table_name;
	 $result_set = $database->query($sql);
	 $row = $database->fetch_array($result_set);
	 return array_shift($row);
  }
  public static function find_by_id($id=0)
  {
  global $database;
  $result_array = self::find_by_sql("select * from ".self::$table_name. " where id=".$database->escape_value($id)." limit 1");
   return !empty($result_array)? array_shift($result_array) : false;
  }
  public static function find_by_sid($id=0)
  {
  global $database;
  $result_array = self::find_by_sql("select * from ".self::$table_name. " where sid=".$database->escape_value($id)." limit 1");
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
  
 /* public static function authenticate($username,$password)
  { global $database;
    
    $username= $database->escape_value($username);
    $password= $database->escape_value($password);
	$sql = "SELECT * from ".self::$table_name;
	$sql .= " where username='{$username}' ";
	$sql .= " and password='{$password}' ";
	$sql .= " limit 1";
	$result_array = self::find_by_sql($sql);
	return !empty($result_array)? array_shift($result_array) : false;
  } */
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
  
  public function destroy()
  {
   if($this->delete())
   { 
     $target_path= SITE_ROOT.DS.'public'.DS.$this->image_path();
	 return unlink($target_path) ? true:false;
   }
   else
   {
    return false;
   }
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
	if(isset($this->id)) { $this->update(); }
	else
	{
	  if(!empty($this->errors)) { return false;}
	  if(strlen($this->caption) >= 255)
	  { $this->errors[] = "The caption can only be 255 characters long";
	     return false;
	  }
	  if(empty($this->filename) || empty($this->temp_path))
	  {
	    $this->errors[] = "The file location was not available";
		return false;
	  }
	  $target_path = SITE_ROOT.DS.'public'.DS.$this->upload_dir.DS.$this->filename;
	  if(file_exists($target_path))
	  {
	    $this->errors[]="The file {$this->filename} already exists";
		return false;
	  }
	  
	  if(move_uploaded_file($this->temp_path,$target_path))
	  {
	   if($this->create())
	    { unset($this->temp_path);
		  return true;
		}
	  }
	  else
	  {
	   $this->errors[]="The file upload failed!!!!";
	   return false;
	  }
	}
  }
  public function image_path()
  {
    return $this->upload_dir."/".$this->filename;
  }
  public function size_as_text()
  {
    if($this->size < 1024 )
	 { return "{$this->size} bytes";
	 }
    
	elseif($this->size < 1048576 )
	 { $size_kb = round($this->size/1024);
	   return "{$size_kb} KB";
	  }
	 else
	 { $size_mb = round($this->size/1048576,1);
	   return "{$size_mb} MB";
	 }
  }
  
  public function comments()
  {
    return Comment::find_comments_on($this->id);
  }
  
}

$matches = new matches();
?>
