<?php

$fields = get_fields();
$options = get_fields('options');

?>
<div class="product-archive-block">
   <div class="pab-top">
      <?php

      if (!empty($fields['headline'])) {
         ?>
         <h2 class="pab-headline"><?php echo $fields['headline']; ?></h2>
         <?php
      }

      if (!empty($fields['text'])) {
         ?>
         <div class="pab-text">
            <?php echo $fields['text']; ?>
         </div>
         <?php
      }

      ?>
   </div>

   <div class="pab-filters">
      <div class="pab-filters-left">
         <?php

         $filter1_options = array(
            'id' => 'filter1',
            'width' => '192px',
            'select_text' => !empty($options['sort_text']) ? $options['sort_text'] : 'Sort',
            'svg' => '<svg width="11" height="8" viewBox="0 0 11 8" fill="none" xmlns="http://www.w3.org/2000/svg">
               <path d="M0.1853 0.965493C-0.045104 1.17537 -0.0617475 1.53228 0.148125 1.76269L4.91632 6.99734C5.02326 7.11473 5.17471 7.18164 5.3335 7.18164C5.4923 7.18164 5.64375 7.11473 5.75069 6.99734L10.5189 1.76268C10.7288 1.53228 10.7121 1.17537 10.4817 0.965492C10.2513 0.755619 9.89439 0.772263 9.68452 1.00267L5.3335 5.77932L0.982492 1.00267C0.772619 0.772264 0.415704 0.75562 0.1853 0.965493Z" fill="#006078"/>
               </svg>',
            'values' => array(
               'alpha' => 'Alphabetical (A-Z)',
               'reversealpha' => 'Alphabetical (Z-A)'
            )
         );

         tf_dropdown($filter1_options);

         ?>
      </div>
      <div class="pab-filters-right">
         <form id="pab-filters-form">
         <input id="pab-filters-search" class="pab-filters-search" type="text" value="" placeholder="<?php echo !empty($options['search_placeholder_text']) ? $options['search_placeholder_text'] : 'Search'; ?>" autocomplete="off">
         <span id="pab-filters-search-icon"></span>
         </form>
         <div id="clear-search" class="clear-search" style="opacity: 0;"><a id="clear-search-text" href="#">Clear</a></div>
         <hr>
      </div>
   </div>

   <div class="pab-search-empty">
      <h3 class="pab-search-empty-title">Search: "<span id="pab-search-term"></span>"</h3>
      <p class="pab-search-empty-text"><?php echo !empty($options['empty_search_text']) ? $options['empty_search_text'] : 'No results'; ?></p>
   </div>

   <div id="search_load" class="pab-categories">
         <!-- this content filled in by ajax -->
   </div>

   <div class="pab-pagination">
      <div class="pab-pagination-dots">
         <!-- empty, dots generated by js -->
      </div>
      <div class="pab-pagination-arrows">
         <button class="prev-btn btn-blue-dark-blue" aria-label="Previous"><svg width="21" height="20" viewBox="0 0 21 20" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M8.55382 15.4445L3.10937 10M3.10937 10L8.55382 4.55557M3.10937 10L17.1094 10" stroke="white" stroke-width="1.67" stroke-linecap="round" stroke-linejoin="round"/>
</svg>
</button>
         <button class="next-btn btn-blue-dark-blue" aria-label="Next"><svg width="21" height="20" viewBox="0 0 21 20" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M11.7274 4.55554L17.1719 9.99999M17.1719 9.99999L11.7274 15.4444M17.1719 9.99999L3.17188 9.99999" stroke="white" stroke-width="1.67" stroke-linecap="round" stroke-linejoin="round"/>
</svg>
</button>
      </div>
   </div>


</div>

<?php

$productNamesArgs = array(
   'post_type' => 'product',
   'status' => 'publish',
   'posts_per_page' => -1,
   'meta_query' => array(
        array(
            'key' => 'is_main_product',
            'value' => 1,
            'compare' => '='
        )
    )
);

$productNames = new WP_Query($productNamesArgs);
$productsnames = array();

if (!empty($productNames->posts)) {
   foreach ($productNames->posts AS $pn) {
      $productsnames[] = array($pn->post_title, 'Product', get_permalink($pn->ID));
   }
}

$categoryNames = get_terms(array('taxonomy' => 'product_cat', 'parent' => '0'));
$categoriesnames = array();

if (!empty($categoryNames)) {
   foreach ($categoryNames AS $cn) {
      $term = get_term($cn->term_id, 'product_cat');
      
      if (is_a($term, 'WP_Term')) {
         $clink = get_term_link($term, 'product_cat');
      } else {
         $clink = '';
      }

      $categoriesnames[] = array($cn->name, 'Category', $clink);
   }
}

// merge together
$productsnames = array_merge($productsnames, $categoriesnames);

?>
<script>
   let products = <?php echo json_encode($productsnames); ?>;
</script>