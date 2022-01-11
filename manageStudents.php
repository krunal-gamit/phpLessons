
<?php
$connect = mysqli_connect("localhost","root","","phplessons");
if($connect){
  echo "connected!";
}
?>

 <!DOCTYPE html>
<html lang="en">
<head>
  <title>MANAGE STUDENT</title>
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

  $q = mysqli_query($connect, "DELETE FROM STUDENT_MASTER WHERE studentId = '".$_REQUEST['deleteId']."' ");

  header("Location: manageStudents.php");
}


if(isset($_REQUEST['updateId'])){

  echo $_REQUEST['updateId'];

  $oldData = mysqli_query($connect, "SELECT * FROM STUDENT_MASTER WHERE studentId = '".$_REQUEST['updateId']."' ");

  $row = mysqli_fetch_array($oldData);
      $studentName=$row['studentName'];
      $studentContact=$row['studentContact'];
      $studentEmail=$row['studentEmail'];
      $studentCity=$row['studentCity']; 
}

?>


<div class="container">

<form method="POST" action="">

  <div class="row">
    
    <div class="col-sm-4 ">
      
    </div>
    <div class="col-sm-4 well">
     
      <h2>Manage Students</h2>
      <div class="form-group">
      <label for="usr">Name:</label>
      <input type="text" class="form-control" id="studentName" <?php if (isset($_REQUEST['updateId'])) { ?> value="<?php echo $row['studentName']; ?>" <?php } ?> name="studentName">
      </div>


      <div class="form-group">
      <label for="usr">Contact:</label>
      <input type="text" class="form-control" id="studentContact" <?php if (isset($_REQUEST['updateId'])) { ?> value="<?php echo $row['studentContact']; ?>" <?php } ?> name="studentContact">
      </div>


      <div class="form-group">
      <label for="usr">Email:</label>
      <input type="text" class="form-control" id="studentEmail" <?php if (isset($_REQUEST['updateId'])) { ?> value="<?php echo $row['studentEmail']; ?>" <?php } ?> name="studentEmail">
      </div>

      <div class="form-group">
      <label for="usr">City:</label>
      <input type="text" class="form-control" id="studentCity" <?php if (isset($_REQUEST['updateId'])) { ?> value="<?php echo $row['studentCity']; ?>" <?php } ?> name="studentCity">
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



    <div class="col-sm-4">
    <?php

    if(isset($_POST['insert']))
    {
      $studentName=$_POST['studentName'];
      $studentContact=$_POST['studentContact'];
      $studentEmail=$_POST['studentEmail'];
      $studentCity=$_POST['studentCity'];

      $result = mysqli_query($connect, "INSERT INTO STUDENT_MASTER (studentName,studentContact,studentEmail,studentCity) VALUES ('$studentName','$studentContact','$studentEmail','$studentCity')");

      if($result>0){
        header("Location: manageStudents.php");
      }
      else
        echo "ERROR";
    }
    

    if(isset($_POST['update']))
    {
      $studentName=$_POST['studentName'];
      $studentContact=$_POST['studentContact'];
      $studentEmail=$_POST['studentEmail'];
      $studentCity=$_POST['studentCity'];

      $result = mysqli_query($connect, "UPDATE STUDENT_MASTER SET studentName='$studentName', studentContact='$studentContact', studentEmail='$studentEmail', studentCity='$studentCity' WHERE studentId='".$_REQUEST['updateId']."' ");

      if($result>0){
        header("Location: manageStudents.php");
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
        <th>studentId</th>
        <th>studentName</th>
        <th>studentContact</th>
        <th>studentEmail</th>
        <th>studentCity</th>
        <th>Edit</th>
        <th>Delete</th>
      </tr>
      
      <?php
      $getquery=mysqli_query($connect,"SELECT * FROM STUDENT_MASTER");
      while ($row=mysqli_fetch_array($getquery)) {
      ?>

      <tr>
        <td><?php echo $row['studentId']; ?></td>
        <td><?php echo $row['studentName']; ?></td>
        <td><?php echo $row['studentContact']; ?></td>
        <td><?php echo $row['studentEmail']; ?></td>
        <td><?php echo $row['studentCity']; ?></td>
        <td><a  name="updateId" class="btn btn-info" href="?updateId=<?php echo $row['studentId']; ?>"> EDIT</a></td>
        <td><a  name="deleteId" class="btn btn-danger" href="?deleteId=<?php echo $row['studentId']; ?>" onclick="return confirm('Are you sure you want to delete?')"> DELETE</a></td>
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