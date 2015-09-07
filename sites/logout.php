<?php 

    $past = time() - 100; 
 
    //this makes the time in the past to destroy the cookie 
    setcookie(crimson.space_id, gone, $past); 
    setcookie(crimson.space_key, gone, $past); 
    header("Location: https://crimson.space"); 

?> 