<?php
require_once(LIB_PATH.'initialize.php');

class Contact
{
    public $contact_id;
    public $contact_email;
    public $subject;
    public $message;
    public $time;
    static $table_name = "contact_us";
    static $db_fields = array('contact_id','contact_email','subject','message','time');

    public static function instantiate($record)
    {
        $object = new self;

        foreach($record as $attribute=>$value)
        {
            if(property_exists('Contact',$attribute))
                $object->$attribute = $value;
        }
        return $object;
    }
    
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
            $this->contact_id = mysqli_insert_id($conn);
            $attributes['contact_id'] = $this->contact_id;
            return true;
        }
        return false;
    }
    
    //delete function
    public function delete()
    {
        $sql = "DELETE from " . self::$table_name;
        $sql .= " WHERE contact_id= " . $this->contact_id;
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
        return self::find_by_sql("SELECT * from ".self::$table_name." order by contact_id desc");
    }
    
    //select by id
    public static function find_by_id($id)
    {
        return self::find_by_sql("SELECT * from ".self::$table_name . " where contact_id='{$id}'");
    }

    public static function new_messages_count()
    {
        $res = self::find_by_sql("SELECT count(is_read) as count from ".self::$table_name." where is_read = 0");
        $row = mysqli_fetch_array($res);
        return $row['count'];
    }
}

?>