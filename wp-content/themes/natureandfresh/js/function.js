$(function () {
    $(document).on('click', '.js-btn', function (ev) {

        if ($(this).hasClass('active')) {
            $(this).removeClass('active')
            $('.js-content').slideUp();
            $("html,body").animate({scrollTop: 0}, 800);
        } else {
            $(this).addClass('active')
            $('.js-content').slideDown(1000);
        }

    });

    $(window).resize(function () {
        if ($(window).width() > 600 && $('body').hasClass('is-mobile')) {
            $('.js-btn').hide();
            $('.js-content').slideDown();
            $('body').removeClass('is-mobile')
        } else if ($(window).width() <= 600 && !$('body').hasClass('is-mobile')) {
            $('body').addClass('is-mobile')
            $('.js-btn').fadeIn();
            $('.js-content').slideUp();
            $('.js-btn').removeClass('active');
            $("html,body").animate({scrollTop: 0}, 800);
        }
    })
});