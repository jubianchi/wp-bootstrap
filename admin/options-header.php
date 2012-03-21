<?php
global $theme_config;
$base = get_bloginfo('template_url');
?>

<form method="post" action="#">
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
