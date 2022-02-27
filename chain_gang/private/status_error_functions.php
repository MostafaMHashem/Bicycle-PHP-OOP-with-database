<?php

function require_login() {
global $session;
// unfortuntly i have problem with the login process 
//but if not i should do the following code
//
if(!$session->is_logged_in()) {
  redirect_to(url_for('staff/login.php'));
} else {
  // let do nothing , let the rest of the page proceed 
}
}

function display_errors($errors=array()) {
  $output = '';
  if(!empty($errors)) {
    $output .= "<div class=\"errors\">";
    $output .= "Please fix the following errors:";
    $output .= "<ul>";
    foreach($errors as $error) {
      $output .= "<li>" . h($error) . "</li>";
    }
    $output .= "</ul>";
    $output .= "</div>";
  }
  return $output;
}
// 
// the below function we made to declare 
// to clear and return the message
// 
// function get_and_clear_session_message() {
//   if(isset($_SESSION['message']) && $_SESSION['message'] != '') {
//     $msg = $_SESSION['message'];
//     unset($_SESSION['message']);
//     return $msg;
//   }
// }

function display_session_message() {
  global $session;
  $msg = $session->message();
  if(isset($msg) && $msg != '') {
    $session->clear_message();
    return '<div id="message">' . h($msg) . '</div>';
  }
}

?>
