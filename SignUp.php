<?php
$connection =mysqli_connect("localhost","root","root","Renting");
if($connection==false)
{ die(mysqli_connect_errno());}

if(isset($_POST["signup"] )   ){
   $email = $connection->real_escape_string($_POST["email"]);
    $sql= "SELECT email_address FROM HomeSeeker where email_address = '$email'  ";
    $result = mysqli_query($connection, $sql);
    
    //if the user already exists in database
    if(mysqli_num_rows($result)>0)
    {
         echo '<script>alert("The email already in use ")</script>';
    }
    else{
    $sql = "INSERT INTO HomeSeeker (first_name, last_name, age, family_member, income, job, phone_number, email_address, password) VALUES
            (?,?,?,?,?,?,?,?,?) ";
    
  //prepare statement
    if($statement = mysqli_prepare($connection, $sql))
    {
        $pass = password_hash($_POST["password"], PASSWORD_DEFAULT);
        mysqli_stmt_bind_param($statement, "ssiidssss",$_POST["fname"] ,$_POST["lname"]  , $_POST["age"],$_POST["Family"],$_POST["income"]
                ,$_POST["job"],$_POST["phoneNumber"] , $_POST["email"],$pass );
        //execute prepare statement
        mysqli_stmt_execute($statement);
        
        session_start();
                             $_SESSION['role']= "HomeSeeker";
                             $email = $_POST['email'] ;
                             $next_increment = 1;
                             $sql = "SELECT id FROM HomeSeeker where email_address ='$email' ";
                             $result= mysqli_query($connection, $sql);
                             while($row= mysqli_fetch_assoc($result))
                                     $next_increment=$row['id'];
                          
                             $_SESSION['id']=$next_increment;
                           
                           
       header("Location:homeseeker.php");
      
    }
}
}
    

?>

<!doctype html>
<html>
    <head>
        <title>Sign-up</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel ="stylesheet" href="general.css">
         <link rel="icon" type="image/png" sizes="50x50" href="images/icon.PNG">
        <style>
            body{
              background: url("images/bimg.png") ;
background-repeat: no-repeat ;
 width: 100vw;
  
  background-size: cover;
            }
 #div-form{
 display: flex;
     flex-direction: column;
  justify-content: center;
  text-align: center;
   font-size: 1em;
  
  width: 20%;
  height:35%;
  
  padding: 2%;
  background-color: #5d6d4a;
    border-radius: 0.6em;
      opacity: 0.8;
      
        margin: 0;
  position: absolute;
  top: 50%;
  left: 50%;
  -ms-transform: translate(-50%, -50%);
  transform: translate(-50%, -50%);
      

}
#div-button{
    
    background-color: #5d6d4a; 
      width: 20%;
    
}
#form{
       text-align: left;
       padding:2%;
       color:white;
     
}
input[type="text"] , input[type="email"] , input[type="password"] ,.num{
float:right;
border-radius: 0.6em;
border:none;
width:40%;
text-align: center;


}
#Sign-up{
 
     width: 40%;
     height:15%;
    
     border: none;
     border-radius: 0.6em;
        font-family: Papyrus;
        font-size: 1em;

  margin: 0;
  position: absolute;
  top: 100%;
  left: 50%;
  -ms-transform: translate(-50%, -50%);
  transform: translate(-50%, -50%);
}
#Sign-up:hover{
            cursor: pointer;
            background-color:#dddddd;
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
            <li>&#8227; <a href="index.php" class="a_top_hypers">Home</a></li>
            <li>&#8227; <a href="" class="a_top_hypers">Sign-Up</a></li>
            <li> <a href="Add_new_property.php"> add </a></li>
            
            
          </ul>
    
      
      </div>
         </header><!--  -->
         <main>
             <div id="div-form">
                 <form action="action" id="form">
                     <label for="fname">First name:</label>
                     <input   id="fname" type ="text" name="fname" value="" ><br>
                     <label for="lname">Last name:</label>
                            <input   id="lname" type ="text" name="lname" value=""><br>
                            <label for="Age">Age:</label>
                            <input  id="Age" type ="number" name="age" value="" min="10" max="100" class="num"><br>
                            <label for="#Family">Family member:</label>
                            <input id ="#Family" type ="number" name="#Family" value="" min="0" max="30" class="num"><br>
                            <label for="income">Income:</label>
                            <input id="income" type ="number" name="income" value=""  class="num"><br>
                               <label for="job">Job:</label>
                               <input id="job" type ="text" name="job" value=""><br>
                            <label for="email">Email:</label>
                            <input id="email" type ="email" value="" name="email"><br>
                            <label for="password" > Password:</label>
                            <input  id ="password" type ="password" name ="password" value="">
                            <div id="div-button">
                              <a href="Homeseeker.php">
                             <button id="Sign-up" type="button"> Sign-up</button>
                             </a>
                             </div>
                            
                 </form>
             </div>
         </main>
         <footer id="foot">
             <h4>@copyRight</h4>
         </footer>
    </body>
</html>

