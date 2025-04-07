<?php
$divActive = isset($divActive) ? $divActive : 'div1'; // Récupérer la variable passée depuis le controller
$divPrincipal = isset($divPrincipal) ? $divPrincipal : 'divElec';


// Vérifier si une recherche a été soumise
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['codeElec_s'])) {
    $_SESSION['codeElec_recherche'] = $_POST['codeElec_s']; // Stocker la valeur dans la session
}

// Récupérer la valeur de la recherche si elle existe
$codeElec_recherche = isset($_SESSION['codeElec_recherche']) ? $_SESSION['codeElec_recherche'] : "";



// Vérifier si une recherche a été soumise
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['codeEau_s'])) {
    $_SESSION['codeEau_recherche'] = $_POST['codeEau_s']; // Stocker la valeur dans la session
}

// Récupérer la valeur de la recherche si elle existe
$codeEau_recherche = isset($_SESSION['codeEau_recherche']) ? $_SESSION['codeEau_recherche'] : "";

// Récupération des releves depuis le contrôleur
?>
<div class="divPrincipaleReleve">

    <div class="<?= $divPrincipal == 'divElec' ? "client-container" : 'none'; ?>">
        <div class="<?= in_array($divActive, ['div1', 'div3', 'div4', 'div2']) ? "cli-pri-card" : 'none'; ?>" id="div1">
            <div class="menu">
                <button><a href="releve">électricité</a></button>
                <button><a href="releve_eau">eau</a></button>
            </div>
            <div class="title">
                <a href="releve">Liste des relevés</a>
                <a href="releve">Ajouter des relevés</a>
            </div>
            <div class="searchBar">
                <form action="search-order-releve-elec" method="POST">
                    <input type="text" name="codeElec_s" placeholder="Chercher le code électricité ou code compteur" value="<?= htmlspecialchars($codeElec_recherche); ?>">
                    <button type="submit">chercher</button>
                </form>

            </div>
            <div class="table-card">
                <table class="releve-table">
                    <thead>
                        <tr>
                            <th>
                                <form action="search-order-releve-elec" method="POST">
                                    <input type="hidden" name="codeElec_s" value="<?= htmlspecialchars($codeElec_recherche); ?>">

                                    <input type="hidden" name="order" value="codeElec">
                                    <button class="btn-reset" type="submit">Code releve électricité</button>
                                </form>
                            </th>
                            <th>
                                <form action="search-order-releve-elec" method="POST">
                                    <input type="hidden" name="codeElec_s" value="<?= htmlspecialchars($codeElec_recherche); ?>">

                                    <input type="hidden" name="order" value="codeElec">
                                    <button class="btn-reset" type="submit">codecompteur électricité</button>
                                </form>
                            </th>
                            <th>
                                <form action="search-order-releve-elec" method="POST">
                                    <input type="hidden" name="codeElec_s" value="<?= htmlspecialchars($codeElec_recherche); ?>">

                                    <input type="hidden" name="order" value="valeur1">
                                    <button class="btn-reset" type="submit">valeur du relevé électricité</button>
                                </form>
                            </th>
                            <th>
                                <form action="search-order-releve-elec" method="POST">
                                    <input type="hidden" name="codeElec_s" value="<?= htmlspecialchars($codeElec_recherche); ?>">

                                    <input type="hidden" name="order" value="date_releve">
                                    <button class="btn-reset" type="submit">Date du relevé de l'électricité</button>
                                </form>
                            </th>
                            <th>
                                <form action="search-order-releve-elec" method="POST">
                                    <input type="hidden" name="codeElec_s" value="<?= htmlspecialchars($codeElec_recherche); ?>">

                                    <input type="hidden" name="order" value="date_presentation">
                                    <button class="btn-reset" type="submit">date de présentation</button>
                                </form>
                            </th>
                            <th>
                                <form action="search-order-releve-elec" method="POST">
                                    <input type="hidden" name="codeElec_s" value="<?= htmlspecialchars($codeElec_recherche); ?>">

                                    <input type="hidden" name="order" value="date_limite_paie">
                                    <button class="btn-reset" type="submit">date limite paie</button>
                                </form>
                            </th>
                            <th>
                                <form action="search-order-releve-elec" method="POST">
                                    <input type="hidden" name="codeElec_s" value="<?= htmlspecialchars($codeElec_recherche); ?>">

                                    <input type="hidden" name="order" value="c.codecli">
                                    <button class="btn-reset" type="submit">codecli</button>
                                </form>
                            </th>
                            <th>
                                <form action="search-order-releve-elec" method="POST">
                                    <input type="hidden" name="codeElec_s" value="<?= htmlspecialchars($codeElec_recherche); ?>">

                                    <input type="hidden" name="order" value="c.nom">
                                    <button class="btn-reset" type="submit">nom du client</button>
                                </form>
                            </th>
                            <div class="t-no-style">
                                <th></th>
                                <th></th>
                            </div>

                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($list)) : ?>
                            <?php foreach ($list as $l) : ?>
                                <tr>
                                    <td><?= htmlspecialchars($l[0]) ?></td>
                                    <td><?= htmlspecialchars($l[1]) ?></td>
                                    <td><?= htmlspecialchars($l[2]) ?></td>
                                    <td><?= htmlspecialchars($l[3]) ?></td>
                                    <td><?= htmlspecialchars($l[4]) ?></td>
                                    <td><?= htmlspecialchars($l[5]) ?></td>
                                    <td><?= htmlspecialchars($l[6]) ?></td>
                                    <td><?= htmlspecialchars($l[7]) ?></td>

                                    <td>
                                        <form action="modifier-releve-elec" method="POST">
                                            <input type="hidden" value="<?= $l[0] ?>" name="codeEl1">
                                            <button type="submit">modifier</button>

                                        </form>
                                    </td>
                                    <td>
                                        <form action="supprimer-releve-elec" method="post">
                                            <input type="hidden" value="<?= $l[0] ?>" name="codeEl">
                                            <button type="submit">supprimer</button>

                                        </form>
                                    </td>



                                </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="6">Aucun d'électricité trouvé.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

        </div>
        <div class="cli-sec-card">
            <div class="<?= in_array($divActive, ['div1', 'div2']) ? "create-cli" : 'none'; ?>">
                <label class="c-title-label" for="">créer un relevé</label>
                <form action="ajouter-releve-elec" method="POST" class="create-cli-form">
                    <div class="cadre"> <label for="codecompteur" class="cr-label">codecompteur</label><br>
                        <input type="text" class="c-input" name="codecompteur" placeholder="codecompteur"><br>
                    </div>
                    <div class="cadre"><label for="valeur1" class="cr-label">valeur releve électricité</label><br>

                        <input type="text" class="c-input" name="valeur1" placeholder="valeur1"><br>
                    </div>
                    <div class="cadre"> <label for="date_releve" class="cr-label">date du relevé de l'électricité</label><br>

                        <input type="text" class="c-input" name="date_releve" placeholder="date_releve"><br>
                    </div>
                    <div class="cadre"> <label for="date_presentation" class="cr-label">date de la présentation</label><br>

                        <input type="text" class="c-input" name="date_presentation" placeholder="date_presentation"><br>
                    </div>
                    <div class="cadre"> <label for="date_limite_paie" class="cr-label">date limite de paie</label><br>

                        <input type="text" class="c-input" name="date_limite_paie" placeholder="date limite de paie"><br>
                    </div>
                    <button type="submit">créer releve</button><br>
                </form>
            </div>

            <div class="<?= ($divActive === 'div3') ? "create-cli" : 'none'; ?>">
                <label class="c-title-label" for="">modifier releve</label>

                <form action="confirmer-modifier-releve-elec" class="create-cli-form" method="POST">
                    <input type="hidden" name="codeElec" value="<?php echo htmlspecialchars($releve['codeElec'] ?? ''); ?>">

                    <div class="cadre"> <label for="" class="cr-label">codecompteur</label><br>
                        <input type="text" class="c-input" name="codecompteur" value="<?php echo htmlspecialchars($releve['codecompteur'] ?? ''); ?>"><br>
                    </div>
                    <div class="cadre"><label for="" class="cr-label">valeur du relevé de l'électricité</label><br>
                        <input type="text" class="c-input" name="valeur1" value="<?php echo htmlspecialchars($releve['valeur1'] ?? ''); ?>"><br>
                    </div>
                    <div class="cadre"> <label for="" class="cr-label">date du releve de l'électricité</label><br>
                        <input type="text" class="c-input" name="date_releve" value="<?php echo htmlspecialchars($releve['date_releve'] ?? ''); ?>"><br>
                    </div>
                    <div class="cadre"> <label for="" class="cr-label">date de presentation du relevé</label><br>
                        <input type="text" class="c-input" name="date_presentation" value="<?php echo htmlspecialchars($releve['date_presentation'] ?? ''); ?>"><br>
                    </div>
                    <div class="cadre"> <label for="date_limite_paie" class="cr-label">date limite de paie</label><br>
                        <input type="text" class="c-input" name="date_limite_paie" placeholder="date limite de paie" value="<?php echo htmlspecialchars($releve['date_limite_paie'] ?? ''); ?>"><br>
                    </div>
                    <button type="submit">modifier releve</button><br>
                </form>

            </div>
            <div class="<?= ($divActive === 'div4') ? "create-cli" : 'none'; ?>">
                <label class="c-title-label" for="">supprimer releve</label>
                <form action="confirme-supprimer-releve-elec" class="create-cli-form" method="POST">
                    <div class="cadre"> <label for="" class="cr-label">code du releve de l'électricité</label><br>
                        <input type="text" class="c-input" name="codeElec" placeholder="exemple: C001" value="<?php echo htmlspecialchars($releve['codeElec'] ?? ''); ?>"><br>

                    </div>

                    <button type="submit">supprimer le releve</button><br>
                </form>
            </div>


        </div>
    </div>
    <div class="<?= $divPrincipal == 'divEau' ? "client-container" : 'none'; ?>">
        <div class="<?= in_array($divActive, ['div1', 'div3', 'div4', 'div2']) ? "cli-pri-card" : 'none'; ?>" id="div1">
            <div class="menu">
                <button><a href="releve">électricité</a></button>
                <button><a href="releve_eau">eau</a></button>
            </div>
            <div class="title">
                <a href="releve_eau">Liste des relevés</a>
                <a href="menu-ajout-releve-eau">Ajouter des relevés</a>
            </div>
            <div class="searchBar">
                <form action="search-order-releve-eau" method="POST">
                    <input type="text" name="codeEau_s" placeholder="Chercher code relevé eau ou code compteur" value="">
                    <button type="submit">chercher</button>
                </form>

            </div>
            <div class="table-card">
                <table class="table">
                    <thead>
                        <tr>
                            <th>
                                <form action="search-order-releve-eau" method="POST">
                                    <input type="hidden" name="codeEau_s" value="<?= htmlspecialchars($codeEau_recherche); ?>">

                                    <input type="hidden" name="order" value="codeEau">
                                    <button class="btn-reset" type="submit">Code relevé de l'eau</button>
                                </form>
                            </th>
                            <th>
                                <form action="search-order-releve-eau" method="POST">
                                    <input type="hidden" name="codeEau_s" value="<?= htmlspecialchars($codeEau_recherche); ?>">

                                    <input type="hidden" name="order" value="co.codecompteur">
                                    <button class="btn-reset" type="submit">codecompteur de l'eau</button>
                                </form>
                            </th>
                            <th>
                                <form action="search-order-releve-eau" method="POST">
                                    <input type="hidden" name="codeEau_s" value="<?= htmlspecialchars($codeEau_recherche); ?>">

                                    <input type="hidden" name="order" value="valeur2">
                                    <button class="btn-reset" type="submit">valeur du relevé de l'eau</button>
                                </form>
                            </th>
                            <th>
                                <form action="search-order-releve-eau" method="POST">
                                    <input type="hidden" name="codeEau_s" value="<?= htmlspecialchars($codeEau_recherche); ?>">

                                    <input type="hidden" name="order" value="date_releve2">
                                    <button class="btn-reset" type="submit">Date du relevé de l'eau</button>
                                </form>
                            </th>
                            <th>
                                <form action="search-order-releve-eau" method="POST">
                                    <input type="hidden" name="codeEau_s" value="<?= htmlspecialchars($codeEau_recherche); ?>">

                                    <input type="hidden" name="order" value="date_presentation2">
                                    <button class="btn-reset" type="submit">date de présentation du relevé</button>
                                </form>
                            </th>
                            <th>
                                <form action="search-order-releve-eau" method="POST">
                                    <input type="hidden" name="codeEau_s" value="<?= htmlspecialchars($codeEau_recherche); ?>">

                                    <input type="hidden" name="order" value="date_limite_paie2">
                                    <button class="btn-reset" type="submit">date limite paie</button>
                                </form>
                            </th>
                            <th>
                                <form action="search-order-releve-eau" method="POST">
                                    <input type="hidden" name="codeEau_s" value="<?= htmlspecialchars($codeEau_recherche); ?>">

                                    <input type="hidden" name="order" value="c.codecli">
                                    <button class="btn-reset" type="submit">codecli</button>
                                </form>
                            </th>
                            <th>
                                <form action="search-order-releve-eau" method="POST">
                                    <input type="hidden" name="codeEau_s" value="<?= htmlspecialchars($codeEau_recherche); ?>">

                                    <input type="hidden" name="order" value="c.nom">
                                    <button class="btn-reset" type="submit">nom du client</button>
                                </form>
                            </th>
                            <div class="t-no-style">
                                <th></th>
                                <th></th>
                            </div>

                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($list)) : ?>
                            <?php foreach ($list as $l) : ?>
                                <tr>
                                    <td><?= htmlspecialchars($l[0]) ?></td>
                                    <td><?= htmlspecialchars($l[1]) ?></td>
                                    <td><?= htmlspecialchars($l[2]) ?></td>
                                    <td><?= htmlspecialchars($l[3]) ?></td>
                                    <td><?= htmlspecialchars($l[4]) ?></td>
                                    <td><?= htmlspecialchars($l[5]) ?></td>
                                    <td><?= htmlspecialchars($l[6]) ?></td>
                                    <td><?= htmlspecialchars($l[7]) ?></td>

                                    <td>
                                        <form action="modifier-releve-eau" method="POST">
                                            <input type="hidden" value="<?= $l[0] ?>" name="codeEau">
                                            <button type="submit">modifier</button>

                                        </form>
                                    </td>
                                    <td>
                                        <form action="supprimer-releve-eau" method="post">
                                            <input type="hidden" value="<?= $l[0] ?>" name="codeEau">
                                            <button type="submit">supprimer</button>

                                        </form>
                                    </td>


                                </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="6">Aucun releve d'eau trouvé.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

        </div>
        <div class="cli-sec-card">
            <div class="<?= in_array($divActive, ['div1', 'div2']) ? "create-cli" : 'none'; ?>">
                <label class="c-title-label" for="">ajouter un relevé d'eau</label>
                <form action="ajouter-releve-eau" method="POST" class="create-cli-form">
                    <div class="cadre"> <label for="codecompteur" class="cr-label">codecompteur</label><br>
                        <input type="text" class="c-input" name="codecompteur" placeholder="codecompteur"><br>
                    </div>
                    <div class="cadre"><label for="valeur2" class="cr-label">valeur releve de l'eau</label><br>

                        <input type="text" class="c-input" name="valeur2" placeholder="valeur2"><br>
                    </div>
                    <div class="cadre"> <label for="date_releve2" class="cr-label">date du releve de l'eau</label><br>

                        <input type="text" class="c-input" name="date_releve2" placeholder="date_releve2"><br>
                    </div>
                    <div class="cadre"> <label for="date_presentation2" class="cr-label">date de la présentation du relevé</label><br>

                        <input type="text" class="c-input" name="date_presentation2" placeholder="date_presentation2"><br>
                    </div>
                    <div class="cadre"> <label for="date_limite_paie2" class="cr-label">date limite de paie</label><br>

                        <input type="text" class="c-input" name="date_limite_paie2" placeholder="date limite de paie"><br>
                    </div>
                    <button type="submit">créer releve</button><br>
                </form>
            </div>

            <div class="<?= ($divActive === 'div3') ? "create-cli" : 'none'; ?>">
                <label class="c-title-label" for="">modifier releve</label>

                <form action="confirmer-modifier-releve-eau" class="create-cli-form" method="POST">
                    <input type="hidden" name="codeEau" value="<?php echo htmlspecialchars($releve['codeEau'] ?? ''); ?>">

                    <div class="cadre"> <label for="" class="cr-label">codecompteur</label><br>
                        <input type="text" class="c-input" name="codecompteur" value="<?php echo htmlspecialchars($releve['codecompteur'] ?? ''); ?>"><br>
                    </div>
                    <div class="cadre"><label for="" class="cr-label">valeur du releve de l'eau</label><br>
                        <input type="text" class="c-input" name="valeur2" value="<?php echo htmlspecialchars($releve['valeur2'] ?? ''); ?>"><br>
                    </div>

                    <div class="cadre"> <label for="" class="cr-label">date du releve de l'eau</label><br>
                        <input type="text" class="c-input" name="date_releve2" value="<?php echo htmlspecialchars($releve['date_releve2'] ?? ''); ?>"><br>
                    </div>
                    <div class="cadre"> <label for="" class="cr-label">date de presentation du relevé</label><br>
                        <input type="text" class="c-input" name="date_presentation2" value="<?php echo htmlspecialchars($releve['date_presentation2'] ?? ''); ?>"><br>
                    </div>
                    <div class="cadre"> <label for="date_limite_paie2" class="cr-label">date limite de paie</label><br>
                        <input type="text" class="c-input" name="date_limite_paie2" value="<?php echo htmlspecialchars($releve['date_limite_paie2'] ?? ''); ?>"><br>
                    </div>
                    <button type="submit">modifier releve</button><br>
                </form>

            </div>
            <div class="<?= ($divActive === 'div4') ? "create-cli" : 'none'; ?>">
                <label class="c-title-label" for="">supprimer releve</label>
                <form action="confirmer-supprimer-releve-eau" class="create-cli-form" method="POST">
                    <div class="cadre"> <label for="" class="cr-label">code du releve de l'eau</label><br>
                        <input type="text" class="c-input" name="codeEau" placeholder="exemple: C001" value="<?php echo htmlspecialchars($releve['codeEau'] ?? ''); ?>"><br>

                    </div>

                    <button type="submit">supprimer le releve</button><br>
                </form>
            </div>


        </div>
    </div>






</div>