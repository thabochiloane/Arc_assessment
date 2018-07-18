<?php

include 'dbConfig.php';

$sql = "SELECT * FROM adminUser";
$result = $conn->query($sql);

?>
	<div class="box">
	<div class="box-header">
	  <h3 class="box-title">Member List | <a href="addmember.php">Add New Member</a></h3>
	</div>
	<!-- /.box-header -->
	<div class="box-body">
	  <table id="example1" class="table table-bordered table-striped">
		<thead>
		<tr>
		  <th>First Name</th>
		  <th>Last Name</th>
		  <th>Password</th>
		  <th>ID Number</th>
		  <th>Email</th>
		  <th>Mobile</th>
		  <th>Edit</th>
		  <th>Delete</th>
		</tr>
		</thead>
		<tbody>
        <?php
			if ($result->num_rows > 0) {
				// output data of each row
				while($row = $result->fetch_assoc()) {
					?>
                    <tr>
                      <td><?php echo $row['firstName']; ?></td>
                      <td><?php echo $row['lastName']; ?></td>
                      <td><?php echo $row['password']; ?></td>
                      <td><?php echo $row['IDNumber']; ?></td>
                      <td><?php echo $row['Email']; ?></td>
                      <td><?php echo $row['Mobile']; ?></td>
                      <td><a href="editmember.php?Email=<?php echo $row["Email"]; ?>">Edit</a></td>
                      <td><a href="deleteMember.php?Email=<?php echo $row["Email"];?>">Delete</a></td>
                    </tr>
                    <?php } }else{ ?>
                    <tr><td colspan="5">No member(s) found.....</td></tr>
                    <?php } ?>
        </tbody>
	  </table>
		</div>
	<!-- /.box-body -->
    </div>
		<?php
			$conn->close();
?>