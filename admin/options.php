<?php
global $theme_config;
$base = get_bloginfo('template_url');

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    bootstrap_admin_save();
}
?>

<div class="wrap">
    <div id="icon-options-general" class="icon32"><br></div><h2>WPBootstrap</h2>

    <form method="post" action="#">
        <table class="form-table">
            <tbody>
                <tr>
                    <th scope="row">Chemin de fer</th>
                    <td>
                        <fieldset>
                            <legend class="screen-reader-text"><span>Options du chemin de fer</span></legend>
                            <label title="Activer sur toutes les pages">
                                <input type="radio" name="show_breadcrumb" value="1" <?php if($theme_config['show_breadcrumb'] == 1) : ?>checked="checked"<?php endif; ?>/>
                                <span>Activer sur toutes les pages</span>
                            </label>
                            <br/>
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
                            <legend class="screen-reader-text"><span>Options du champ de recherche</span></legend>
                            <label title="Activer sur toutes les pages">
                                <input type="radio" name="show_search" value="1" <?php if($theme_config['show_search'] == 1) : ?>checked="checked"<?php endif; ?>/>
                                <span>Afficher le champ de recherche</span>
                            </label>
                            <br/>
                            <label title="Activer sur toutes les pages sauf la page d'accueil">
                                <input type="radio" name="show_search" value="0" <?php if($theme_config['show_search'] == 0) : ?>checked="checked"<?php endif; ?>/>
                                <span>Masquer le champ de recherche</span>
                            </label>
                        </fieldset>
                        <br/>
                        <fieldset>
                            <legend class="screen-reader-text"><span>Options du bouton de connexion</span></legend>
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

                <tr>
                    <th scope="row">Mettre en avant sur la page d'accueil</th>
                    <td>
                        <fieldset>
                            <legend class="screen-reader-text"><span>Mettre en avant sur la page d'accueil</span></legend>
                            <?php foreach($theme_config['formats'] as $k => $format) : ?>
                                <label title="<?php echo __($format); ?>" style="display: inline-block; width: 200px">
                                    <input type="checkbox" name="sticky_formats[]" value="<?php echo $format; ?>" <?php if(in_array('post-format-' . $format, $theme_config['sticky_formats'])) : ?>checked="checked"<?php endif; ?>/>
                                    <span><?php echo __($format); ?></span>
                                </label>
                                <?php if((($k + 1) % 2) == 0) : ?><br/><?php endif; ?>
                            <?php endforeach; ?>
                        </fieldset>
                        <br/>
                        <fieldset>
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
        <p class="submit"><input type="submit" name="submit" id="submit" class="button-primary" value="Enregistrer les modifications"></p>
    </form>
</div>