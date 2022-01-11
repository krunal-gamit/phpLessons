 <?php

$connect= mysqli_connect("localhost","root","","phplessons");

if ($connect) {
	echo "Connected.";
}
else 
	echo "Failed."

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Manage Client</title>
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

  $q = mysqli_query($connect, "DELETE FROM CLIENT_MASTER WHERE clientId = '".$_REQUEST['deleteId']."' ");

  header("Location: manageClient.php");
}


if(isset($_REQUEST['updateId'])){

  echo $_REQUEST['updateId'];

  $oldData = mysqli_query($connect, "SELECT * FROM CLIENT_MASTER WHERE clientId = '".$_REQUEST['updateId']."' ");

  $row = mysqli_fetch_array($oldData);
      $clientName=$row['clientName'];
      $clientAddress=$row['clientAddress'];
      $clientCity=$row['clientCity'];
      $clientPin=$row['clientPin']; 
      $clientState=$row['clientState']; 
      $clientDueBal=$row['clientDueBal']; 
}

?>


<div class="container">
  <div class="row">
    <div class="col-sm-4">
    </div>
    
<form method="POST" action="">
    <div class="col-sm-4 well">
    	<h2>Manage Client</h2>
    	<div class="form-group">

  		<label for="usr">Name:</label>
  		<input type="text" class="form-control" id="clientName" <?php if (isset($_REQUEST['updateId'])) { ?> value="<?php echo $row['clientName']; ?>" <?php } ?> name="clientName">
		</div>

		<div class="form-group">
    		
  		<label for="usr">Address:</label>
  		<input type="text" class="form-control" id="clientAddress" <?php if (isset($_REQUEST['updateId'])) { ?> value="<?php echo $row['clientAddress']; ?>" <?php } ?> name="clientAddress">
		</div>

		<div class="form-group">
    		
  		<label for="usr">City:</label>
  		<input type="text" class="form-control" id="clientCity" <?php if (isset($_REQUEST['updateId'])) { ?> value="<?php echo $row['clientCity']; ?>" <?php } ?> name="clientCity">
		</div>

		<div class="form-group">
    		
  		<label for="usr">Pincode:</label>
  		<input type="text" class="form-control" id="clientPin" <?php if (isset($_REQUEST['updateId'])) { ?> value="<?php echo $row['clientPin']; ?>" <?php } ?> name="clientPin">
		</div>

		<div class="form-group">
    		
  		<label for="usr">State:</label>
  		<input type="text" class="form-control" id="clientState" <?php if (isset($_REQUEST['updateId'])) { ?> value="<?php echo $row['clientState']; ?>" <?php } ?> name="clientState">
		</div>

		<div class="form-group">
    		
  		<label for="usr">Due Balance:</label>
  		<input type="text" class="form-control" id="clientDueBal" <?php if (isset($_REQUEST['updateId'])) { ?> value="<?php echo $row['clientDueBal']; ?>" <?php } ?> name="clientDueBal">
		</div>

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
</form>
    <div class="col-sm-4">

			<?php

			if(isset($_POST['insert']))
			{

				$clientName= $_POST['clientName'];
				$clientAddress= $_POST['clientAddress'];
				$clientCity= $_POST['clientCity'];
				$clientPin= $_POST['clientPin'];
				$clientState= $_POST['clientState'];
				$clientDueBal= $_POST['clientDueBal'];
			
			$ans=mysqli_query($connect, "INSERT INTO CLIENT_MASTER (clientName, clientAddress, clientCity, clientPin, clientState, clientDueBal) VALUES ('$clientName', '$clientAddress', '$clientCity', '$clientPin', '$clientState', '$clientDueBal')");

			if($ans>0){
        header("Location: manageClient.php");
      }
      else
        echo "ERROR";
    
			}


			if(isset($_POST['update']))
    {
      $clientName= $_POST['clientName'];
				$clientAddress= $_POST['clientAddress'];
				$clientCity= $_POST['clientCity'];
				$clientPin= $_POST['clientPin'];
				$clientState= $_POST['clientState'];
				$clientDueBal= $_POST['clientDueBal'];

      $result = mysqli_query($connect, "UPDATE CLIENT_MASTER SET clientName='$clientName', clientAddress='$clientAddress', clientCity='$clientCity', clientPin='$clientPin', clientState='$clientState', clientDueBal='$clientDueBal'   WHERE clientId='".$_REQUEST['updateId']."' ");

      if($result>0){
        header("Location: manageClient.php");
      }
      else
        echo "ERROR";
    }


			?>

    </div>
  </div>

			<div class="row">
			<div class="col-sm-12 well"> 
				<table class="table"> 
					<tr>
					<th>clientId</th>
					<th>clientName</th>
					<th>clientAddress</th>
					<th>clientCity</th>
					<th>clientPin</th>
					<th>clientState</th>
					<th>clientDueBal</th>
					<th>EDIT</th>
					<th>DELETE</th>
				</tr>

				<?php

				$q = mysqli_query($connect, "SELECT * FROM CLIENT_MASTER");

				while ($row = mysqli_fetch_array($q)) {	
				
				$clientId = $row['clientId'];
				$clientName = $row['clientName'];
				$clientAddress = $row['clientAddress'];
				$clientCity = $row['clientCity'];
				$clientPin = $row['clientPin'];
				$clientState = $row['clientState'];
				$clientDueBal = $row['clientDueBal'];
				?>

				<tr>
					<td><?php echo $row['clientId']; ?></td>
					<td><?php echo $row['clientName']; ?></td>
					<td><?php echo $row['clientAddress']; ?></td>
					<td><?php echo $row['clientCity']; ?></td>
					<td><?php echo $row['clientPin']; ?></td>
					<td><?php echo $row['clientState']; ?></td>
					<td><?php echo $row['clientDueBal']; ?></td>
					<td><a  name="updateId" class="btn btn-info" href="?updateId=<?php echo $row['clientId']; ?>"> EDIT</a></td>
        <td><a  name="deleteId" class="btn btn-danger" href="?deleteId=<?php echo $row['clientId']; ?>" onclick="return confirm('Are you sure you want to delete?')"> DELETE</a></td>
      </tr>

				<?php

				}

				?>

				</table>				
			</div>	
			</div>
</div>

</body>
</html>