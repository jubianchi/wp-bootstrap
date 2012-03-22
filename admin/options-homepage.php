<?php
global $theme_config;
?>

<form method="post" action="#">
    <h3><?php _e('Home page', 'wpbootstrap'); ?></h3>

    <table class="form-table">
        <tbody>
            <tr>
                <th scope="row"><?php _e('Highlight posts', 'wpbootstrap'); ?></th>
                <td>
                    <fieldset>
                        <legend class="screen-reader-text"><span><?php _e('Homepage posts options', 'wpbootstrap'); ?></span></legend>

                        <?php foreach($theme_config[POST_FORMATS_KEY] as $k => $format) : ?>
                            <label title="<?php echo __($format); ?>" style="display: inline-block; width: 200px">
                                <input type="checkbox" name="<?php echo STICKY_FORMATS_KEY; ?>[]" value="<?php echo $format; ?>" <?php if(in_array('post-format-' . $format, $theme_config[STICKY_FORMATS_KEY])) : ?>checked="checked"<?php endif; ?>/>
                                <span><?php echo __($format); ?></span>
                            </label>
                            <?php if((($k + 1) % 2) == 0) : ?><br/><?php endif; ?>
                        <?php endforeach; ?>
                        <br/><br/>
                        <label>
                            <span><?php _e('Display', 'wpbootstrap'); ?></span>
                            <select name="<?php echo STICKY_ROWS_KEY; ?>" id="sticky_rows">
                                <?php for($i = 1; $i <= 5; $i++) : ?>
                                    <option value="<?php echo $i; ?>" <?php if($theme_config[STICKY_ROWS_KEY] == $i) : ?>selected="selected"<?php endif; ?>>
                                        <?php echo $i; ?>
                                    </option>
                                <?php endfor; ?>
                            </select>
                            <span><?php _e('rows', 'wpbootstrap'); ?> <small><?php _e('(3 posts/rows)', 'wpbootstrap'); ?></small></span>
                        </label>
                    </fieldset>
                </td>
            </tr>
        </tbody>
    </table>

    <p class="submit"><input type="submit" name="submit" id="submit" class="button-primary" value="<?php _e('Apply changes', 'wpbootstrap'); ?>"/></p>
</form>
