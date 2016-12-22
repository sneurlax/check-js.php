<?php
/**
 * The simplest way i found to check javascript vía PHP
 * Not to run code if javascript, to tell server if a client 
 * has enabled Javascript. Check at $_SESSION['js'] for 1/0 true/false
 * 
 * Need cookie to run
 *
 * I've not wrapped into a class nor a function because lazy
 * It's easy too to put a include_once("javascheck.php")
 *
 * @category   function
 * @package    check_javascript_php
 * @author     Erm3nda <erm3nda@gmail.com>
 * @copyright  1997-2005 The PHP Group
 * @license    http://www.php.net/license/3_0.txt  PHP License 3.0
 * @help       To run again push ctrl+F5 OR F5 between 1-2 secs not just once.
 * @screenshot Not yet
 * @requisites Cookie enabled (PHP session)
 */

// function to check for session after|before PHP version 5.4.0
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

// starting the function
start_session();

// create a script to run on the AJAX GET request from :P Javascript enabled browser
echo
  '<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <script type="text/javascript">
  $(document).ready(function(){
  $.get(document.URL.substring(0, document.URL.length-1) + "?sessionstart=1");
  console.log(document.URL.substring(0, document.URL.length-1) + "?sessionstart=1");
});
  </script>';
  
  // Ajax GET request handle
  if ($_REQUEST['sessionstart'] == 1){
    $_SESSION['js'] = 1; // save into session variable
  } else {
    session_destroy(); // force reset the test. otherwise session
  }
  
  // If the session variable has not saved by the AJAX call, loads again.
  if (!isset($_SESSION['js'])){
    header("Refresh: 1"); // thats only for the first load
    echo "Javascript is not enabled <br>"; // Return false
  } else {
    echo "Javascript is enabled <br>"; // Return true
  }