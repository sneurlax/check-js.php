<?php
/**
 * Check if Javascript is enabled on the client via PHP
 * 
 * Cookies are required (for PHP sessions)
 *
 * Usage: include_once("javascheck.php"); within your HTML <body>
 *
 * @package    check-js.php
 * @author     Erm3nda <erm3nda@gmail.com>
 * @author     sneurlax <sneurlax@gmail.com>
 * @license    public domain
 */

// Start a session (if no session already exists.)  Compatible with PHP version 5.4.0 and higher
function start_session() {
  if(version_compare(phpversion(), "5.4.0") != -1){
    if (session_status() == PHP_SESSION_NONE) {
      session_start();
    }
  } else {
    if(session_id() == '') {
      session_start();
    }
  }
}

start_session();

// Run an AJAX GET request (will only run if js is enabled)
echo
'<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script><script type="text/javascript">$(document).ready(function(){ $.get(window.location.href + "?ajax=1"); });</script>';
  
if(isset($_REQUEST['js'])) {
  if ($_REQUEST['js'] == 1){
  } else {
    session_destroy();
  }
}

// If the session variable has not been set, refresh
if(isset($_SESSION['js'])){
  echo "Javascript is enabled <br>";
} else {
  header("Refresh: 1");
  echo "Javascript is not enabled <br>";
}

?>
