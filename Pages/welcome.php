<?php
include '../CssJsFooBar.php';
$page->Styles();
?>
<div class="container mb-5">
	<div class="row">
		<div class="col-md-12">
			<h1 class="display-4 mt-2 text-center"> Welcome to my small <span class="text-warning">FooBar</span> framework</h1>
			<hr>
			<h6 class="text-center"><span class="text-primary">Hello Guest...!!!</span> Please follow Documentation</h6>
			<hr>
		</div>
	</div>
	<div class="row mt-3">
		<div class="col-md-6">
			<div class="bg-light p-3">
				<h6 class="text-primary">Styles & Scripts</h6>
				<hr>
				<pre>include '../CssJsFooBar.php';</pre>
				<pre>$page->Styles();</pre>
				<pre>$page->Scripts();</pre>
				<b><pre>Add Extra Style or Script in CssJsFooBar.php</pre></b>
			</div>
		</div>
		<div class="col-md-6">
			<div class="bg-light p-3">
				<h6 class="text-dark">Database Connection</h6>
				<hr>
				<pre>Change Settings in Config Folder</pre>
				<pre>$conn = $myObj->connect($servername,$username,$password,$dbname);</pre>
				<b><pre>Defualt:</pre></b>
				<pre>Severname->Localhost, username->root, password->'';</pre>

			</div>
		</div>		
	</div>	
	<div class="row mt-3">
		<div class="col-md-6">
			<div class="bg-light p-3">
				<h6 class="text-success">Insert Data</h6>
				<hr>
				<pre>Create all ajax redirection pages in <b>RequestFoo</b> Folder</pre>
				<pre>include '../RequestBar/InsertBar.php';</pre>
				<b><pre>To get table column fields</pre></b>
				<pre>$columns = $myObj->Columns($_POST);</pre>
				<hr>
				<b><pre>To get POST values </pre></b>
				<pre>$data = $myObj->DataValues($_POST);</pre><hr>
				<b><pre>To add extra column fields </pre></b>
				<pre>$extracolumns = ["Column1","Columns2"];</pre>
				<pre>$columns = $myObj->addColumn($columns,$extracolumns);</pre><hr>
				<b><pre>To add extra data values </pre></b>
				<pre>$extravalues = [$UniqueId,$addedOn];</pre>
				<pre>$data = $myObj->addValue($data,$extravalues);</pre>
			</div>
		</div>
		<div class="col-md-6">
			<div class="bg-light p-3">
				<h6 class="text-secondary">Select (or) Get Data</h6>
				<hr>
				<pre>include '../RequestBar/SelectBar.php';</pre>
				<pre>$table_name = 'table_name';</pre>
				<pre>$columns = ['$column1','$columns2','$column3',....];</pre>
				<pre>$myObj->Select($table_name,$columns);</pre>
			</div>
			<div class="bg-light p-3 mt-4">
				<h6 class="text-info">Select (or) Get Data With Unique Identy</h6>
				<hr>
				<pre>include '../routing/routeBar.php';</pre>
				<pre>include '../RequestBar/SelectParamsBar.php';</pre>
				<pre>$param = [$get->param(0),...]; (or) $get->allParams();</pre>
				<pre>$table_name = 'table_name';</pre>
				<pre>$columns = ['$column1','$columns2','$column3',....];</pre>
				<pre>$where = ['UniqueId'];</pre>
				<pre>$select->SelectParam($table_name,$columns,$where,$param);</pre>
			</div>
		</div>
	</div>
	<div class="row mt-3">
		<div class="col-md-6">
			<div class="bg-light p-3">
				<h6 class="text-danger">Delete Data</h6>
				<hr>
				<pre>include '../RequestBar/DeleteBar.php';</pre>
				<pre>$columns = $myObj->getColumns($_POST);</pre>	
				<pre>$data = $myObj->getColumnsValues($_POST);</pre>
				<pre>$table_name = $myObj->TableName($_POST);</pre>
				<pre>$myObj->Delete($table_name,$columns,$data);</pre>
				
			</div>
		</div>
		<div class="col-md-6">
			<div class="bg-light p-3">
				<h6 class="text-dark">Update Data</h6>
				<hr>
				<pre>include '../RequestBar/UpdateBar.php';</pre>
				<pre>$table_name ='table_name';</pre>
				<pre>$columns = $update->Columns($_POST);</pre>
				<pre>$data = $update->DataValues($_POST);</pre>
				<pre>$where_columns = ['ColumnName'];</pre>
				<pre>$where_values = [$_POST["ColumnValue"],...];</pre>
				<small><pre>$update->Update($table_name,$columns,$data,$where_columns,$where_values);</pre></small>
			</div>
		</div>		
	</div>			
	<hr>
	<footer><p class="text-right">Thank you -  Anudeep Puris</p></footer>
</div>
<?php
$page->Scripts();
?>
