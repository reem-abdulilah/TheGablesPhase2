<?php

$connection =mysqli_connect("localhost","root","root","renting");
                     $error= mysqli_connect_error();
                     
                     if ($error != null){
            echo "<p>Could not connect to the database.</p>";
        }
        
        $propertyId = $_POST['delete'];


$query = "DELETE FROM RentalApplication WHERE property_id = $propertyId";
$result= mysqli_query($connection, $query);

$query = "DELETE FROM PropertyImage WHERE property_id = $propertyId";
$result= mysqli_query($connection, $query);

$query = "DELETE FROM Property WHERE id = $propertyId";
$result= mysqli_query($connection, $query);

if($result){
  header('Location: Homeowner.php');
  }
  else{
      echo 'Error deleting: ' . mysqli_error($connection);
  }
mysqli_close($connection);
?>