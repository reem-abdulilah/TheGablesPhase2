<?php  session_start();

       if(!isset($_SESSION["id"]))
       {
           header("Location:index.php");
           exit();
       }
       else if ($_SESSION["role"]=="HomeSeeker")
       {
            header("Location:index.php");
           exit();
       }
       

$connection =mysqli_connect("localhost","root","root","renting");
                     $error= mysqli_connect_error();
                     
                     if ($error != null){
            echo "<p>Could not connect to the database.</p>";
        }
        
  $status = $_POST['status'];
  $rental_application_id = $_POST['rental_application_id'];


$query1 = "UPDATE RentalApplication SET application_status_id = (SELECT id FROM ApplicationStatus WHERE status = '$status') WHERE id = '$rental_application_id'";
$result = mysqli_query($connection, $query1);
 
if ($status == 'accepted') {
    $query2 = "UPDATE RentalApplication SET application_status_id =
        (SELECT id FROM ApplicationStatus WHERE status = 'declined') 
        WHERE id IN (
  SELECT id FROM (
    SELECT id FROM RentalApplication WHERE property_id = (
      SELECT property_id FROM RentalApplication WHERE id = '$rental_application_id') AND id !='$rental_application_id'
  ) AS subquery
)";
    $result = mysqli_query($connection, $query2);
  }
  
  if($result){
  header('Location: Homeowner.php');
  }
  else{
      echo 'Error updating status: ' . mysqli_error($connection);
  }
 mysqli_close($connection);
 ?>




