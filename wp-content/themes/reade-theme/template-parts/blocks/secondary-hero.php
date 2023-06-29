<?php

$fields = get_fields();

$cat = get_the_category(); 
if ($cat) {
 $cat_names = array_column($cat, 'cat_name');
 $cat_name = $cat[0]->cat_name; 
 $cat_parent_id = $cat[0]->category_parent;
 $cat_parent_term = get_term( $cat_parent_id, 'category' );
 $cat_parent_name = $cat_parent_term->name;
}

?>


<div class="secondary-hero--section  <?php echo $fields['background_color'];?>">
 <div class="secondary-hero--wrap">
  <div class="secondary-hero--inner">

   <div class="secondary-hero--shadow">
    <div class="secondary-hero--content">
     <div class="secondary-hero--copy">
      <?php if($fields['heading']) :?>
       <h1><?php echo $fields['heading'] ;?></h1>
       <?php endif ;?>
       <?php if($fields['content']) :?>
        <p><?php echo $fields['content'] ;?></p>
       <?php endif ;?>
       <?php if(($fields['back_btn']) && (!empty($cat))) :?>
        <a class="secondary-back--btn  btn-arrow-reverse" href="<?php echo get_permalink( $cat_parent_id );?>">
         <svg width="16" height="17" viewBox="0 0 16 17" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path fill-rule="evenodd" clip-rule="evenodd" d="M6.64179 11.5692C6.38143 11.8295 5.9593 11.8295 5.69895 11.5692L3.03218 8.90241C2.77182 8.64205 2.77182 8.21992 3.03218 7.95956L5.69894 5.2928C5.9593 5.03244 6.38143 5.03244 6.64179 5.2928C6.90215 5.55316 6.90215 5.97529 6.64179 6.23565L5.11314 7.7643L12.8373 7.76429C13.2055 7.76429 13.504 8.06278 13.504 8.43098C13.504 8.79919 13.2055 9.09768 12.8373 9.09768L5.11314 9.09768L6.64179 10.6263C6.90215 10.8867 6.90215 11.3088 6.64179 11.5692Z" fill="white"/>
         </svg>
        <span>
         Back to all <?php echo $cat_parent_name ;?>
        </span>
       </a>
       <?php elseif ((!$fields['back_btn']) && (!empty($fields['link']))) :?>
        <a 
        class="btn-blue-dark-blue" 
        href="<?php echo $fields['link']['url'] ;?>"
        target="<?php echo $fields['link']['target'] ?: '_self' ;?>">
        <?php echo $fields['link']['title'] ;?>
       </a>
       <?php endif ;?>
      </div>
      
     <?php if(!empty($fields['image'])) :?>
      <figure class="secondary-hero--figure">
       <?php echo wp_get_attachment_image( $fields['image']['ID'], 'full' ); ;?>
      </figure>
     <?php endif ;?>
    </div>
   </div>

   <?php if(!empty($fields['resource_link'])) :?>
    <div class="secondary-hero--resource secondary-hero--shadow">
     <div class="secondary-hero-resource--wrap">
      <?php if(!empty($fields['copy'])) :?>
       <p><?php echo $fields['copy'] ;?></p>
      <?php endif ;?>
      <a 
      class="btn-blue-dark-blue"
      href="<?php echo $fields['resource_link']['url'] ;?>"
      target="<?php echo $fields['resource_link']['target'] ?: '_self' ;?>">
      <?php echo $fields['resource_link']['title'] ;?>
     </a>
     </div>
    </div>
   <?php endif ;?>

   <?php if($fields['include_icon'] == true) :?>
    <svg class="geo-decor" width="243" height="243" viewBox="0 0 243 243" fill="none" xmlns="http://www.w3.org/2000/svg">
     <path d="M72.1 182.451C72.0661 182.474 72.0344 182.496 72.0027 182.518C68.6119 184.81 64.4285 185.203 60.8091 183.563C56.6914 181.79 54.0274 177.837 53.8865 173.255C53.7456 168.672 56.1675 164.566 60.1905 162.525C63.6728 160.682 67.8728 160.815 71.3966 162.895C74.914 164.971 77.0596 168.575 77.1382 172.539C77.3032 176.464 75.4208 180.157 72.1 182.451ZM60.7431 166.079C58.4545 167.66 57.1375 170.272 57.2291 173.155C57.3292 176.426 59.2194 179.244 62.1594 180.506C64.7413 181.675 67.71 181.387 70.1325 179.751C72.6365 178.084 73.9233 175.465 73.7997 172.667C73.7987 172.652 73.7977 172.637 73.7982 172.624C73.7479 169.819 72.2149 167.26 69.6969 165.772C67.1818 164.288 64.2017 164.184 61.7267 165.491C61.3817 165.67 61.054 165.865 60.7431 166.079Z" fill="#BAE3E9"/>
     <path d="M96.7348 218.125C96.7031 218.146 96.6714 218.168 96.6375 218.192C93.2468 220.484 89.0633 220.877 85.444 219.237C81.3277 217.466 78.6622 213.511 78.5214 208.929C78.382 204.348 80.7877 200.218 84.8254 198.198C88.3077 196.356 92.5076 196.488 96.0315 198.569C99.5489 200.645 101.692 204.25 101.77 208.212C101.937 212.132 100.058 215.83 96.7348 218.125ZM85.3786 201.75C83.0921 203.329 81.7745 205.944 81.8625 208.827C81.9647 212.096 83.8549 214.914 86.7928 216.178C89.3747 217.347 92.3434 217.059 94.7623 215.422C94.7871 215.408 94.8103 215.392 94.8357 215.375C97.2111 213.734 98.5542 211.11 98.4316 208.336C98.4306 208.321 98.4297 208.306 98.4287 208.291C98.3813 205.491 96.8483 202.932 94.3317 201.446C91.8152 199.96 88.8336 199.854 86.358 201.164C86.0157 201.338 85.6895 201.535 85.3786 201.75Z" fill="#BAE3E9"/>
     <path d="M139.943 214.623C139.912 214.644 139.88 214.666 139.848 214.688C136.458 216.98 132.273 217.377 128.654 215.737C124.534 213.965 121.871 210.009 121.73 205.427C121.589 200.844 123.997 196.726 128.035 194.698C131.518 192.856 135.716 192.99 139.242 195.069C142.759 197.145 144.902 200.751 144.98 204.712C145.149 208.634 143.266 212.328 139.943 214.623ZM128.587 198.251C126.3 199.83 124.983 202.442 125.071 205.325C125.171 208.595 127.061 211.414 130.003 212.678C132.583 213.845 135.554 213.559 137.975 211.921C140.399 210.203 141.765 207.635 141.642 204.836C141.641 204.822 141.64 204.807 141.639 204.792C141.591 201.991 140.06 199.434 137.542 197.946C135.024 196.458 132.044 196.354 129.568 197.664C129.225 197.841 128.897 198.036 128.587 198.251Z" fill="#BAE3E9"/>
     <path d="M158.519 175.453C158.487 175.475 158.456 175.497 158.424 175.519C155.033 177.811 150.848 178.206 147.228 176.566C143.112 174.794 140.446 170.84 140.306 166.257C140.166 161.677 142.574 157.546 146.61 155.527C150.092 153.685 154.29 153.815 157.816 155.898C161.333 157.974 163.479 161.574 163.556 165.539C163.721 169.461 161.842 173.158 158.519 175.453ZM147.163 159.078C144.876 160.658 143.559 163.273 143.647 166.155C143.749 169.425 145.639 172.243 148.577 173.507C151.159 174.676 154.128 174.387 156.549 172.75C156.573 172.736 156.597 172.72 156.62 172.704C158.997 171.062 160.339 168.436 160.216 165.665C160.215 165.65 160.214 165.635 160.216 165.621C160.168 162.818 158.635 160.259 156.116 158.774C153.599 157.288 150.618 157.183 148.142 158.493C147.798 158.668 147.472 158.865 147.163 159.078Z" fill="#BAE3E9"/>
     <path d="M201.728 171.95C201.695 171.974 201.665 171.994 201.631 172.018C198.242 174.312 194.058 174.705 190.439 173.065C186.319 171.293 183.656 167.337 183.515 162.754C183.374 158.172 185.764 154.06 189.82 152.026C193.303 150.184 197.503 150.316 201.028 152.399C204.545 154.475 206.69 158.077 206.765 162.04C206.932 165.964 205.051 169.655 201.728 171.95ZM190.372 155.579C188.085 157.158 186.768 159.77 186.858 162.651C186.958 165.922 188.846 168.741 191.788 170.006C194.368 171.173 197.341 170.885 199.762 169.247C199.785 169.231 199.806 169.217 199.829 169.201C202.207 167.559 203.55 164.935 203.427 162.164C203.426 162.149 203.427 162.133 203.426 162.118C203.378 159.317 201.847 156.76 199.329 155.272C196.814 153.788 193.831 153.68 191.355 154.99C191.01 155.169 190.68 155.366 190.372 155.579Z" fill="#BAE3E9"/>
     <path d="M220.304 132.781C220.271 132.804 220.239 132.826 220.205 132.85C216.814 135.142 212.633 135.533 209.016 133.892C204.896 132.12 202.234 128.166 202.091 123.585C201.952 119.005 204.339 114.885 208.395 112.855C211.877 111.012 216.077 111.145 219.601 113.226C223.119 115.301 225.264 118.906 225.341 122.867C225.505 126.79 223.625 130.488 220.304 132.781ZM208.946 116.408C206.66 117.987 205.342 120.603 205.431 123.481C205.533 126.75 207.422 129.572 210.362 130.834C212.941 132.003 215.911 131.717 218.332 130.079C218.359 130.063 218.38 130.049 218.405 130.031C220.781 128.391 222.122 125.765 222.001 122.993C222 122.978 221.999 122.963 222.002 122.949C221.951 120.147 220.422 117.589 217.901 116.102C215.381 114.616 212.403 114.51 209.928 115.82C209.583 115.996 209.257 116.193 208.946 116.408Z" fill="#BAE3E9"/>
     <path d="M195.667 97.1084C195.633 97.1318 195.602 97.1537 195.568 97.1771C192.177 99.4689 187.996 99.8606 184.379 98.2194C180.259 96.4473 177.597 92.4937 177.454 87.9125C177.315 83.3284 179.728 79.2279 183.758 77.1823C187.238 75.341 191.44 75.4724 194.964 77.553C198.481 79.6287 200.629 83.2314 200.706 87.1962C200.871 91.1217 198.99 94.8135 195.667 97.1084ZM184.31 80.7371C182.024 82.3162 180.705 84.9298 180.795 87.8105C180.897 91.0797 182.787 93.9016 185.727 95.1639C188.305 96.3323 191.275 96.0461 193.698 94.4105C193.723 94.393 193.746 94.3769 193.77 94.3608C196.145 92.7203 197.49 90.0948 197.367 87.3245C197.366 87.3095 197.365 87.2946 197.368 87.2803C197.319 84.4773 195.784 81.9163 193.266 80.4317C190.747 78.9471 187.769 78.842 185.292 80.1498C184.947 80.3287 184.621 80.5223 184.31 80.7371Z" fill="#BAE3E9"/>
     <path d="M132.498 122.602C132.022 122.931 131.39 123.002 130.833 122.737C129.998 122.343 129.643 121.344 130.037 120.513L140.074 99.3378C140.472 98.5034 141.467 98.1477 142.3 98.544C143.135 98.9389 143.489 99.9349 143.096 100.769L133.057 121.941C132.926 122.217 132.733 122.44 132.498 122.602Z" fill="#BAE3E9"/>
     <path d="M200.347 154.764C199.871 155.093 199.239 155.164 198.679 154.9C197.845 154.502 197.491 153.506 197.884 152.672L207.914 131.537C208.314 130.701 209.311 130.353 210.142 130.741C210.976 131.14 211.33 132.136 210.937 132.969L200.907 154.105C200.774 154.378 200.577 154.605 200.347 154.764Z" fill="#BAE3E9"/>
     <path d="M186.142 164.574C185.909 164.735 185.631 164.839 185.328 164.862L161.994 166.734C161.073 166.808 160.269 166.123 160.195 165.202C160.122 164.282 160.801 163.475 161.727 163.404L185.061 161.531C185.982 161.457 186.786 162.142 186.86 163.063C186.906 163.678 186.618 164.246 186.142 164.574Z" fill="#BAE3E9"/>
     <path d="M208.988 116.389C208.228 116.914 207.188 116.723 206.663 115.964L193.361 96.7031C192.836 95.9438 193.027 94.9031 193.786 94.3787C194.545 93.8543 195.586 94.0447 196.11 94.804L209.413 114.065C209.937 114.824 209.747 115.865 208.988 116.389Z" fill="#BAE3E9"/>
     <path d="M147.195 159.067C146.435 159.591 145.395 159.401 144.87 158.641L131.568 139.38C131.043 138.621 131.234 137.58 131.993 137.056C132.752 136.531 133.793 136.722 134.317 137.481L147.62 156.742C148.144 157.501 147.954 158.542 147.195 159.067Z" fill="#BAE3E9"/>
     <path d="M180.066 89.7497C179.833 89.9104 179.555 90.0148 179.252 90.0369L155.918 91.9097C154.997 91.9833 154.193 91.2984 154.119 90.3776C154.044 89.4583 154.729 88.6505 155.651 88.5791L178.985 86.7063C179.906 86.6327 180.71 87.3176 180.784 88.2384C180.832 88.8551 180.54 89.4225 180.066 89.7497Z" fill="#BAE3E9"/>
     <path d="M85.4036 201.742C84.6443 202.266 83.6036 202.076 83.0792 201.316L69.7767 182.056C69.2523 181.296 69.4427 180.256 70.202 179.731C70.9614 179.207 72.002 179.397 72.5264 180.156L85.8289 199.417C86.3534 200.177 86.1608 201.219 85.4036 201.742Z" fill="#BAE3E9"/>
     <path d="M118.274 132.425C118.039 132.587 117.761 132.691 117.458 132.713L94.1471 134.57C93.2263 134.644 92.4207 133.957 92.3485 133.038C92.2735 132.115 92.9619 131.312 93.8806 131.24L117.191 129.383C118.112 129.309 118.916 129.994 118.991 130.917C119.04 131.53 118.748 132.098 118.274 132.425Z" fill="#BAE3E9"/>
     <path d="M124.35 207.249C124.117 207.41 123.837 207.516 123.534 207.538L100.2 209.411C99.279 209.484 98.4749 208.799 98.4013 207.879C98.3292 206.96 99.0175 206.147 99.9333 206.08L123.267 204.207C124.188 204.134 124.992 204.819 125.066 205.739C125.114 206.353 124.824 206.922 124.35 207.249Z" fill="#BAE3E9"/>
     <path d="M138.551 197.442C138.075 197.77 137.445 197.844 136.886 197.577C136.051 197.182 135.695 196.187 136.09 195.352L146.104 174.193C146.494 173.356 147.492 173 148.328 173.397C149.163 173.792 149.519 174.787 149.124 175.622L139.11 196.781C138.981 197.055 138.786 197.28 138.551 197.442Z" fill="#BAE3E9"/>
     <path d="M147.195 159.066C146.435 159.59 145.395 159.4 144.87 158.641L131.568 139.38C131.043 138.621 131.234 137.58 131.993 137.055C132.752 136.531 133.793 136.721 134.317 137.481L147.62 156.742C148.144 157.501 147.954 158.542 147.195 159.066Z" fill="#BAE3E9"/>
     <path d="M70.7073 165.276C70.2314 165.605 69.5994 165.676 69.0417 165.411C68.2088 165.015 67.8516 164.018 68.2479 163.185L78.2851 142.01C78.6836 141.176 79.676 140.822 80.5111 141.217C81.344 141.613 81.6998 142.608 81.3049 143.443L71.2662 164.615C71.1345 164.891 70.94 165.116 70.7073 165.276Z" fill="#BAE3E9"/>
     <path d="M133.884 139.779C133.85 139.803 133.819 139.825 133.787 139.846C130.396 142.138 126.211 142.533 122.591 140.893C118.474 139.12 115.81 135.167 115.669 130.585C115.528 126.002 117.952 121.894 121.973 119.855C125.455 118.012 129.654 118.143 133.177 120.223C136.695 122.299 138.844 125.904 138.92 129.868C139.086 133.79 137.205 137.486 133.884 139.779ZM122.525 123.409C120.239 124.988 118.92 127.602 119.011 130.485C119.111 133.755 121.002 136.574 123.942 137.836C126.524 139.005 129.492 138.717 131.915 137.081C131.938 137.065 131.961 137.049 131.985 137.033C134.362 135.391 135.703 132.769 135.582 129.997C135.581 129.982 135.58 129.967 135.583 129.953C135.532 127.147 133.999 124.589 131.479 123.102C128.962 121.619 125.984 121.514 123.507 122.822C123.164 123 122.836 123.195 122.525 123.409Z" fill="#BAE3E9"/>
     <path d="M152.456 100.61C152.423 100.633 152.393 100.653 152.359 100.677C148.97 102.971 144.786 103.364 141.167 101.724C137.047 99.9521 134.385 95.9985 134.242 91.4173C134.1 86.8325 136.516 82.7306 140.547 80.6835C144.027 78.8423 148.229 78.9736 151.753 81.0542C155.271 83.1299 157.416 86.7341 157.491 90.6968C157.66 94.6194 155.779 98.3147 152.456 100.61ZM141.102 84.2368C138.815 85.816 137.498 88.4317 137.584 91.3118C137.688 94.583 139.576 97.4028 142.517 98.6672C145.098 99.8342 148.069 99.5444 150.49 97.9067C150.513 97.8906 150.534 97.876 150.557 97.8599C152.935 96.2179 154.278 93.5939 154.155 90.8236C154.154 90.8086 154.156 90.7943 154.155 90.7794C154.107 87.9764 152.575 85.4196 150.057 83.9314C147.538 82.4469 144.56 82.3418 142.085 83.6516C141.738 83.8285 141.411 84.0235 141.102 84.2368Z" fill="#BAE3E9"/>
     <path d="M127.821 64.9393C127.787 64.9627 127.758 64.9832 127.724 65.0065C124.335 67.3005 120.151 67.6936 116.532 66.0539C112.412 64.2818 109.75 60.3281 109.607 55.747C109.465 51.1622 111.879 47.0581 115.912 45.0132C119.394 43.1705 123.595 43.3054 127.119 45.386C130.637 47.4617 132.782 51.0659 132.857 55.0286C133.024 58.9469 131.144 62.6444 127.821 64.9393ZM116.466 48.5665C114.18 50.1457 112.861 52.7593 112.949 55.6415C113.052 58.9127 114.941 61.7325 117.882 62.9969C120.462 64.1639 123.433 63.8741 125.854 62.2364C125.878 62.2203 125.899 62.2057 125.922 62.1896C128.3 60.5476 129.643 57.9236 129.519 55.1533C129.518 55.1383 129.521 55.124 129.52 55.1091C129.471 52.3061 127.94 49.7493 125.423 48.2633C122.907 46.7772 119.926 46.6735 117.449 47.9813C117.101 48.156 116.775 48.3532 116.466 48.5665Z" fill="#BAE3E9"/>
     <path d="M84.6114 68.4395C84.5797 68.4614 84.5479 68.4833 84.5162 68.5052C81.1269 70.7991 76.9414 71.1937 73.322 69.554C69.2021 67.7819 66.5388 63.8261 66.3979 59.2435C66.2556 54.6587 68.676 50.5503 72.6999 48.5147C76.1821 46.6721 80.3821 46.8049 83.9059 48.8855C87.4233 50.9612 89.571 54.5639 89.6475 58.5287C89.8153 62.4492 87.9343 66.1445 84.6114 68.4395ZM73.253 52.066C70.9665 53.6451 69.6475 56.2587 69.7376 59.1394C69.8377 62.41 71.7279 65.2284 74.6708 66.4949C77.2513 67.6619 80.22 67.3735 82.641 65.7358C84.967 64.0825 86.4304 61.4473 86.3082 58.6513C86.3087 58.6384 86.3077 58.6235 86.3089 58.607C86.26 55.8041 84.727 53.2452 82.2083 51.7606C79.6932 50.2767 76.7116 50.1709 74.236 51.4808C73.8916 51.6562 73.564 51.8512 73.253 52.066Z" fill="#BAE3E9"/>
     <path d="M66.0379 107.61C66.0061 107.632 65.9744 107.654 65.9427 107.676C62.5534 109.97 58.3678 110.364 54.7485 108.725C50.6307 106.951 47.9667 102.999 47.8259 98.4163C47.6835 93.8315 50.1039 89.7231 54.1285 87.6839C57.6107 85.8413 61.8107 85.9741 65.336 88.0568C68.8533 90.1325 70.9968 93.7382 71.074 97.6994C71.2418 101.62 69.3608 105.315 66.0379 107.61ZM54.6831 91.2373C52.3966 92.8164 51.0776 95.4301 51.1677 98.3108C51.2692 101.583 53.1594 104.402 56.1009 105.666C58.6813 106.833 61.65 106.545 64.0711 104.907C66.5213 103.221 67.8619 100.621 67.7382 97.8226C67.7387 97.8097 67.7378 97.7948 67.7368 97.7798C67.6879 94.9769 66.1563 92.4201 63.6398 90.934C61.1233 89.448 58.1431 89.3443 55.6661 90.6521C55.3202 90.8254 54.9919 91.024 54.6831 91.2373Z" fill="#BAE3E9"/>
     <path d="M90.6732 143.281C90.6415 143.302 90.6097 143.324 90.578 143.346C87.1887 145.64 83.0031 146.035 79.3838 144.395C75.266 142.622 72.6021 138.669 72.4612 134.087C72.3189 129.502 74.7407 125.396 78.7638 123.354C82.246 121.512 86.446 121.645 89.9699 123.725C93.4872 125.801 95.6328 129.405 95.7115 133.368C95.8771 137.29 93.9961 140.986 90.6732 143.281ZM79.3184 126.908C77.0319 128.487 75.7144 131.103 75.803 133.981C75.9045 137.254 77.7948 140.072 80.7362 141.337C83.3167 142.504 86.2854 142.215 88.7064 140.578C91.1493 138.881 92.4972 136.291 92.3735 133.493C92.374 133.48 92.3731 133.465 92.3721 133.45C92.3232 130.647 90.7917 128.09 88.2737 126.602C85.7571 125.116 82.777 125.013 80.3014 126.323C79.957 126.498 79.6294 126.693 79.3184 126.908Z" fill="#BAE3E9"/>
     <path d="M64.6731 90.42C64.1971 90.7487 63.5666 90.8218 63.0074 90.5551C62.1724 90.1602 61.8166 89.1656 62.2115 88.3306L72.2254 67.1716C72.6167 66.3359 73.6164 65.9829 74.45 66.3756C75.285 66.7705 75.6408 67.7651 75.2459 68.6001L65.2319 89.7591C65.1038 90.035 64.9078 90.2579 64.6731 90.42Z" fill="#BAE3E9"/>
     <path d="M112.215 57.585C111.982 57.7457 111.703 57.8515 111.401 57.8757L88.0898 59.7324C87.1691 59.806 86.3656 59.1176 86.2934 58.1989C86.2213 57.2802 86.9033 56.4719 87.8276 56.3989L111.138 54.5422C112.059 54.4686 112.863 55.1571 112.935 56.0757C112.985 56.691 112.691 57.2563 112.215 57.585Z" fill="#BAE3E9"/>
     <path d="M141.137 84.2251C140.378 84.7495 139.337 84.5591 138.813 83.7998L125.51 64.5389C124.986 63.7796 125.176 62.739 125.935 62.2145C126.695 61.6901 127.735 61.8805 128.26 62.6398L141.562 81.9007C142.089 82.6585 141.898 83.6992 141.137 84.2251Z" fill="#BAE3E9"/>
     <path d="M132.499 122.6C132.023 122.929 131.391 123 130.834 122.735C129.999 122.34 129.644 121.342 130.038 120.511L140.075 99.3356C140.473 98.5012 141.468 98.1455 142.301 98.5418C143.136 98.9367 143.49 99.9327 143.097 100.766L133.058 121.939C132.927 122.215 132.734 122.438 132.499 122.6Z" fill="#BAE3E9"/>
     <path d="M118.274 132.425C118.039 132.587 117.761 132.692 117.458 132.714L94.1471 134.57C93.2263 134.644 92.4207 133.957 92.3485 133.038C92.2735 132.115 92.9619 131.312 93.8806 131.24L117.191 129.383C118.112 129.309 118.916 129.994 118.991 130.917C119.04 131.53 118.748 132.098 118.274 132.425Z" fill="#BAE3E9"/>
     <path d="M79.3489 126.899C78.5896 127.424 77.5489 127.233 77.0245 126.474L63.722 107.213C63.1976 106.454 63.388 105.413 64.1473 104.889C64.9067 104.364 65.9473 104.555 66.4717 105.314L79.7742 124.575C80.2966 125.336 80.1062 126.376 79.3489 126.899Z" fill="#BAE3E9"/>
    </svg>
   <?php endif ;?>
  </div>
 </div>
</div>