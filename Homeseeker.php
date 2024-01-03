<?php  session_start();

       if(!isset($_SESSION["id"]))
       {
           header("Location:index.php");
           exit();
       }
       else if ($_SESSION["role"]=="HomeOwner")
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
        <title>Home Seeker</title>
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
    color: #51311b ;
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

#welcomingSeeker{
    font-style: italic;
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
    /*font-family: montserrat; */
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



#req{
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

#SeekerInfo{
    
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
 <h1  id="h1">The Gables</h1>
            <img  id ="img-title" src ="images/logo.PNG" alt ="logo" width="300" height="300">
           
          
          <div
        id="div_top_hypers"
        style="display: flex; justify-content: space-between"
      >
             
          <ul id="ul_top_hypers">
            <li>&#8227; <a href="Homeseeker.php" class="a_top_hypers">Home Seeker</a></li>
            
            
            
          </ul>
    
      
      </div>
          </header>
     <?php 
     
     
     $connection=mysqli_connect("localhost","root","root","Renting");
                     $error= mysqli_connect_error();
                     
                     if ($error != null){
            echo "<p>Could not connect to the database.</p>";
        }
        
          else {   
            
        $seekerID= $_SESSION['id']; 
        $all = "SELECT * FROM homeseeker WHERE id = $seekerID "; 
        $results = mysqli_query($connection, $all);
         /*$sql1="SELECT * FROM RentalApplication where home_seeker_id = $seekerID ";
         $result1= mysqli_query($connection, $sql1);
         $app_information = mysqli_fetch_assoc($result1);*/
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
                <pre id="welcomingSeeker"> Welcome <?php echo $row["first_name"] ?>!</pre>
            </h1>

            <pre id="SeekerInfo" title="Your Information!">       <strong>Name:</strong> <?php echo $row["first_name"].' '.$row["last_name"] ?> 
  <strong>     Phone Number:</strong> <?php echo $row["phone_number"] ?> 
  <strong>     Email:</strong> <?php echo $row["email_address"] ?></pre>
             <?php
                endwhile;
            ?>
            
        </div>
            
            <div id ="top2">
                <br><br>
                <h1>  What do you want to view? </h1> <br>
                <a class="frag" href="#req">Requested Homes</a>
                <a class="frag" href="#prop">Homes for Rent</a>
            </div>
            
            <br><br><br><br> 
            
        <div class="table">
        <h2>Requested Homes</h2>
          <?php
          
           $sql2="SELECT * FROM Property  p join RentalApplication r on p.id=r.property_id join ApplicationStatus s on s.id=r.application_status_id 
               join PropertyCategory cat on cat.id=p.property_category_id
where  home_seeker_id=$seekerID ";
                     
                      $result2= mysqli_query($connection, $sql2);
              
                ?>
        <table title="Rental Applications Table">
            
           
                <tr id="req">
    <th>Property Name</th>
    <th>Category</th>
     <th>Rent</th>
     <th>Status</th>
    
  </tr>
  
        <?php while($value= mysqli_fetch_assoc($result2)){
       ?>
  <tr>
      <td><a href="Property_details.php?id=<?php echo$value["property_id"];?>">
               <?php echo($value["name"]);?></a></td>
      
      <td><?php echo($value["category"]);?> </td>
      <td><?php echo($value["rent_cost"]);?> </td>
    <td><?php echo($value["status"]) ;?></td>
     <?php } ?>
  </tr>
  


  
</table>
        <br><br><br><br>
        
        
        <div id="add">
            <FORM method="GET" action="" id="category_submit" >
            <label style="font-size: 110%">Search by category:</label>
        <select style="font-family: Papyrus; font-size: 100%"  id="category" name="category" onchange="submit('category_submit')">
              <option disabled selected>Category </option>"
               <?php 
             $sql4="SELECT * FROM PropertyCategory";
           $result4= mysqli_query($connection, $sql4);
          
        
             while( $category_information = mysqli_fetch_assoc($result4)){
                 
                
                    echo("<option value=".$category_information["id"].">".$category_information["category"]."</option>");}
                   ?>
   
  </select>
            </FORM>
        </div>
        </div>
        
        <div class="table">
        <h2>Homes for Rent</h2>
        <table title="Homes for Rent Table">
            
  <tr id="prop">
    <th>Property Name</th>
    <th>Category</th>
     <th>Rent</th>
     <th>Rooms</th>
     <th>Location</th>
    <th></th>
  </tr>
  
  <?php
                    
            $sql3="select *, p.id as property_id from Property p join PropertyCategory c on p.property_category_id=c.id 
where p.id not in (select property_id from RentalApplication where home_seeker_id=$seekerID)";
                    

    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
     
     if(isset($_GET['category'])){
         
        
     $category= $_GET['category'];
     
      $sql3="select *, p.id as property_id from Property p join PropertyCategory c on p.property_category_id=c.id 
where p.id not in (select property_id from RentalApplication where home_seeker_id=$seekerID) and c.id=$category";
     

      }
      else{
           $sql3="select *, p.id as property_id from Property p join PropertyCategory c on p.property_category_id=c.id 
where p.id not in (select property_id from RentalApplication where home_seeker_id=$seekerID)";
          
      }
 }
     

                      $result3= mysqli_query($connection, $sql3);
                
                   while($value1= mysqli_fetch_assoc($result3)){
      
                      
                    ?>
  <tr>
    <td class="Property" ><a href="Property_details.php?id=<?php echo$value1["property_id"];?>">  <?php echo($value1["name"]);?></a></td>
    <td><?php echo($value1["category"]);?></td>
    <td><?php echo($value1["rent_cost"]);?></td>
  <td> <?php echo($value1["rooms"]);?></td>
  <td><?php echo($value1["location"]);?></td>
  
  <td><form method="POST" action="HomeSeeker.php" >
                             <input type="hidden" name="property_id" value="<?php  echo$value1["property_id"]; ?>">
                             <button type="submit">Apply</button>
                         </form></td>
   <?php }?>
                         
                         <?php

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
     
     if(isset($_POST['property_id'])){
         
        
     $property_id= $_POST['property_id'];
     $status_id=2;
     
       $sqlid="SELECT id FROM RentalApplication";
                        $resultid=mysqli_query($connection, $sqlid);
                        $newid=0;
                        while($rowid= mysqli_fetch_assoc($resultid)){
                            $newid=$rowid['id'];      
                        }                                              
                       $newid = (int)$newid + 1;
                        
    $sql_add = "INSERT INTO RentalApplication VALUES ($newid, $property_id, '$seekerID', $status_id)";
                 mysqli_query($connection,$sql_add);
                         echo '<script>window.location="HomeSeeker.php"</script>';

      }
 }
     
?>
       
  </tr>

</table>
        <script>
    function submit(id){
        var form = document.getElementById(id);


            form.submit();
    }
</script>
        </div>
        </main>
        <footer id="foot">
            <h4>@copyRight</h4>
        </footer>
    </body>
</html>
