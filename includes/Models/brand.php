<?php
require_once(LIB_PATH.'initialize.php');

class Brand
{
    public $brand_id;
    public $brand_name;

    static $table_name = "brands";
    static $db_fields = array('brand_id','brand_name');

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

    //making simple variable to object with instances of his class
    public static function instantiate($record)
    {
        $object = new self;

        foreach($record as $attribute=>$value)
        {
            if(property_exists('Brand',$attribute))
                $object->$attribute = $value;
        }
        return $object;
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
            $this->category_id = mysqli_insert_id($conn);
            $attributes['brand_id'] = $this->brand_id;
            return true;
        }
        return false;
    }
    
    
    //delete function
    public function delete()
    {
        $sql = "DELETE from " . self::$table_name;
        $sql .= " WHERE brand_id= " . $this->brand_id;
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
    return self::find_by_sql("SELECT * from ".self::$table_name . " where brand_id='{$id}'");
    }   
    
    
}
?>