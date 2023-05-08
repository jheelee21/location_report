<?php
  session_start();
  
  // adding connection from web server to the database
  $db = new mysqli("localhost","jheelee21","Ljunhee21!","jheelee21");
  $db->set_charset("utf8");
 
  // function for entering the query for the linked database
  function mq($sql){
    global $db;
    return $db->query($sql);
  }
 
?>