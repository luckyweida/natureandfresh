/* Open when someone clicks on the span element */
function openNav() {
    $('#instafeed').find('img').hide();
    var length = $('#instafeed').find('img').size();
    $($('#instafeed').find('img')[parseInt((Math.random() * 100) % length, 10)]).fadeIn();

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

function instImgLoad() {
    $.each($('.inst-photo:not(.animated)'), function (key, val) {
        if (elementInViewport2(val)) {
            setTimeout(function () {
                $(val).css('visibility', 'visible');
                $(val).addClass('animated fadeIn');
            }, key * 50)
        }
    });
};

function elementInViewport2(el) {
    var top = el.offsetTop;
    var left = el.offsetLeft;
    var width = el.offsetWidth;
    var height = el.offsetHeight;

    while (el.offsetParent) {
        el = el.offsetParent;
        top += el.offsetTop;
        left += el.offsetLeft;
    }

    return (
        top < (window.pageYOffset + window.innerHeight) &&
        left < (window.pageXOffset + window.innerWidth) &&
        (top + height) > window.pageYOffset &&
        (left + width) > window.pageXOffset
    );
};

$(function () {
    var pageLoadingEnabled = 0;

    // $('#myModal').on('show.bs.modal', function (e) {
    //     alert('modal show');
    // });

    $(document).on('click', '.header-nav .js-toggle', function (event) {
        $('.header-nav .js-toggle').not(this).parent().removeClass('open');
        $(this).parent().toggleClass('open');
    });

    $(document).on('click', 'body', function (e) {
        if (!$('.header-nav .js-toggle').is(e.target)
            && $('.header-nav .js-toggle').has(e.target).length === 0
            && $('.open').has(e.target).length === 0
        ) {
            $('.header-nav .js-toggle').parent().removeClass('open');
        }
    });

    if ($('#google-map').length) {
        var myLatlng = {lat: -37.250261, lng: 174.750975};
        var map = new google.maps.Map(document.getElementById('google-map'), {
            zoom: 15,
            center: myLatlng,
            scrollwheel: false,
            styles: [{"featureType": "administrative", "elementType": "labels.text.fill", "stylers": [{"color": "#444444"}]}, {"featureType": "landscape", "elementType": "all", "stylers": [{"color": "#f2f2f2"}]}, {"featureType": "landscape", "elementType": "geometry.fill", "stylers": [{"visibility": "on"}]}, {"featureType": "landscape.man_made", "elementType": "geometry.fill", "stylers": [{"hue": "#ffd100"}, {"saturation": "44"}]}, {"featureType": "landscape.man_made", "elementType": "geometry.stroke", "stylers": [{"saturation": "-1"}, {"hue": "#ff0000"}]}, {"featureType": "landscape.natural", "elementType": "geometry", "stylers": [{"saturation": "-16"}]}, {"featureType": "landscape.natural", "elementType": "geometry.fill", "stylers": [{"hue": "#ffd100"}, {"saturation": "44"}]}, {"featureType": "poi", "elementType": "all", "stylers": [{"visibility": "off"}]}, {
                "featureType": "road",
                "elementType": "all",
                "stylers": [{"saturation": "-30"}, {"lightness": "12"}, {"hue": "#ff8e00"}]
            }, {"featureType": "road.highway", "elementType": "all", "stylers": [{"visibility": "simplified"}, {"saturation": "-26"}]}, {"featureType": "road.arterial", "elementType": "labels.icon", "stylers": [{"visibility": "off"}]}, {"featureType": "transit", "elementType": "all", "stylers": [{"visibility": "off"}]}, {"featureType": "water", "elementType": "all", "stylers": [{"color": "#c0b78d"}, {"visibility": "on"}, {"saturation": "4"}, {"lightness": "40"}]}, {"featureType": "water", "elementType": "geometry", "stylers": [{"hue": "#ffe300"}]}, {"featureType": "water", "elementType": "geometry.fill", "stylers": [{"hue": "#ffe300"}, {"saturation": "-3"}, {"lightness": "-10"}]}, {"featureType": "water", "elementType": "labels", "stylers": [{"hue": "#ff0000"}, {"saturation": "-100"}, {"lightness": "-5"}]}, {"featureType": "water", "elementType": "labels.text.fill", "stylers": [{"visibility": "off"}]}, {
                "featureType": "water",
                "elementType": "labels.text.stroke",
                "stylers": [{"visibility": "off"}]
            }]
        });
        var image = window._baseurl + '/images/marker.png';
        var marker = new google.maps.Marker({
            position: myLatlng,
            icon: image
        });
        marker.setMap(map);

        var contentString = '<div id="google-tooltip">' +
            '<div id="google-tooltip_img">' +
                '<img src="' + window._baseurl + '/images/pages/contact_img.png' + '"/>' +
            '</div>' +
            '<div id="google-tooltip_info">' +
                '<div class="google-tooltip_info_title">Nature & Fresh</div>' +
                '<div class="google-tooltip_info_text">1340C Glenbrook Road, Rd1, Waiuku 2681, New Zealand</div>' +
            '</div>' +
            '</div>';

        var infowindow = new google.maps.InfoWindow({
            content: contentString,
            maxWidth: 230
        });
        marker.addListener('click', function () {
            infowindow.open(map, marker);
        });
        infowindow.open(map, marker);

        google.maps.event.addListener(infowindow, 'domready', function() {

            var iwOuter = $('.gm-style-iw');
            var iwBackground = iwOuter.prev();
            var last = iwBackground.children().last();
            last.css('opacity', 0);
            last.prev().find(' > div > div').css('background', '#666');
            last.prev().prev().css('opacity', 0);
            iwOuter.next().remove();
            iwOuter.parent().css('padding', 0)
            iwOuter.parent().css('margin', 0)

            iwOuter.css('left', parseInt(iwOuter.css('left'), 10) + 9 + 'px');
            iwOuter.css('top', parseInt(iwOuter.css('top'), 10) + 10 + 'px');
        });

    }


    $('.js-product-overlay').click(function () {
        $('#product-overlay').removeClass('fadeOut')
        $('#product-overlay').addClass('animated fadeIn');
        $('#product-overlay').show();
    });

    var feed = new Instafeed({
        get: 'user',
        limit: 20,
        resolution: 'standard_resolution',
        userId: '4266168427',
        accessToken: '4266168427.1677ed0.bf4887a85d5d48d3828b1fa66f8ea871',
        template: '<img style="display: none;" src="{{image}}" />',
        after: function () {
        }
    });
    feed.run();

    if ($('#the-photo').length) {

        var html = '<div class="col-md-6 col-xs-12 insta_container mb-1">';
        html += '<a target="_blank" href="{{link}}">';
        html += '<div class="insta_msg"><div class="text">{{caption}}</div></div>';
        html += '<img class="inst-photo image" src="{{image}}" style="visibility: hidden"/>';
        html += '</a>';
        html += '</div>';

        var galleryFeed = new Instafeed({
            target: 'my-photos',
            get: 'user',
            limit: 8,
            resolution: 'standard_resolution',
            userId: '4266168427',
            accessToken: '4266168427.1677ed0.bf4887a85d5d48d3828b1fa66f8ea871',
            template: html,
            after: function () {
                instImgLoad();
                if (!this.hasNext()) {
                    $('.load-more').hide();
                } else {
                    $('.load-more').fadeIn();
                }
            }
        });
        $(window).scroll(function () {
            instImgLoad();
        })
        $('.load-more').click(function () {
            $('.load-more').fadeOut();
            galleryFeed.next();
        });
        galleryFeed.run();
    }
    ;


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
    });

    $('.control_quantity .remove').click(function () {
        var value = $(this).parent().find('.amount').val();
        value = parseInt(isNaN(value) ? 1 : value, 10);
        $(this).parent().find('.amount').val(Math.max(value - 1, 1));
    });

    jQuery('img.svg').each(function () {
        var $img = jQuery(this);
        var imgID = $img.attr('id');
        var imgClass = $img.attr('class');
        var imgURL = $img.attr('src');

        jQuery.get(imgURL, function (data) {
            // Get the SVG tag, ignore the rest
            var $svg = jQuery(data).find('svg');

            // Add replaced image's ID to the new SVG
            if (typeof imgID !== 'undefined') {
                $svg = $svg.attr('id', imgID);
            }
            // Add replaced image's classes to the new SVG
            if (typeof imgClass !== 'undefined') {
                $svg = $svg.attr('class', imgClass + ' replaced-svg');
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

        $.each($(".owl-carousel"), function (idx, itm) {
            // alert($(itm).find('.item:not(.cloned)').length);
            var owl = $(itm).owlCarousel({
                items: 1,
                loop: true,
                lazyLoad: true,
                animateIn: 'fadeIn',
                animateOut: 'fadeOut',
                dots: true,
                singleItem: true,
                center: true,
                // autoplay: true,
                autoplayHoverPause: true,
                touchDrag: $(itm).find('.item:not(.cloned)').length > 1 ? true : false,
                mouseDrag: $(itm).find('.item:not(.cloned)').length > 1 ? true : false,
                // autoplaySpeed: 1,
                // navigation : true,
                // slideSpeed : 600,
                // paginationSpeed : 900,
                // autoPlay : 7000,
                // transitionStyle : "fadeUp",
                smartSpeed: 600,

                onChanged: function (ev) {
                    processImages();
                }
            });

            // owl.owlCarousel();
            // $(itm).fadeIn();

            $(itm).parent().find('.carousel-next').on('click', function () {
                owl.trigger('next.owl.carousel');
            });
            $(itm).parent().find('.carousel-prev').on('click', function () {
                owl.trigger('prev.owl.carousel');
            });


            //Owl carousel height solution
            // var $this = $(this);

            // $this.owlCarousel({
            //     afterUpdate: function () {
            //       updateSize($this);
            //     },
            //     afterInit: function () {
            //       updateSize($this);
            //     }
            // });


        })
    }

    if ($('body').hasClass('woocommerce-cart')) {
        $(document).on('mousedown', '.right-menu-item_cart', function (ev) {
            $('html, body').animate({
                scrollTop: $(".shop_table_responsive").offset().top
            }, 500);
            ev.preventDefault();
            return false;
        })
    }

    if ($.support.pjax) {
        $.pjax.defaults.timeout = 600000;
        $.pjax.defaults.scrollTo = false;

        $(document).on('submit', 'form.js-dropdown-cart-form', function (event) {
            // $.pjax.submit(event, '.js-dropdown-cart-form div.cart-drop_item', {
            //     fragment: '.js-dropdown-cart-form div.cart-drop_item'
            // });
        });

        $(document).on('submit', 'form.js-address-form, form.js-account-form', function (event) {
            $('.woocommerce-MyAccount-content').html('<div class="pjax-loading product-loading"><h3 class="text">We are processing your request. <br /><small>Please wait...</small></h3><div class="spinner"></div></div>');
            $.pjax.submit(event, '.woocommerce-MyAccount-content', {
                fragment: '.woocommerce-MyAccount-content'
            });
        });
        $('.woocommerce-MyAccount-content').on('pjax:success', function(e) {
            if (document.URL.indexOf('address') != -1) {
                var html = '<h3>Your changes have been made</h3>';
                html += '<p><a class="btn btn-sm" href="/my-account/edit-address/">Click here to go back to your addresses</a></p>';
            } else if (document.URL.indexOf('account') != -1) {
                var html = '<h3>Your changes have been made</h3>';
                html += '<p><a class="btn btn-sm" href="/my-account/edit-account/">Click here to go back to your account</a></p>';
            }

            $('.woocommerce-MyAccount-content').html(html);
        });

        $(document).on('submit', 'form.js-add-cart-form', function (event) {
            $('.js-cart-dismiss').hide();
            $('.js-add-cart-info').html('<div class="pjax-loading product-loading"><span class="text">We are processing your request. <br /><small>Please wait...</small></span><div class="spinner"></div></div>');
            $.pjax.submit(event, '.right-menu-item_cart', {
                fragment: '.right-menu-item_cart'
            });
        });
        $('.right-menu-item_cart').on('pjax:success', function(e) {
            $('.js-cart-dismiss').show();
            var html = '<h4>The item(s) have been added to cart</h4>';
            // html += '<p><a href="/cart/">Click here to view your shopping cart now</a></p>';
            $('.js-add-cart-info').html(html);
        });

        // $(document).on('submit', 'form.js-dropdown-cart-form', function (event) {
        //     $.pjax.submit(event, '#cart-drop', {
        //         fragment: '#cart-drop'
        //     });
        //     $('#cart-drop').html('<div class="pjax-loading"><span class="text">We are processing your request. <br /><small>Please wait...</small></span><div class="spinner"></div></div>');
        // });


        $(document).on('click', 'form.js-login [type=submit]', function (event) {
            // $.pjax.submit(event, '#account-drop', {
            //     fragment: '#account-drop'
            // });
            $(this).closest('form').hide();
            $('.woocommerce-error').hide();
            $('#account-drop').prepend('<div class="pjax-loading"><span class="text">We are processing your request. <br /><small>Please wait...</small></span><div class="spinner"></div></div>');
            $(this).closest('form').submit();
        });

        $(document).on('click', 'form.js-dropdown-cart-form [type=submit]', function (event) {
            // $.pjax.submit(event, '#account-drop', {
            //     fragment: '#account-drop'
            // });
            $(this).closest('form').hide();
            $('.woocommerce-error').hide();
            $('#cart-drop').prepend('<div class="pjax-loading"><span class="text">We are processing your request. <br /><small>Please wait...</small></span><div class="spinner"></div></div>');
            $(this).closest('form').submit();
        });
    }

    if (window.location.hash == '#account-drop' && $('#account-drop').length) {
        $('#account-drop').parent().addClass('open')
    }

    if (window.location.hash == '#cart-drop' && $('#cart-drop').length) {
        $('#cart-drop').parent().addClass('open')
    }

    if ($('#shop').length || $('#homepage').length) {
        processImages();
        $.each($('.js-variation'), function (idx, itm) {
            $(itm).closest('form').find('.price-details').html($(itm).find('option:selected').data('price'));
            $(itm).closest('form').find('.variation_id').val($(itm).find('option:selected').data('id'));
            $(itm).closest('form').find('.js-attrs').empty();

            if ($(itm).find('option:selected').length) {
                var json = JSON.parse(decodeURIComponent($(itm).find('option:selected').data('attrs')));
                for (var key in json) {
                    var val = json[key];
                    $(itm).closest('form').find('.js-attrs').append('<input type="text" name="attribute_' + val[0] + '" value="' + val[1] + '">');
                }

                if ($(itm).find('option:selected').data('sale')) {
                    $(itm).closest('.product-slider').find('.js-discount').html('<span>-' + parseInt((($(itm).find('option:selected').data('regular') - $(itm).find('option:selected').data('sale')) / $(itm).find('option:selected').data('regular') * 100), 10) + '%</span>');
                    $(itm).closest('.product-slider').find('.js-discount').show();
                } else {
                    $(itm).closest('.product-slider').find('.js-discount').hide();
                }
            }
        });
        $(document).on('change', '.js-variation', function () {
            $(this).closest('form').find('.price-details').html($(this).find('option:selected').data('price'));
            $(this).closest('form').find('.variation_id').val($(this).find('option:selected').data('id'));
            $(this).closest('form').find('.js-attrs').empty();
            if ($(this).find('option:selected').data('sale')) {
                $(this).closest('.product-slider').find('.js-discount').html('<span>-' + parseInt((($(this).find('option:selected').data('regular') - $(this).find('option:selected').data('sale')) / $(this).find('option:selected').data('regular') * 100), 10) + '%</span>');
                $(this).closest('.product-slider').find('.js-discount').show();
            } else {
                $(this).closest('.product-slider').find('.js-discount').hide();
            }

            var json = JSON.parse(decodeURIComponent($(this).find('option:selected').data('attrs')));
            for (var key in json) {
                var val = json[key];
                $(this).closest('form').find('.js-attrs').append('<input type="text" name="attribute_' + val[0] + '" value="' + val[1] + '">');
            }
        });

        $.each($('.owl-carousel'), function (idx, itm) {
            $(itm).on('changed.owl.carousel', function(property) {
                if (!window._selLock) {
                    window._carLock = 1;
                    var val = $(property.target).find('.owl-item:nth-child(' + (property.item.index + 1) + ')').find('a').data('var');
                    if (val) {
                        $(property.target).closest('.product-slider').find('form').find('select').val(val).change();
                    }
                    window._carLock = 0;
                }
            })
        });

        $.each($('form'), function (idx, itm) {
            $(itm).find('select').change(function (ev) {
                if (!window._carLock) {
                    window._selLock = 1;
                    var elm = $(this).closest('.product-slider').find('.owl-carousel').find('.owl-item:not(.cloned)').find('[data-var="' + $(this).val() + '"]');
                    var num = $(this).closest('.product-slider').find('.owl-carousel').find('.owl-item.cloned').length / 2;
                    $(this).closest('.product-slider').find('.owl-carousel').trigger('to.owl.carousel', elm.parent().index() - num)
                    window._selLock = 0;
                }
            });
        })
    }

    if ($('#product').length) {
        processImages();
        $(document).on('change', '.js-var input', function () {
            if (!window._carLock) {
                window._selLock = 1;
                var elm = $(this).closest('.product-details').find('.owl-carousel').find('.owl-item:not(.cloned)').find('[data-var="' + $(this).data('html') + '"]');
                var num = $(this).closest('.product-details').find('.owl-carousel').find('.owl-item.cloned').length / 2;
                console.log(elm.parent().index())
                $(this).closest('.product-details').find('.owl-carousel').trigger('to.owl.carousel', elm.parent().index() - num)
                window._selLock = 0;
            }
        });

        $('.product-details .owl-carousel').on('changed.owl.carousel', function(property) {
            if (!window._selLock) {
                window._carLock = 1;
                var val = $(property.target).find('.owl-item:nth-child(' + (property.item.index + 1) + ')').find('textarea').val();
                if (val) {
                    var val = JSON.parse(val);
                    for (var idx in val) {
                        var itm = val[idx];
                        $('input[value="' + itm.option.toLowerCase() + '"]').prop('checked', 'checked').change();
                    }
                    window._carLock = 0;
                }
            }
        })

        var val = '';
        $.each($('.product-attr input'), function (idx, itm) {
            if ($(itm).is(':checked')) {
                val = val + (val == '' ? '' : ' ') + $(itm).val();
            }
        })
        $('.js-var input[data-html="' + val + '"]').click();
        // console.log($('.js-var input[data-html="' + val + '"]'), '.js-var input[data-html=' + val + ']');
        // alert(val);


        $('.js-attrs').empty();
        if ($('.js-var input:checked').length) {
            var json = JSON.parse(decodeURIComponent($('.js-var input:checked').data('attrs')));
            for (var key in json) {
                var val = json[key];
                $('.js-attrs').append('<input type="text" name="attribute_' + val[0] + '" value="' + val[1] + '"><br />');
            }

            $('.price-details').html($('.js-var input:checked').data('price'));
            if ($('.js-var input:checked').data('sale')) {
                $('.js-discount').html('<span>-' + parseInt((($('.js-var input:checked').data('regular') - $('.js-var input:checked').data('sale')) / $('.js-var input:checked').data('regular') * 100), 10) + '%</span>');
                $('.js-discount').show();
            } else {
                $('.js-discount').hide();
            }
        }

        $(document).on('change', '.js-choices :radio', function () {
            $('.js-attrs').empty();
            var html = '';
            $.each($('.js-choices :radio:checked'), function (idx, itm) {
                html += $(itm).val() + ' ';
            });
            html = html.trim();

            $('.js-var input').removeAttr('checked')
            $.each($('.js-var input'), function (idx, itm) {
                if ($(itm).data('html') == html) {
                    $(itm).prop('checked', 'checked').change();
                    $('.price-details').html($(itm).data('price'));
                    if ($(itm).data('sale')) {
                        $('.js-discount').html('<span>-' + parseInt((($(itm).data('regular') - $(itm).data('sale')) / $(itm).data('regular') * 100), 10) + '%</span>');
                        $('.js-discount').show();
                    } else {
                        $('.js-discount').hide();
                    }
                }
            })
            var json = JSON.parse(decodeURIComponent($('.js-var input:checked').data('attrs')));
            for (var key in json) {
                var val = json[key];
                $('.js-attrs').append('<input type="text" name="attribute_' + val[0] + '" value="' + val[1] + '"><br />');
            }
        })
    }
});


//Owl carousel height solution
// function updateSize($carousel) {
//     var maxHeight = 0;

//     $('.owl-item', $carousel).each(function () {
//     var $this = $(this);
//     var $image = $this.find('img');

//     //Max height
//     var prevHeight = $this.height();
//     var thisHeight = $this.height('auto').height();
//     $this.height(prevHeight);
//     maxHeight = (maxHeight > thisHeight ? maxHeight : thisHeight);

//     //Set image as background
//     var imageSource = $image.attr('src');
//      $this.css('backgroundImage', 'url(' + imageSource + ')');
//     });

//     //Set equal height
//     $('.owl-item', $carousel).height(maxHeight);

//     $('#max-height').text(maxHeight + 'px');
// }

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



