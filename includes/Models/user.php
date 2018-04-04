<?php
require_once('database.php');

class User
{
    public $user_id;
    public $email;
    public $password;
    public $first_name;
    public $last_name;
    public $reg_date;

    //shipping details
    public $ship_address;
    public $ship_city;
    public $ship_postal_code;
    public $ship_country;

    static $table_name = "users";
    static $db_fields = array('user_id','email','password','first_name','last_name','reg_date',
    'ship_address', 'ship_city', 'ship_postal_code','ship_country');


    public static function authenticate($email,$pass)
    {
        $sql = "SELECT * from users ";
        $sql .= "WHERE email= '{$email}' AND";
        $sql .= " password = '{$pass}'";

        $result = self::find_by_sql($sql);
        $row = mysqli_fetch_array($result);
        if($row != null)
        {
            $userAsObject = self::instantiate($row);
            return $userAsObject;
        }
        return null;
    }

    //making simple variable to object with instances of his class
    public static function instantiate($record)
    {
        $object = new self;

        foreach($record as $attribute=>$value)
        {
            if(property_exists('User',$attribute))
                $object->$attribute = $value;
        }
        return $object;
    }


//=========================Common Database Function===========================================

//making array with instances name and instances values
public function attributes()
{
    $attributes = array();
    foreach(self::$db_fields as $field)
    {
        if(property_exists($this,$field))
        {
            $attributes[$field] = $this->$field;
        }
    }
    return $attributes;
}
//insert object to database with his instances
public function create()
{
    $attributes = $this->attributes();
    $sql = "INSERT INTO " . self::$table_name . " (";
    $sql .= join(",", array_keys($attributes));
    $sql .= ")VALUES('";
    $sql .= join("','", array_values($attributes));
    $sql .= "')";
    
    $conn = new mysqli(DB_SERVER,DB_USER,null,DB_NAME);

    if($conn->query($sql))
    {
        $this->user_id = mysqli_insert_id($conn);
        $attributes['user_id'] = $this->user_id;
        return true;
    }
    return false;
}

//update function
public function update()
{
    $attributes = $this->attributes();
    //new instances array
    $attribute_pairs = array();
    foreach($attributes as $key => $value)
    {
        $attribute_pairs[] = "{$key}='{$value}'";
    }
    $sql = "UPDATE ".self::$table_name." SET ";
    $sql .= join(",",$attribute_pairs);
    $sql .= " WHERE user_id=".$this->user_id;
    $conn = new mysqli(DB_SERVER,DB_USER,null,DB_NAME);
    $conn->query($sql);
    return(mysqli_affected_rows($conn) == 1) ? true : false;
}

//delete function
public function delete()
{
    $sql = "DELETE from " . self::$table_name;
    $sql .= " WHERE user_id= " . $this->user_id;
    $conn = new mysqli(DB_SERVER,DB_USER,null,DB_NAME);
    $conn->query($sql);
    return(mysqli_affected_rows($conn) == 1) ? true : false;
}

//sending query to database and return query result
public static function find_by_sql($sql)
{
    global $database;
    $result = $database->query($sql);
    return $result;
}

//select all data from the table 
public static function find_all()
{
    return self::find_by_sql("SELECT * from ".self::$table_name);
}

//select by id
public static function find_by_id($id)
{
    return self::find_by_sql("SELECT * from ".self::$table_name . " where user_id='{$id}'");
}

public static function count()
{
    $res = self::find_by_sql("SELECT count(*) as count from ".self::$table_name);
    $row = mysqli_fetch_array($res);
    return $row['count'];
}

public static function is_email_exist($email)
{
    $res = self::find_by_sql("SELECT * from users where email='{$email}'");
    $row = mysqli_fetch_array($res);

    if($row['email'] == '')
        return true;
    else
        return false;
}

}

?>