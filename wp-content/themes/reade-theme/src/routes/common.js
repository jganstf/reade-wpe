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
		if ($('.news-featured').length) {
			if ($('.tf-dropdown').length) {
				$('.tf-dropdown ul li').on('click', function() {
					document.location.href = $(this).data('key');
				})
			}
		}

		/**
		 * News/archive page, view more functionality
		 */

		let cardsPerPage;

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


		/**
		 * News Search
		 */
		if ($('.news-search').length) {
			$('.news-search').on('click', function() {

			})
		}

		//TODO bigpicture on img



		// window resize
		window.onresize = function() {
			
			// change pagination of cards on news pages/grids
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
		}
	},
};

function runIO() {
	// const options = {
	//   root: null,
	//   rootMargin: '0px',
	//   threshold: [],
	// };

	//closure
	let count = 0;
	setInterval( () => {
		count = Math.max( 0, count - 1 );
	}, 350 );
	function handleIntersection( entries ) {
		entries.map( ( entry ) => {
			if ( entry.isIntersecting ) {
				count++;
				setTimeout( () => {
					entry.target.classList.add( 'show' );
				}, ( count % 5 ) * 50 );
			}
			// else {
			//   entry.target.classList.remove('visible')
			// }
		} );
	}

	const io = new IntersectionObserver( handleIntersection );//, options);
	//match io.scss
	$( `
    .landing-hero-content > *, 
    .page-default-content *[class*=-content] > *,
    *[class*=-img]:not(.clients-img) > *
  ` ).each( ( _, el ) => io.observe( el ) );
}
