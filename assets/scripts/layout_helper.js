function validateEmail(email) {
    var re = /\S+@\S+\.\S+/;
    return re.test(email);
}

LayoutHelper = {

    Init : function(){

        $('#testimonial-form').find(':input').change(function(event){
            if($(this).val() == ''
                && $(this).hasClass('required')
                || ($(this).attr('name') == 'email_address'
                && !validateEmail($(this).val()))) {
                $(this).parents('.control-group').find('.icon-ok').hide();
            } else {
                $(this).parents('.control-group').find('.icon-ok').show();
            }
        });

        $('#testimonial-form').submit(function(event){
            event.preventDefault();


            var errors_count = 0;

            $('#picture_path').parents('.control-group').find('.alert-error').hide();

            $(this).find(':input').each(function(event){
                if($(this).val() == ''
                    && $(this).hasClass('required')
                    || ($(this).attr('name') == 'email_address'
                            && !validateEmail($(this).val()))) {
                    $(this).parents('.control-group').find('.alert-error').delay(errors_count++ * 500).fadeIn('slow');
                    $(this).parents('.control-group').find('.icon-ok').hide();
                } else {
                    $(this).parents('.control-group').find('.alert-error').fadeOut('slow');
                    $(this).parents('.control-group').find('.icon-ok').show();
                }
            }).promise().done(function(){
                if(errors_count == 0) {
                    $('#testimonial-form').fadeOut('slow', function(event){

                        $('html, body').animate({scrollTop:0}, 1000);

                        $('#loading_message').fadeIn('slow', function(event){
                            if($('#no-testimonial').length > 0)
                              $('#no-testimonial').fadeOut('slow');

                            $.post("save.php", $('#testimonial-form').serialize()).done(function(data) {
                                data = JSON.parse(data);
                                $('#loading_message').fadeOut('slow', function(event){
                                    $('#success_message').fadeIn('slow');
                                    $('section.wrapper > section.content > section.testimonial_list').prepend(data.html);
                                });
                            });
                        });
                    });
                }
            });
        });

        $('form :input[data-content]').popover({
            trigger : 'focus'
        });

        $('#picture').uploadify({
            'buttonImage' : 'assets/images/select-photo.png',
            'height'      : '28',
            'width'       : '140',
            'uploader'    : base_url + 'post_image.php',
            'cancelImg'   : base_url + 'assets/uploadify/uploadify-cancel.png',
            'swf'         : base_url + 'assets/uploadify/uploadify.swf',
            'buttonText'  : 'Alege Poza',
            'scriptData'  : { },
            'onDialogOpen' : function() {
                $('#picture_path').parents('.control-group').find('.alert-error').fadeOut('fast', function(){
                    $(this).remove();
                });
            },
            'onUploadSuccess'  : function(file, response) {
                response = $.parseJSON(response);

                if(response.status == 'error'){
                    $('#picture_path').parents('.control-group').append('<section class="alert alert-error">' + response.error + '</section>');
                } else {

                    $('#picture_path').val(response.new_path);
                    $('#picture_name').val(response.image_name);

                    $('#form-holder').fadeOut('slow');
                    $('#form-preview').fadeIn('slow');
                    $('#form-preview > img.image_container').attr('src', response.new_path);


                    $('#picture_path').parents('.control-group').find('.alert-error').fadeOut('fast', function(){
                        $(this).remove();
                    });
                }
            }
        });
    }

}