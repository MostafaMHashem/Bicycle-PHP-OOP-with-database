<?php 

class DatabaseObject {
    
    static protected $database;
    static protected $table_name= "";
    static protected $columns = [];
    public $errors = [];
    // remember we use self for the class we use but it save the class name it's in 
    // so we use 'static' to assign the class name used in run time  


    static public function set_database($database) { 
        self::$database = $database;  
    }

    static public function find_by_sql($sql) {
        $result = self::$database->query($sql); // we get the result in a variable so that we could make benefits of the result object methods and properties
        if(!$result) {
            exit(" Database Query Failed ");
        }
        // return the results into objects 
        $object_array = [];
        while($record = $result->fetch_assoc()) {
            $object_array[] = static::instantiate($record);
        }

        $result->free();

        return $object_array;
    }

    static public function find_all() {
        $sql = "SELECT * FROM " . static::$table_name  ;
        return static::find_by_sql($sql);
    }

    static public function count_all() {
        $sql = "SELECT COUNT(*) FROM " . static::$table_name  ;
        $result_set = self::$database->query($sql);             // we get the result in a variable so that we could make benefits of the result object methods and properties
        $row = $result_set->fetch_array();                      // translate it into array with one row 
        return array_shift($row);
    }

    static public function find_by_id($id) {
        $sql = "SELECT * FROM " . static::$table_name . " " ;
        $sql .= "WHERE id='" . self::$database->escape_string($id) . "'";
        $obj_array = static::find_by_sql($sql);
        if(!empty($obj_array)) {
            return array_shift($obj_array);
        } else {
            return false;
        }
        
    }

    static public function instantiate($record) {
        $object = new static;
        // Could manually assign the properties values
        // But automatic assignment is easier and re-usable
        foreach($record as $property => $value) {
            if(property_exists($object, $property)) {
            $object->$property = $value;
            }
        }
        return $object;
    }

    protected function validate() {
        $this->errors = [];

       // add  custom code here , unique to each class


        return $this->errors;
    }

    protected function create() {
        $this->validate();
        if(!empty($this->errors)) { return false; }

        $attributes = $this->sanitized_attributes();
        $sql = "INSERT INTO " . static::$table_name . " (";
        $sql .= join(', ', array_keys($attributes));
        $sql .= ") VALUES ('";
        $sql .= join("', '", array_values($attributes) );
        $sql .= "')";

        $result = self::$database->query($sql);
        if($result) {
            $this->id = self::$database->insert_id;
        }
        return $result;
    }

    protected function update() {
        $this->validate();
        if(!empty($this->errors)) { return false; }

        $attributes = $this->sanitized_attributes();
        $attributes_pairs = [];
        foreach($attributes as $key => $value) {
            $attributes_pairs[] = "{$key}='{$value}'";
        }

        $sql = "UPDATE " . static::$table_name . " SET ";
        $sql .=join(', ', $attributes_pairs);
        $sql .= " WHERE id='" . self::$database->escape_string($this->id) . "' ";
        $sql .= "LIMIT 1";
        $result = self::$database->query($sql);
        return $result;
    }

    public function save() {
        // a new record doesn't have an id yet 
        if(isset($this->id)) {
            return $this->update();
        } else {
            return $this->create();
        }
    }

    public function merge_attributes($args=[]) {
        foreach($args as $key => $value) {
            if(property_exists($this, $key) && !is_null($value)) {
            $this->$key = $value;
            }
        }
    }

    // attributes will have tha database columns and the properties excluding the 'id'
    public function attributes() {
        $attributes = [];
        foreach(static::$db_columns as $column) {
            if($column == 'id') { continue; }
            $attributes[$column] = $this->$column;
        }
        return $attributes;
    }

    protected function sanitized_attributes() {
        $sanitized = [];
        foreach($this->attributes() as $key => $value) {
            $sanitized[$key] = self::$database->escape_string($value);
        }
        return $sanitized;
    }

    public function delete() {
        $sql = "DELETE FROM " . static::$table_name . " ";
        $sql .= "WHERE id='". self::$database->escape_string($this->id) ."'";
        $sql .= "LIMIT 1";
        $result = self::$database->query($sql);
        return $result;

        // After deleting, the instance of the object will still
        // exist, even though the database record does not.
        // This can be useful, as in:
        //   echo $user->first_name . " was deleted.";
        // but, for example, we can't call $user->update() after
        // calling $user->delete().
    }
    
}

?>
