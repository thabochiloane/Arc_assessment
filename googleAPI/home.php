<?php
session_start();
//check if user logged in or else go to login page
if(!isset($_SESSION['access_token'])) {
	header('Location: google-login.php');
	exit();	
}

?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<title>ARC Assessment</title>
		<script src="jquery.min.js"></script>
		<link rel="stylesheet" href="styles.css">

	</head>

<body>

<div id="form-container">
	<input type="text" id="spreadsheet-title" placeholder="Spreadsheet Title" autocomplete="off" />
	<button id="create-spreadsheet">Create Spreadsheet</button>
</div>

<script>

// Send an ajax request to create spreadsheet
$("#create-spreadsheet").on('click', function(e) {
	var blank_reg_exp = /^([\s]{0,}[^\s]{1,}[\s]{0,}){1,}$/;

	$(".input-error").removeClass('input-error');

	if(!blank_reg_exp.test($("#spreadsheet-title").val())) {
		$("#spreadsheet-title").addClass('input-error');
		return;
	}

	$("#create-spreadsheet").attr('disabled', 'disabled');
	$.ajax({
        type: 'POST',
        url: 'ajax.php',
        data: { spreadsheet_title: $("#spreadsheet-title").val() },
        dataType: 'json',
        success: function(response) {
        	$("#create-spreadsheet").removeAttr('disabled');
        	alert('Spreadsheet created in Google Drive with with ID : ' + response.spreadsheet_id);
        },
        error: function(response) {
            $("#create-spreadsheet").removeAttr('disabled');
            alert(response.responseJSON.message);
        }
    });
});

</script>

</body>
</html>