<?php
/**
 * @package WordPress
 * @subpackage wp-bootstrap
 * @author jubianchi <contact@jubianchi.fr>
 * @version 2.0
 * @link http://wpbootstrap.jubianchi.fr
 */
?>
<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
    <article id="comment-<?php comment_ID(); ?>" class="well comment">
        <div class="row-fluid">
            <div class="span2">
                <?php echo get_avatar($comment, 64); ?>
                <div class="comment-meta commentmetadata">
                    <p>
                        <?php
                        printf(
                            __('%s', 'wpbootstrap'),
                            sprintf(
                                '<cite class="fn">%s</cite>',
                                get_comment_author_link()
                            )
                        );
                        ?>
                        <br/>
                        <a href="<?php echo esc_url( get_comment_link( $comment->comment_ID )); ?>">
                            <time datetime="<?php comment_time('c'); ?>">
                                <?php
                                printf(
                                    __('On %s at %s', 'wpbootstrap'),
                                    get_comment_date('d/m/Y'),
                                    get_comment_time('H:i')
                                );
                                ?>
                            </time>
                        </a>
                    </p>

                    <?php if($comment->comment_approved == '0') : ?>
                    <p class="alert alert-notice">
                        <?php _e('Your comment is awaiting moderation.', 'wpbootstrap'); ?>
                    </p>
                    <?php endif; ?>
                </div><!-- eo .comment-meta .commentmetadata -->
                <?php if($comment->comment_approved != '0') : ?>
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
            <div class="span10">
                <div class="comment-content"><?php comment_text(); ?></div>
        </div>
    </article><!-- eo #comment-##  -->
</li>