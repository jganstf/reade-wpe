function placeholder() {}

function handleFAQAccordion() {
	const $faq = $('.faq-accordion')
	if (!$faq.length) {
		return
	}

	$faq.each(function () {
		$(this)
			.find('.accordion-btn')
			.on('click', function () {
				$(this).attr('aria-expanded', function (i, attr) {
					return attr == 'true' ? 'false' : 'true'
				})
				$(this).parent().toggleClass('open')
				$(this)
					.siblings('.accordion-answer')
					.attr('aria-hidden', function (i, attr) {
						return attr == 'true' ? 'false' : 'true'
					})
			})
	})
}

function handleContactLocationInformation() {
	const $locations = $('.contact-information--locations button')
	const $contentBlocks = $('.contact-information--set')

	if (!$locations.length) {
		return
	}

	$locations.each(function (index) {
		$(this).on('click', function (e) {
			if ($(this).attr('aria-expanded') == 'true') {
				return
			} else {
				$locations.each(function () {
					$(this).attr('aria-expanded') == 'true'
						? $(this).attr('aria-expanded', 'false')
						: $(this).attr('aria-expanded', 'true')
				})
				$contentBlocks.each(function () {
					$(this).attr('aria-hidden') == 'true'
						? $(this).attr('aria-hidden', 'false')
						: $(this).attr('aria-hidden', 'true')
					$(this).attr('aria-hidden') == 'true'
						? $(this).removeClass('active')
						: $(this).addClass('active')
				})
			}
		})
	})
}

function handleLeadershipSlider() {
	const $slide = $('.leadership-slider--slider')
	const $contact = $('.leadership-slider-mobile--contacts')

	if (!$slide.length) {
		return
	}

	$slide.slick({
		infinite: false,
		slidesToShow: 1,
		slidesToScroll: 1,
		dots: true,
		appendDots: $('.leadership-slider--nav'),
		customPaging: function (slider, i) {
			var title = $(slider.$slides[i]).data('title')
			var position = $(slider.$slides[i]).data('position')
			return `<button class="team-member--btn"><span>${title}</span> ${
				position ? position : ''
			}</button>`
		},
		arrows: false,
		asNavFor: $contact,
		adaptiveHeight: true,
	})

	$contact.slick({
		dots: false,
		slidesToScroll: 1,
		slidesToShow: 1,
		infinite: false,
		asNavFor: $slide,
		prevArrow: $('.slick-prev-arrow'),
		nextArrow: $('.slick-next-arrow'),
	})
}

function handleTabbedRotator() {
	const $tabs = $('.tabbed-rotator--tabs')

	if (!$tabs) {
		return
	}

	let $mobileBtn = $('.current-tab')
	let $tabArr = $('.tabbed-rotator--tab')

	function toggleNavClass() {
		$('.tabbed-rotator-content--wrap').toggleClass('opened closed')
	}

	$mobileBtn.on('click', function () {
		toggleNavClass()
	})

	$tabs.slick({
		infinite: false,
		slidesToShow: 1,
		slidesToScroll: 1,
		dots: true,
		adaptiveHeight: true,
		appendDots: $('.tabbed-rotator--nav'),
		customPaging: function (slider, i) {
			var title = $(slider.$slides[i]).data('title')
			return `<button class="team-member--btn"><span>${title}</span></button>`
		},
		arrows: false,
	})

	$tabs.on('afterChange', function (event, slick, currentSlide) {
		$tabArr.each(function (index) {
			index == currentSlide ? $mobileBtn.text($(this).data('title')) : null
		})
	})

	$tabs.on('beforeChange', function (event, slick, currentSlide) {
		let x = window.matchMedia('(max-width: 1024px)')
		if (x.matches) {
			toggleNavClass()
		}
	})
}

function handleIndustrySlider() {
	const $slides = $('.industry-slider--slider')

	if (!$slides.length) {
		return
	}

	$slides.slick({
		slidesToScroll: 1,
		rows: 3,
		slidesPerRow: 2,
		adaptiveHeight: true,
		dots: true,
		appendDots: $('.industry-slider--dots'),
		prevArrow: $('.industry-slider--arrows .slick-prev-arrow'),
		nextArrow: $('.industry-slider--arrows .slick-next-arrow'),
		responsive: [
			{
				breakpoint: 768,
				settings: {
					rows: 6,
					slidesPerRow: 1,
				},
			},
		],
	})
}

function handleTestimonialSlider() {
	const $slider = $('.testimonial-slider--section')

	if (!$slider.length) {
		return
	}

	$slider.each(function () {
		$(this)
			.find('.testimonial-slider--slider')
			.slick({
				variableWidth: true,
				infinite: false,
				dots: true,
				adaptiveHeight: false,
				appendDots: $(this).find('.testimonial-slider--dots'),
				prevArrow: $(this).find('.slick-prev-arrow'),
				nextArrow: $(this).find('.slick-next-arrow'),
			})
	})

}

function runBlocks() {
	placeholder()
	handleFAQAccordion()
	handleContactLocationInformation()
	handleLeadershipSlider()
	handleTabbedRotator()
	handleIndustrySlider()
	handleTestimonialSlider()
}

export { runBlocks }
