<?php

class Dbobject
{
	private $servername;
	private $username;
	private $password;
	private $database;
	private $conn;
	private $table;
	private $primary_key;
	private $primary_value;
	function __construct($servername,$username,$password,$database)
	{
		# code...
		$this->servername=$servername;
		$this->username=$username;
		$this->password=$password;
		$this->database=$database;
		$this->table=null;
		$this->primary_value=null;
		$this->primary_key=null;
		$this->conn = new mysqli($servername,$username,$password,$database);
		// Check connection
		if ($this->conn->connect_error) {
    		die("Connection failed: " . $conn->connect_error);
		} 

	}
	public function setTable($value)
	{
		# code...
		$this->table=$value;
	}
	public function setPrimaryKey($value)
	{
		# code...
		$this->primary_key=$value;
	}
	public function setPrimaryValue($value)
	{
		# code...
		$this->primary_value=$value;
	}

	public function grabfromTab($table,$primary_key,$primary_value,$column)
	{
		# code...
		$sql="SELECT $column FROM $table WHERE $primary_key='$primary_value'";
		$result=$this->conn->query($sql);
		if ($result->num_rows > 0) {
    		// output data of each row
    		$row = $result->fetch_assoc();
    		if($column=='*'){
    			return $row;
    		}else{
    			return $row[$column];
    		}  	
    	}
    	else{
    		return "error";
    	}
	}
	public function grabdata($primary_key,$primary_value,$column)
	{
		# code...
		$sql="SELECT $column FROM $this->table WHERE $primary_key='$primary_value'";
		$result=$this->conn->query($sql);
		if ($result->num_rows > 0) {
    		// output data of each row
    		$row = $result->fetch_assoc();
    		if($column=='*'){
    			return $row;
    		}else{
    			return $row[$column];
    		}  	
    	}
    	else{
    		return "error";
    	}

	}
	public function grabvalue($column)
	{
		$sql="SELECT $column FROM $this->table WHERE $this->primary_key='$this->primary_value'";
		$result=$this->conn->query($sql);
		if ($result->num_rows > 0) {
    		// output data of each row
    		$row = $result->fetch_assoc();
    		if($column=='*'){
    			return $row;
    		}else{
    			return $row[$column];
    		}  	
    	}
    	else{
    		return "error";
    	}
	}

}
?>