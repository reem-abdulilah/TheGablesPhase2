<?php 
 session_start();
       if(!isset($_SESSION["id"]))
       {
           header("Location:index.php");
           exit();
       }

       // done but check for home seeker info details 
       //--------------------- connection step--------------------------------------------------

        $connection = mysqli_connect("localhost", "root", "root", "Renting") or die("Connection failed");
        $error = mysqli_connect_error();  
        
       if($error!=null){
          $output= '<p> Could not connect to the database. </p>'.$error;
            exit($output);
       }
       
       
        // if not home owner go to index 
       
        if ($_SESSION['role']!='HomeOwner'&&$_SESSION['role']!='HomeSeeker')
        {  
          header("location:redirect.php");
        } // 4 for secuerty
        
        //-----------------------------------------------------------------------
       
        if(isset($_GET['id']) && is_numeric($_GET['id']))
        {  
          $id=$_GET['id'];
          
       
        $query = "select p.* ,cat.category ,h.id as owner_id ,h.name as owner_name ,h.email_address,h.phone_number,m.path from property p left join propertyimage m on m.property_id=p.id join propertycategory cat on p.property_category_id=cat.id join homeowner h on h.id=p.homeowner_id where  p.id=".$id;
        $PSQl = mysqli_query($connection, $query);
        $Property = mysqli_fetch_assoc($PSQl);  
        
 
        //------------- for home seeker ---------------------
        
      if ($_SERVER['REQUEST_METHOD'] == 'POST') {


          if(isset($_POST['PId']))
          $PId = $_POST['PId'];
          
          if(isset($_POST['Papply']))
          $Papply = $_POST['Papply'];
          
          if(isset($_POST['statusId']))
          $StatusId = $_POST['statusId'];
 
        if ($PId != '' && $Papply!='') {             
        $Sid=$_SESSION['id'];
        
        $Aquery = "INSERT INTO rentalapplication (property_id, home_seeker_id, application_status_id) VALUES('".$PId."' ,'".$Sid."','".$StatusId."')";
        
         $result = mysqli_query($connection, $Aquery);
   
    if ($result) {
       $apply=mysqli_insert_id($connection);
    }
        
          header("location:Homeseeker.php");
      }}
  
     //------------- done for home seeker check working ---------------------

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
        <title>Property details </title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="general.css">
        <link rel="icon" type="image/png" sizes="50x50" href="images/icon.PNG">
 
        <style>
            
       #logOut a:link {
    color: #51311b;
    text-decoration: none;
    font-weight: bold;
    font-size: 140%;
    float: right;
    margin-right:45px;
    margin-top:45px;
}
#logOut a:visited {
    color: #4d856d;
}

#logOut a:hover {
    color: #898b77;
}

         
             .container {
             margin-left: 300px;
             margin-right: 300px;
             margin-top: -20px;
             margin-bottom: 100px;
               
            }
            
            #PInfo {
           background-color: rgba(255, 255, 255, .4);
           padding: 3em;
           height: 45%;
           border-radius: 20px;
           box-shadow: 20px 20px 40px -6px rgba(0,0,0,0.2);
           text-align: center;
           position: relative;
           margin-bottom: 1%;
            }
            
            #Pimg{
           background-color: rgba(255, 255, 255, .4);
           padding: 1em;
           height: 370px;
           border-radius: 20px;
           box-shadow: 20px 20px 40px -6px rgba(0,0,0,0.2);
           text-align: center;
           position: relative;
           margin-top: 2%;

            }
            
            
             h2{
                 background-color: rgba(255, 255, 255, .4);
                 padding: 1em;
                 height: 25px;
                 border-radius: 20px;
                 box-shadow: 20px 20px 40px -6px rgba(0,0,0,0.2);
                 text-align: center;
                 position: relative;
                      }
                
            
            
            /* ####### buttons and image ####### */
            
            button{ 
               
             background: transparent;
             width: 450px;
             height: 58px;
             padding: 1em;
             margin-bottom: 1em;
             border: none;

             text-align: center;
             border-radius: 5000px;
             box-shadow: 4px 4px 60px rgb(0 0 0 / 20%);
             color: #fff;
             font-family: Papyrus;
             font-size: 16px;    
             font-weight:bold;
             text-shadow: 2px 2px 4px rgb(0 0 0 / 20%);
            }
            
            button:hover{
                       background: rgba(255,255,255,0.1);
                       box-shadow: 4px 4px 60px 8px rgba(0,0,0,0.2);
                      }
                      
                      img{
                                     border-radius: 20px;
                                     margin-left: 35px;
                                     margin-right: 35px;

                      }
                
                   
            /* ################ text style ########### */
            
            .title{
                color: white;
                font-size: 20px;
                }
            
                  .key{
                      display: inline-block;
                      float: left;
                      width: 41%;
                      margin-top: 10px;
                      margin-bottom:30px;
                      color: #fff; 
                       font-size:16px;
                    }
                    
                    .value{
                    color: #fff; 
                    font-size:16px;
                    margin-top: 10px;
                    text-shadow:none ;
                    display:block;
                    }
         
                    
                    
                    h2{
                        color:white;
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
     
        <header id="header">
        <h1  id="h1">The Gables</h1>
            <img  id ="img-title" src ="images/logo.PNG" alt ="logo" width="300" height="300">
          
          <div
        id="div_top_hypers"
        style="display: flex; justify-content: space-between" >
             
          <ul id="ul_top_hypers">
            <?php if($_SESSION['role']=='HomeOwner'){?>
            <li>&#8227; <a href="HomeOwner.php" class="a_top_hypers">Home Owner</a></li>

           <?php }else{?>
           <li>&#8227; <a href="HomeSeeker.php" class="a_top_hypers">Home Seeker</a></li>
           <?php }?> 
           
          <li>&#8227; <a href="Property_details.php?id=<?php echo $Property['id'];?>" class="a_top_hypers" >Property details</a></li>
          
          </ul>
      </div>
          </header>
       
        <form method="POST" id = "log">
                    <button type="submit" name="logout" style="font-size: 24px; color: #51311b; float: right;" id="b1">Log Out</button> 
                </form>
    <br>
        <div class="container">
        <h2> <?php echo $Property['name']; ?> </h2>
        
        
        <form method="post">
            <?php if($_SESSION['role']=='HomeSeeker'){?>

             <input type="hidden" name="PId" value="<?php echo $id;?>">
             <input type="hidden" name="Papply" value="1">
             <input type="hidden" name="statusId" value="1">
             <button type="submit" value="Apply"> Apply</button>
            </form><?php } ?>
        
        
        <form>
            <?php if($_SESSION['role']=='HomeOwner'){?>
             <button type="submit" value="Edit" formaction=<?php echo "Edit_property.php?id=".$Property['id'];?> > Edit</button>
        </form><?php } ?>
        
       
        <div id="PInfo">
            
            <span class="title">Property Information</span> <br><br>
            <span class="key"> Property Name:</span>   <span class="value"> <?php echo $Property['name']; ?></span><br>
           <span class="key"> Category: </span>        <span  class="value"><?php echo $Property['category']?> </span ><br>
           <span class="key"> Number of rooms:</span>  <span  class="value"> <?php echo $Property['rooms']; ?> </span ><br>
           <span class="key"> Rent: </span>            <span class="value"> <?php echo $Property['rent_cost']; ?> </span ><br> 
           <span class="key"> Location:</span>         <span class="value"> <?php echo $Property['location']; ?></span > <br>
           <span class="key"> Max Number of tenants:</span> <span class="value"> <?php echo $Property['max_tenants']; ?></span ><br>
           <span class="key"> Description: </span>    <span class="value"> <?php echo $Property['description']; ?></span><br>  
        </div><br> 
         <br>
            <div id="Pimg">
              
                <span class="title"> Property images</span><br><br>
             <img src="images/<?php echo$Property['path'];?>" width="100" height="100" alt="Property image 1">
            
  
             
      <?php 
        if($_SESSION['role']=='HomeSeeker'){
        echo "<p style='font-size:18px;'> Home Owner Information</p>";
        echo "<p>  Name: ".$Property['name']."</p>";
        echo "<p>  EmailAddress: ".$Property['email_address']."</p> ";
        echo "<p>  Phone Number: ".$Property['phone_number']."</p>";            
        
            }
        ?>
   
       </div>
        </div>
   
    
    <footer id="foot">
            <h4>@copyRight</h4>
        </footer>
          
</html>
