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
       
       //--------------------- connection step--------------------------------------------------

        $connection = mysqli_connect("localhost", "root", "root", "Renting") or die("Connection failed");
        $error = mysqli_connect_error();  
        
       if($error!=null){
          $output= '<p> Could not connect to the database. </p>'.$error;
            exit($output);
       }
       
        if ($_SESSION['role'] !== 'HomeOwner') {  
          header("location:redirect.php");
        }

      //-----------------------------------------------------------------------
       
        if(isset($_GET['id']) && is_numeric($_GET['id']) )
         $id=$_GET['id'];
        

        $query = "select p.* ,cat.category ,h.id as owner_id ,h.name as owner_name ,h.email_address,h.phone_number,m.path from property p left join propertyimage m on m.property_id=p.id join propertycategory cat on p.property_category_id=cat.id join homeowner h on h.id=p.homeowner_id where  p.id=".$id;
        $PSQl = mysqli_query($connection, $query);
        $Property = mysqli_fetch_assoc($PSQl);  
    

        // --------------------------------------------------------
      
        $CQuery="SELECT * FROM PropertyCategory";
        $categorys = mysqli_query($connection ,$CQuery);
        
         // --------------------------------------------------------
   
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            

             if (isset($_POST["Pname"]) & isset($_POST["Nofrooms"]) & isset($_POST["rent"]) & isset($_POST["location"]) & 
               isset($_POST["maxN"]) & isset($_POST["description"]) &  isset($_POST["category"])) {
                
               
               
            $name= $_POST["Pname"];
            $room= $_POST["Nofrooms"];
            $rent= $_POST["rent"];
            $location= $_POST["location"];
            $maxN= $_POST["maxN"];
            $description= $_POST["description"];
            $categoryID= $_POST["category"];  // id of category 
            
            
        $name=mysqli_real_escape_string($connection,$name);
        $location=mysqli_real_escape_string($connection,$location);
        $description=mysqli_real_escape_string($connection,$description);


          
          if(isset($_POST['image_delete'])){
           $process_delete= $_POST['image_delete'];
         
          if($process_delete!=""){
              
           $delete="UPDATE PropertyImage SET path=' ' WHERE property_id=".$id;
            mysqli_query($connection, $delete);
   
            if(mysqli_affected_rows($connection)) {
            header("location:Property_details.php?id=".$id);
                              }
          }}
           

    
     
               //-------------------------------------- for update
                          

        if(isset($_FILES['picture'])){
            $errors= array();
            $file_name = $_FILES['picture']['name'];
            $file_size =$_FILES['picture']['size'];
            $file_tmp =$_FILES['picture']['tmp_name'];
            $file_type=$_FILES['picture']['type'];


            if($file_size > 1048576){
                $errors[]='File size too large';
            }
            if(empty($errors)){
                move_uploaded_file($file_tmp,"images/".$file_name);
            }else{
                print_r($errors);
            }
            

             
        //-------------------------------------
            
            
        if ($file_name!="") {
        $update_image = "UPDATE PropertyImage SET path='$file_name' where property_id=$id";
        mysqli_query($connection, $update_image);
           }

          
          $update_request = "UPDATE Property SET name='$name',rooms=$room,rent_cost=$rent,location='$location',max_tenants=$maxN,property_category_id='$categoryID',description='$description'  where id=$id";
          $result = mysqli_query($connection, $update_request);

            if ($result>0) {
         header("location:Property_details.php?id=".$id );
                 }
        }
           }
                 
        }//end of req
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
        <title>Edit Property</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
          <link rel="stylesheet" href="general.css">
          <link rel="icon" type="image/png" sizes="50x50" href="images/icon.PNG">

        <style>
            
            /* ###########body and contaier########*/
         
            
            .container {
              margin-left: 300px;
             margin-right: 300px;
             margin-top: 5px;
             margin-bottom: 60px;
             text-align: center;
            }
            
           /* form {
           background-color: rgba(255, 255, 255, .4);
           padding: 3em;
           height: 840px;
           border-radius: 20px;
           box-shadow: 20px 20px 40px -6px rgba(0,0,0,0.2);
           text-align: center;
           position: relative;
                 }*/
           
           
             #PInfo{
           background-color: rgba(255, 255, 255, .4);
           padding: 3em;
           height: 57%;
           border-radius: 20px;
           box-shadow: 20px 20px 40px -6px rgba(0,0,0,0.2);
           text-align: center;
           position: relative;
           margin-bottom: 30px;
           margin-top: 2%;
            }
                 
           #Pimg{
           background-color: rgba(255, 255, 255, .4);
           padding: 1em;
           height: 300px;
           border-radius: 20px;
           box-shadow: 20px 20px 40px -6px rgba(0,0,0,0.2);
           text-align: center;
           position: relative;
           margin-bottom:10%;
           
            }
            
             img{
                   border-radius: 20px;
                      
                      }
            
           
           /* ############# inputs and labels###########*/
           
           
             input:not(input[type=radio])  {
                   background: transparent;
                   width: 200px;
                   padding: 1em;
                   margin-bottom: 1em;
                    border: none;
                   text-align:center;
    
                   border-radius: 5000px;
                   box-shadow: 4px 4px 60px rgba(0,0,0,0.2);
                   color: #fff;
                   font-family: Montserrat, sans-serif;
                   font-weight: 500;
                   text-shadow: 2px 2px 4px rgba(0,0,0,0.2);
             }
             
             button{
                  background: transparent;
                   width: 200px;
                   padding: 1em;
                   border: none;
                   text-align:center;
   
                   border-radius: 5000px;
                   box-shadow: 4px 4px 60px rgba(0,0,0,0.2);
                   color: #fff;
                   font-family: Papyrus;
                   font-size: 16px;
                   font-weight: 500;
                   text-shadow: 2px 2px 4px rgba(0,0,0,0.2);
                   margin-top: 20px;
                   
                   text-align: center;
              
             }
             
                
             
             textarea {
             background: transparent;
             width: 368px;
             height: 58px;
             padding: 1em;
             margin-bottom: 1em;
             border: none;

             text-align: center;
             border-radius: 5000px;
             box-shadow: 4px 4px 60px rgb(0 0 0 / 20%);
             color: #fff;
             font-family: Montserrat, sans-serif;
             font-weight: 500;
             text-shadow: 2px 2px 4px rgb(0 0 0 / 20%);
             }
             
             
             textarea:hover,button:hover,input:not(input[type=radio]):hover {
                       background: rgba(255,255,255,0.1);
                       box-shadow: 4px 4px 60px 8px rgba(0,0,0,0.2);
                      }
                      
                      
                   h2{
                      color: #fff;   
                     }
                     
                    #cate, label{      
                    color: #fff; 
                    font-size:18px;
                    text-shadow:none ;
                    display:block;
                    }
            
                  #cate,label > span{
                      display: inline-block;
                      float: left;
                      width: 260px;
                      margin-top: 10px
                    }
                    
                    
                    
                    .Vimg{
                      display: inline-block;
                      margin-left:  10px;
                      margin-bottom: 200px;
                    }
                    .title{
                     color: white;
                    font-size: 20px;
                     }
                     
                     a{
                         margin-left: 10px;
                     }
                     
                     #upload{
                       text-align: right;
                         
                     }
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
                     
                   /* ############# button ##############*/
   
                .Vbutton input[type="radio"], .Abutton input[type="radio"]  {
                        width: 15px;
                       }
                       

                .Vbutton label, .Abutton label  {
                    display: inline;
                    margin-left: 155px;
                   float:left;
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
        style="display: flex; justify-content: space-between" >
             
          <ul id="ul_top_hypers">
              <ul id="ul_top_hypers">
            <?php if($_SESSION['role']=='HomeOwner'){?>
            <li>&#8227; <a href="HomeOwner.php" class="a_top_hypers">Home Owner</a></li>

           <?php }else{?>
           <li>&#8227; <a href="HomeSeeker.php" class="a_top_hypers">Home Seeker</a></li>
           <?php }?> 
              <li>&#8227; <a href="Property_details.php?id=<?php echo $Property['id'];?>" class="a_top_hypers" >Property details</a></li>
             <li>&#8227; <a href="" class="a_top_hypers">Edit Property</a></li>
          
          </ul>
      </div>
          </header>
      
      <form method="POST" id = "log">
                    <button type="submit" name="logout" style="font-size: 24px; color: #51311b; float: right;" id="b1">Log Out</button> 
                </form>
        
        <div class="container" >
            
              <form action="" method="post" enctype="multipart/form-data">
                  
                  <br>
            <div id="PInfo">
       

            <h2> Holiday Villa</h2> <br> 
             <label><span> Property Name:</span> 
                <input type="text" name="Pname" class="Pinfo" value="<?php echo $Property['name'];?>">
            </label> <br>
            
        
            
            <span id="cate"> Category:</span>
                <div class="Vbutton"> 
               <label for="Villa">
                   <?php  foreach($categorys as $cat){?>
                    
              <input type="radio" name="category"  id="Villa" <?php if ($cat['id'] == $Property['property_category_id']) {
                                  echo 'checked';       
                       } ?>      value="<?php echo $cat['id']; ?>" class="Pinfo"  > 
              <?php echo $cat['category']; ?>
              <?php } ?>
               </label>
                  </div>

             <br> <br>  <br>
            
             <label><span>Number of rooms:</span> 
                <input type="number" name="Nofrooms" class="Pinfo" value="<?php echo $Property['rooms']; ?>">
            </label><br>
            
            <label><span> Rent:</span> 
                <input type="text" name="rent" class="Pinfo" value="<?php echo $Property['rent_cost']; ?>">
            </label> <br>
            
            <label><span> Location:</span> 
                <input type="text" name="location" class="Pinfo" value="<?php echo $Property['location']; ?>">
            </label><br>
            
            <label> <span> Max number of tenants:</span> 
                <input type="number" name="maxN" class="Pinfo" value="<?php echo $Property['max_tenants']; ?>">
            </label><br>
            
            <label><span>Description:</span> 
                <textarea  name="description" class="Pinfo" cols="55" rows="6"> <?php echo $Property['description']; ?> </textarea>
            </label><br>
            </div>
              
            
             <span class="title"> Property images </span>
            <div id="Pimg">
               
                    
                
                <label><br> <span>Upload:</span>
                <input type="file" name="picture" class="Pinfo" style="font-family: Papyrus;">
            </label><br>
               
                
                 <?php if ($Property['path'] != "") {
                 $path =$Property['path']; ?>
                
             <span class="Vimg">

             <img src="images/<?php echo $path; ?>" width="100" height="100" alt="<?php echo $path; ?>">

            <?php } ?>
            
             <?php
            if($Property['path']!=" "){ ?>
            
            <input type="hidden" name="image_delete" value="<?php echo $Property['path']; ?>" />
             <button type="submit" id="<?php echo $Property['path']; ?>"> Delete Image </button>
             <?php }
             else 
                 echo"No images added";
                 ?>
             </span>
            </div>
            <button type="submit" value="Edit"> Edit</button>
            </form>

            </div> 
  
        <footer id="foot" >
            <h4>@copyRight</h4>
        </footer>
    </body>
</html>


