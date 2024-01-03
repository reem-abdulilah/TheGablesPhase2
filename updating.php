
<form method=" post" action="">
    <input type =" text" name ="password">
  <input type ="submit"  value="signin" name ="signin" id ="singin">
</form>


<?php
/*$connection= mysqli_connect("localhost","root","root","Hospital");
$error= mysqli_connect_error();
if($error==null)
{ 
    
        $sql="update HomeOwner SET password='$hashed_password' WHERE passowrd='$pass' ";
}}*?
 * 
 */
    if(isset($_POST['signin'])){
    $password = $_POST['password'];
    echo $password ;
        $hashed_password = password_hash($pass, PASSWORD_DEFAULT);
    echo  $hashed_password ;}


/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */
?>
