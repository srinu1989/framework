<?php
include '../Config/ConfigFoo.php';
include '../Interfaces/interfaces.php';

class DeleteDataQuery implements Delete {
	function __construct($conn)
	{
		$this->conn = $conn;
	}
	public function Sanitize($data) {
		if (is_array($data)) {
			return htmlspecialchars_decode(htmlentities(stripslashes(strip_tags(implode(',', $data)))));
		}
		if (!is_array($data)) {
			return htmlspecialchars_decode(htmlentities(stripslashes(strip_tags(trim($data)))));
		}
	}
	public function TableName($table_name) {
		if (!empty($table_name)) {
			$table_name = array_pop($_POST);
			return $table_name;	
		}
	}
	public function getColumns($columns) {
		if (!empty($columns)) {
			$array_keys = array_keys($_POST);
			$columns = array_slice($array_keys , 0, -1);
			return $columns;
		}
	}
	public function getColumnswithQmark($columns) {
		$arr = [];
		foreach ($columns as $key => $value) {
			$arr[]  = "`".$value.'`=?';
		}
		$values = implode(' AND ', $arr);
		return $values;
	}
	public function getColumnsValues($data) {
		$filter = array_slice($data, 0, -1);
		return $filter;
	}
	public function getTypeofFields($columns) {
		$column_types = implode('', str_replace($columns, 's', $columns));
		$addSingleQoutes = $column_types;
		return $addSingleQoutes;
	}
	public function parameterValues($columns,$data){
		$values =	[];
		$count = 0;
		foreach ($data as $key => $value) {
			$values[] = $data[$key];
		}
		return $values;
	}
	public function Delete($table_name,$columns,$data) {
		$delete = $this->conn->prepare("DELETE FROM `".$table_name."` WHERE ".$this->getColumnswithQmark($columns)."");
		$params= array_merge(array($this->getTypeofFields($columns)), $this->parameterValues($columns,$data));
		$tmp = [];
		foreach($params as $key => $value) {
			$tmp[$key] = &$params[$key];
		}
		var_dump($params);
		call_user_func_array(array($delete, 'bind_param'), $tmp);
		if($delete->execute()) {
			echo 200;
		} else {
			echo 500;
			die("Failed :".$delete->error);
		}
		$delete->close();
	}
}
$myObj = new DeleteDataQuery($conn);

?>