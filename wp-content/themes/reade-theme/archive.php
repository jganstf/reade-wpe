<?php 
//$fields = get_fields(); 

$cat_ID = get_queried_object()->term_id;
//TODO pagination, category
$featured = get_posts([
   'post_type'      => 'resource',
   'post_status'    => 'publish',
   'posts_per_page' => -1,
   'category'       => $cat_ID,
   'post__in'       => get_option( 'sticky_posts' ),
]);
$remaining = get_posts([
   'post_type'      => 'post',
   'post_status'    => 'publish',
   'posts_per_page' => -1,
   'category'       => $cat_ID,
   'post__not_in'       => get_option( 'sticky_posts' ),
]);

$qobj = get_queried_object();

get_header(); ?>
<main id="main-content" class="main-content-wrap">
   <div class="theme-main">
      <div class="theme-inner-wrap">
         <article class="archive-default-content">

         <?php

         // set up variables for blog hero partial
         $hero_headline = $qobj->name;
         $hero_description = $qobj->description;
         $hero_search = true;
         $hero_breadcrumbs = array(
            '/news/' => 'All News'
         );


         // include blog hero partial
         include 'template-parts/blocks/partial/blog-hero.php';

         ?>

         <div class="news-archive-articles">
            <?php

            if (!empty($remaining)) {

               foreach ($remaining AS $art) {
                  $npost = $art;
                  include 'template-parts/blocks/partial/news-card-regular.php';
               }

            }

            ?>
         </div>

         <button id="view-more" class="btn-white-blue view-more">View More</button>

         













            
         </article>
      </div>
   </div>
</main>
<?php
//loop
get_footer(); ?>
