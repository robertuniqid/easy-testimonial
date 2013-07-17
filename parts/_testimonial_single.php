<section class="testimonial">
    <figure>
      <?php if($testimonial['picture_path'] != '') : ?>
        <img src="<?php echo $testimonial['picture_path'];?>">
      <?php else : ?>
        <img src="assets/images/image_placeholder.png" >
      <?php endif;?>
    </figure>
    <p class="name"><?php echo $testimonial['name'];?></p>
  <?php if($testimonial['website'] != '') : ?>
    <p class="website">
      <a target="_blank"
         href="<?php echo strpos($testimonial['website'], 'http://') === 0 ? $testimonial['website'] : 'http://' . $testimonial['website'];?>">
          <?php echo $testimonial['website'];?>
        </a>
    </p>
  <?php endif;?>
    <section><?php echo $testimonial['content'];?></section>
    <div class="clear"></div>
    <p class="post_date">
      <?php echo gmdate('d M Y', $testimonial['creation_time']);?>
    </p>
</section>