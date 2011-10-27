<?php
$base = get_bloginfo('template_url');
?>

<div class="wrap">
    <div id="icon-options-general" class="icon32"><br></div><h2>WPBootstrap</h2>

    <form method="post" action="options.php">
        <table class="form-table">
            <tbody>
                <tr>
                    <th scope="row">Chemin de fer</th>
                    <td>
                        <fieldset>
                            <legend class="screen-reader-text"><span>Options du chemin de fer</span></legend>
                            <label title="Activer sur toutes les pages">
                                <input type="radio" name="date_format" value="enable_all"/>
                                <span>Activer sur toutes les pages</span>
                            </label>
                            <br/>
                            <label title="Activer sur toutes les pages sauf la page d'accueil">
                                <input type="radio" name="date_format" value="enable""/>
                                <span>Activer sur toutes les pages sauf la page d'accueil</span>
                            </label>
                            <br/>
                            <label title="Désactiver">
                                <input type="radio" name="date_format" value="disable"/>
                                <span>Désactiver</span>
                            </label>
                            <br/>
                        </fieldset>
                    </td>
                </tr>

                <tr>
                    <th scope="row">Mettre en avant sur la page d'accueil</th>
                    <td>
                        <fieldset>
                            <legend class="screen-reader-text"><span>Mettre en avant sur la page d'accueil</span></legend>
                            <label title="En passant">
                                <input type="checkbox" name="date_format" value="aside"/>
                                <span>En passant</span>
                            </label>
                            <br/>
                            <label title="Galerie">
                                <input type="checkbox" name="date_format" value="gallery""/>
                                <span>Galerie</span>
                            </label>
                            <br/>
                            <label title="Citation">
                                <input type="checkbox" name="date_format" value="quote"/>
                                <span>Citation</span>
                            </label>
                            <br/>
                        </fieldset>
                        <br/>
                        <fieldset>
                            <label title="Et exclure de la boucle principale">
                                <span>Afficher</span>
                                <select name="default_role" id="default_role">
                                    <option value="3">3</option>
                                    <option value="3">6</option>
                                    <option value="3">9</option>
                                    <option value="3">12</option>
                                </select>
                                <span>articles</span>
                            </label>
                        </fieldset>
                        <br/>
                        <fieldset>
                            <label title="Et exclure de la boucle principale">
                                <input type="radio" name="date_format" value="enable""/>
                                <span>Et exclure de la boucle principale</span>
                            </label>
                            <br/>
                            <label title="Et inclure dans la boucle principale">
                                <input type="radio" name="date_format" value="disable"/>
                                <span>Et inclure dans la boucle principale</span>
                            </label>
                            <br/>
                        </fieldset>
                    </td>
                </tr>
            </tbody>
        </table>
        <p class="submit"><input type="submit" name="submit" id="submit" class="button-primary" value="Enregistrer les modifications"></p>
    </form>
</div>