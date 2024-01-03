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
        <title>Home Owner</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="general.css">
         <link rel="icon" type="image/png" sizes="50x50" href="images/icon.PNG">
        <style>
           
            main{
     margin: 3%;
 }
 
 #logOut a:link {
    color:#51311b;
    text-decoration: none;
    font-weight: bold;
    font-size: 140%;

}

#logOut a:visited {
    color: #51311b;
}

#logOut a:hover {
    color: #898b77;
}

#top{
    
    background-color:#d3d8d3;
    color:#566051;
   float: left;
     width: 50%;
   
}

#top2{
   
    color:black;
    text-align:center;
}

#top2 a, #top2 a:visited{
    color:black;
     text-decoration: none; 
  background-color: #d3d8d3;
  border: 0;
  border-radius: 100px;
 font-weight:bold;
 font-size: 120%;
  padding: 30px;
  box-shadow: 20px 10px 40px rgba(0, 0, 0, 0.15);
}

#top2 a:hover{
   background-color: #9fb396;
}

#top2 a:active {
  background: #566051;
  color: rgb(255, 255, 255, 0.7);
}

#welcomingOwner{
    font-style: italic;
    font-size:140%;
     font-family: Papyrus;
}

#logOut, #add{
    float: right;
}

.table h2{
    margin: 5%;
    margin-bottom: 1%;
    
}

.table table{
    background:white;
   border-collapse: collapse;
   
    box-shadow: 0 3px 40px rgba(0, 0, 0, 0.15);
}


.table{
    width:70%;
    margin-left: auto;
    margin-right: auto;
}

.table td, .table th{
     padding: 5%;
         text-align: center;
         font-family: Papyrus;
       width:8%;

}

.table td{
     border-top: 1.5px solid #dddddd;
}



#app{
    background-color: #d3d8d3;
     font-size: 110%;
    
}

#prop{
    background-color: #d3d8df;
    font-size: 110%;
}

.table td:hover {
      background-color: #F8F8FF;

}

.table a:link {
    color: #4d856d;
}

.table a:visited {
    color: #51311b;
}

.table a:hover {
    color: #898b77;
}



#add a:link{
    color:black;
    text-decoration: none;
    font-weight: bold;
    font-size: 120%;
  background-color: #d3d8d3;
  border-radius: 100px;
  padding: 30px;
  box-shadow: 20px 10px 40px rgba(0, 0, 0, 0.15);
}

#add a:hover{
     background-color: #9fb396;
}

#add a:active {
  background: #566051;
  color: rgb(255, 255, 255, 0.7);
}

#OwnerInfo{
    
    text-align: left;
    font-size: 130%;
    font-family: Papyrus;
    
}

button{
  align-items: center;
  background-color: #d3d8d3;
  border: 0;
  border-radius: 100px;
  font-family: Papyrus;
  font-size: 16px;
  font-weight: 600;
  padding-left: 20px;
  padding-right: 20px;
  text-align: center;
}

button:hover,
button:focus { 
  background-color: #9fb396;
  color: #ffffff;
}

button:active {
  background: #566051;
  color: rgb(255, 255, 255, .7);
}

        </style>
    </head>
    
    <body>
    <header id="header">
    <h1 id="h1">The Gables</h1>
            <img  id ="img-title" src ="images/logo.PNG" alt ="logo" width="300" height="300">
           
          
          <div
        id="div_top_hypers"
        style="display: flex; justify-content: space-between"
      >
             
          <ul id="ul_top_hypers">
            <li>&#8227; <a href="HomeOwner.php" class="a_top_hypers">Home Owner</a></li>
            
            
            
          </ul>
    
      
      </div>
          </header>
     <?php 
     


     if (!isset($_SESSION['id'])) {
  header('Location: logIn.php');
  exit;
     }
     
     $connection=mysqli_connect("localhost","root","root","renting");
                     $error= mysqli_connect_error();
                     
                     if ($error != null){
            echo "<p>Could not connect to the database.</p>";
        }
        
       else {     
            
        $ownerID= $_SESSION['id']; 
        
        $all = "SELECT * FROM homeowner WHERE id = $ownerID";
        $results = mysqli_query($connection, $all);
    
       }
                while ($row = mysqli_fetch_assoc($results)):;
            ?>
               
        
       
        <main>
            <aside id="logOut" title="Log Out">
                <form method="POST">
                    <button type="submit" name="logout" style="font-size: 24px; color: #51311b;">Log Out</button>
                </form>
            </aside>
            <br><br>
         
        
        <div id="top">
           
            <h1>
                <pre id="welcomingOwner"> Welcome <?php echo $row["name"] ?>!</pre>
            </h1>

            <pre id="OwnerInfo" title="Your Information!">       <strong>Name:</strong> <?php echo $row["name"] ?> 
  <strong>     Phone Number:</strong> <?php echo $row["phone_number"] ?> 
  <strong>     Email:</strong> <?php echo $row["email_address"] ?></pre>
             <?php
                endwhile;
            ?>
            
        </div>
            
            <div id ="top2">
                <br><br>
                <h1>  What do you want to view? </h1> <br>
                <a class="frag" href="#app">Rental Applications</a>
                <a class="frag" href="#prop">Listed Property</a>
            </div>
            
            <br><br><br><br> 
        <div class="table">
        <h2>Rental Applications</h2>
        
        <?php
               $sql ="SELECT
          Property.name AS property_name,
          Property.location AS property_location,
          Property.id AS property_id,
          CONCAT(HomeSeeker.first_name, ' ', HomeSeeker.last_name) AS applicant_name,
          RentalApplication.id AS rental_application_id,
          RentalApplication.home_seeker_id AS home_seeker_id,
          ApplicationStatus.status AS application_status
        FROM RentalApplication
        INNER JOIN Property ON RentalApplication.property_id = Property.id
        INNER JOIN HomeSeeker ON RentalApplication.home_seeker_id = HomeSeeker.id
        INNER JOIN ApplicationStatus ON RentalApplication.application_status_id = ApplicationStatus.id";
                
            $results2 = mysqli_query($connection, $sql);
            
                ?>
        
        <table title="Rental Applications Table">
            
           
                <tr id="app">
    <th>Property Name</th>
    <th>Location</th>
     <th>Applicant</th>
     <th>Status</th>
    <th></th>
  </tr>
       <?php while ($row = mysqli_fetch_assoc($results2)):; 
       ?>
  <tr>
      
       
      <td><a href="Property_details.php?id= <?php echo $row["property_id"]; ?>">
               <?php echo $row["property_name"];
                ?> </a></td>
                
                <td>
                    <?php echo $row["property_location"];
                    ?>
                </td>
                    
                    <td> <a href="applicant.php?id= '<?php echo $row["home_seeker_id"]; ?>'"> 
                    <?php echo $row["applicant_name"];
                    ?>
                        </a></td>
                    
                    <td>
                    <?php echo $row["application_status"];
                    ?>
                </td>
                    
                    <td>
                        <form method="POST" action="updateStatus.php">
                            
                             <input type='hidden' name='rental_application_id' value='<?php echo $row["rental_application_id"]; ?>'> 
                            <button type='submit' name='status' value='accepted' style= "font-size:70%; color: green"> ✔ Accept</button>
                    <button type='submit' name='status' value='declined' style= "font-size:65%; color: red;" > ✘ Decline</button>
                        </form>
                </td>
                
            
  </tr>
  <?php
                endwhile;
               
            ?>
  

</table>
        <br><br><br><br>
        <div id="add">
        <a href="Add_new_property.php" title="Add Property">＋ Add Property</a>
        </div>
        </div>
        
        <div class="table">
        <h2>Listed Properties</h2>
        
         <?php
           $sql2= "SELECT p.*, pc.category
FROM Property p
INNER JOIN PropertyCategory pc ON p.property_category_id = pc.id
WHERE p.homeowner_id = $ownerID AND (
  p.id NOT IN (
    SELECT property_id
    FROM RentalApplication
    WHERE application_status_id = 0000
  ) OR p.id NOT IN (
    SELECT property_id
    FROM RentalApplication
  )
)";
                
            $results3= mysqli_query($connection, $sql2);
            
                ?>
        
        <table title="Listed Property Table">
            
  <tr id="prop">
    <th>Property Name</th>
    <th>Category</th>
     <th>Rent</th>
     <th>Rooms</th>
     <th>Location</th>
    <th></th>
  </tr>
  
  <?php while ($row = mysqli_fetch_assoc($results3)):; 
       ?>
  
  <tr>
      
       <td><a href="Property_details.php?id= <?php echo $row["id"]; ?>">
               <?php echo $row["name"];
                ?> </a></td>
                
     
      <td>
                    <?php echo $row["category"];
                    ?>
                </td>
      
      <td> <?php echo $row["rent_cost"];?> /Month</td>
      
   <td>  <?php echo $row["rooms"];
   ?> </td>
    
    <td>
                    <?php echo $row["location"];
                    ?>
                </td>
    
    <td>
        <form method="POST" action="deleteProperty.php">
        <button name="delete" value="<?php echo $row["id"]; ?>" style="font-size: 70%; color: black;">Delete</button>
        </form>
    </td>
    
     <?php
                endwhile;
                mysqli_close($connection);
            ?>
  </tr>
  
  
</table>
        </div>
        </main>
        <footer id="foot">
            <h4>@copyRight</h4>
        </footer>
        
    </body>
</html>