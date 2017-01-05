
/* Open when someone clicks on the span element */
function openNav() {
    $('#instafeed').find('img').hide();
    $($('#instafeed').find('img')[parseInt(Math.random() * 100 % 15, 10)]).fadeIn();

    $('#overlay-menu').removeClass('fadeOut')
    $('#overlay-menu').addClass('animated fadeIn');
    $('#overlay-menu').show();
    $('#nav-icon1').addClass('open');
    $('#nav-menu').html('close menu');
};

/* Close when someone clicks on the "x" symbol inside the overlay */
function closeNav() {
    $('#overlay-menu').removeClass('fadeIn')
    $('#overlay-menu').addClass('animated fadeOut');
    $('#overlay-menu').fadeOut();
    $('#nav-icon1').removeClass('open');
    $('#nav-menu').html('menu');
};

$(function () {
    var pageLoadingEnabled = 0;

    var feed = new Instafeed({
        get: 'user',
        limit: 15,
        resolution: 'standard_resolution',
        userId: '4266168427',
        accessToken: '4266168427.1677ed0.bf4887a85d5d48d3828b1fa66f8ea871',
        template: '<img style="display: none;" src="{{image}}"></img>',
        after: function() {


        }
    });
    feed.run();

    $('#nav-icon1').click(function () {
        if ($('#nav-icon1').hasClass('open')) {
            closeNav();
        } else {
            openNav();
        }
        return false;
    });

    $('.menu').click(function () {
        if ($('#nav-icon1').hasClass('open')) {
            closeNav();
        } else {
            openNav();
        }
        return false;
    })


    $('.control_quantity .add').click(function () {
        var value = $(this).parent().find('.amount').val();
        value = parseInt(isNaN(value) ? 1 : value, 10);
        $(this).parent().find('.amount').val(Math.min(value + 1, 99));
    })

    $('.control_quantity .remove').click(function () {
        var value = $(this).parent().find('.amount').val();
        value = parseInt(isNaN(value) ? 1 : value, 10);
        $(this).parent().find('.amount').val(Math.max(value - 1, 1));
    })

    jQuery('img.svg').each(function(){
        var $img = jQuery(this);
        var imgID = $img.attr('id');
        var imgClass = $img.attr('class');
        var imgURL = $img.attr('src');

        jQuery.get(imgURL, function(data) {
            // Get the SVG tag, ignore the rest
            var $svg = jQuery(data).find('svg');

            // Add replaced image's ID to the new SVG
            if(typeof imgID !== 'undefined') {
                $svg = $svg.attr('id', imgID);
            }
            // Add replaced image's classes to the new SVG
            if(typeof imgClass !== 'undefined') {
                $svg = $svg.attr('class', imgClass+' replaced-svg');
            }

            // Remove any invalid XML tags as per http://validator.w3.org
            $svg = $svg.removeAttr('xmlns:a');

            // Replace image with new SVG
            $img.replaceWith($svg);

        }, 'xml');
    });

    if (pageLoadingEnabled) {
        // $('.preload-loading .loading-widgets img').fadeIn(1000);
        $('.preload-loading .loading-widgets img').addClass('animated bounceInUp');
        setTimeout(function () {
            // $(".dial").fadeIn();
            $(".dial").knob({
                min: 0,
                max: 100,
                width: 50,
                thickness: .15,
                fgColor: '#5B7543',
            });
            // $('.preload-loading .loading-widgets .dial').addClass('animated bounceInUp');
            $('.preload-loading .loading-widgets canvas').addClass('animated bounceInUp');

            setTimeout(function () {
                startLoadContent(1);
            }, 500)

        }, 800);
    } else {
        $('.preload-loading').hide();
        $('.preload-content').show();
        $('html,body').css('height', 'auto');

        $.each($('img.lazy-load'), function (key, val) {
            $(val).wrap('<span class="is-img ' + ($(val).data('class') ? $(val).data('class') : '') + '"></span>');
        });
        $(window).scroll(function (ev) {
            processImages();
        });
        processImages();

        var owl = $(".owl-carousel").owlCarousel({
            items: 1,
            loop: true,
            lazyLoad: true,
            animateIn: 'fadeIn',
            animateOut: 'fadeOut',
            onChanged: function (ev) {
                processImages();
            }
        });
        owl.owlCarousel();
        $('.owl-carousel').fadeIn();

        $(document).on('click', '.carousel-next', function () {
            owl.trigger('next.owl.carousel');
        });
        $(document).on('click', '.carousel-prev', function () {
            owl.trigger('prev.owl.carousel');
        });
    }
});

function startLoadContent(progress) {
    $('.dial').val(progress).trigger('change');

    if (progress >= 100) {
        $('.preload-loading .loading-widgets img').addClass('animated bounceOutUp');
        // $('.preload-loading .loading-widgets .dial').hide();
        $('.preload-loading .loading-widgets canvas').fadeOut();


        setTimeout(function () {
            $('.preload-loading').slideUp(800, function () {
                $('html,body').css('height', 'auto');
            });

            $('.preload-content').fadeIn(500, function () {
                $.each($('img.lazy-load'), function (key, val) {
                    $(val).wrap('<span class="is-img ' + ($(val).data('class') ? $(val).data('class') : '') + '"></span>');
                });
                $(window).scroll(function (ev) {
                    processImages();
                });
                processImages();

                setTimeout(function () {
                    var owl = $(".owl-carousel").owlCarousel({
                        items: 1,
                        loop: true,
                        lazyLoad: true,
                        onChanged: function (ev) {
                            processImages();
                        }
                    });
                    owl.owlCarousel();
                    $('.owl-carousel').fadeIn();

                    $(document).on('click', '.carousel-next', function () {
                        owl.trigger('next.owl.carousel');
                    });
                    $(document).on('click', '.carousel-prev', function () {
                        owl.trigger('prev.owl.carousel');
                    });
                }, 1000)
            })
        }, 500);
        return;
    }

    setTimeout(function () {
        startLoadContent(progress + 1)
    }, 15)
}

function processImages() {
    $.each($('img:not(.loaded)'), function (key, val) {
        if ($(val).visible(true)) {
            if ($(val).data('src')) {
                $(val).attr('src', $(val).data('src'));
                var imgLoad = imagesLoaded($(val).parent());
                imgLoad.on('progress', onProgress);
            }
        }
    });

    $.each($('div.lazy-load:not(.loaded)'), function (key, val) {
        if ($(val).visible(true)) {
            if ($(val).data('style')) {
                $(val).addClass('loaded');
                $(val).attr('style', $(val).data('style'));
                $(val).css('visibility', 'hidden');
                setTimeout(function () {
                    $(val).css('visibility', 'visible');
                    $(val).addClass('animated fadeIn');
                }, 500);
            }
        }
    });
};

function onProgress(imgLoad, image) {
    if (!$(image.img).data('delay')) {
        $(image.img).addClass('loaded');
    } else {
        setTimeout(function () {
            $(image.img).addClass('loaded');
        }, $(image.img).data('delay'));
    }
}



