<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
    <article id="comment-<?php comment_ID(); ?>" class="well comment">
        <div class="row">
            <div class="pull-left span2">
                <?php echo get_avatar($comment, 64); ?>
            </div>
            <div class="pull-left contenainer-fluid">
                <div class="comment-meta commentmetadata">
                    <p>
                        <a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
                            <time datetime="<?php comment_time('c'); ?>">
                                <?php
                                printf(
                                    __('On %s at %s', 'wpbootstrap'),
                                    get_comment_date(),
                                    get_comment_time()
                                );
                                ?>
                            </time>
                        </a>,
                        <?php
                        printf(
                            __('%s <span class="says">says:</span>', 'wpbootstrap'),
                            sprintf(
                                '<cite class="fn">%s</cite>',
                                get_comment_author_link()
                            )
                        );
                        ?>
                    </p>

                    <?php if($comment->comment_approved == '0') : ?>
                        <p class="alert-message notice">
                            <?php _e('Your comment is awaiting moderation.', 'wpbootstrap'); ?>
                        </p>
                    <?php endif; ?>
                </div><!-- eo .comment-meta .commentmetadata -->

                <div class="comment-content"><?php comment_text(); ?></div>

                <?php if ( $comment->comment_approved != '0' ) : ?>
                    <div class="reply">
                        <?php
                        comment_reply_link(array_merge(
                            $args,
                            array(
                                'depth' => $depth,
                                'max_depth' => $args['max_depth']
                            )
                        ));
                        ?>
                        <?php edit_comment_link(__('Edit', 'wpbootstrap')); ?>
                    </div><!-- eo .reply -->
                <?php endif; ?>
        </div>
    </article><!-- eo #comment-##  -->
</li>