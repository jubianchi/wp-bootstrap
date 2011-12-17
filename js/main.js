require(['jquery/jquery'], function() {
    $('.topbar ul.sub-menu').each(function() {
        var e = $(this),
            p = $(this).parent('li');

        e.addClass('dropdown-menu');
        p.addClass('dropdown')
         .attr('data-dropdown', 'dropdown');
        $('a:first', p).addClass('dropdown-toggle');
    });

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

    require([
        'bootstrap/bootstrap-dropdown',
        'bootstrap/bootstrap-twipsy',
        'bootstrap/bootstrap-scrollspy',
        'bootstrap/bootstrap-alerts',
        'bootstrap/bootstrap-modal',
        'bootstrap/bootstrap-popover',
        'bootstrap/bootstrap-tabs'
    ]);

    $('[type=submit], [type=button], [type=reset], button').addClass('btn');
    $('[type=submit]').addClass('primary');
    $('[type=button], [type=reset], button').addClass('default');

    if(wpbootstrap.post_format == 'gallery') {
        var ul = $('<ul class="media-grid"/>');
        $('article img').each(function() {
            var a = $(this).parent(),
                li = $('<li/>').appendTo(ul),
                nxt = a.next(),
                p = a.parent('p'),
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
                    var link = $(this),
                        href = link.attr('href'),
                        althref = link.attr('data-alt-href'),
                        title = link.attr('data-title'),
                        artist = link.attr('data-artist'),
                        duration = link.attr('data-duration'),
                        track = {
                            mp3: href,
                            oga: althref,
                            rating:4.5,
                            title: title || href.substr(href.lastIndexOf('/') + 1).replace('.mp3', ''),
                            //buy:'http://www.codebasehero.com',
                            //price:'0.99',
                            duration: duration,
                            artist: artist
                        };

                    var cover;
                    if((cover = link.attr('data-cover')) != null) {
                        track.cover = link.attr('data-cover');
                    }

                    playlist.push(track);
                    link.remove()
                });

                cont.addClass('well').ttwMusicPlayer(playlist);
            });
        });
    }

    if(wpbootstrap.reply_to) {
        var form = $('#commentform').parent().parent(),
            target = $('#comment-' + wpbootstrap.reply_to).parent();

        if(form && target) {
            form.appendTo(target);
        }
    }

    if($('img, figure').size() > 0) {
        require(['helper/facebox'], function() {
            $('a:has(img), figure a').facebox({
                loadingImage : wpbootstrap.template_dir + '/img/loading.gif',
                closeImage   : wpbootstrap.template_dir + '/img/closelabel.png'
            });
        });
    }

    require(['helper/prettify'], function() {
        prettyPrint();
    });
});

