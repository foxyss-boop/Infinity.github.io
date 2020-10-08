<?php
session_start();
include_once "classes/Database.php";
include_once APP_PATH . '/classes/Settings.php';
include_once APP_PATH . '/classes/User.php';
include_once APP_PATH . '/classes/Auth.php';
include_once APP_PATH . '/classes/Mailer.php';
include_once APP_PATH . '/classes/Utils.php';
include_once APP_PATH . '/logics/loginLogic.php';
?>

<!DOCTYPE html>
<html lang="en">
<?php include_once 'components/meta.php';?>
<title>BlackNET - Login</title>
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
          <?php endif;?>

          <?php if (isset($_GET['msg'])): ?>
            <?php $utils->show_alert("Profile has been updated, login again.", "success", "check-circle");?>
          <?php endif;?>

          <div class="form-group">
            <div class="form-label-group">
              <input type="text" id="username" class="form-control" name="username" placeholder="Username" required="required" autofocus="autofocus">
              <label for="username">Username</label>
            </div>
          </div>
          <div class="form-group">
            <div class="form-label-group">
              <input type="password" id="password" name="password" class="form-control" placeholder="Password" required="required">
              <label for="password">Password</label>
            </div>
          </div>
          <div class="align-content-center text-center">
            <?php if ($getSettings->recaptchastatus === "on"): ?>
              <div class="form-group">
                <div class="g-recaptcha" data-sitekey="<?php echo $getSettings->recaptchapublic; ?>" required></div>
              </div>
            <?php endif;?>
          </div>
          <button type="submit" class="btn btn-primary btn-block">Login</button>
        </form>
        <div class="text-center">
          <a class="d-block small mt-3" href="forgot-password.php">Forgot Password?</a>
        </div>
      </div>
    </div>
  </div>

  <p class="text-center mt-3 text-white">
    Powered By <a href="https://github.com/BlackHacker511/BlackNET">BlackNET</a>
  </p>

  <?php include_once 'components/js.php';?>
  <script src='https://www.google.com/recaptcha/api.js' async defer></script>

</body>

</html>
