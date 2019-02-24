<?php 
class db {

    private $conn;
    private $server, $user, $pwd, $db_name;

    public $result;

    function __construct( $server, $user, $pwd, $db_name ) {

        $this->server = $server;
        $this->user = $user;
        $this->pwd = $pwd;
        $this->db_name = $db_name;

        $this->connect();

    }

    public function connect() {

        $this->conn = new mysqli(
            $this->server,
            $this->user,
            $this->pwd,
            $this->db_name
        );

        if( !$this->conn ) {
            die("Connection failed: " . mysqli_connect_error());
        }

    } 

    public function query( $query = null ) {

        $this->result = $this->conn->query( $query );
        return $this->result;

    }

    public function fetch_data() {

        $data = $this->result::fetch_all( MYSQLI_ASSOC );
        $this->free();

        return $data;
    }

    public function real_escape_string( $string = null ) {
        return $this->conn->real_escape_string( $string );
    }

    public function insert_id() {
        return mysqli_insert_id( $this->conn );
    }

    public function free() {
        $this->result->free();
    }

    public function close() {
        $this->conn->close();
    }
}