<?php
global $theme_config;
?>

<form method="post" action="#">
    <h3><?php _e('Header', 'wpbootstrap'); ?></h3>

    <table class="form-table">
        <tbody>
            <tr valign="top" id="text-color-row">
                <th scope="row"><label for="header_bgcolor"><?php _e('Header options', 'wpbootstrap'); ?></label></th>
                <td>
                    <fieldset>
                        <legend class="screen-reader-text"><span><?php _e('Header options', 'wpbootstrap'); ?></span></legend>
                        <label>
                            <input type="radio" name="<?php echo SHOW_HERO_UNIT_KEY; ?>" value="<?php echo ALL_PAGES; ?>" <?php if($theme_config[SHOW_HERO_UNIT_KEY] == ALL_PAGES) : ?>checked="checked"<?php endif; ?>/>
                            <span><?php _e('Enable on all pages', 'wpbootstrap'); ?></span>
                        </label>
                        <br/>
                        <label>
                            <input type="radio" name="<?php echo SHOW_HERO_UNIT_KEY; ?>" value="<?php echo ALL_PAGES_BUT_HOME; ?>" <?php if($theme_config[SHOW_HERO_UNIT_KEY] == ALL_PAGES_BUT_HOME) : ?>checked="checked"<?php endif; ?>/>
                            <span><?php _e('Enable on all pages except home', 'wpbootstrap'); ?></span>
                        </label>
                        <br/>
                        <label>
                            <input type="radio" name="<?php echo SHOW_HERO_UNIT_KEY; ?>" value="<?php echo DISABLED; ?>" <?php if($theme_config[SHOW_HERO_UNIT_KEY] == DISABLED) : ?>checked="checked"<?php endif; ?>/>
                            <span><?php _e('Disable', 'wpbootstrap'); ?></span>
                        </label>
                    </fieldset>
                </td>
            </tr>
            <tr valign="top" id="text-color-row">
                <th scope="row"><label for="header_bgcolor"><?php _e('Background color', 'wpbootstrap'); ?></label></th>
                <td>
                    <fieldset>
                        <legend class="screen-reader-text"><span><?php _e('Background color', 'wpbootstrap'); ?></span></legend>

                        <p>
                            <input type="text" name="<?php echo HEADER_BGCOLOR_KEY; ?>" id="header_bgcolor" placeholder="#F5F5F5"/>
                            <input type="button" class="button hide-if-no-js" value="<?php _e('Color picker', 'wpbootstrap'); ?>" id="pickcolor">
                        </p>
                        <div id="color-picker" style="z-index: 100; background:#eee; border:1px solid #ccc; position:absolute; display:none;"></div>
                    </fieldset>
                </td>
            </tr>
        </tbody>
    </table>

    <table class="form-table">
        <tbody>
            <tr>
                <th scope="row"><?php _e('Ribbon', 'wpbootstrap'); ?></th>
                <td>
                    <fieldset>
                        <legend class="screen-reader-text"><span><?php _e('Ribbon options', 'wpbootstrap'); ?></span></legend>
                        <label>
                            <input type="radio" name="<?php echo SHOW_RIBBON_KEY; ?>" value="1" <?php if($theme_config[SHOW_RIBBON_KEY] == true) : ?>checked="checked"<?php endif; ?>/>
                            <span><?php _e('Display the ribbon', 'wpbootstrap'); ?></span>
                        </label>
                        <br/>
                        <label>
                            <input type="radio" name="<?php echo SHOW_RIBBON_KEY; ?>" value="0" <?php if($theme_config[SHOW_RIBBON_KEY] != true) : ?>checked="checked"<?php endif; ?>/>
                            <span><?php _e('Hide the ribbon', 'wpbootstrap'); ?></span>
                        </label>
                        <br/><br/>
                        <label style="display: inline-block; width: 450px">
                            <span><?php _e('Ribbon link', 'wpbootstrap'); ?></span>
                            <input type="url" name="<?php echo RIBBON_URL_KEY; ?>" value="<?php echo $theme_config[RIBBON_URL_KEY]; ?>" style="width: 450px;" placeholder="http://"/>
                        </label>
                        <br/><br/>
                        <label style="display: inline-block; width: 450px">
                            <span><?php _e('Ribbon image URL', 'wpbootstrap'); ?></span>
                            <input type="url" name="<?php echo RIBBON_IMAGE_URL_KEY; ?>" value="<?php echo $theme_config[RIBBON_IMAGE_URL_KEY]; ?>" style="width: 450px;" placeholder="http://"/>
                        </label>
                        <br/><br/>
                        <label style="display: inline-block; width: 450px">
                            <span><?php _e('Ribbon image alt text', 'wpbootstrap'); ?></span>
                            <input type="text" name="<?php echo RIBBON_IMAGE_ALT_KEY; ?>" value="<?php echo $theme_config[RIBBON_IMAGE_ALT_KEY]; ?>" style="width: 450px;"/>
                        </label>
                    </fieldset>
                </td>
            </tr>
        </tbody>
    </table>

    <p class="submit"><input type="submit" name="submit" id="submit" class="button-primary" value="<?php _e('Apply changes', 'wpbootstrap'); ?>"/></p>
</form>

<link rel="stylesheet" type="text/css" href="/wp-admin/css/farbtastic.css"/>
<script type="text/javascript" src="/wp-admin/js/farbtastic.js"></script>
<script type="text/javascript">
    var farbtastic,
        default_color    = '<?php echo $theme_config[HEADER_BGCOLOR_KEY]; ?>',
        header           = jQuery('#header_bgcolor'),
        picker_handle    = jQuery('#pickcolor'),
        picker_cont_sel  = '#color-picker',
        picker_container = jQuery(picker_cont_sel);

    function pickColor(color) {
        farbtastic.setColor(color);
        header.val(color)
    }

    jQuery(document).ready(function() {
        picker_handle.click(function() {
            picker_container.show();
        });

        header.keyup(function() {
            var _hex = header.val(),
                hex = _hex;

            if(hew.indexOf('#') == 0) {
                hex = hex.replace(/[^#a-fA-F0-9]+/, '');
            }
            if (hex != _hex) header.val(hex);
            if (hex.length == 4 || hex.length == 7) pickColor(hex);
        });

        jQuery(document).mousedown(function(){
            picker_container.each( function() {
                var display = jQuery(this).css('display');
                if (display == 'block') jQuery(this).fadeOut(2);
            });
        });

        farbtastic = jQuery.farbtastic(picker_cont_sel, function(color) { pickColor(color); });
        pickColor(default_color);
    });
</script>