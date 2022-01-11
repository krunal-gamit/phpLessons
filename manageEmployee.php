<?php

$conn = mysqli_connect('localhost','root','','phplessons');

if ($conn) {
	echo "Connected.";
}
else
	echo "Failed.";
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <title>MANAGE EMPLOYEE</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<script type="text/javascript">
  
  function insertMsg() {
    alert("Your record has been successfully Saved!");
    return true;
  }

  function updateMsg() {
    alert("Your record has been successfully Updated!");
    return true;
  }

</script>


<body>

<?php

if(isset($_REQUEST['deleteId'])){

  echo $_REQUEST['deleteId'];

  $q = mysqli_query($conn, "DELETE FROM EMPLOYEE_MASTER WHERE employeeId = '".$_REQUEST['deleteId']."' ");

  header("Location: manageEmployee.php");
}


if(isset($_REQUEST['updateId'])){

  echo $_REQUEST['updateId'];

  $oldData = mysqli_query($conn, "SELECT * FROM EMPLOYEE_MASTER WHERE employeeId = '".$_REQUEST['updateId']."' ");

  $row = mysqli_fetch_array($oldData);
      $employeeName=$row['employeeName'];
      $employeeContact=$row['employeeContact'];
      $employeeEmail=$row['employeeEmail'];
      $employeeSalary=$row['employeeSalary']; 
}

?>



<div class="container mt-5">
	<form method="POST" action="">
  <div class="row">
    <div class="col-sm-4">
      
    </div>
    
    <div class="col-sm-4 well">
    	<h2>MANAGE EMPLOYEE</h2>
      	<div class="form-group">
		  <label for="usr">Name:</label>
		  <input type="text" class="form-control" id="employeeName" <?php if (isset($_REQUEST['updateId'])) { ?> value="<?php echo $row['employeeName']; ?>" <?php } ?> name="employeeName">
		</div>
		<div class="form-group">
		  <label for="usr">Contact:</label>
		  <input type="text" class="form-control" id="employeeContact" <?php if (isset($_REQUEST['updateId'])) { ?> value="<?php echo $row['employeeContact']; ?>" <?php } ?> name="employeeContact">
		</div>
		<div class="form-group">
		  <label for="usr">Email:</label>
		  <input type="text" class="form-control" id="employeeEmail" <?php if (isset($_REQUEST['updateId'])) { ?> value="<?php echo $row['employeeEmail']; ?>" <?php } ?> name="employeeEmail">
		</div>
		<div class="form-group">
		  <label for="usr">Salary:</label>
		  <input type="text" class="form-control" id="employeeSalary" <?php if (isset($_REQUEST['updateId'])) { ?> value="<?php echo $row['employeeSalary']; ?>" <?php } ?> name="employeeSalary">
		</div>

		<br>
		<?php
      if (isset($_REQUEST['updateId'])) {
        ?>
      <input type="submit" class="btn btn-info" id="update" name="update" value="Update" onclick="updateMsg()">
      <?php
      }
      else
      {
      ?>
      <input type="submit" class="btn btn-primary" id="insert" name="insert" value="Insert" onclick="insertMsg()">
      <?php 
      }
       ?>

    </div>
    
    <div class="col-sm-4">

    	<?php

    	if(isset($_POST['insert'])){

    		$employeeName = $_POST['employeeName'];
    		$employeeContact = $_POST['employeeContact'];
    		$employeeEmail = $_POST['employeeEmail'];
    		$employeeSalary = $_POST['employeeSalary'];

    		$q = "INSERT INTO employee_master (employeeName,employeeContact,employeeEmail,employeeSalary) VALUES ('$employeeName','$employeeContact','$employeeEmail','$employeeSalary')";
    		$insert=mysqli_query($conn,$q);

    		if($insert>0){
        header("Location: manageEmployee.php");
      }
      else
        echo "ERROR";
    }


    if(isset($_POST['update']))
    {
      $employeeName = $_POST['employeeName'];
    		$employeeContact = $_POST['employeeContact'];
    		$employeeEmail = $_POST['employeeEmail'];
    		$employeeSalary = $_POST['employeeSalary'];

      $result = mysqli_query($conn, "UPDATE EMPLOYEE_MASTER SET employeeName='$employeeName', employeeContact='$employeeContact', employeeEmail='$employeeEmail', employeeSalary='$employeeSalary' WHERE employeeId='".$_REQUEST['updateId']."' ");

      if($result>0){
        header("Location: manageEmployee.php");
      }
      else
        echo "ERROR";
    }

    	?>
    		<br><br>
    </div>
  </div>


  <div class="row">
    <div class="col-sm-12 well">
	
	<table class="table">
		
		<tr>
			<th>employeeId</th>
			<th>employeeName</th>
			<th>employeeContact</th>
			<th>employeeEmail</th>
			<th>employeeSalary</th>
			<th>Edit</th>
       <th>Delete</th>
		</tr>

		
			<?php
				$result = mysqli_query($conn, "SELECT * FROM employee_master");

					while ($row =mysqli_fetch_array($result)) {
						$emlpoyeeId = $row['employeeId'];
						$employeeName = $row['employeeName'];
						$employeeContact = $row['employeeContact'];
						$employeeEmail = $row['employeeEmail'];
						$employeeSalary = $row['employeeSalary'];

						?>
						<tr>
						<td><?php echo $row['employeeId']; ?></td>
						<td><?php echo $row['employeeName']; ?></td>
						<td><?php echo $row['employeeContact']; ?></td>
						<td><?php echo $row['employeeEmail']; ?></td>
						<td><?php echo $row['employeeSalary']; ?></td>
						<td><a  name="updateId" class="btn btn-info" href="?updateId=<?php echo $row['employeeId']; ?>"> EDIT</a></td>
        <td><a  name="deleteId" class="btn btn-danger" href="?deleteId=<?php echo $row['employeeId']; ?>" onclick="return confirm('Are you sure you want to delete?')"> DELETE</a></td>
						</tr>

						<?php

					}

			?>
		


	</table>      



    </div>


  </form>
</div>

</body>
</html>
