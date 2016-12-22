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
  if(version_compare(phpversion(), "5.4.0") != -1) {
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

if(isset($_SESSION['check-js'])) {
  $_SESSION['check-js']++;
} else {
  $_SESSION['check-js'] = 0;
}

// Run an AJAX GET request (will only run if js is enabled)
echo '
<script>
  if (!window.jQuery){
    var jq = document.createElement("script");
    jq.type = "text/javascript";
    jq.src = "http://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js";
    document.getElementsByTagName("head")[0].appendChild(jq);
  }
  $(document).ready(function(){
    $.get(window.location.href + "?ajax");
  });
</script>';

// check is AJAX GET request was run (ie. check if js is enabled)
if(isset($_REQUEST['ajax'])) {
  $_SESSION['js'] = 1;
}

// If the session variable has not been set, refresh
if(isset($_SESSION['js'])){
  if(isset($_REQUEST['debug'])) {
    echo "Javascript is enabled <br>";
  }
} else {
  if(isset($_SESSION['check-js'])) {
    if($_SESSION['check-js'] < 1) {
      header("Refresh: 1");
    }
  }
  if(isset($_REQUEST['debug'])) {
    echo "Javascript is not enabled <br>";
  }
}

?>
