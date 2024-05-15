/**
*
* --------------------------------------------------------------------
*
* Template : Weiboo - WooCommerce WordPress Theme

* --------------------------------------------------------------------
*
**/

(function($) {
    "use strict";
    // sticky menu
    var header = $('.menu-sticky');
    var win = $(window);
    var headerinnerHeight = $(".header-inner").innerHeight();

    win.on('scroll', function() {
       var scroll = win.scrollTop();
       if (scroll < headerinnerHeight) {
           header.removeClass("sticky");
           
       } else {
           header.addClass("sticky");
       }
    });

    $('.header-inner').waypoint('sticky', {
      offset: 0
    });

    $(".widget_nav_menu li a").filter(function(){
        return $.trim($(this).html()) == '';
    }).hide();

    // collapse hidden
    $(function(){ 
        var navMain = $(".navbar-collapse"); // avoid dependency on #id
         // when you have dropdown inside navbar
         navMain.on("click", "a:not([data-toggle])", null, function () {
             navMain.collapse('hide');
        });
     });


    // video 
    if ($('.player').length) {
        $(".player").YTPlayer();
    }    


    $(".menu-area .navbar ul > li.menu-item-has-children").hover(
        function () {
            $(this).addClass('hover-minimize');
        },
        function () {
            $(this).removeClass("hover-minimize");
        }
    );


    $( ".showcase-item" ).hover(function() {
        $( this ).toggleClass("hover");
    });
   


    //Phone Number 

    $('.phone_call').on('click', function(event) {        
        $('.phone_num_call').slideToggle('show');
    });

    //search 

     $('.sticky_search').on('click', function(event) {        
        $('.sticky_form').animate({ opacity: 'toggle' }, 500);;
        $( '.sticky_form input' ).focus();
    });


    $('.sticky_search').on('click', function() {
        $('body').removeClass('search-active').removeClass('search-close');
          if ($(this).hasClass('close-full')) {
            $('body').addClass('search-close');
             $('.sticky_form').fadeOut('show');
        }
        else {
            $('body').addClass('search-active');
        }
        return false;
    });

   
    $('.nav-link-container').on('click', function(e){
        $('body.on-offcanvas').removeClass('on-offcanvas');
        setTimeout(function(){ $('body').addClass('on-offcanvas'); },500);        
    });


    if($('.reactheme-newsletter').hasClass('reactheme-newsletters')){
        $('body').addClass('reactheme-pages-btm-gap');
    } 


    $('.sticky_form_search').on('click', function() {      
        $('body, html').removeClass('reactheme-search-active').removeClass('reactheme-search-close');
          if ($(this).hasClass('close-search')) {
          $('body, html').addClass('reactheme-search-close');

        }
        else {
          $('body, html').addClass('reactheme-search-active');
        }
        return false;
    });

   
    if($('#reactheme-header').hasClass('fixed-menu')){
        $('body').addClass('body-left-space');
    }  

    $("#reactheme-header ul > li.classic").hover(
        function () {
            $('body').addClass('mega-classic');
        },
        function () {
            $('body.mega-classic').removeClass("mega-classic");
        }
    );

    if($('.user-info').hasClass('usereactheme-d')){
        $('body').addClass('profiles');
    } 

    if($('.learn-press-form-login').hasClass('learn-press-form')){
        $('body').addClass('profiles-login');
    }

    if ($('.reacttimeline').length) {
        var items = $(".reacttimeline li, .journey-list li"),
        timelineHeight = $(".timeline ul").height(),
        greyLine = $('.default-line'),
        lineToDraw = $('.draw-line');

        if(lineToDraw.length) {
            $(window).on('scroll', function () {

            var redLineHeight = lineToDraw.height(),
            greyLineHeight = greyLine.height(),
            windowDistance = $(window).scrollTop(),
            windowHeight = $(window).height() / 2,
            timelineDistance = $(".reacttimeline").offset().top;

                if(windowDistance >= timelineDistance - windowHeight) {
                    var line = windowDistance - timelineDistance + windowHeight;
                    if(line <= greyLineHeight) {
                        lineToDraw.css({
                          'height' : line + 20 + 'px'
                        });
                    }
                }

                var bottom = lineToDraw.offset().top + lineToDraw.outerHeight(true);
                items.each(function(index){
                  var circlePosition = $(this).offset();
                    if(bottom > circlePosition.top) {               
                        $(this).addClass('in-view');
                    } else {
                        $(this).removeClass('in-view');
                    }
                }); 
            });
        }
    }

    $(document).ready(function(){
        function resizeNav() {
            $(".menu-ofcn").css({"height": window.innerHeight});
            var radius = Math.sqrt(Math.pow(window.innerHeight, 2) + Math.pow(window.innerWidth, 2));
            var diameter = radius * 2;
            $(".off-nav-layer").width(diameter);
            $(".off-nav-layer").height(diameter);
            $(".off-nav-layer").css({"margin-top": -radius, "margin-left": -radius});
        }
        $(".menu-button, .close-button").on('click', function() {
            $(".nav-toggle, .off-nav-layer, .menu-ofcn, .close-button, body").toggleClass("off-open");
        });
        $(window).resize(resizeNav);
        resizeNav();
    });
   
    // Canvas Menu Js
    $( ".nav-link-container > a" ).off("click").on("click", function(event){
        event.preventDefault();
        $(".nav-link-container").toggleClass("nav-inactive-menu-link-container");
        $(".mobile-menus").toggleClass("nav-active-menu-container");
    });

    // Get a quote popup

    $('.popup-quote').magnificPopup({
        type: 'inline',
        preloader: false,
        focus: '#qname',
        removalDelay: 500, //delay removal by X to allow out-animation
        // When elemened is focused, some mobile browsers in some cases zoom in
        // It looks not nice, so we disable it:
        callbacks: {
            beforeOpen: function() {
                this.st.mainClass = this.st.el.attr('data-effect');
                if($(window).width() < 700) {
                    this.st.focus = false;
                } else {
                    this.st.focus = '#qname';
                }
            }
        }
    });


    // Canvas Menu Js
    $( ".nav-link-container > a" ).off("click").on("click", function(event){
        event.preventDefault();
        $(".nav-link-container").toggleClass("nav-inactive-menu-link-container");
        $(".mobile-menus").toggleClass("nav-active-menu-container");
    });
    
    $(".nav-close-menu-li > a").on('click', function(event){
        $(".mobile-menus").toggleClass("nav-active-menu-container");
        $(".content").toggleClass("inactive-body");
    });


    $(".reactheme-heading h3").each(function() {
  
      // Some Vars
      var elText,
          openSpan = '<span class="first-word">',
          closeSpan = '</span>';
      
      // Make the text into array
      elText = $(this).text().split(" ");
      
      // Adding the open span to the beginning of the array
      elText.unshift(openSpan);
      
      // Adding span closing after the first word in each sentence
      elText.splice(2, 0, closeSpan);
      
      // Make the array into string 
      elText = elText.join(" ");
      
      // Change the html of each element to style it
      $(this).html(elText);
    });

  

    // Portfolio Single Carousel
    if ($('.cdev').length) {
         $(".cdev").circlos();
    }

    $(function(){ 
        $( "ul.children" ).addClass( "sub-menu" );
    });

    $(".reactheme-products-grid .product-btn .button").addClass("glyph-icon flaticon-shopping-bag");
    
     //Videos popup jQuery activation code
    $('.popup-videos').magnificPopup({
        disableOn: 10,
        type: 'iframe',
        mainClass: 'mfp-fade',
        removalDelay: 160,
        preloader: false,
        fixedContentPos: false
    });

    // collapse hidden
    $(function(){ 
         var navMain = $(".navbar-collapse"); // avoid dependency on #id
         // "a:not([data-toggle])" - to avoid issues caused
         // when you have dropdown inside navbar
         navMain.on("click", "a:not([data-toggle])", null, function () {
             navMain.collapse('hide');
         });
     });

    //Select box wrap css
    $(".menu-area .navbar ul > li.mega > ul.sub-menu").wrapInner("<div class='container flex-mega'></div>");
    $('.menu-area .navbar ul > li.mega > ul.sub-menu li').first().addClass('first-li-item');


    if ($('div').hasClass('openingfoot')) {
        $('body').addClass('openingfootwrap');
    }

  
  //preloader
    $(window).on( 'load', function() {
        $("#weiboo-load").delay(600).fadeOut(400);
        $(".weiboo-loader").delay(600).fadeOut(400);       
        

    if($(window).width() < 992) {
      $('.reactheme-menu').css('height', '0');
      $('.reactheme-menu').css('opacity', '0');
      $('.reactheme-menu').css('z-index', '-1');
      $('.reactheme-menu-toggle').on( 'click', function(){
         $('.reactheme-menu').css('opacity', '1');
         $('.reactheme-menu').css('z-index', '1');
     });
    }
    })    

     // magnificPopup init
    $('.image-popup').magnificPopup({
        type: 'image',
        callbacks: {
            beforeOpen: function() {
               this.st.image.markup = this.st.image.markup.replace('mfp-figure', 'mfp-figure animated zoomInDown');
            }
        },
        image: {
            tError: '<a href="%url%">The image #%curr%</a> could not be loaded.',
            titleSrc: function(item) {
                return '<div class="gallery-title-wrap"><h3>' + item.el.attr('title') + '</h3>' + '<p>' + item.el.attr('caption') + '</p></div>';
            }
        },
        gallery: {
            enabled: true
        }
    });


    $(window).load(function() {

    //  image loaded portfolio init
    $('.grid').imagesLoaded(function() {
        $('.portfolio-filter').on('click', 'button', function() {
            var filterValue = $(this).attr('data-filter');
            $grid.isotope({
                filter: filterValue
            });
        });
        var $grid = $('.grid').isotope({

            animationOptions: {
             duration: 750,
             easing: 'linear',
             queue: false
           },

            itemSelector: '.grid-item',
            percentPosition: true,
            masonry: {
                columnWidth: '.grid-item',
            }
        });
    });

    $('.portfolio-filter button').on('click', function(event) {
        $(this).siblings('.active').removeClass('active');
        $(this).addClass('active');
        event.preventDefault();
    });



	// init Isotope
	var $grid = $('.weiboo-grid').isotope({
		itemSelector: '.element-item',
		layoutMode: 'fitRows',
		getSortData: {
		name: '.name',
		symbol: '.symbol',
		number: '[data-sell] parseInt',
		weight: function( itemElem ) {
			var weight = $( itemElem ).find('.p-title').attr('data-sell');
			var weight2 = parseFloat( weight.replace( /[\(\)]/g, '') );
			return weight2;
		}
		},
		sortAscending: {
			weight: false, // weight descendingly
			number: false // number descendingly
		}		
	});
	
    // store filter for each group
    var filters = {};

    $('.filters').on( 'change', function( event ) {
        var $select = $( event.target );
        // get group key
        var filterGroup = $select.attr('value-group');
        var fVal = event.target.value;

        // var sortByValue = $(this).attr('data-sort-by');

        // var sortByValue = $select.attr('data-sort-by');
        if(fVal == '.number' || fVal == '.weight'){
            var fVal2 = fVal.replace(".", "");
            $grid.isotope({ sortBy: fVal2 });
        }else{
            // set filter for group
            filters[ filterGroup ] = event.target.value;
            // combine filters
            var filterValue = concatValues( filters );
            // set filter for Isotope
            $grid.isotope({ filter: filterValue });
        }
    });

    // flatten object by concatting values
    function concatValues( obj ) {
        var value = '';
        for ( var prop in obj ) {
            value += obj[ prop ];
        }
        return value;
    }

	// filter functions
	var filterFns = {
		// show if number is greater than 50
		numberGreaterThan50: function() {
		var number = $(this).find('.number').text();
		return parseInt( number, 10 ) > 50;
		},
		// show if name ends with -ium
		ium: function() {
		var name = $(this).find('.name').text();
		return name.match( /ium$/ );
		}
	};
	
	// bind filter button click
	$('.filter-box').on( 'click', '.btn-flt', function() {
		var filterValue = $( this ).attr('data-filter');
		// use filterFn if matches value
		filterValue = filterFns[ filterValue ] || filterValue;
		$grid.isotope({ filter: filterValue });
	});

	// bind sort button click
	$('.filter-box').on( 'click', '.btn-srt', function() {
		var sortByValue = $(this).attr('data-sort-by');
		$grid.isotope({ sortBy: sortByValue });
	});
	
	// change is-checked class on buttons
	$('.button-group').each( function( i, buttonGroup ) {
		var $buttonGroup = $( buttonGroup );
		$buttonGroup.on( 'click', 'button', function() {
		$buttonGroup.find('.is-checked').removeClass('is-checked');
		$( this ).addClass('is-checked');
		});
	});

    });
    
     // Counter Up  
    $('.rs-counter').counterUp({
        delay: 20,
        time: 1500
    });     
    // scrollTop init
    var win=$(window);
    var totop = $('#top-to-bottom');    
    win.on('scroll', function() {
        if (win.scrollTop() > 150) {
            totop.fadeIn();
        } else {
            totop.fadeOut();
        }
    });
    totop.on('click', function() {
        $("html,body").animate({
            scrollTop: 0
        }, 500)
    }); 

    $(function(){ 
        $( "ul.children" ).addClass( "sub-menu" );
    });

    $( ".reactheme-event-grid.event-slider-style4 .event-item .events-short" ).last().addClass( "none-borders" );
    
    $( ".comment-body, .comment-respond" ).wrap( "<div class='comment-full'></div>" );    

    //woocommerce quantity style
    if ( ! String.prototype.getDecimals ) {
          String.prototype.getDecimals = function() {
              var num = this,
                  match = ('' + num).match(/(?:\.(\d+))?(?:[eE]([+-]?\d+))?$/);
              if ( ! match ) {
                  return 0;
              }
              return Math.max( 0, ( match[1] ? match[1].length : 0 ) - ( match[2] ? +match[2] : 0 ) );
          }
      }
    // Quantity "plus" and "minus" buttons
    $( document.body ).on( 'click', '.plus, .minus', function() {
        var $qty        = $( this ).closest( '.quantity' ).find( '.qty'),
            currentVal  = parseFloat( $qty.val() ),
            max         = parseFloat( $qty.attr( 'max' ) ),
            min         = parseFloat( $qty.attr( 'min' ) ),
            step        = $qty.attr( 'step' );

        // Format values
        if ( ! currentVal || currentVal === '' || currentVal === 'NaN' ) currentVal = 0;
        if ( max === '' || max === 'NaN' ) max = '';
        if ( min === '' || min === 'NaN' ) min = 0;
        if ( step === 'any' || step === '' || step === undefined || parseFloat( step ) === 'NaN' ) step = 1;

        // Change the value
        if ( $( this ).is( '.plus' ) ) {
            if ( max && ( currentVal >= max ) ) {
                $qty.val( max );
            } else {
                $qty.val( ( currentVal + parseFloat( step )).toFixed( step.getDecimals() ) );
            }
        } else {
            if ( min && ( currentVal <= min ) ) {
                $qty.val( min );
            } else if ( currentVal > 0 ) {
                $qty.val( ( currentVal - parseFloat( step )).toFixed( step.getDecimals() ) );
            }
        }

        // Trigger change event
        $qty.trigger( 'change' );
    });
    if ($('.product-image--slider').length) {
        const swiper = new Swiper('.product-image--slider', {
            // Optional parameters
            // direction: 'vertical',
            loop: true,
            // If we need pagination
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            // Navigation arrows
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            // And if we need scrollbar
            scrollbar: {
                el: '.swiper-scrollbar',
            },
        });
    }
    if ($('.product-image--slider-shop').length) {
        const swiperShop = new Swiper('.product-image--slider-shop', {
            // Optional parameters
            // direction: 'vertical',
            loop: true,
            // If we need pagination
            pagination: {
                el: '.swiper-pagination',
            },
            // Navigation arrows
            navigation: {
                nextEl: '.swiper-button-next-shop',
                prevEl: '.swiper-button-prev-shop',
            },
            // And if we need scrollbar
            scrollbar: {
                el: '.swiper-scrollbar',
            },
        });
    }



    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
    const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));
    const cartBTn = $(".rt-product--grid .classic-product .second-product .product-cart a.button");
    const addedToCart = $(".rt-product--grid .classic-product .second-product .product-cart a.added_to_cart");

    cartBTn.html('<i class="rt-cart-shopping"></i>');

    cartBTn.click(function(){
        addedToCart.html('<i class="rt-basket-shopping"></i>');
      });

    addedToCart.html('<i class="rt-basket-shopping"></i>');

    const orderReview =  document.querySelector('.woocommerce-checkout form.checkout #order_review');
      if(orderReview){
          orderReview.insertAdjacentHTML('afterbegin', `<h3 id="order_review_head">Your order</h3>`);
      }
   
    const hasSubMenu = $('.weiboo-pcat .sub-menu');    
    hasSubMenu.find("ul").hide();
    $(".weiboo-pcat .sub-menu .toggler").click(function () {
        $(this).parent(".weiboo-pcat .sub-menu").children("ul").slideToggle("100");
     
    });

    $(window).on('elementor/frontend/init', function () { 
        elementorFrontend.hooks.addAction( 'frontend/element_ready/global', function( $scope ) {
            const cartParent = $('.cart-icon-instedof-text');
            const addToCart = $('.cart-icon-instedof-text .add_to_cart_button');
            addToCart.html('<i class="rt-basket-shopping add-to-cart-icon"></i>');

            
           
        });
    });

    
    if ($('.rt-nice-select').length) {
        $('.rt-nice-select').niceSelect();
    };

    // Menu Expand on Click
    let linkMenu = $('.expand-on-click.menu-area .navbar ul li');
    linkMenu.click(function(){
        let linkSubMenu = $(this).find("ul");
        if( linkSubMenu.hasClass("menu-expand-click") ){
            linkSubMenu.removeClass("menu-expand-click");
        }else{
            let parentMenu = $(this).parent();
            let allSub = parentMenu.find("li ul");
            allSub.removeClass("menu-expand-click");
            linkSubMenu.addClass("menu-expand-click");            
        }
    });

    $(document).on("click", function(event){
        var $trigger = linkMenu;
        let linkSubMenu2 = linkMenu.find("ul");
        if($trigger !== event.target && !$trigger.has(event.target).length){
            linkSubMenu2.removeClass("menu-expand-click");
        }
    });

    $(window).on( 'load', function() {
        const pviewConatiner = $('.change-wooproduct-view');
        const gridViewt = $('.change-wooproduct-view .pgrid-view');
        const listViewt = $('.change-wooproduct-view .plist-view ');
        const productConatiner = $('.woocommerce-shop.woocommerce.archive ul.products');
        listViewt.on("click", function(event){
            productConatiner.addClass('list-view-product-archive');
        });
        gridViewt.on("click", function(event){
            productConatiner.removeClass('list-view-product-archive');
        });
        // Weiboo Subscription Modal
        const modalId = document.getElementById('weibooSubscriptionModal');
        if(modalId){
            var myModal = new bootstrap.Modal(modalId, {
              keyboard: false
            });
            function weibooModalHandle() {
              myModal.show();
            }
            // const myTimeout = setTimeout(weibooModalHandle, 1000);
            if (localStorage.getItem("isWeibooSubModalShow") === null) {
                const myTimeout = setTimeout(weibooModalHandle, 1000);
                localStorage.setItem("isWeibooSubModalShow", true);
            }
        }
    });


})(jQuery);


const addToCartBox = document.querySelectorAll('.cart-icon-instedof-text');
addToCartBox.forEach( item => {
    const changeAddedToCartIcon = function(e){
        if (e.target.classList.contains('add_to_cart_button') || e.target.classList.contains('rt-basket-shopping') ) {
            const innerItem = e.target;
            const addedToCartBox = innerItem.closest('.cart-icon-instedof-text');
            const anchorAdd = addedToCartBox.querySelector('.add_to_cart_button');
            const iconTag = anchorAdd.querySelector('i');
            const addtoCartNw = addedToCartBox.querySelector('.add-to-cart-icon');
            iconTag.classList.remove('rt-basket-shopping');
            iconTag.classList.add("animate-spin","rt-spin4");
        }
    }

    item.addEventListener('click', changeAddedToCartIcon.bind(1));   

})


// $(window).load(function() {
//     function activateAllTooltips(){

//         // const addToCartTool = $('.cart-icon-instedof-text .add_to_cart_button');
//         // addToCartTool.attr({"data-bs-toggle":"tooltip","data-bs-title": "Add to Cart", "title":"Add to Cart", "data-bs-original-title":"Add to Cart" });            
//         // const quicView = $('.yith-wcqv-button');
//         // quicView.attr({"data-bs-toggle":"tooltip","data-bs-title": "Quick View", "title":"Quick View", "data-bs-original-title":"Quick View" });

//         // const addtoWish = $('.yith-wcwl-add-button .add_to_wishlist');
//         // addtoWish.attr({"data-bs-toggle":"tooltip","data-bs-title": "Add to Wishlist", "title":"Add to Wishlist", "data-bs-original-title":"Add to Wishlist" });

//         jQuery('[data-bs-toggle="tooltip"]').tooltip();
//     }
//     const bsTooltip = setTimeout(activateAllTooltips, 1000);
// });