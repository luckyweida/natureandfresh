$(function () {
    $('.preload-loading .loading-widgets img').addClass('animated bounceInUp');
    setTimeout(function () {
        $(".dial").fadeIn();
        $(".dial").knob({
            min: 0,
            max: 100,
            width: 80,
            thickness: .2,
            fgColor: '#FEFBF3',
        });
        $('.preload-loading .loading-widgets .dial').addClass('animated bounceInUp');
        $('.preload-loading .loading-widgets canvas').addClass('animated bounceInUp');

        setTimeout(function () {
            window._pregress = 1;
            startLoadContent(1);
        }, 500)

    }, 800)
});

function startLoadContent(progress) {
    $('.dial').val(progress).trigger('change');

    if (progress >= 100) {
        $('.preload-loading .loading-widgets img').addClass('animated bounceOutUp');
        $('.preload-loading .loading-widgets .dial').hide();
        $('.preload-loading .loading-widgets canvas').fadeOut();
        setTimeout(function () {
            $('.preload-loading').slideUp(800, function () {
                $('html,body').css('height', 'auto');
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
            });
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
            $(val).attr('src', $(val).data('src'));
            var imgLoad = imagesLoaded($(val).parent());
            imgLoad.on('progress', onProgress);
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



