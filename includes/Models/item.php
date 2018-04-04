<?php
require_once(LIB_PATH.'initialize.php');

class Item
{
    public $item_id;
    public $name;
    public $brand_name;
    public $quantity;
    public $price;
    public $category;
    public $description;

    //Images File property
    public $filename;
    public $type;
    public $size;

    public $temp_path;
    public $upload_dir ="images";
    public $errors=array();


    static $table_name = "items";
    static $db_fields = array('item_id','name','brand_name','quantity','price','category','description','filename','type','size');

//===========================Item Functions=====================================================
    //reduce num items from the quantity
    public function reduce_item($num)
    {
        if($this->quantity - $num >= 0)
        {
        $this->quantity -= $num;
        self::update();
        return true;
        }
        return false;
    }

    public static function update_item_quantity($id,$quantity)
    {
        $rows = self::find_by_id($id);
        $row = mysqli_fetch_array($rows);
        $item_to_update = new self();
        $item_to_update = self::instantiate($row);
        $item_to_update->quantity -= $quantity;
        $item_to_update->update();
    }
    //=========================Images Functions==================================================

    protected $upload_errors = array(
        UPLOAD_ERR_OK => "No errors.",
        UPLOAD_ERR_INI_SIZE => "Larger than upload_max_filesize.",
        UPLOAD_ERR_FORM_SIZE => "Larger than form MAX_FILE_SIZE.",
        UPLOAD_ERR_PARTIAL => "Partial upload.",
        UPLOAD_ERR_NO_FILE => "No file.",
        UPLOAD_ERR_NO_TMP_DIR => "No temporary directory.",
        UPLOAD_ERR_CANT_WRITE => "Can't write to disk.",
        UPLOAD_ERR_EXTENSION => "File upload stopped by extansion."
    );

    public function destroy()
    {
        if($this->delete())
        {
            $target_path = SITE_ROOT.'public'.DS.'images'.DS.$this->filename;
            return unlink($target_path) ? true : false;
        }
        else
        {
            return false;
        }
    }

    public function attach_file($file)
    {
        if(!$file || empty($file) || !is_array($file))
        {
            $this->errors[] = "No file was uploaded.";
            return false;
        }
        else if($file['error'] != 0)
        {
            $this->errors[] = $this->upload_errors[$file['error']];
            return false;
        }
        else
        {
            $this->temp_path  =$file['tmp_name'];
            $this->filename   =basename($file['name']);//basename show the file name with extansion (.jpg/.png...)
            $this->type       =$file['type'];
            $this->size       =$file['size'];
            return true;
        }
    }

    public function image_path()
    {
        return $this->upload_dir.DS.$this->filename;
    }

    public function save()
    {
        if(isset($this->item_id))
        {
            $this->update();
        }
        else
        {
            if(!empty($this->errors))
            {
                return false;
            } 
            if(empty($this->filename) || empty($this->temp_path))
            {
                $this->errors[] = "The file location was not available.";
                return false;
            }

            $target_path = SITE_ROOT .DS. 'public' .DS. $this->upload_dir .DS. $this->filename; 

            if(file_exists($target_path))
            {
                $this->errors[] = "The file already exists.";
                return false;
            }

            if(move_uploaded_file($this->temp_path, $target_path));
            {
                if($this->create())
                {
                    unset($this->temp_path);
                    return true;
                }
                else
                {
                    $this->errors[] = "The file upload field.";
                    return false;
                }
            }
            
        }
    }
        
    
    //=========================Common Database Function===========================================

    //making simple variable to object with instances of his class, getting row result from db
    public static function instantiate($record)
    {
        $object = new self;

        foreach($record as $attribute=>$value)
        {
            if(property_exists('Item',$attribute))
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
            $this->item_id = mysqli_insert_id($conn);
            $attributes['item_id'] = $this->item_id;
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
        $sql .= " WHERE item_id=".$this->item_id;
        $conn = new mysqli(DB_SERVER,DB_USER,null,DB_NAME);
        $conn->query($sql);
        return(mysqli_affected_rows($conn) == 1) ? true : false;
    }

    
    //delete function
    public function delete()
    {
        $sql = "DELETE from " . self::$table_name;
        $sql .= " WHERE item_id= " . $this->item_id;
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
        return self::find_by_sql("SELECT * from ".self::$table_name . " where item_id='{$id}'");
    }
    
    public static function find_by_category($category)
    {
        return self::find_by_sql("SELECT * from ".self::$table_name . " where category ='{$category}'");
    }
    
}


?>