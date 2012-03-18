<?php
/**
 * @package WordPress
 * @subpackage wp-bootstrap
 * @author jubianchi <contact@jubianchi.fr>
 * @version 2.0
 * @link http://wpbootstrap.jubianchi.fr
 */
?>
<div class="span2">
    <div class="well sidebar-nav">
        <?php if (is_active_sidebar('foot-col-1')) : ?>

            <?php dynamic_sidebar('foot-col-1'); ?>

        <?php endif; ?>
    </div><!--/.well -->
</div>