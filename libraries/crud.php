<?php

require_once("connection.php");


class CRUD{


	//Insert Method
	public function insertData($table, $columns, $values){

		$sql ="INSERT INTO $table ($columns) VALUES($values)";
			
		$insert = mysqli_query($GLOBALS['DB'],  $sql) or die("Failed Insertion");
		return $insert;
			
	}
	
	//Select Method
	public function selectData($table, $columns, $conditions){
	
		$sql = "SELECT $columns FROM $table";
		
		if($conditions !=""){
		
			$sql .="  WHERE $conditions";
		}
	
		$rows = mysqli_query($GLOBALS['DB'],  $sql) or die("Failed Selection");	
		$array = [];
		
		while($re = mysqli_fetch_assoc($rows)){		
			$array[] = $re;		
		}
		
		return $array;
	}
	
	//Delete Method
	public function deleteData($table, $conditions){
	
		$sql = "DELETE FROM $table WHERE $conditions";
	
		$row = mysqli_query($GLOBALS['DB'], $sql) or die(mysqli_error($GLOBALS['DB']));
	
		return $row;
	
	}
	
	// Update Method
	function updateData($table, $data, $conditions){
	
		$sql = "UPDATE $table SET $data WHERE $conditions";
			
		$row = mysqli_query($GLOBALS['DB'], $sql) or die(mysqli_error($GLOBALS['DB']));
	
		return $row;
	
	}
	
	//Select Method For one row
	public function select_one($table, $conditions){
	
		$sql = "select * from $table where $conditions";
		
		$rows = mysqli_query($GLOBALS['DB'],  $sql) or die("Failed Select One row");
		
		$row = mysqli_fetch_assoc($rows);
		
		
		return $row;
	}
	
}



