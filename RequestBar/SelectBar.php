<?php
include '../Config/ConfigFoo.php';
include '../Interfaces/interfaces.php';
	class getDataQuery implements getData
	{
		function __construct($conn)
		{
			$this->conn = $conn;
		}
		public function createVariable($columns) {
				$columns =  implode(',', $columns);
				$columns = str_replace('$', '', $columns);
				return $columns;
		}
		public function bindValues($data) {
				$values  = implode(',', $columns);
				return $values;
		}
		public function getData($columns) {
					$arr = [];
					foreach ($columns as $key => $value) {
						if ($value !== "NULL") {
							$arr[] = $value;
						}
					}
					return $arr;
		}
		public function Select($table_name,$columns) {
			$select = $this->conn->prepare("SELECT ".$this->createVariable($columns)." FROM `".$table_name."`");
				if ($select->execute()) {
						$tmp = array();
						foreach($columns as $key => $value) {
							$tmp[$key] = &$columns[$key];
						}
						call_user_func_array(array($select, 'bind_result'), $tmp);	
						$result = [];
						while ($select->fetch()) {
								$result[] = $this->getData($columns);
						}
						return $result;
				}
				$select->close();
		}
	}
$myObj = new getDataQuery($conn);	
?>