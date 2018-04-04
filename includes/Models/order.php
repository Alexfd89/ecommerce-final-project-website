<?php
require_once(LIB_PATH.'initialize.php');

class Order
{
    public $order_id;
    public $user_id;
    public $cart_id;

    public $order_date;

    public $user_name;
    public $ship_address;
    public $ship_city;
    public $ship_postal_code;
    public $ship_country;
    public $ship_phone;

    public $total_price;
    public $credit_card;

    static $table_name = "orders";
    static $db_fields = array('order_id','user_id','cart_id','order_date','user_name','ship_address','ship_city','ship_postal_code','ship_country','ship_phone','total_price','credit_card');

    //=========================Common Database Function===========================================

    //making simple variable to object with instances of his class, getting row result from db
    public static function instantiate($record)
    {
        $object = new self;

        foreach($record as $attribute=>$value)
        {
            if(property_exists('Order',$attribute))
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
            $this->order_id = mysqli_insert_id($conn);
            $attributes['order_id'] = $this->order_id;
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
        $sql .= " WHERE order_id=".$this->order_id;
        $conn = new mysqli(DB_SERVER,DB_USER,null,DB_NAME);
        $conn->query($sql);
        return(mysqli_affected_rows($conn) == 1) ? true : false;
    }
    
    //delete function
    public function delete()
    {
        $sql = "DELETE from " . self::$table_name;
        $sql .= " WHERE order_id= " . $this->order_id;
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
        return self::find_by_sql("SELECT * from ".self::$table_name." order by order_id desc");
    }
    
    //select by id
    public static function find_by_id($id)
    {
        return self::find_by_sql("SELECT * from ".self::$table_name . " where order_id='{$id}'");
    }

    public static function new_orders_count()
    {
        $res = self::find_by_sql("SELECT count(is_watched) as count from ".self::$table_name." where is_watched = 0");
        $row = mysqli_fetch_array($res);
        return $row['count'];
    }
    
    
}




?>