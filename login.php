<?php
require_once('init.php');

if(isset($_COOKIE['password']) && $_COOKIE['password'] = Model_Constant::ADMINISTRATION_PASSWORD)
  header( 'Location: administration.php' );

if(isset($_POST['password'])) {
  if($_POST['password'] == Model_Constant::ADMINISTRATION_PASSWORD) {
    setcookie('password',Model_Constant::ADMINISTRATION_PASSWORD);
    header( 'Location: administration.php' );
  } else
    $error = 'Invalid password';
}

?><!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="ro" dir="ltr">
<head>
  <title>Testimonials</title>
  <meta http-equiv="content-type" content="text/html;charset=utf-8" />
  <meta name="content-language" content="ro" />
  <meta name="language" content="Romanian" />

  <script type="text/javascript">
    var base_url = '';
  </script>

  <!-- HTML 5 Shiv -->
  <script type="text/javascript" src="assets/scripts/html5shiv.js"></script>

  <!-- Include jQuery -->
  <script type="text/javascript" src="assets/scripts/jquery-1.8.2.js"></script>

  <!-- Twitter Bootstrap -->
  <script type="text/javascript" src="assets/scripts/bootstrap.min.js"></script>

  <!-- Uploadify -->
  <link href="assets/uploadify/uploadify.css" rel="stylesheet" type="text/css" />
  <script type="text/javascript" src="assets/uploadify/jquery.uploadify.min.js"></script>

  <!-- Stylesheets -->
  <link rel="stylesheet" type="text/css" href="assets/styles/style.css">

  <!-- Include Layout Helper -->
  <script type="text/javascript" src="assets/scripts/layout_helper.js"></script>
  <script type="text/javascript" src="assets/scripts/layout_helper_popup.js"></script>
</head>

<body>
<section class="wrapper">
  <header>
    <p>Testimonials Login</p>
  </header>

  <section class="content">
    <form method="POST" style="width:250px;margin:0 auto;">
      <?php if(isset($error)) : ?>
        <div class="alert alert-error">
          <p><?php echo $error;?></p>
        </div>
      <?php endif;?>
      <label for="password">Password</label>
      <input id="password" type="password" name="password">
      <input type="submit" class="right btn btn-primary" name="submit" value="Login">
    </form>
  </section>

  <footer></footer>
  <div class="clear"></div>
</section>

</body>
</html>