<?php

// Block categories
add_filter('block_categories_all', function ($categories, $post) {
	return array_merge(
		$categories,
		array(
			array(
				'slug' => 'theme-blocks',
				'title' => 'Theme Blocks',
			),
		)
	);
}, 10, 2);

add_action('acf/init', 'theme_register_blocks');
function theme_register_blocks()
{
	if (!function_exists('acf_register_block')) {
		return;
	}

	/** Keep Alphabetic */
	$img_root = "./assets/img/blocks";
	$mode = 'edit';
 /** 
	 * Calculator
	 * */
	acf_register_block([
		'name'			=> 'calculator',
		'title'			=> 'Calculator',
		'render_template'	=> get_stylesheet_directory() . "/template-parts/blocks/calculator.php",
		'category'		=> 'theme-blocks',
		'icon'			=> 'button',
		'image'        => $img_root . '/calculator.webp',
		'mode'			=> $mode,
		'keywords'		=> ['hero', 'reade', 'theme', TEXTDOMAIN],
		'supports'     => ['align' => false],
	]);

	/** 
	 * Call To Action
	 * */
	acf_register_block([
		'name'			=> 'call-to-action',
		'title'			=> 'Call To Action',
		'render_template'	=> get_stylesheet_directory() . "/template-parts/blocks/call-to-action.php",
		'category'		=> 'theme-blocks',
		'icon'			=> 'button',
		'mode'			=> $mode,
		'keywords'		=> ['call-to-action', 'cta', 'reade', 'theme', TEXTDOMAIN],
		'supports'     => ['align' => false],
	]);

	/** 
	 * Contact Dual CTA
	 * */
	acf_register_block([
		'name'			=> 'contact-dual-cta',
		'title'			=> 'Contact Dual CTA',
		'render_template'	=> get_stylesheet_directory() . "/template-parts/blocks/contact-dual-cta.php",
		'category'		=> 'theme-blocks',
		'icon'			=> 'button',
		'mode'			=> $mode,
		'keywords'		=> ['contact', 'cta', 'dual', 'reade', 'theme', TEXTDOMAIN],
		'supports'     => ['align' => false],
	]);

	/** 
	 * Contact Form
	 * */
	acf_register_block([
		'name'			=> 'contact-form',
		'title'			=> 'Contact Form',
		'render_template'	=> get_stylesheet_directory() . "/template-parts/blocks/contact-form.php",
		'category'		=> 'theme-blocks',
		'icon'			=> 'button',
		'mode'			=> $mode,
		'keywords'		=> ['contact', 'form', 'reade', 'theme', TEXTDOMAIN],
		'supports'     => ['align' => false],
	]);

	/** 
	 * Contact Hero
	 * */
	acf_register_block([
		'name'			=> 'contact-hero',
		'title'			=> 'Contact Hero',
		'render_template'	=> get_stylesheet_directory() . "/template-parts/blocks/contact-hero.php",
		'category'		=> 'theme-blocks',
		'icon'			=> 'button',
		'mode'			=> $mode,
		'keywords'		=> ['contact', 'hero', 'reade', 'theme', TEXTDOMAIN],
		'supports'     => ['align' => false],
	]);

	/** 
	 * Contact Location Information
	 * */
	acf_register_block([
		'name'			=> 'contact-location-information',
		'title'			=> 'Contact Location Information',
		'render_template'	=> get_stylesheet_directory() . "/template-parts/blocks/contact-location-information.php",
		'category'		=> 'theme-blocks',
		'icon'			=> 'button',
		'mode'			=> $mode,
		'keywords'		=> ['contact', 'location', 'reade', 'theme', TEXTDOMAIN],
		'supports'     => ['align' => false],
	]);

	/** 
	 * Dual Block
	 * */
	acf_register_block([
		'name'			=> 'dual-block',
		'title'			=> 'Dual Block',
		'render_template'	=> get_stylesheet_directory() . "/template-parts/blocks/dual-block.php",
		'category'		=> 'theme-blocks',
		'icon'			=> 'button',			
		'image'        => $img_root . '/dual-block.webp',
		'mode'			=> $mode,
		'keywords'		=> ['dual', 'block', 'reade', 'theme', TEXTDOMAIN]
	]);
	

	/** 
	 * FAQS Accordions
	 * */
	acf_register_block([
		'name'			=> 'faqs-accordions',
		'title'			=> 'FAQs Accordions',
		'render_template'	=> get_stylesheet_directory() . "/template-parts/blocks/faqs-accordions.php",
		'category'		=> 'theme-blocks',
		'icon'			=> 'button',
		'mode'			=> $mode,
		'keywords'		=> ['faqs', 'reade', 'theme', TEXTDOMAIN]
	]);
	
		/** 
			* FAQS Hero
			* */
		acf_register_block([
			'name'			=> 'faqs-hero',
			'title'			=> 'FAQs Hero',
			'render_template'	=> get_stylesheet_directory() . "/template-parts/blocks/faqs-hero.php",
			'category'		=> 'theme-blocks',
			'icon'			=> 'button',
			'mode'			=> $mode,
			'keywords'		=> ['faqs', 'reade', 'hero', 'theme', TEXTDOMAIN],
			'supports'     => ['align' => false],
		]);
	
		/** 
			* Grid Hero
			* */
		acf_register_block([
			'name'			=> 'grid-hero',
			'title'			=> 'Grid Hero',
			'render_template'	=> get_stylesheet_directory() . "/template-parts/blocks/grid-hero.php",
			'category'		=> 'theme-blocks',
			'icon'			=> 'button',
			'image'        => $img_root . '/grid-hero.webp',
			'mode'			=> $mode,
			'keywords'		=> ['grid', 'reade', 'hero', 'theme', TEXTDOMAIN],
			'supports'     => ['align' => false],
		]);
	
		/** 
			* Industry Slider
			* */
		acf_register_block([
			'name'			=> 'industry-slider',
			'title'			=> 'Industry Slider',
			'render_template'	=> get_stylesheet_directory() . "/template-parts/blocks/industry-slider.php",
			'category'		=> 'theme-blocks',
			'icon'			=> 'button',
			'image'        => $img_root . '/industry-slider.webp',
			'mode'			=> $mode,
			'keywords'		=> ['industry', 'reade', 'slider', 'theme', TEXTDOMAIN],
			'supports'     => ['align' => false],
		]);
	
		/** 
			* Leadership Slider
			* */
		acf_register_block([
			'name'			=> 'leadership-slider',
			'title'			=> 'Leadership Slider',
			'render_template'	=> get_stylesheet_directory() . "/template-parts/blocks/leadership-slider.php",
			'category'		=> 'theme-blocks',
			'icon'			=> 'button',
			'image'        => $img_root . '/leadership-slider.webp',
			'mode'			=> $mode,
			'keywords'		=> ['reade', 'leadership', 'slider', 'theme', TEXTDOMAIN],
			'supports'     => ['align' => false], //TODO
		]);

	/**
	 * News Category
	 * */

	 acf_register_block([
		'name'			=> 'news-category',
		'title'			=> 'News Category',
		'render_template'	=> get_stylesheet_directory() . "/template-parts/blocks/news-category.php",
		'category'		=> 'theme-blocks',
		'icon'			=> 'button',
		'image'        => $img_root . '/news-category.webp',
		'mode'			=> $mode,
		'keywords'		=> ['news category', 'news', 'category', 'reade', 'theme', TEXTDOMAIN],
		'supports'     => ['align' => false],
	]);

	/**
	 * News Hero
	 * */

	 acf_register_block([
		'name'			=> 'news-hero',
		'title'			=> 'News Hero',
		'render_template'	=> get_stylesheet_directory() . "/template-parts/blocks/news-hero.php",
		'category'		=> 'theme-blocks',
		'icon'			=> 'button',
		'image'        => $img_root . '/news-hero.webp',
		'mode'			=> $mode,
		'keywords'		=> ['news hero', 'news', 'hero', 'reade', 'theme', TEXTDOMAIN],
		'supports'     => ['align' => false],
	]);

	/**
	 * News Featured
	 * */

	 acf_register_block([
		'name'			=> 'news-featured',
		'title'			=> 'News Featured',
		'render_template'	=> get_stylesheet_directory() . "/template-parts/blocks/news-featured.php",
		'category'		=> 'theme-blocks',
		'icon'			=> 'button',
		'image'        => $img_root . '/news-featured.webp',
		'mode'			=> $mode,
		'keywords'		=> ['news featured', 'news', 'featured', 'reade', 'theme', TEXTDOMAIN],
		'supports'     => ['align' => false],
	]);

	// /** 
	//  * Page Hero 
	//  * */
	// acf_register_block([
	// 	'name'			 => 'page-hero',
	// 	'title'			 => 'Hero',
	// 	'render_template'	=> get_stylesheet_directory() . "/template-parts/blocks/page-hero.php",
	// 	'category'		 => 'theme-blocks',
	// 	'icon'			 => 'button',
	// 	'image'         => $img_root . '/page-hero.webp',
	// 	'mode'			 => $mode,
	// 	'keywords'		 => ['hero', 'reade', 'theme', TEXTDOMAIN],
	// 	'supports'      => ['align' => false],
     
	// ]);

	/** 
	 * Primary Footer CTA
	 * */
	acf_register_block([
		'name'			 => 'primary-footer-cta',
		'title'			 => 'Primary Footer CTA',
		'render_template'	=> get_stylesheet_directory() . "/template-parts/blocks/primary-footer-cta.php",
		'category'		 => 'theme-blocks',
		'icon'			 => 'button',
		'image'        => $img_root . '/primary-footer-cta.webp',
		'mode'			 => $mode,
		'keywords'		 => ['footer', 'cta', 'reade', 'theme', TEXTDOMAIN],
		'supports'      => ['align' => false],
	]);

	/** 
	 * Primary Hero Banner
	 * */
	acf_register_block([
		'name'			 => 'primary-hero-banner',
		'title'			 => 'Primary Hero Banner',
		'render_template'	=> get_stylesheet_directory() . "/template-parts/blocks/primary-hero-banner.php",
		'category'		 => 'theme-blocks',
		'icon'			 => 'button',
		'image'        => $img_root . '/primary-hero.webp',
		'mode'			 => $mode,
		'keywords'		 => ['hero', 'reade', 'theme', TEXTDOMAIN],
		'supports'      => ['align' => false],
	]);

	/** 
	 * Secondary Hero
	 * */
	acf_register_block([
		'name'			 => 'secondary-hero',
		'title'			 => 'Secondary Hero',
		'render_template'	=> get_stylesheet_directory() . "/template-parts/blocks/secondary-hero.php",
		'category'		 => 'theme-blocks',
		'icon'			 => 'button',
		'image'        => $img_root . '/secondary-hero.webp',
		'mode'			 => $mode,
		'keywords'		 => ['secondary', 'hero', 'reade', 'theme', TEXTDOMAIN],
		'supports'      => ['align' => false],
	]);

	/** 
	 * Simple CTA
	 * */
	acf_register_block([
		'name'			 => 'simple-cta',
		'title'			 => 'Simple CTA',
		'render_template'	=> get_stylesheet_directory() . "/template-parts/blocks/simple-cta.php",
		'category'		 => 'theme-blocks',
		'icon'			 => 'button',
		'mode'			 => $mode,
		'keywords'		 => ['simple', 'cta', 'reade', 'theme', TEXTDOMAIN],
		'supports'      => ['align' => false],
	]);

	/** 
	 * Static Testimonial
	 * */
	acf_register_block([
		'name'			 => 'static-testimonial',
		'title'			 => 'Static Testimonial',
		'render_template'	=> get_stylesheet_directory() . "/template-parts/blocks/static-testimonial.php",
		'category'		 => 'theme-blocks',
		'icon'			 => 'button',
		'mode'			 => $mode,
		'keywords'		 => ['static', 'testimonial', 'reade', 'theme', TEXTDOMAIN],
		'supports'      => ['align' => false],
	]);
	
	/** 
		* Sustainable Dual CTA
	 * */
	acf_register_block([
		'name'			 => 'sustainable-dual-cta',
		'title'			 => 'Sustainable Dual CTA',
		'render_template'	=> get_stylesheet_directory() . "/template-parts/blocks/sustainable-dual-cta.php",
		'category'		 => 'theme-blocks',
		'icon'			 => 'button',
		'image'        => $img_root . '/sustainable-dual-cta.webp',
		'mode'			 => $mode,
		'keywords'		 => ['sustainable', 'dual', 'cta', 'reade', 'theme', TEXTDOMAIN],
		'supports'		=> ['align' => false]
	]);

		/** 
	 * Tabbed Rotator
	 * */
	acf_register_block([
		'name'			 => 'tabbed-rotator',
		'title'			 => 'Tabbed Rotator',
		'render_template'	=> get_stylesheet_directory() . "/template-parts/blocks/tabbed-rotator.php",
		'category'		 => 'theme-blocks',
		'icon'			 => 'button', //TODO
		'image'         => $img_root . '/tabbed-rotator.webp',
		'mode'			 => $mode,
		'keywords'		 => ['tabbed', 'rotator', 'reade', 'theme', TEXTDOMAIN],
		'supports'      => ['align' => false],
      //TODO
		//'enqueue_style' => get_template_directory_uri() . '/template-parts/blocks/testimonial/testimonial.css',
	]);

		/** 
	 * Testimonial Slider
	 * */
	acf_register_block([
		'name'			 => 'testimonial-slider',
		'title'			 => 'Testimonial Slider',
		'render_template'	=> get_stylesheet_directory() . "/template-parts/blocks/testimonial-slider.php",
		'category'		 => 'theme-blocks',
		'icon'			 => 'button', //TODO
		// 'image'         => $img_root . '/testimonial-slider.webp',
		'mode'			 => $mode,
		'keywords'		 => ['testimonial', 'slider', 'reade', 'theme', TEXTDOMAIN],
		'supports'      => ['align' => false],
      //TODO
		//'enqueue_style' => get_template_directory_uri() . '/template-parts/blocks/testimonial/testimonial.css',
	]);

	/**
	 * Tools CTA
	 */

	acf_register_block([
		'name'			 => 'tools-cta',
		'title'			 => 'Tools CTA',
		'render_template'	=> get_stylesheet_directory() . "/template-parts/blocks/tools-cta.php",
		'category'		 => 'theme-blocks',
		'icon'			 => 'button',
		'mode'			 => $mode,
		'keywords'		 => ['tools', 'cta', 'reade', 'theme', TEXTDOMAIN],
		'supports'      => ['align' => false]
	]);
}


function theme_register_blocks_style()
{
	if (function_exists('register_block_style')) {
		// register_block_style( 
      //    'core/group', 
      //    array( 
      //       'name' =>'blue-bg', 
      //       'label'=> __('Blue Background', TEXTDOMAIN), 
               // 'is_default'   => false, // 'inline_style' => '.wp-block-group.is-style-blue-wave', 
      //    ) 
      // );
	}
}
add_action('acf/init', 'theme_register_blocks_style');
