<?php
class DB {

    private $__conn;
    protected $_hostname;
    protected  $_username;
    protected  $_password;
    protected  $_db;

    public function __construct($_hostname, $_username, $_password, $_db){

        $this->_hostname = $_hostname;
        $this->_username = $_username;
        $this->_password = $_password;
        $this->_db= $_db;

    }


    public function connect(){

        $this->__conn = new mysqli($this->_hostname, $this->_username, $this->_password, $this->_db);
        $this->__conn->set_charset('utf8');
        // check connect
        if ($this->__conn->connect_error){
            die('connect DB failed '. $this->__con->connect_error);
        }
    }

    public function disconnect(){

        if ($this->__conn){
            $this->__conn->close();
            echo 'close successfully';
        }
    }

    // @method truy van
    public function query($table = null, $sql = null, $where = null){


        $this->connect();

        // check table null -> die
        if (empty($table)){
            die('not table');
        }

        // sql not null
        if ($sql == "SELECT"){
            $sql = "SELECT * FROM " .$table. " " .$where;
            //printf($sql);
        }

        if ($this->__conn->query($sql)){
           echo 'Done!';
        }else{
            die('die query '. $this->__conn->connect_error);
        }

    }

    // @method count num rows
    public function num_nows($sql = null)
    {

        if ($this->__conn) {

            if ($sql != null) {
                $query = $this->__conn->query($sql);
                $row = $query->num_rows;

                if (!empty($sql)) {
                    @$query = $this->__conn->query($sql);
                    @$row = $query->num_rows;

                    return $row;
                } else {
                    die('die method count num rows ' . $this->__con->connect_error);
                }
            }
        }
    }

    // @method get data
    // 1 row
    // n rows

    public function fetch_assoc($sql = null, $type)
    {

        if ($this->__conn) {

            if (!empty($sql)) {

                $query = $this->__conn->query($sql);

                if ($query) {

                    if ($type == 0) {

                        while ($row = $query->fetch_assoc()) {
                            $data[] = $row;
                        }
                        return $data;

                    } elseif ($type == 1) {

                        $data = $query->fetch_assoc();
                        return $data;

                    }

                }

            } else {
                return false;
            }
        }
    }


    // @method xu ly chuoi truy van

    public function escape_string($string){


        if (!empty($string)){

            $string = $this->__conn->real_escape_string($string);
        }else{
            die('$string null');
            return false;
        }
        return $string;
    }

    public function last_id(){

        if ($this->__conn){
            $last_id = $this->__conn->insert_id;
            return $last_id;
        }

    }


    public function insert($table, $data){

        if (empty($table)){
            return false;
        }

        if (!is_array($data)){
            return false;
        }

        $field_key = '';
        $field_val = '';

        foreach ($data as $key => $val){
            $field_key .= ", $key ";
            $field_val .= ", '" .$val. "'";
        }

        $sql = "INSERT INTO " .$table. "(" .trim($field_key, ','). ") VALUES (" .trim($field_val, ','). ")";

        if ($this->__conn->query($sql)){

            echo 'Done!';

        } else{

            die('query error ' .$this->__conn->error);
        }


    }

    public function update($table, $data, $where){

        if (empty($table)){
            return false;
        }

        if ($this->__conn){

            $sql = '';

            foreach ($data as $key => $value){

                $sql .= ", $key = '" .$this->escape_string($value). "'";

            }

            $sql = "UPDATE " .$table. " SET " .trim($sql, ','). " " .$where;

           if ($this->__conn->query($sql)){
               echo 'Done!';
           }else{
               die('die update ' .$this->__conn->connect_error);
           }


        }

    }

    public function delete($where){

        if ($this->__conn){
            $sql = "DELETE FROM notes WHERE " .$where;

            if ($this->__conn->query($sql)){
                echo 'Done!';
            }else{
                die('die query delete ' .$this->__conn->connect_error);
            }
        }


    }

}