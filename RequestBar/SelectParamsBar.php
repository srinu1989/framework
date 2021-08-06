<?php
include '../Config/ConfigFoo.php';
class SelectParams {
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
	public function getColumnswithQmark($param) {
		$arr = [];
		foreach ($param as $key => $value) {
			$arr[]  = "`".$this->Sanitize($value).'`=?';
		}
		$values = implode(' AND ', $arr);
		return $this->Sanitize($values);
	}
	public function createVariable($columns) {
		$columns =  implode(',', $columns);
		$columns = str_replace('$', '', $columns);
		return $columns;
	}
	public function getTypeofFields($columns) {
		$column_types = implode('', str_replace($columns, 's', $columns));
		$addSingleQoutes = $column_types;
		return $addSingleQoutes;
	}
	public function parameterValues($param){
		$values =	[];
		foreach ($param as $key => $value) {
		$values[$key] = $this->Sanitize(preg_replace('/[^A-Za-z0-9\-]/', '', urldecode($value)));
		}
		return $values;
	}
	public function getData($columns) {
		$arr = [];
		foreach ($columns as $key => $value) {
			$arr[] = $value;
		}
		return $arr;
	}
	public function SelectParam($table_name,$columns,$where,$param) {
		$select = $this->conn->prepare("SELECT ".$this->createVariable($columns)." FROM `".$table_name."` WHERE ".$this->getColumnswithQmark($where)."");
		$params= array_merge(array($this->getTypeofFields($where)),$this->parameterValues($param));
		$tmp1 = [];
		foreach($params as $key => $value) {
			$tmp1[$key] = &$params[$key];
		}
		call_user_func_array(array($select,'bind_param'), $tmp1);
		if ($select->execute()) {
			$tmp = array();
			foreach($columns as $key => $value) {
				$tmp[$key] = &$columns[$key];
			}
		call_user_func_array(array($select,'bind_result'), $tmp);	
			$res = [];
			while ($select->fetch()) {
				$res = $this->getData($columns);
			}
			return $res;
		}else {
			echo "sql failed";
		}
		$select->close();
	}
}
$select = new SelectParams($conn);
?>