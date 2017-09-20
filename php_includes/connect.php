<?php
  
  $db_conx = mysqli_connect("sendourlove.ipagemysql.com", "eugene_123", "sparkynewyear81", "eugenesdatabase");
  if(mysqli_connect_errno()) {
    echo mysqli_connect_error();
    exit();
  }
?>