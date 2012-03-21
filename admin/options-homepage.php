<?php
global $theme_config;
$base = get_bloginfo('template_url');
?>

<form method="post" action="#">
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
