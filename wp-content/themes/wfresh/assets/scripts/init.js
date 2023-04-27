var wf = wf || {
    init: function() {
        try {
            wf.sidemenu();
            wf.header();
            wf.woocommerce();
            wf.woofilter();
            wf.page();
        } catch (e) {
            console.debug(e);
        }
    },
    resize: function() {
        try {} catch (e) {
            console.debug(e);
        }
    },
    sidemenu: function() {
        $('header .menu ul li a#mobile-nav').on('click', function(e) {
            e.preventDefault();
            $('header .menu ul.hamburger').toggleClass('checked');
            $('#theme-wrapper').toggleClass('side-menu');
        });
    },
    header: function() {

    },
    page: function() {
        var p = $('.page .page-content .container-fluid');
        if (p.hasClass('privacy') ||
            p.hasClass('terms') ||
            p.hasClass('returns') ||
            p.hasClass('faq') ||
            p.hasClass('track-order')) {
            $('<div class="sidebar margintop paddingleft"><a href="/faq">FAQ</a><a href="/terms">Terms & Conditions</a><a href="/returns">Return Policy</a><a href="/privacy">Privacy</a><a href="/track-order">Track Order</a></div>').prependTo('.page .page-content');
        }
        if (p.hasClass('privacy')) {
            $('.page .sidebar a:contains(Privacy)').addClass('active');
        }
        if (p.hasClass('faq')) {
            $('.page .sidebar a:contains(FAQ)').addClass('active');
            $('.faq .questions a').click(function(e) {
                if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
                    var target = $(this.hash);
                    target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
                    if (target.length) {
                        $('html, body').animate({
                            scrollTop: target.offset().top
                        }, 400);
                        return false;
                    };
                };
                e.preventDefault();
            });
        };
        if (p.hasClass('terms')) {
            $('.page .sidebar a:contains(Terms & Conditions)').addClass('active');
        }
        if (p.hasClass('track-order')) {
            $('.page .sidebar a:contains(Track Order)').addClass('active');
        }
        if (p.hasClass('returns')) {
            $('.page .sidebar a:contains(Return Policy)').addClass('active');
        }
        $('footer .fb.share a').click(function(e) {
            e.preventDefault();
            window.open($(this).attr('href'), 'ShareWindow', 'height=450, width=550, top=' + ($(window).height() / 2 - 275) + ', left=' + ($(window).width() / 2 - 225) + ', toolbar=0, location=0, menubar=0, directories=0, scrollbars=0');
            return false;
        });
        $('footer .tw.share a').click(function(e) {
            e.preventDefault();
            window.open($(this).attr('href'), 'ShareWindow', 'height=250, width=550, top=' + ($(window).height() / 2 - 275) + ', left=' + ($(window).width() / 2 - 225) + ', toolbar=0, location=0, menubar=0, directories=0, scrollbars=0');
            return false;
        });
    },
    woocommerce: function() {
        $('.products-slider-wrapper .products').owlCarousel({
            nav: true,
            navText: ['<i class="fa fa-angle-left""></i>', '<i class="fa fa-angle-right"></i>'],
            dots: false,
            loop: false,
            responsive: {
                0: {
                    items: 2,
                },
                600: {
                    items: 5,
                },
                1000: {
                    items: 6,
                }
            }

        });
        $('.yith-wcwl-add-to-wishlist .ajax-loading, #yith-wcwl-popup-message').remove();
        if ($('.wishlist-empty')[0]) {
            $('.wishlist-title').remove();
            $('.wishlist_table thead').remove();
        }
        $('.woocommerce ul.products li h3').remove();
        $('.woocommerce-result-count').appendTo('.woocommerce .content-header');
        $('.woocommerce .woocommerce-ordering').appendTo('.woocommerce .content-header');
        if ($('body').hasClass('woocommerce-account')) {
            $('header .col_12 .header-group .verticalize .cart li:first-child').addClass('current-menu-item');
        };
        if ($('body').hasClass('woocommerce-wishlist')) {
            $('header .col_12 .header-group .verticalize .cart li:nth-child(2)').addClass('current-menu-item');
        };
        if ($('body').hasClass('woocommerce-cart')) {
            $('.page-content').addClass('woocommerce paddingtop container-fluid clearfix');
            $('header .col_12 .header-group .verticalize .cart li:last-child').addClass('current-menu-item');
            $('.woocommerce-cart-form').addClass('col col_8');
            $('.woocommerce .cart-collaterals').addClass('col col_4');
        };
        if ($('body').hasClass('single-product')) {
            $('.woocommerce.single-product .woocommerce-tabs > *').wrapAll('<div class="container"></div>');
            $('#theme-wrapper #sidebar').remove();
        }
        if ($('body').hasClass('single-product') || $('body').hasClass('woocommerce-cart')) {
            var inputNum = $('input.input-text.qty');

            function customNumInput() {
                if (inputNum.length) {
                    inputNum.each(function() {
                        var thisInput = $(this);

                        thisInput.parent('.quantity').append('<a id="up" href="#">+</a><a id="down" href="#">-</a>');
                        var adjustVal = thisInput.siblings('a');

                        adjustVal.on('click', function(e) {
                            var minVal = parseInt(thisInput.attr('min'));
                            var maxVal = parseInt(thisInput.attr('max'));
                            e.preventDefault();
                            var $this = $(this);
                            var value = parseInt(thisInput.val());
                            if (isNaN(minVal)) {
                                minVal = 0;
                            }

                            if (isNaN(maxVal)) {
                                maxVal = Number.MAX_VALUE;
                            }

                            if ($this.is('#down') && (value > minVal)) {
                                value--;
                            } else if ($this.is('#up') && (value < maxVal)) {
                                value++;
                            }
                            thisInput.val(value);
                        });
                    });
                }
            }
            customNumInput()
        }
        if ($('body').hasClass('woocommerce-checkout')) {
            $('.page-content .woocommerce').addClass('paddingtop container-fluid clearfix');
        }
    },
    woofilter: function() {

        var colWidth, $products = $(".archive.woocommerce ul.products");

        if (window.innerWidth > 1050) colWidth = $products.width() / 4;
        else if (window.innerWidth > 765 && window.innerWidth <= 1050) colWidth = $products.width() / 3;
        else if (window.innerWidth > 450 && window.innerWidth <= 765) colWidth = $products.width() / 2;
        else colWidth = ($products.width() / 1 - 50);

        $products.isotope({
            itemSelector: 'li',
            filter: '*',
            getSortData: {               
                size: "[data-size]",
                           
            },
            layoutMode: 'masonry',
            masonry: {   
                columnWidth: colWidth,
                sFitWidth: true,
                 
            },
            animationOptions: {
                duration: 750,
                easing: 'linear',
                queue: false
            }
        });

        $('.archive.woocommerce ul.products li').each(function(i) {
            setTimeout(function() {
                $('.archive.woocommerce ul.products li').eq(i).addClass("post-loaded animate");
            }, 200 * (i + 1));
        });
        $('.archive.woocommerce ul.products li').each(function(i) {
            setTimeout(function() {
                $('.archive.woocommerce ul.products li').eq(i).removeClass("post-loaded");
            }, 400 * (i + 1));
        });


        $('.archive #theme-wrapper .filter section ul li a').click(function() {
            $('.archive #theme-wrapper .filter section ul li a').removeClass('active');
            $(this).addClass('active');

            var selector = $(this).attr('data-filter');
            $products.isotope({
                filter: selector,
                animationOptions: {
                    duration: 750,
                    easing: 'linear',
                    queue: false
                }
            });
            return false;
        });
        var s;   
        $(".field-text").on("input", "#menu-search", function() {       
            clearTimeout(s);       
            var e = $(this);       
            s = setTimeout(function() {           
                var t = e.val().toLowerCase(),
                    o = t ? function() {                   
                        var e = $(this),
                            o = e.data("name") ? e.data("name") : "";                   
                        return o.match(new RegExp(t));               
                    } : "*";           
                $(".products").isotope({               
                    filter: o           
                });
            }, 300);   
        });

        $products.on('arrangeComplete',
            function(event, filteredItems) {
                $('.archive #theme-wrapper #pageandresult #resultcount .totalcount').text(filteredItems.length);
            }
        );

        $(window).resize(function() {

            $products.isotope({
                layoutMode: 'masonry',
                masonry: {   
                    columnWidth: colWidth,
                    sFitWidth: true,
                     
                }       
            });
        });
    },
};

var $ = jQuery.noConflict();
$(function() {   
    wf.init();
});
$(window).resize(function() {   
    wf.resize();
});
$(window).load(function() {});
