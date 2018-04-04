<?php
require_once(LIB_PATH.'initialize.php');

class Cart_items
{
    public $cart_id;
    public $item_id;
    public $item_price;
    public $quantity;
    public $total;

    static $table_name = "Cart_items";
    static $db_fields = array('cart_id','item_id','item_price','quantity','total');

    //=========================Common Database Function===========================================

    //making simple variable to object with instances of his class, getting row result from db
    public static function instantiate($record)
    {
        $object = new self;

        foreach($record as $attribute=>$value)
        {
            if(property_exists('Cart_items',$attribute))
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
            return true;
        return false;
    }
    
    //delete function
    public function delete()
    {
        $sql = "DELETE from " . self::$table_name;
        $sql .= " WHERE cart_id= " . $this->cart_id;
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
        return self::find_by_sql("SELECT * from ".self::$table_name . " where cart_id='{$id}'");
    }
    
    
}



?>