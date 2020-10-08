<?php
include_once 'classes/Database.php';
include_once APP_PATH . '/classes/Update.php';
include_once APP_PATH . '/classes/Utils.php';
include_once APP_PATH . '/logics/installLogic.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <?php include_once 'components/meta.php';?>
  <title>BlackNET - Installation</title>
  <?php include_once 'components/css.php';?>
</head>

<body class="bg-dark">
  <div class="container pt-3">
    <div class="card card-login mx-auto mt-5">
      <div class="card-header">Install</div>
      <div class="card-body">
        <form method="POST">
          <?php if (isset($msg)): ?>
            <?php $utils->show_alert("Panel has been installed.", "success", "check-circle");?>
          <?php endif;?>
          <div class="alert alert-primary text-center border-primary">
            <p class="lead h2">
              <b>this page going to install BlackNET default settings<br>
                <hr>
                <div>
                <?php foreach ($required_libs as $common_name => $lib_name): ?>
                <?php echo $common_name . ": ", extension_loaded($lib_name) ? "OK" : "Missing", "<br />"; ?>
                <?php array_push($is_installed, extension_loaded($lib_name));?>
                <?php endforeach;?>
                </div>
                <hr>
                <p class="h3">admin login details</p>
                <ul class="list-unstyled h4">
                  <li class="">Username: admin</li>
                  <li class="">Password: admin</li>
                </ul>
                <hr />
                <p>Please change the admin information for better security.</p>
              </b></p>
          </div>
          <?php if (in_array(false, $is_installed)): ?>
          <button type="submit" class="btn btn-primary btn-block" disabled>Start Installation</button>
          <?php else: ?>
          <button type="submit" class="btn btn-primary btn-block">Start Installation</button>
          <?php endif;?>
        </form>
      </div>
    </div>
  </div>
  <?php include_once 'components/js.php';?>

</body>

</html>
