<?php
global $theme_config;
$base = get_bloginfo('template_url');

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    bootstrap_admin_save();
}
?>

<div class="wrap">
    <div id="icon-themes" class="icon32"><br></div><h2>wp-bootstrap</h2>

    <form method="post" action="#">
        <h3>Navigation</h3>

        <table class="form-table">
            <tbody>
                <tr>
                    <th scope="row">Chemin de fer</th>
                    <td>
                        <fieldset>
                            <legend class="screen-reader-text"><span>Options du chemin de fer</span></legend>

                            <label title="Activer sur toutes les pages sauf la page d'accueil">
                                <input type="radio" name="show_breadcrumb" value="2" <?php if($theme_config['show_breadcrumb'] == 2) : ?>checked="checked"<?php endif; ?>/>
                                <span>Activer sur toutes les pages sauf la page d'accueil</span>
                            </label>
                            <br/>
                            <label title="Désactiver">
                                <input type="radio" name="show_breadcrumb" value="0" <?php if($theme_config['show_breadcrumb'] == 0) : ?>checked="checked"<?php endif; ?>/>
                                <span>Désactiver</span>
                            </label>
                        </fieldset>
                    </td>
                </tr>

                <tr>
                    <th scope="row">Topbar</th>
                    <td>
                        <fieldset>
                            <legend class="screen-reader-text"><span>Options de la Topbar</span></legend>
                            
                            <label title="Activer sur toutes les pages">
                                <input type="radio" name="show_search" value="1" <?php if($theme_config['show_search'] == 1) : ?>checked="checked"<?php endif; ?>/>
                                <span>Afficher le champ de recherche</span>
                            </label>
                            <br/>
                            <label title="Activer sur toutes les pages sauf la page d'accueil">
                                <input type="radio" name="show_search" value="0" <?php if($theme_config['show_search'] == 0) : ?>checked="checked"<?php endif; ?>/>
                                <span>Masquer le champ de recherche</span>
                            </label>
                            <br/><br/>
                            <label title="Activer sur toutes les pages">
                                <input type="radio" name="show_login" value="1" <?php if($theme_config['show_login'] == 1) : ?>checked="checked"<?php endif; ?>/>
                                <span>Afficher le bouton de connexion</span>
                            </label>
                            <br/>
                            <label title="Activer sur toutes les pages sauf la page d'accueil">
                                <input type="radio" name="show_login" value="0" <?php if($theme_config['show_login'] == 0) : ?>checked="checked"<?php endif; ?>/>
                                <span>Masquer le bouton de connexion</span>
                            </label>
                        </fieldset>
                    </td>
                </tr>
            </tbody>
        </table>

        <h3>Page d'accueil</h3>

        <table class="form-table">
            <tbody>
                <tr>
                    <th scope="row">Mettre en avant les articles</th>
                    <td>
                        <fieldset>
                            <legend class="screen-reader-text"><span>Options des articles sur la page d'accueil</span></legend>
                            
                            <?php foreach($theme_config['formats'] as $k => $format) : ?>
                                <label title="<?php echo __($format); ?>" style="display: inline-block; width: 200px">
                                    <input type="checkbox" name="sticky_formats[]" value="<?php echo $format; ?>" <?php if(in_array('post-format-' . $format, $theme_config['sticky_formats'])) : ?>checked="checked"<?php endif; ?>/>
                                    <span><?php echo __($format); ?></span>
                                </label>
                                <?php if((($k + 1) % 2) == 0) : ?><br/><?php endif; ?>
                            <?php endforeach; ?>
                            <br/><br/>
                            <label>
                                <span>Afficher</span>
                                <select name="sticky_rows" id="sticky_rows">
                                    <?php for($i = 1; $i <= 5; $i++) : ?>
                                        <option value="<?php echo $i; ?>" <?php if($theme_config['sticky_rows'] == $i) : ?>selected="selected"<?php endif; ?>>
                                            <?php echo $i; ?>
                                        </option>
                                    <?php endfor; ?>
                                </select>
                                <span>lignes <small>(3 articles par ligne)</small></span>
                            </label>
                        </fieldset>
                    </td>
                </tr>
            </tbody>
        </table>

        <h3>Apparence</h3>

        <table class="form-table">
            <tbody>
                <tr valign="top" id="text-color-row">
                    <th scope="row"><label for="header_bgcolor">Couleur de fond</label></th>
                    <td>
                        <fieldset>
                            <legend class="screen-reader-text"><span>Options du header</span></legend>

                            <p>
                                <input type="text" name="header_bgcolor" id="header_bgcolor"/>
                                <input type="button" class="button hide-if-no-js" value="Sélecteur de couleur" id="pickcolor">
                            </p>
                            <div id="color-picker" style="z-index: 100; background:#eee; border:1px solid #ccc; position:absolute; display:none;"></div>
                        </fieldset>
                    </td>
                </tr>
            </tbody>
        </table>

        <h3>Support</h3>

        <table class="form-table">
            <tbody>
                <tr>
                    <th scope="row">GitHub</th>
                    <td>
                        <fieldset>
                            <legend class="screen-reader-text"><span>Options GitHub</span></legend>
                            <label title="Activer sur toutes les pages">
                                <input type="radio" name="github_support" value="1" <?php if($theme_config['github_support'] == 1) : ?>checked="checked"<?php endif; ?>/>
                                <span>Afficher le lien GitHub</span>
                            </label>
                            <br/>
                            <label title="Activer sur toutes les pages sauf la page d'accueil">
                                <input type="radio" name="github_support" value="0" <?php if($theme_config['github_support'] == 0) : ?>checked="checked"<?php endif; ?>/>
                                <span>Masquer le lien GitHub</span>
                            </label>
                            <br/><br/>
                            <label title="URL GitHub" style="display: inline-block; width: 200px">
                                <span>URL du lien GitHub</span>
                                <input type="text" name="github_url" value="<?php echo $theme_config['github_url']; ?>" style="width: 250px;"/>
                            </label>
                        </fieldset>
                    </td>
                </tr>
            </tbody>
        </table>
        
        <p class="submit"><input type="submit" name="submit" id="submit" class="button-primary" value="Enregistrer les modifications"></p>
    </form>
</div>
<link rel="stylesheet" type="text/css" href="/wp-admin/css/farbtastic.css"/>
<script type="text/javascript" src="/wp-admin/js/farbtastic.js"></script>
<script type="text/javascript">
var farbtastic,
    default_color    = '<?php echo $theme_config['header_bgcolor']; ?>',
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