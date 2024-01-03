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
       
       if(isset($_POST['logout'])) {
    // Unset all session variables
    session_unset();

    // Destroy the session
    session_destroy();

    // Redirect the user to the home page
    header("Location:index.php");
    exit();
       } 
       ?>
<!DOCTYPE html>

<html>
    <head>
        <title>Applicant Information</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
         <link rel="stylesheet" href="general.css">
         <link rel="icon" type="image/png" sizes="50x50" href="images/icon.PNG">
         
         <style>
             
             #applicant{
    background:white; 
    border-radius: 3%;
    box-shadow: 0 3px 40px rgba(0, 0, 0, 0.15);
        width:30%;
        text-align: center; 
        opacity: 0.7;
        padding: 3%;
        margin: 2% auto;
         font-family: Papyrus;
         
}

 
                                #log{
                        
           background-color: rgba(255, 255, 255, .4);
           padding: 0;
           height: 0;
           border-radius: 0;
           text-align: center;
           position: relative;
                float: right;
                                } 
                                
    #b1{
  align-items: center;
  background-color: #d3d8d3;
  border: 0;
  border-radius: 100px;
  font-family: Papyrus;
  font-size: 16px;
  font-weight: 600;
  padding: 2px 2px 2px 2px;
  text-align: center;
  width: 150px;
   margin-top: 30px;
  margin-right: 50px;
}

#b1:hover,
#b1:focus { 
  background-color: #9fb396;
  color: #ffffff;
}

#b1:active {
  background: #566051;
  color: rgb(255, 255, 255, .7);
}
         </style>
         
    </head>
    
    <body>
        <header id="header">
 <h1  id="h1">The Gables</h1>
            <img  id ="img-title" src ="images/logo.PNG" alt ="logo" width="300" height="300">
          
          <div
        id="div_top_hypers"
        style="display: flex; justify-content: space-between"
      >
             
          <ul id="ul_top_hypers">
            <li>&#8227; <a href="HomeOwner.php" class="a_top_hypers">Home Owner</a></li>
            <li>&#8227; <a href="applicant.php" class="a_top_hypers">Applicant's Information</a></li>
            
            
            
          </ul>
    
      
      </div>
          </header>
        
        <?php

$connection =mysqli_connect("localhost","root","root","renting");
                     $error= mysqli_connect_error();
                     
                     if ($error != null){
            echo "<p>Could not connect to the database.</p>";
        }
        $homeSeekerId = $_GET['id'];


$query = "SELECT * FROM HomeSeeker WHERE id = $homeSeekerId";
$result = mysqli_query($connection, $query);
         $row = mysqli_fetch_assoc($result);
        
        ?>
        
        <main>
             <form method="POST" id = "log">
                    <button type="submit" name="logout" style="font-size: 24px; color: #51311b; float: right;" id="b1">Log Out</button> 
                </form>
        <div id="applicant">
           <h1>Applicant Information</h1>
            <br>
            <strong>First name:</strong> <?php echo $row["first_name"]; ?> <br><br>
           <strong> Last name:</strong> <?php echo $row["last_name"]; ?> <br><br>
            <strong> Age:</strong> <?php echo $row["age"]; ?> <br><br>
             <strong> Job:</strong> <?php echo $row["job"]; ?> <br><br>
               <strong> Income:</strong> <?php echo $row["income"]; ?> <br><br>
            <strong> Number of family members:</strong> <?php echo $row["family_member"]; ?> <br><br>
            <strong> Phone number:</strong> <?php echo $row["phone_number"]; ?>  <br><br>
           <strong> Email:</strong> <?php echo $row["email_address"]; ?>
            <br><br>
        </div>
        </main>
        
        <footer id="foot">
            <h4>@copyRight</h4>
        </footer>
    </body>
</html>

