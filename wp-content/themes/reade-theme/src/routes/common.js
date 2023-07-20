// import bigpicture from 'bigpicture'
import lozad from 'lozad';

import { runFunctions } from './_functions';
import { runBlocks } from './_blocks';

const { $ } = window;
const $body = $( document.body );

export default {
	init() {
		const observer = lozad( 'img' ); 
		observer.observe();
		$('.hero img').attr('loading', 'eager')

		runFunctions();
		runBlocks();
		// runIO()
	},
	finalize() {
		// JavaScript to be fired on all pages, after page specific JS is fired
		// class to hide outlines if not using keyboard
		$body.on( 'mousedown', function() {
			$body.addClass( 'using-mouse' );
		} );
		$body.on( 'keydown', function() {
			$body.removeClass( 'using-mouse' );
		} );

		/**
		 * News page, tf dropdown action
		 */
		function handleTFDropdown() {
			if ($('.news-featured').length) {
				if ($('.tf-dropdown').length) {
					$('.tf-dropdown ul li').on('click', function() {
						document.location.href = $(this).data('key');
					})
				}
			}
		}

		/**
		 * News/archive page, view more functionality
		 */
		// this variable needs to be global
		let cardsPerPage;

		function handleNewsCardPagination() {
			// if you change these values, also change the window.onresize() values
			if (window.innerWidth < 769) {
				cardsPerPage = 3;

			} else {
				cardsPerPage = 6;
			}

			let $cards = $('.news-card-regular');
			let totalCards = $cards.length;
			let cardsToShow = Math.min(cardsPerPage, totalCards);
			let shownCards = cardsToShow;

			if ($('.view-more').length) {

				$cards.slice(cardsToShow, totalCards).hide();

				if (totalCards <= cardsPerPage) {
					$('#view-more').hide();
				} else {
					$('#view-more').show();
				}

				$('#view-more').click(function() {
					cardsToShow += cardsPerPage;
					$cards.slice(shownCards, cardsToShow).fadeIn();
					shownCards = cardsToShow;

					if (shownCards >= totalCards) {
						$('#view-more').hide();
					}
				});
			};
		}


		/*
		* news single share positioning
		*/
		function handleNewsSharePosition() {
			if (window.innerWidth > 1024) {
				if ($('#single-share').length) {
					var parentContainer = $('#single-container');
					var childElement = $('#single-news-content');
					$('#single-share').css('top', childElement.offset().top - parentContainer.offset().top);
				}
			}
		}







		/** WOOCOMMERCE JS **/
		function handleSingleProductDropdown() {
			$('body.single-product #select1 ul li, body.single-product #select2 ul li').on('click', function() {
				// hide all
				$('.product-rfq-select').addClass('tf-dropdown-hidden');

				// show relevant select box
				if ($('#product-rfq-select-' + $(this).data('key')).length) {
					$('#product-rfq-select-' + $(this).data('key')).removeClass('tf-dropdown-hidden');
				}

				// update submitted product hidden input
				if ($('#submitted_product_1').length) {
					$('#submitted_product_1').val($(this).data('key'));
					$('.submitted_product_1_variant').attr('id', 'product-' + $(this).data('key') + '-variant');
				}
			});
		}

		function handleSingleRFQDropdown() {
			$('body.single-product ul li').on('click', function() {
				let parent = $(this).parent().parent().parent().parent().attr('id').replace('product-rfq-select-', '');
				$('#product-' + parent + '-variant').val($(this).data('key'));
			});
		}

		function handleSingleQTYUnits() {
			if ($('#product-units').length) {
				$('#product-units ul li').on('click', function() {
					$('#product-qty-units').val($(this).data('key'));
				});
			}
		}

		function validateRFQForm(product_data) {

			let error_msg = '';

			/* Simple product */
			if (product_data.product_type == 'skip_crosssell') {
				if (product_data.product_1_variant == '') {
					error_msg = 'Please select ' + product_data.product_1_attribute_name.toLowerCase();
				} else {
					if (isNaN(product_data.product_qty)) {
						error_msg = 'Please select quantity';
					}
				}
			}

			/* Multiple attributes, OR */
			if (product_data.product_type == 'multiple_attributes_or') {

				// count visible selection dropdowns
				let visible_count = $('.product-rfq-select:visible').length;
				
				if (visible_count === 0) {
					error_msg = 'Please select specification';
				} else {
					if (product_data.product_1_variant == '') {
						error_msg = 'Please select ' + $('#product-' + product_data.product_1 + '-attribute-name').val().toLowerCase();
					} else {
						if (isNaN(product_data.product_qty)) {
							error_msg = 'Please select quantity';
						}
					}
				}
			}

			/* Multiple attributes, AND */
			if (product_data.product_type == 'multiple_attributes_and') {

				if (product_data.product_1_variant == '') {
					error_msg = 'Please select ' + $('#product-' + product_data.product_1 + '-attribute-name').val().toLowerCase();
				} else {
					if (product_data.product_2_variant == '') {
						error_msg = 'Please select ' + $('#product-' + product_data.product_2 + '-attribute-name').val().toLowerCase();
					} else {
						if (isNaN(product_data.product_qty)) {
							error_msg = 'Please select quantity';
						}
					}
				}
			}

			if (error_msg == '') {
				$('#product-rfq-error-message').css('display', 'none');
				return true;
			} else {
				$('#product-rfq-error-message').html(error_msg);
				$('#product-rfq-error-message').css('display', 'block');
				return false;
			}

		}

		function handleAddToQuote() {
			$('#product-submit-button').on('click', function() {

				$(this).find('.spinner').css('display', 'block');
				$(this).find('svg:not(.spinner').css('display', 'none');
				// gather data
				let multiple_attributes = $('#multiple_attributes').length ? $('#multiple_attributes').val() : '0';
				let product_1 = $('#submitted_product_1').length ? $('#submitted_product_1').val() : false;
				let product_1_variant = $('#product-' + $('#submitted_product_1').val() + '-variant').length ? $('#product-' + $('#submitted_product_1').val() + '-variant').val() : false;
				let product_2 = $('#submitted_product_2').length ? $('#submitted_product_2').val() : false;
				let product_2_variant = $('#product-' + $('#submitted_product_2').val() + '-variant').length ? $('#product-' + $('#submitted_product_2').val() + '-variant').val() : false;
				let product_qty = $('#product-qty').val() && !isNaN($('#product-qty').val()) ? $('#product-qty').val() : '1';
				let product_unit = $('#product-qty-units').val() ? $('#product-qty-units').val() : 'units';
				let skip_crosssell = $('#skip_crosssell').length ? 1 : false;
				let product_type = $('#product_type').val() ? $('#product_type').val() : false;
				let product_1_attribute_name = $('#product_1_attribute_name').val() ? $('#product_1_attribute_name').val() : false;

				let product_data = {};
				product_data['multiple_attributes'] = multiple_attributes;
				product_data['product_1'] = product_1;
				product_data['product_1_variant'] = product_1_variant;
				product_data['product_2'] = product_2;
				product_data['product_2_variant'] = product_2_variant;
				product_data['product_qty'] = product_qty;
				product_data['product_unit'] = product_unit;
				product_data['skip_crosssell'] = skip_crosssell;
				product_data['product_type'] = product_type;
				product_data['product_1_attribute_name'] = product_1_attribute_name;

				if (!validateRFQForm(product_data)) {
					$(this).find('.spinner').css('display', 'none');
					$(this).find('svg:not(.spinner').css('display', 'block');
					return;
				}

				$.ajax({
		            type: "POST",
		            url: "/wp-content/themes/reade-theme/_woo-ajax.php",
		            data: 'action=doAddToQuote&data=' + JSON.stringify(product_data),
		            success: function(responseText){
		            	$('#product-submit-button').find('.spinner').css('display', 'none');
		            	$('#product-submit-button').find('svg:not(.spinner)').css('display', 'block');
		              if (responseText == 'success') {
		              	$('#hidden-lity-opener').click();
		              }
		            },
		            error: function() {
		            	$('#product-submit-button').find('.spinner').css('display', 'none');
		            	$('#product-submit-button').find('svg:not(.spinner)').css('display', 'block');
		            },
		            complete: function() {
		            	$('#product-submit-button').find('.spinner').css('display', 'none');
		            	$('#product-submit-button').find('svg:not(.spinner)').css('display', 'block');
		            }
		          });
			});
		}

		// function handleAddToQuote() {
		// 	$('#add-to-quote-button').on('click', function() {
				
		// 	})
		// }

		// run functions
		handleTFDropdown();
		handleNewsCardPagination();
		handleNewsSharePosition();

		// woocommerce functions
		handleSingleProductDropdown();
		handleSingleRFQDropdown();
		handleSingleQTYUnits();
		handleAddToQuote();






		// window resize
		window.onresize = function() {
			
			/**
			 * Change pagination of news cards/grids
			 */
			if ($('.view-more').length) {
				if (window.innerWidth < 769) {
					cardsPerPage = 3;
				} else {
					cardsPerPage = 6;
				}
		
				$cards = $('.news-card-regular');
				totalCards = $cards.length;
				//if (cardsToShow == cardsPerPage) {
					cardsToShow = Math.min(cardsPerPage, totalCards);
				//} else {
					//cardsToShow = $('.news-card-regular:visible').length;
				//}
				shownCards = cardsToShow;

				$cards.slice(0, cardsToShow).show();
				$cards.slice(cardsToShow, totalCards).hide();
		
				if (totalCards <= cardsPerPage) {
					$('#view-more').hide();
				} else {
					$('#view-more').show();
				}
			}


			/**
			 * Share element positioning
			 */
			if (window.innerWidth > 1024) {
				if ($('#single-share').length) {
					var parentContainer = $('#single-container');
					var childElement = $('#single-news-content');
					$('#single-share').css('top', childElement.offset().top - parentContainer.offset().top);
				}
			} else {
				if ($('#single-share').length) {
					$('#single-share').css('top', '0');
				}
			}
		}
	},
};
