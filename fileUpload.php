<?php

	include 'dbConfig.php';

	$conn = mysql_connect (DB_SERVER, DB_USER, DB_PASSWORD);
	mysql_select_db (DB_NAME,$conn);
	if(!$conn){
		die( "Sorry! There seems to be a problem connecting to our database.");
	}

	function get_file_extension($file_name) {
		return end(explode('.',$file_name));
	}

	function errors($error){
		if (!empty($error))
		{
				$i = 0;
				while ($i < count($error)){
				$showError.= '<div class="msg-error">'.$error[$i].'</div>';
				$i ++;}
				return $showError;
		}// close if empty errors
	} // close function


	if (isset($_POST['upfile'])){
	// check feilds are not empty

	if(get_file_extension($_FILES["uploaded"]["name"])!= 'csv')
	{
	$error[] = 'Only CSV files accepted!';
	}

	if (!$error){

	$tot = 0;
	$handle = fopen($_FILES["uploaded"]["tmp_name"], "r");
	while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
		for ($c=0; $c < 1; $c++) {	
		
				if($data[0] !='firstName'){
					
					$sql = "SELECT id FROM adminUser WHERE Email = '".$line[4]."'";
					$result = mysqli_query($conn, $sql);

					if (mysqli_num_rows($result) > 0) {
						// output data of each row
						while($row = mysqli_fetch_assoc($result)) {
							
							$db->query("UPDATE adminUser SET firstName = '".$line[0]."', lastName = '".$line[1]."', password = '".$line[2]."', IDNumber = '".$line[3]."', Email = '".$line[4]."', Mobile = '".$line[5]."' WHERE Email = '".$line[4]."'");
						}
					} else {
						
						mysql_query("INSERT INTO adminUser(
						firstName,
						lastName,
						password,
						IDNumber,
						Email,
						Mobile
						)VALUES(
							'".mysql_real_escape_string($data[0])."',
							'".mysql_real_escape_string($data[1])."',
							'".mysql_real_escape_string($data[2])."',
							'".mysql_real_escape_string($data[3])."',
							'".mysql_real_escape_string($data[4])."',
							'".mysql_real_escape_string($data[5])."'
						)")or die(mysql_error());
						
					}
				}

		$tot++;}
	}
	fclose($handle);
	$content.= "<div class='success' id='message'> CSV File Imported, $tot records added </div>";

	}// end no error
	}//close if isset upfile
              
	
$er = errors($error);
$content.= <<<EOF
<h3>Import CSV Data</h3>
$er
<form enctype="multipart/form-data" action="" method="post" class="form-horizontal" role="form">
<div class="box-body">
	<div class="form-group">
	<label for="exampleInputFile">File input</label>
	<input name="uploaded" type="file" maxlength="20" /><input type="submit" name="upfile" value="Upload File">
	</div>
	</div>
</form>
EOF;
echo $content;
//--------------------end of upload

