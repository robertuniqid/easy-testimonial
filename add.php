<?php require_once('init.php');?><!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="ro" dir="ltr">
    <head>
        <title>Testimonials</title>
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
        <script type="text/javascript">
            var ValidationInformation = {
                required_fields : ['name', 'email_address', 'testimonial']
            };

            $(document).ready(function(){
                LayoutHelper.Init();
            });
        </script>
    </head>

    <body>
        <section class="wrapper">
            <header>
                <p>Testimonials</p>
            </header>

            <section class="content">
                <section id="loading_message" style="display: none;">
                    <section class="alert alert-info">
                        <p>Great !</p>
                        <p>Please wait while we're saving your testimonial</p>
                    </section>

                </section>

                <section id="success_message" style="display: none;">
                    <section class="alert alert-success">
                        <p>Great !</p>
                        <p>Your testimonial has been successfully added!</p>
                        <p>You can view it here : <a href="list.php">Testimonial List</a></p>
                    </section>
                </section>


                <div class="clear"></div>

                <section class="testimonial_add">
                  <?php require_once('parts/_testimonial_form.php');?>
                </section>

                <div class="clear"></div>
            </section>

            <footer></footer>
            <div class="clear"></div>
        </section>

    </body>
</html>