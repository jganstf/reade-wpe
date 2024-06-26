<?php
// Block preview
if (!empty($block['data']['_is_preview'])) {
?>
   <figure>
      <img style="object-fit: contain; max-width: 100%;" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/blocks/grid-hero.webp" alt="Preview of Benefits Block">
   </figure>
<?php
} else if ($fields = get_fields() ?: []) {

?>

   <div class="contact-dual-cta--section">
      <div class="contact-dual-cta--wrap">
         <div class="contact-dual-cta--inner">
            <?php foreach ($fields['ctas'] as $index => $cta) : ?>
               <div class="contact-dual-cta--single">
                  <?php if (!empty($cta['heading'])) : ?>
                     <h2 class="<?php echo (empty($cta['content'])) ? 'heading-solo' : null; ?>"><?php echo $cta['heading']; ?></h2>
                  <?php endif; ?>
                  <?php if (!empty($cta['content'])) : ?>
                     <p><?php echo $cta['content']; ?></p>
                  <?php endif; ?>
                  <?php if (!empty($cta['link'])) : ?>
                     <a href="<?php echo $cta['link']['url']; ?>" class="dual-cta-btn" target="<?php echo $cta['link']['target'] ?: '_self'; ?>"><?php echo $cta['link']['title']; ?></a>
                  <?php endif; ?>
               </div>
            <?php endforeach; ?>
         </div>
      </div>
   </div>


<?php
} ?>
