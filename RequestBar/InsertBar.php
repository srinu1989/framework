<?php
include '../Config/ConfigFoo.php';
include '../Interfaces/interfaces.php';
class Insert implements Data {
	public function __construct($conn) {
		$this->conn = $conn;
	}
	public function getDate() {
		date_default_timezone_set('Asia/Kolkata');
		$date = date('d-m-y');
		return $date;	
	}
	public function Columns($columns) {
		if (!empty($columns)) {
			$array_keys = array_keys($_POST);
			$columns = array_slice($array_keys , 0, -2);
			return $columns;
		}
	}
	public function DataValues($data) {
		if (!empty($data)) {
			$array_values = array_values($_POST);
			$data = array_slice(array_values($_POST), 0, -2);
			return $data;
		}
	}
	public function addColumn($columns,$extracolumns) {

		return array_merge($columns,$extracolumns);

	}
	public function addValue($data,$extravalues) {
		
		return array_merge($data,$extravalues);
		
	}
	public function TableName($table_name) {
		if (!empty($table_name)) {
			$table_name = array_pop($_POST);
			return $table_name;	
		}
	}
	public function Sanitize($data) {
		if (is_array($data)) {
			return htmlspecialchars_decode(htmlentities(stripslashes(strip_tags(implode(',', $data)))));
		}
		if (!is_array($data)) {
			return htmlspecialchars_decode(htmlentities(stripslashes(strip_tags(trim($data)))));
		}
	}
	public function getTypeofFields($columns) {
		$column_types = implode('', str_replace($columns, 's', $columns));
		$addSingleQoutes = $column_types;
		return $addSingleQoutes;
	}
	public function preAssignedValues($columns) {
		$column_fields = implode(',', str_replace($columns, '?', $columns));
		return $column_fields;
	}
	public function ColumnNames($columns) {
		$addSingleQoutes = [];
		foreach ($columns as $key => $value) {
			$addSingleQoutes[$key] = "`".$value."`";
		}
		$field_names = implode(',', $addSingleQoutes);	
		return $field_names;
	}
	public function parameterValues($columns,$data){
		$values =	[];
		foreach ($columns as $key => $value) {
			$values[$key] = $this->Sanitize($data[$key]);
		}
		return $values;
	}
	public function insert($table_name, $columns, $data) {
		$sql = $this->conn->prepare("INSERT INTO `".$table_name."`(".$this->ColumnNames($columns).") VALUES(".$this->preAssignedValues($columns).")");
		$params= array_merge(array($this->getTypeofFields($columns)),$this->parameterValues($columns,$data));
		$tmp = [];
		foreach($params as $key => $value) {
			$tmp[$key] = &$params[$key];
		}
		call_user_func_array(array($sql, 'bind_param'), $tmp);
		if($sql->execute()) {
			echo 200;
		} else {
			echo 500;
			die("Failed :".$sql->error);
		}
		$sql->close();
	}
}
$myObj = new Insert($conn);

?>	