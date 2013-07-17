<form method="POST" id="testimonial-form">
    <div class="left">
      <div class="control-group">
          <label class="control-label"
                 for="name">Name</label>
          <div class="controls">
              <div class="input-prepend">
                  <span class="add-on"><i class="icon-user"></i></span>
                  <input class="span6 required"
                         id="name"
                         type="text"
                         name="name"
                         data-content="Your name"
                          >
                  <i style="margin:0 0 0 5px;display: none;" class="icon-ok"></i>
              </div>
              <div class="alert alert-error" style="width: 436px;display: none;">This field is required.</div>
          </div>
      </div>

      <div class="control-group">
          <label class="control-label" for="email_address">Email address</label>
          <div class="controls">
              <div class="input-prepend">
                  <span class="add-on"><i class="icon-envelope"></i></span>
                  <input class="span6 required"
                         id="email_address"
                         type="text"
                         name="email_address"
                         data-content="Your email address"
                          >
                  <i style="margin:0 0 0 5px;display: none;" class="icon-ok"></i>
              </div>
              <div class="alert alert-error" style="width: 436px;display: none;">This field should be a valid email address.</div>
          </div>
      </div>

      <div class="control-group">
          <label class="control-label" for="website">Website</label>
          <div class="controls">
              <div class="input-prepend">
                  <span class="add-on"><i class="icon-globe"></i></span>
                  <input class="span6"
                         id="website"
                         type="text"
                         name="website"
                         data-content="Your Website, if you have one"
                          >
                  <i style="margin:0 0 0 5px;display: none;" class="icon-ok"></i>
              </div>
          </div>
      </div>

      <div class="control-group">
          <label class="control-label" for="picture_name">Picture</label>
          <div class="controls">
              <div class="input-prepend">
                  <span class="add-on"><i class="icon-picture"></i></span>
                  <input class="span4" id="picture_path" type="hidden" name="picture_path" value="">
                  <input class="span4" id="picture_name" type="text" name="picture_name" disabled="disabled">
                  <input id="picture" type="file" name="picture">
              </div>
              <div class="alert alert-error" style="width: 436px;display: none;">This field is required</div>
          </div>
      </div>

      <div class="control-group">
          <label class="control-label" for="testimonial">Testimonial</label>
          <textarea id="testimonial"
                    name="testimonial"
                    class="span4 required"
                    data-content="Please write down your testimonial"
                    style="resize: none;width:470px;height:200px;"></textarea>
          <div class="alert alert-error" style="width: 436px;display: none;">This field is required</div>
      </div>
      <div class="clear"></div>
      <input type="submit" class="btn btn-primary right" name="submit" value="Send &raquo;"/>
      <div class="clear"></div>
    </div>
    <div class="right">
      <div id="form-holder">
        <img class="background" src="assets/images/image_placeholder.png" >
      </div>
      <div id="form-preview" style="display: none">
        <img class="image_container" src="">
      </div>
    </div>

    <div class="clear"></div>
</form>