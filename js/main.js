;$(function() {
    $('.navbar ul.sub-menu').each(function() {
        var e = $(this),
            p = e.parent('li');

        e.addClass('dropdown-menu');
        p.addClass('dropdown');

        var toggle = p.find('a:first');
        toggle.addClass('dropdown-toggle').attr('data-toggle', 'dropdown');
    });


    if(!wpbootstrap.is_home && !wpbootstrap.is_front) {
        $('[type=submit], [type=button], [type=reset], button').addClass('btn');
        $('[type=submit]').addClass('primary');
        $('[type=button], [type=reset], button').addClass('default');
    }

    $('article .gallery').each(function(i, e) {
        e = $(e);
        var carousel = $('<div class="carousel slide"/>');
            carouselInner = $('<div class="carousel-inner"/>').appendTo(carousel);

        $('dt a img', e).each(function(i, f) {
            f = $(f);
            var item = $('<div class="item"/>').appendTo(carouselInner);

            if(i == 0) item.addClass('active');

            f.attr('width', null).attr('height', null).clone().appendTo(item);
            f.attr('rel', 'facebox');

            var caption = f.parents('dt').next('dd');
            if(caption.size()) {
                var capt = $('<div class="carousel-caption"/>').html('<h4>' + f.attr('alt') + '</h4><p>' + caption.text() + '</p>').appendTo(item);
            }
        });

        var parent = e.parents('.content');
        e.prev('style').remove();
        e.remove();


        $('<a class="carousel-control left" href="#' + e.attr('id') + '" data-slide="prev">&lsaquo;</a><a class="carousel-control right" href="#' + e.attr('id') + '" data-slide="next">&rsaquo;</a>').appendTo(carousel);

        carousel.attr('id', e.attr('id')).appendTo(parent);
        carousel.carousel();
    });

    // fix sub nav on scroll
    var $win = $(window)
        , $nav = $('.subnav')
        , navTop = $('.subnav').length && $('.subnav').offset().top - 40
        , isFixed = 0
    processScroll()
    $win.on('scroll', processScroll)
    function processScroll() {
        var i, scrollTop = $win.scrollTop()
        if (scrollTop >= navTop && !isFixed) {
            isFixed = 1
            $nav.addClass('subnav-fixed')
        } else if (scrollTop <= navTop && isFixed) {
            isFixed = 0
            $nav.removeClass('subnav-fixed')
        }
    }

    $('.carousel').click(function(e) {
        if($(e.target).is('.carousel-control') || $(e.target).hasClass('full')) return;

        var original = $(this),
            carousel = original.clone().attr('id', original.attr('id') + '-full'),
            pos = original.position(),
            size = {width: original.width(), height: original.height()},
            resize = function() {
                carousel.animate({
                    'margin-left': '-' + carousel.width() / 2 + 'px',
                    'margin-top': '-' + carousel.height() / 2 + 'px'
                });
            };

        $('img', carousel).css('max-height', $(window).height() * 0.9);
        $('.carousel-control', carousel).attr('href', '#' + carousel.attr('id'));

        carousel
            .css('display', 'none')
            .appendTo($('body'))
            .addClass('full')
            .css({
                'margin-left': '-' + carousel.width() / 2 + 'px',
                'margin-top': '-' + carousel.height() / 2 + 'px'
            })
            .fadeIn()
            .on('slid', resize);

        $(window).on('resize', resize);

        $('<div class="modal-backdrop fade in"/>')
            .css('display', 'none')
            .appendTo($('body'))
            .fadeIn()
            .click(function() {
                var mb = $(this);
                carousel
                    .fadeOut(function() {
                        carousel.remove();
                        mb.remove();
                    });
            });
    });

    if(wpbootstrap.reply_to) {
        var form   = $('#commentform').parent().parent(),
            target = $('#comment-' + wpbootstrap.reply_to).parent();

        if(form && target) form.appendTo(target)
    }

    /*if($('img, figure').size() > 0) {
        $('a:has(img), figure a').facebox({
            loadingImage : wpbootstrap.template_dir + '/img/loading.gif',
            closeImage   : wpbootstrap.template_dir + '/img/closelabel.png'
        })
    }*/

    $('[rel=facebox]').facebox();

    $('#wp-calendar').addClass('table table-bordered table-striped table-condensed');

    prettyPrint();
});