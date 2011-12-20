;require(['jquery/jquery'], function() {
    require(['bootstrap/bootstrap-dropdown'],function() {
        $('.topbar ul.sub-menu').each(function() {
            var e = $(this),
                p = e.parent('li');

            e.addClass('dropdown-menu');
            p.addClass('dropdown')
                .attr('data-dropdown', 'dropdown')
                .find('a:first').addClass('dropdown-toggle');
        });
    });

    if(wpbootstrap.is_home || wpbootstrap.is_front) {
        require(['helper/dotdotdot'], function() {
            $('.ellipsis').dotdotdot();
            $('article.aside div.content').css('height', '200px').dotdotdot({
                after: "a.more-link"
            });
            $('article header h2').css('height', '40px').dotdotdot({
                watch: "window",
                after: ".label"
            });
        });
    } else {
        $('[type=submit], [type=button], [type=reset], button').addClass('btn');
        $('[type=submit]').addClass('primary');
        $('[type=button], [type=reset], button').addClass('default');
    }

    require([
        'bootstrap/bootstrap-twipsy',
        'bootstrap/bootstrap-scrollspy',
        'bootstrap/bootstrap-alerts',
        'bootstrap/bootstrap-modal',
        'bootstrap/bootstrap-popover',
        'bootstrap/bootstrap-tabs'
    ]);

    if(wpbootstrap.post_format == 'gallery') {
        var ul = $('<ul class="media-grid"/>');
        $('article img').each(function() {
            var a   = $(this).parent(),
                li  = $('<li/>').appendTo(ul),
                nxt = a.next(),
                p   = a.parent('p'),
                img = $('img:first', a),
                str = nxt.text();

            nxt.parent('.wp-caption').remove();
            if(nxt.hasClass('wp-caption-text')) {
                a.attr('data-content', str)
                 .attr('data-original-title', img.attr('alt'))
                 .attr('data-controls-modal', 'modal')
                 .attr('rel', 'popover')
                 .popover({placement: 'below'})
                 .facebox({
                    loadingImage : wpbootstrap.template_dir + '/img/loading.gif',
                    closeImage   : wpbootstrap.template_dir + '/img/closelabel.png'
                 });

            }
            a.appendTo(li);
            p.remove();
        });

        ul.appendTo('article.gallery .content');
    }

    if(wpbootstrap.post_format == 'audio') {
        require(['helper/jplayer', 'helper/mplayer'], function() {
            var cont = $('.jplayer');

            cont.each(function() {
                var playlist = [],
                    cont = $(this),
                    links = $('a[href*=mp3]', cont);

                links.each(function() {
                    var link  = $(this),
                        attrs = ['oga', 'title', 'cover', 'buy', 'price', 'rating', 'duration', 'artist'],
                        track = { mp3: link.attr('href') };

                    for(var i = 0; i < attrs.length; i++) {
                        var attr  = attrs[i],
                            value = link.attr('data-' + attr);

                        if(value) track[attr] = value;
                    }

                    playlist.push(track);
                    link.remove()
                });

                $('p, div, br', cont).remove();
                cont.ttwMusicPlayer(playlist)
            })
        })
    }

    if(wpbootstrap.reply_to) {
        var form   = $('#commentform').parent().parent(),
            target = $('#comment-' + wpbootstrap.reply_to).parent();

        if(form && target) form.appendTo(target)
    }

    if($('img, figure').size() > 0) {
        require(['helper/facebox'], function() {
            $('a:has(img), figure a').facebox({
                loadingImage : wpbootstrap.template_dir + '/img/loading.gif',
                closeImage   : wpbootstrap.template_dir + '/img/closelabel.png'
            })
        })
    }

    require(['helper/prettify'], function() {
        prettyPrint()
    })
});

