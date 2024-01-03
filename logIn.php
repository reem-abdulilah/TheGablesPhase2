<?php 
session_start();
              $connection=mysqli_connect("localhost","root","root","Renting");
                     $error= mysqli_connect_error();
             
              if(isset($_POST["signin"]) & isset($_POST["role"]) & isset($_POST["email"]) & isset($_POST["password"]))
              {
                  $role = $_POST["role"];
                  $email =$_POST["email"]; 
                  //to prevent input injection
                  $email =  $connection->real_escape_string($email);
                  
                  $pass=$_POST["password"];
                  
                    if($error==null){
                         $sql="select * from $role where email_address='$email' ";
                         $result=mysqli_query($connection,$sql);
                         if(mysqli_num_rows($result)>0 )
                         {
                             $row=mysqli_fetch_assoc($result);
                             if(password_verify( $pass,$row["password"]))
                             { 
                             $_SESSION['role']= $role;
                             $_SESSION['id']= $row['id'];
                           
                             
                             
                             if($role=="HomeSeeker")
                             { header("Location:homeseeker.php");
                             exit;}
                             else
                             { header("Location:homeowner.php");
                             exit;}
                         }
                         }
                        else{
                            echo '<script>alert("Invalid credintial ")</script>';
                              
                         }
                    }
        }
        ?>
              
<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/ClientSide/html.html to edit this template
-->
<html>
    <head>
        <title>log In </title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="general.css">
        <link rel="icon" type="image/png" sizes="50x50" href="images/icon.PNG">
        <style>
                    #div-form{

     display: flex;
     flex-direction: column;
  justify-content: center;
  text-align: center;
   
  
  width: 20%;
  height:200px;
  
  padding: 15px;
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
#form{
       text-align: left;
       padding:3px;
       color:white;
}
input[type="email"] , input[type="password"],#role{
float:right;
border-radius: 0.6em;
border:none;
width:60%;
text-align: center;
}

#role{
    width:60%;
    text-align:center;
      font-family: Papyrus;
}

#div-button{
    
    background-color: #5d6d4a; 
      width: 20%;
    
}
#singin{
 
     width: 220px;
     height:50px;
    
     border: none;
     border-radius: 0.6em;
        font-family: Papyrus;
        font-size: 20px;
     

  margin: 0;
  position: absolute;
  top: 100%;
  left: 50%;
  -ms-transform: translate(-50%, -50%);
  transform: translate(-50%, -50%);
}
 body{
              background: url("images/bimg.png") ;
background-repeat: no-repeat ;
 width: 100vw;
  
  background-size: cover;
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
            <li>&#8227; <a href="" class="a_top_hypers">Log-In</a></li>
            
            
          </ul>
    
      
      </div>
         </header><!-- comment -->
         <main>
             
             
             
             
             <div id="div-form">
                 <form id="form " method = "post" action ="">
                  <label for="email">Email:</label>
                  <input type ="email" value="" name="email"><br>
                            <label for="password" > Password:</label>
                            <input type ="password" name ="password" value="">
                            <span>Role:</span>
                            <select id="role" name="role" style>
    <option value="HomeSeeker">Home seeker</option>
    <option value="HomeOwner">Home owner</option>
                            </select>
                            
                            
                            <div  class="div-button">
                            <input type ="submit"  value="signin" name ="signin" id ="singin">
                            </div>
            </form>
                            
                
             </div><!-- comment -->
             
             <?php
   

                     
                     ?>
             
             
        <div>
            
        </div>
             </main>
            <footer id="foot">
            <h4>@copyRight</h4>
        </footer>
        <!-- <script>
             function goTo(){
             role = document.getElementById("role").value;
             console.log(role);
             if(role==="Home seeker")
             {
                   location.replace("Homeseeker.php");
             }
             else
             {
                location.replace("Homeowner.php");  
             }
             }
             </script>-->
    </body>
</html>

