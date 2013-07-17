<?php
require_once('init.php');

// Handle Login
if(!isset($_COOKIE['password'])
    || $_COOKIE['password'] != Model_Constant::ADMINISTRATION_PASSWORD)
  header( 'Location: login.php' );


$testimonial_list = Model_Operation_FileStorage::getInstance()->fetchInformation('testimonials');

if(isset($_GET['action'])) {
  if($_GET['action'] == 'delete') {

    $message = '<div class="alert alert-success">Testimonial successfully deleted</div>';

    unset($testimonial_list[$_GET['entry_id']]);
    Model_Operation_FileStorage::getInstance()->storeInformation('testimonials', $testimonial_list);
  }

  if($_GET['action'] == 'change_password') {
    if(isset($_POST['new_password'])) {
      $constants_file = file_get_contents('models/Constant.php');

      $constants_file = str_replace("'" . Model_Constant::ADMINISTRATION_PASSWORD . "'", "'" . $_POST['new_password'] . "'", $constants_file);

      setcookie('password', $_POST['new_password']);

      $message = '<div class="alert alert-success">Password successfully changed</div>';
      file_put_contents('models/Constant.php', $constants_file);
    }
  }
}

?><!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="ro" dir="ltr">
<head>
  <title>Testimonials Administration</title>
  <meta http-equiv="content-type" content="text/html;charset=utf-8" />
  <meta name="content-language" content="en" />
  <meta name="language" content="English" />

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
    <p>Testimonials Administration</p>
  </header>

  <section class="content">
    <button id="toggle-change-password-form" class="btn btn-primary" style="display: block;margin: 0 auto;">I want to change my password</button>
    <form id="change-password-form"
          method="POST"
          action="administration.php?action=change_password"
          style="width: 380px;margin: 0 auto;display: none">
      <div class="control-group">
        <label for="name" class="control-label">New Password</label>
        <div class="controls">
          <div class="input-prepend">
            <span class="add-on"><i class="icon-pencil"></i></span>
            <input type="text" required="required" name="new_password" id="new_password" class="span4 required">
          </div>
          <div style="width: 280px;display: none" class="alert alert-error">This field is required.</div>
        </div>
      </div>
      <input type="submit" name="submit" class="btn btn-primary right" value="Change Password">
      <div class="clear"></div>
    </form>

    <?php if(isset($message)) : ?>
      <?php echo $message;?>
    <?php endif;?>

    <?php if(empty($testimonial_list)) : ?>
      <div class="alert alert-info">
        There are no testimonials available currently
      </div>
    <?php else : ?>
      <table class="table table-striped">
        <thead>
        <tr>
          <th>Nr</th>
          <th>Name</th>
          <th>Email Address</th>
          <th>Website</th>
          <th></th>
        </tr>
        </thead>
        <tbody>
        <?php $i = 1;foreach($testimonial_list as $entry_id => $entry) : ?>
          <tr entry_id="<?php echo $entry_id; ?>">
            <td><?php echo $i;?></td>
            <td><?php echo $entry['name'];?></td>
            <td><?php echo $entry['email_address'];?></td>
            <td><?php echo $entry['website'] == '' ? '-' : $entry['website'];?></td>
            <td style="width:200px" class="operations">
              <a class="view btn btn-primary" array_position="<?php echo $i - 1;?>">
                View &raquo;
              </a>
              <a href="administration.php?action=delete&entry_id=<?php echo $entry_id;?>"
                 class=" btn btn-danger modal_delete"
                 title="Delete Testimonial"
                 question="Are you sure you want to delete this testimonial from <?php echo $entry['name'];?>? "
                  >Delete &raquo;</a>
            </td>
          </tr>
          <?php $i++;endforeach;?>
        </tbody>
      </table>
    <?php endif;?>
    <script type="text/javascript">
      var encoded_information = '<?php echo json_encode($testimonial_list);?>';
      var clean_information = $.parseJSON(encoded_information);

      $('a.view').bind('click', function(event){
        event.preventDefault();

        LayoutHelper.Popup.Modal(
            'Testimonial from ' + clean_information[$(this).attr('array_position')]['name'],
            clean_information[$(this).attr('array_position')]['content']
        );
      });

      $('a.modal_delete').click(function(event){
        event.preventDefault();
        var html = '<div id="testimonial-delete" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">' +
            '<div class="modal-header">' +
            '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>' +
            '<h3 id="myModalLabel">' + $(this).attr('title') + '</h3>' +
            '</div>' +
            '<div class="modal-body">' +
            '<p>' + $(this).attr('question') + '</p>' +
            '</div>' +
            '<div class="modal-footer">' +
            '<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>' +
            '<a class="btn btn-danger" href="' + $(this).attr('href') + '">Delete</a>' +
            '</div>' +
            '</div>';

        $('body').append(html);

        $('#testimonial-delete').modal().on('hidden', function () { $(this).remove(); });
      });

      $('#toggle-change-password-form').bind('click', function(event){
        event.preventDefault();

        if($('#change-password-form').is(':hidden'))
          $('#change-password-form').slideDown('slow');
        else
          $('#change-password-form').slideUp('slow');
      });

    </script>
  </section>

  <footer></footer>
  <div class="clear"></div>
</section>

</body>
</html>