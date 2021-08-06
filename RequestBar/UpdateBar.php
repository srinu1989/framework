<?php
include '../Interfaces/interfaces.php';
include '../Config/ConfigFoo.php';
class UpdateQuery implements Update
{
	public function __construct($conn)
	{
		$this->conn = $conn;
	}
	public function TableName($table_name)
	{
		if (!empty($table_name)) {
			$table_name = array_pop($_POST);
			return $table_name;
		}
	}
	public function Columns($columns)
	{
		if (!empty($columns)) {
			$array_keys = array_keys($_POST);
			$columns = array_slice($array_keys, 0, -2);
			return $columns;
		}
	}
	public function DataValues($data)
	{	
		$arr  = [];	
		if (!empty($data)) {
			foreach ($data as $key => $value) {
				if (!is_array($value)) {
					$arr[] = $value;
				} else {
					$arr[] = implode(',', $value);
				}
			}
		//	$array_values = array_values($_POST);
			$data = array_slice(array_values($arr), 0, -1);
			return $data;
		}
	}
	public function getTypeofFields($columns)
	{
		$column_types = implode('', str_replace($columns, 's', $columns));
		$addSingleQoutes = $column_types;
		return $addSingleQoutes;
	}
	public function preAssignedValues($columns)
	{
		$column_fields = implode(',', str_replace($columns, '?', $columns));
		return $column_fields;
	}
	public function getColumnswithQmark($columns)
	{
		$arr = [];
		foreach ($columns as $key => $value) {
			$arr[] = "`" . $value . '`=?';
		}
		$values = implode(',', $arr);
		return $values;
	}
	public function parameterValues($columns,$data){
		$values =	[];
		$count = 0;
		foreach ($data as $key => $value) {
			$values[] = $data[$key];
		}
		return $values;
	}
	public function Update($table_name,$columns,$data,$where_columns,$where_values)
	{
		$update = $this->conn->prepare("UPDATE `".$table_name."` SET ".$this->getColumnswithQmark($columns)." WHERE ".$this->getColumnswithQmark($where_columns)."");
		$final_columns = array_merge($columns,$where_columns);
		$params= array_merge(array($this->getTypeofFields($final_columns)), $this->parameterValues($final_columns,$data));
		$tmp = [];
		foreach($params as $key => $value) {
			$tmp[$key] = &$params[$key];
		}
		call_user_func_array(array($update, 'bind_param'), $tmp);
		if($update->execute()) {
			echo 200;
		} else {
			echo 500;
			die("Failed :".$update->error);
		}
		$update->close();
	}
}
$update = new UpdateQuery($conn);
?>