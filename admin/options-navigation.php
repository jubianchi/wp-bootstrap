<?php
global $theme_config;
$base = get_bloginfo('template_url');
?>

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

    <p class="submit"><input type="submit" name="submit" id="submit" class="button-primary" value="Enregistrer les modifications"></p>
</form>
