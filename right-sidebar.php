<?php
  ?>
<script type="text/javascript">
function SwapImage1() {
  document.cloudimage.src="images/cloudsearch4.png"
}
function SwapImage1Back() {
  document.cloudimage.src="images/cloudsearch3.png"
}
</script>
<div id="sidebar-right">
  <div id="cloudsearch"><img src="images/cloudsearch3.png" name="cloudimage" alt="search" width="230" height="301" onmouseover="SwapImage1()" onmouseout="SwapImage1Back()"></div>
  <div id="search">Search</div>
  <div id="security"><a href="setupforgot.php?choice=true">Account</a></div>
  <div id="tab1">Send Flowers</div>
  <div id="tab2">Send Greeting Cards</div>
    </div>
    <script src="js/jquery.min.js"></script>
    <script src="js/jquery-migrate.js"></script>
<script>
  $(document).ready(function(){
    $( "#tab1" ).hover(function( event ) {
      event.stopImmediatePropagation();
        $("#tab1").delay(300).animate({width:'300px',height:'50px'});
      },function(){
        $("#tab1").delay(500).animate({width:'196px',height:'30px'});
      });
     $( "#security" ).hover(function( event ) {
      event.stopImmediatePropagation();
        $("#security").delay(300).animate({width:'280px',height:'28px'});
    },function(){
        $("#security").delay(500).animate({width:'196px',height:'30px'});
        });
    $( "#tab2" ).hover(function( event ) {
      event.stopImmediatePropagation();
        $("#tab2").delay(300).animate({width:'300px',height:'50px'});
      },function(){
        $("#tab2").delay(500).animate({width:'196px',height:'30px'});
      });
  });
</script>