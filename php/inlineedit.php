<?php 
require ('config.php');
session_start();



if ($_POST) { // We check if there is a post.
   
   $inline = $_POST['inline']; 
   $value = $_POST['value'];

   //Since we cannot post the + (plus) value, we send it with {0} and convert it back to + here.
   $value = str_replace('{0}','+',$value); 
    
   $id = $_POST['id'];

      if ($con->query("update networth_crypto SET $inline = '$value' WHERE id =$id")) // We write our query to update the data.
      {
         echo true; // If the update query is working we return true
      }
      else
      {
         echo false; // We return false if the id is not found or there is an error in the query
      }
}

?>