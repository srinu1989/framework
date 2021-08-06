<?php 
	
	interface Data {

			 function Insert($table_name, $columns, $data);
	}

	interface getData {

			function Select($table_name,$data);
	}

	interface Delete {

			 function Delete($table_name, $columns, $data);
	}

	interface Update {

			 function Update($table_name,$columns,$data,$where_columns,$where_values);
	}

?>