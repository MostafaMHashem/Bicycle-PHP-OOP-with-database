<?php
  if(!isset($page_title)) { $page_title = 'Staff Area'; }
  
?>

<!doctype html>

<html lang="en">
  <head>
    <title>Chain Gang - <?php echo h($page_title); ?></title>
    <meta charset="utf-8">
    <link rel="stylesheet" media="all" href="<?php echo url_for('/stylesheets/staff.css'); ?>" />
  </head>

  <body>
    <header>
      <h1>Chain Gang Staff Area</h1>
    </header>

    <navigation>
      <ul>
        <!-- if($session->is_logged_in())
              .
              .
              it should be like the above conditional statement 
              but i made it true always because i have problems with login , login function step 
        -->
        <?php if($session->is_logged_in()) { ?>
        <li>User : <?php echo $session->username; ?></li>
        <li><a href="<?php echo url_for('/staff/index.php'); ?>">Menu</a></li>
        <li><a href="<?php echo url_for('/staff/logout.php'); ?>">Logout</a></li>
        <?php } ?>
      </ul>
    </navigation>

    <?php echo display_session_message(); ?>
