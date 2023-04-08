<?php
  include 'session.inc.php';

  session_unset();
  session_destroy();
  header( 'location: /index.php' );
  exit();
?>
