<?php
	$con=mysqli_connect("localhost","root","","batch2");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
	<form method="POST">
		<div class="row">
			<div class="col-sm-4">
			</div>
			<div class="col-sm-4 well">
				<h4>Manage Student</h4>
				<div class="form-group">
				  <label for="usr">Name:</label>
				  <input type="text" class="form-control" id="studentName" name="studentName">
				</div>
				<div class="form-group">
				  <label for="usr">Contact:</label>
				  <input type="text" class="form-control" id="studentContact" name="studentContact">
				</div>
				<div class="form-group">
				  <label for="usr">Email:</label>
				  <input type="text" class="form-control" id="studentEmail" name="studentEmail">
				</div>
				<div class="form-group">
				  <label for="usr">City:</label>
				  <input type="text" class="form-control" id="studentCity" name="studentCity">
				</div>
				<input type="submit" class="btn btn-primary" value="Insert Data" id="btnInsert" name="btnInsert"/>
				<input type="submit" class="btn btn-info" value="Update Data" id="btnUpdate" name="btnUpdate"/>
			</div>
			<div class="col-sm-4">
				<?php
					if(isset($_POST['btnInsert']))
					{
						$studentName=$_POST['studentName'];
						$studentContact=$_POST['studentContact'];
						$studentEmail=$_POST['studentEmail'];
						$studentCity=$_POST['studentCity'];
						$result=mysqli_query($con,"INSERT INTO student_master (studentName,studentContact,studentEmail,studentCity) VALUES ('$studentName','$studentContact','$studentEmail','$studentCity')");
						if($result>0)
							echo "Data Inserted";
						else
							echo "Fail";
					}
				?>
			</div>
		</div>
		
		<div class="row">
			<div class="col-sm-12">
				<table class="table">
					<tr>
						<th>studentId</th>
						<th>studentName</th>
						<th>studentContact</th>
						<th>studentEmail</th>
						<th>studentCity</th>
						<th>Edit</th>
						<th>Delete</th>
					</tr>
					<?php
						$getData=mysqli_query($con,"SELECT * FROM student_master");
						while($row=mysqli_fetch_array($getData))
						{
							?>
							<tr>
								<td><?php echo $row['studentId'];?></td>
								<td><?php echo $row['studentName'];?></td>
								<td><?php echo $row['studentContact'];?></td>
								<td><?php echo $row['studentEmail'];?></td>
								<td><?php echo $row['studentCity'];?></td>
								<td>Edit</td>
								<td>Delete</td>
							</tr>
							<?php
							
						}
					?>
				</table>
			</div>
		</div>
	</form>
</div>

</body>
</html>