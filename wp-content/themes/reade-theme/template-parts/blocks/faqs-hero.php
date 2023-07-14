<?php

$fields = get_fields();

?>

<div class="faqs-hero <?php echo $fields['style'] ;?>">
 <div class="faqs-hero-content--wrap">
   <?php if(!empty($fields['heading'])) :?>
    <h1><?php echo $fields['heading'] ;?></h1>
   <?php endif ;?> 
   <?php if(!empty($fields['content'])) :?>
    <p><?php echo $fields['content'] ;?></p>
   <?php endif ;?>
 </div>

 <?php if($fields['icon'] != 'none') :?>
  <div class="faqs-hero--decor" aria-hidden="true">
   <?php if($fields['icon'] == 'magnify') :?>
    <svg class="magnify-svg" width="118" height="153" viewBox="0 0 118 153" fill="none" xmlns="http://www.w3.org/2000/svg">
     <path d="M49.9052 107.644C52.8776 107.644 55.7039 107.182 58.3839 106.259C61.0642 105.336 63.5793 104.026 65.9292 102.327L90.6141 127.138L94.7131 123.04L69.8975 98.3398C71.8177 96.1245 73.1841 93.6513 73.9965 90.9202C74.8089 88.1893 75.2151 85.3475 75.2151 82.3951C75.2151 75.6721 72.8066 69.9292 67.9896 65.1664C63.1725 60.4036 57.301 58.0222 50.3749 58.0222C43.4489 58.0222 37.5855 60.4303 32.7849 65.2464C27.9843 70.0625 25.5839 75.95 25.5839 82.909C25.5839 89.8681 27.9483 95.7303 32.677 100.496C37.4057 105.261 43.1484 107.644 49.9052 107.644ZM50.3865 101.995C45.1821 101.995 40.689 100.104 36.9069 96.3232C33.1249 92.5421 31.2339 88.0562 31.2339 82.8656C31.2339 77.6749 33.1293 73.1782 36.92 69.3754C40.7107 65.5725 45.2083 63.6711 50.4126 63.6711C55.6169 63.6711 60.1101 65.5769 63.8921 69.3884C67.6741 73.2 69.5651 77.7043 69.5651 82.9015C69.5651 88.0986 67.6698 92.5801 63.879 96.346C60.0883 100.112 55.5908 101.995 50.3865 101.995ZM13.6862 152.613C10.1057 152.613 7.09449 151.393 4.65267 148.951C2.21084 146.51 0.989929 143.501 0.989929 139.924V13.3362C0.989929 9.75958 2.21084 6.7506 4.65267 4.30925C7.09449 1.86789 10.1203 0.647217 13.7301 0.647217H82.8592L117.756 35.4267V139.876C117.756 143.485 116.535 146.51 114.093 148.951C111.652 151.393 108.64 152.613 105.06 152.613H13.6862ZM80.0896 38.3065V6.29611H13.7301C11.9575 6.29611 10.3327 7.03452 8.85558 8.51136C7.37846 9.98819 6.6399 11.6127 6.6399 13.3849V139.876C6.6399 141.648 7.37846 143.272 8.85558 144.749C10.3327 146.226 11.9575 146.965 13.7301 146.965H105.016C106.788 146.965 108.413 146.226 109.89 144.749C111.368 143.272 112.106 141.648 112.106 139.876V38.3065H80.0896Z" fill="#BAE3E9"/>
    </svg>
   <?php elseif (($fields['icon'] == 'reverse-box') || ($fields['icon'] == 'box')) :?>
    <svg class="box-svg<?php echo ($fields['icon'] == 'reverse-box') ? ' reversed' : null ;?>" width="170" height="224" viewBox="0 0 170 224" fill="none" xmlns="http://www.w3.org/2000/svg">
     <path d="M19.2041 44.916L93.8502 1L168.398 44.916L93.8083 88.832V185.673L19.2041 141.771V44.916ZM19.2041 44.916L93.8083 88.832L168.398 44.916V141.771L93.8083 185.673" stroke="#AEE3F0" stroke-width="2" stroke-linejoin="round"/>
     <path d="M0.999025 148.318L40.1267 125.298L79.2031 148.318L40.1047 171.337V222.099L0.999025 199.087V148.318ZM0.999025 148.318L40.1047 171.337L79.2031 148.318V199.087L40.1047 222.099" stroke="#AEE3F0" stroke-width="2" stroke-linejoin="round"/>
    </svg>
   <?php endif ;?>

  </div>
 <?php endif ;?>

</div>