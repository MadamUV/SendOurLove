<?php
  function randStrGen($len) {
    $result="";
    $dateNow = new DateTime('NOW');
    $date1 = $dateNow->format('Y9m6dH6i9s');
    $chars="zyxwvut".$date1."srqponmlkjihgfedcba9087654321$$$#####";
    $char_arr = str_split($chars);
    for($n=0; $n<$len; $n++) {
      $result.="".array_rand($char_arr);
    }
    return $result;
  }
?>