<?php
global $theme_config;
$base = get_bloginfo('template_url');
?>

<form method="post" action="#">
    <h3><?php _e('Navigation', 'wpbootstrap'); ?></h3>

    <table class="form-table">
        <tbody>
            <tr>
                <th scope="row"><?php _e('Breadcrumb', 'wpbootstrap'); ?></th>
                <td>
                    <fieldset>
                        <legend class="screen-reader-text"><span><?php _e('Breadcrumb options', 'wpbootstrap'); ?></span></legend>

                        <label>
                            <input type="radio" name="<?php echo SHOW_BREADCRUMB_KEY; ?>" value="<?php echo ALL_PAGES; ?>" <?php if($theme_config[SHOW_BREADCRUMB_KEY] == ALL_PAGES) : ?>checked="checked"<?php endif; ?>/>
                            <span><?php _e('Enable on all pages', 'wpbootstrap'); ?></span>
                        </label>
                        <br/>
                        <label>
                            <input type="radio" name="<?php echo SHOW_BREADCRUMB_KEY; ?>" value="<?php echo ALL_PAGES_BUT_HOME; ?>" <?php if($theme_config[SHOW_BREADCRUMB_KEY] == ALL_PAGES_BUT_HOME) : ?>checked="checked"<?php endif; ?>/>
                            <span><?php _e('Enable on all pages except home', 'wpbootstrap'); ?></span>
                        </label>
                        <br/>
                        <label>
                            <input type="radio" name="<?php echo SHOW_BREADCRUMB_KEY; ?>" value="<?php echo DISABLED; ?>" <?php if($theme_config[SHOW_BREADCRUMB_KEY] == DISABLED) : ?>checked="checked"<?php endif; ?>/>
                            <span><?php _e('Disable', 'wpbootstrap'); ?></span>
                        </label>
                    </fieldset>
                </td>
            </tr>

            <tr>
                <th scope="row"><?php _e('Topbar', 'wpbootstrap'); ?></th>
                <td>
                    <fieldset>
                        <legend class="screen-reader-text"><span><?php _e('Topbar options', 'wpbootstrap'); ?></span></legend>

                        <label>
                            <input type="radio" name="<?php echo SHOW_SEARCH_KEY; ?>" value="1" <?php if($theme_config[SHOW_SEARCH_KEY] == true) : ?>checked="checked"<?php endif; ?>/>
                            <span><?php _e('Show search field', 'wpbootstrap'); ?></span>
                        </label>
                        <br/>
                        <label>
                            <input type="radio" name="<?php echo SHOW_SEARCH_KEY; ?>" value="0" <?php if($theme_config[SHOW_SEARCH_KEY] != true) : ?>checked="checked"<?php endif; ?>/>
                            <span><?php _e('Hide search field', 'wpbootstrap'); ?></span>
                        </label>
                        <br/><br/>
                        <label>
                            <input type="radio" name="<?php echo SHOW_LOGIN; ?>" value="1" <?php if($theme_config[SHOW_LOGIN] == true) : ?>checked="checked"<?php endif; ?>/>
                            <span><?php _e('Show login link', 'wpbootstrap'); ?></span>
                        </label>
                        <br/>
                        <label>
                            <input type="radio" name="<?php echo SHOW_LOGIN; ?>" value="0" <?php if($theme_config[SHOW_LOGIN] != true) : ?>checked="checked"<?php endif; ?>/>
                            <span><?php _e('Hide login link', 'wpbootstrap'); ?></span>
                        </label>
                    </fieldset>
                </td>
            </tr>
        </tbody>
    </table>

    <p class="submit"><input type="submit" name="submit" id="submit" class="button-primary" value="<?php _e('Apply changes', 'wpbootstrap'); ?>"/></p>
</form>
