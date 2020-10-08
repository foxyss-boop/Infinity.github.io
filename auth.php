<?php
session_start();
require_once 'classes/Database.php';
include_once APP_PATH . '/classes/User.php';
include_once APP_PATH . '/classes/Auth.php';
include_once APP_PATH . '/classes/Utils.php';
include_once APP_PATH . '/vendor/auth/FixedBitNotation.php';
include_once APP_PATH . '/vendor/auth/GoogleAuthenticator.php';
include_once APP_PATH . '/logics/authLogic.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <?php include_once 'components/meta.php';?>

  <title>BlackNET - 2 Factor Authentication</title>

  <?php include_once 'components/css.php';?>
</head>

<body class="bg-dark">
  <div class="container">
    <div class="card card-login mx-auto mt-5">
      <div class="card-header">Login</div>
      <div class="card-body">
        <form method="POST">
          <?php if (isset($error)): ?>
            <?php $utils->show_alert($error, "danger", "times-circle");?>
          <?php else: ?>
            <?php $utils->show_alert("Please open the app for the code.", "primary", "info-circle");?>
          <?php endif;?>
          <div class="form-group">
            <div class="form-label-group">
              <input type="text" id="AuthCode" pattern="[0-9]{6}" name="AuthCode" class="form-control" placeholder="Verification Code" required="required">
              <label for="AuthCode">Verification Code</label>
            </div>
          </div>
          <div class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" id="remberme" name="remberme">
            <label class="custom-control-label" for="remberme">Trust Device for 30 days</label>
          </div>
          <div class="pt-3">
            <button type="submit" class="btn btn-primary btn-block">Login</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <?php include_once 'components/js.php';?>

</body>

</html>