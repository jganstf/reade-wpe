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
		$('.hero img, .primary-hero--figure img').attr('loading', 'eager')

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


		function handleRemoveFromQuote() {
			$('.removeFromQuote').on('click', function() {

				let cartKey = $(this).data('cartKey');

				$.ajax({
		            type: "POST",
		            url: "/wp-content/themes/reade-theme/_woo-ajax.php",
		            data: 'action=doRemoveFromQuote&key=' + JSON.stringify(cartKey),
		            success: function(responseText){
		              if (responseText == 'success') {
		              	$('#cart-item-' + cartKey).fadeOut(200, function() {
		              		if (!$('.piq-cart-item:visible').length) {
		              			$('.piq-additional-notes, .rfq-notes, .piq-container-right').css('display', 'none');
		              			$('.rfq-empty').css('display', 'flex');
		              		}
		              	});
		              }
		            },
		            error: function() {
		            	//alert('there was an error');
		            },
		            complete: function() {
		            }
		          });
			})
		}

		function handleChangeUnits() {
			$('.tf-dropdown ul li').on('click', function() {
				let cartKey = $(this).parent().parent().parent().parent().parent().parent().parent().data('cartKey');
				let unit = $(this).text();

				 $.ajax({
		            type: "POST",
		            url: "/wp-content/themes/reade-theme/_woo-ajax.php",
		            data: 'action=doChangeUnits&newUnit=' + unit + '&cartKey=' + cartKey,
		            success: function(responseText){
		              if (responseText == 'success') {
		              	//$('#cart-item-' + cartKey).fadeOut();
		              }
		            },
		            error: function() {
		            	//alert('there was an error');
		            },
		            complete: function() {
		            }
		          });
			});
		}

		function debounce(fn, duration) {
				var timer;
				return function(e){
				  clearTimeout(timer);
				  timer = setTimeout(fn, duration, e);
				}
			  }

		function debounceSearch(fn, duration) {
				var timer;
				return function(){
				  clearTimeout(timer);
				  timer = setTimeout(fn, duration);
				}
			  }

		function handleChangeQty() {
			$('.product-qty').on('input', debounce((e) => {
				// how to get $(this) data here?
				// curently
				let cartKey = $(e.target).data('cartKey');
				let qtyVal = $(e.target).val();

				$.ajax({
		            type: "POST",
		            url: "/wp-content/themes/reade-theme/_woo-ajax.php",
		            data: 'action=doChangeQty&cartKey=' + cartKey + '&qty=' + qtyVal,
		            success: function(responseText){
		            	//alert(responseText);
		              if (responseText == 'success') {
		              	//$('#cart-item-' + cartKey).fadeOut();
		              }
		            },
		            error: function() {
		            	//alert('there was an error');
		            },
		            complete: function() {
		            }
		          });

			}, 500));
		}

		function handleRFQSubmit() {
			$('.piq-container-right button').on('click', function() {
				$.ajax({
		            type: "POST",
		            url: "/wp-content/themes/reade-theme/_woo-ajax.php",
		            data: 'action=doSubmit&formData=x',
		            success: function(responseText){
		            	//alert(responseText);
		              if (responseText == 'success') {
		              	document.location.href = '/itemized-rfq-form-success/';
		              }
		            },
		            error: function() {
		            	//alert('there was an error');
		            },
		            complete: function() {
		            }
		          });
			})
		}

		function handleProductCustomField() {
			$('.product-custom-fields-title').on('click', function() {
				if ($(this).next().css('display') == 'none') {
					$(this).find('svg').css('transform', 'rotate(180deg)');
				} else {
					$(this).find('svg').css('transform', 'unset');
				}

				$(this).next().slideToggle(250);
			});
		}

		let categoryType = '.pab-category';
		let searchLoaded = false;



		if (document.body.classList.contains('post-type-archive-product')) {
			  let currentPage = 1;
			  let elementsPerPage;
			  let totalElements = $(categoryType).length;

			  if (window.innerWidth < 640) {
			  	elementsPerPage = 3;
			  } else {
			  	elementsPerPage = 6;
			  }

			  function showElements(startIndex, endIndex) {
			    $('.pab-category').hide();
			    let pabs = $(categoryType).slice(startIndex, endIndex);
				pabs.each(function() {
					$(this).fadeIn(250);
				});
			  }

			  function updatePaginationButtons() {
			    $('.prev-btn').prop('disabled', currentPage === 1);
			    $('.next-btn').prop('disabled', currentPage === Math.ceil(totalElements / elementsPerPage));
			  }

			  function updateDots(create=false) {

			  	if (create) {
			  		let pages = Math.ceil($('.search-result').length / elementsPerPage);
			  		$('.pab-pagination-dots').html('');
			  		currentPage = 1;
			  		for (let i = 0; i < pages; i++) {
			  			$('.pab-pagination-dots').append('<svg ' + (i+1 == currentPage ? 'class="pab-pagination-dot-current" ' : '') + 'width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="5.74709" cy="5.9999" r="5.24416" stroke="#009FC6"></circle></svg>');
			  		}
			  		
			  		totalElements = $(categoryType).length;
			  		updatePaginationButtons();
			  	} else {
				  	let dots = $('.pab-pagination-dots svg');
				  	dots.removeClass('pab-pagination-dot-current');

				  	for (let i = 0; i < dots.length; i++) {
				  		if (i + 1 == currentPage) {
				  			dots[i].classList.add('pab-pagination-dot-current');
			  			}
			  		}

			  		
			  	}

			  }

			  showElements(0, elementsPerPage); // Initially show the first 3 elements
			  updatePaginationButtons();
			  updateDots();

			  $('.prev-btn').on('click', function() {
			    if (currentPage > 1) {
			      currentPage--;
			      const startIndex = (currentPage - 1) * elementsPerPage;
			      const endIndex = startIndex + elementsPerPage;
			      showElements(startIndex, endIndex);
			      updatePaginationButtons();
			      updateDots();
			    }
			  });

			  $('.next-btn').on('click', function() {
			    if (currentPage < Math.ceil(totalElements / elementsPerPage)) {
			      currentPage++;
			      const startIndex = (currentPage - 1) * elementsPerPage;
			      const endIndex = startIndex + elementsPerPage;
			      showElements(startIndex, endIndex);
			      updatePaginationButtons();
			      updateDots();
			    }
			  });



			  function handleSearch() {
				$('.pab-filters-search').on('keyup', debounceSearch(() => {
					let search = $('.pab-filters-search').val().toLowerCase();

					if (search.length >= 3) {
						// set category type to search
						categoryType = '.search-result';
						searchLoaded = true;

						$('.pab-category').hide();

						let allCats = $('.pab-category');

						for (let i = 0; i < allCats.length; i++) {
							if ($(allCats[i]).data('searchTerms').indexOf(search) !== -1) {
								$(allCats[i]).addClass('search-result');
							} else {
								$(allCats[i]).removeClass('search-result');
							}
						}

						showElements(0, elementsPerPage);
						updateDots(true);

					} else {
						if (searchLoaded) {
							categoryType = '.pab-category';
							showElements(0, elementsPerPage);
							updateDots();
							updatePaginationButtons();
							searchLoaded = false;

							totalElements = $(categoryType).length;
					  		let pages = Math.ceil($('.pab-category').length / elementsPerPage);
					  		currentPage = 1;
					  		$('.pab-pagination-dots').html('');
					  		for (let i = 0; i < pages; i++) {
					  				$('.pab-pagination-dots').append('<svg ' + (i+1 == currentPage ? 'class="pab-pagination-dot-current" ' : '') + 'width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="5.74709" cy="5.9999" r="5.24416" stroke="#009FC6"></circle></svg>');
					  		}
					  		updatePaginationButtons();
						}
					}

				}, 250));
			}

			handleSearch();
		}

		

		// run functions
		handleTFDropdown();
		handleNewsCardPagination();
		handleNewsSharePosition();

		// woocommerce functions
		handleSingleProductDropdown();
		handleSingleRFQDropdown();
		handleSingleQTYUnits();
		handleAddToQuote();
		handleRemoveFromQuote();
		handleChangeUnits();
		handleChangeQty();
		handleRFQSubmit();
		handleProductCustomField();




		window.addEventListener('resize', function handleResize() {
			/* Per page elements for products */
			if (window.innerWidth < 640) {
				if (3 != elementsPerPage) {
					elementsPerPage = 3;
					showElements(0, elementsPerPage);
			  		updatePaginationButtons();
			  		updateDots();
				};
			} else {
				if (6 != elementsPerPage) {
					elementsPerPage = 6;
					showElements(0, elementsPerPage);
			  		updatePaginationButtons();
			  		updateDots();
				}
			}
		})

		// window resize
		window.addEventListener('resize', function() {
			
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


			
		});
	},
};
