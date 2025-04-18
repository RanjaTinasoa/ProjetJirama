<?php
$divActive = isset($divActive) ? $divActive : 'div1'; // Récupérer la variable passée depuis le controller

// Vérifier si une recherche a été soumise
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['nom_client'])) {
    $_SESSION['nom_recherche'] = $_POST['nom_client']; // Stocker la valeur dans la session
}

// Récupérer la valeur de la recherche si elle existe
$nom_recherche = isset($_SESSION['nom_recherche']) ? $_SESSION['nom_recherche'] : "";
// Récupération des compteur depuis le contrôleur
?>

<div class="client-container">
    <div class="<?= in_array($divActive, ['div1', 'div3', 'div4', 'div2']) ? "cli-pri-card" : 'none'; ?>" id="div1">
        <div class="title">
            <a href="compteur">Liste des Compteurs</a>
            <a href="compteur">Ajouter un compteur</a>
        </div>
        <div class="searchBar">
            <form action="search-order-compteur" method="POST">
                <input type="text" name="nom_client" placeholder="Chercher le client propriétaire du compteur" value="<?= htmlspecialchars($nom_recherche); ?>">
                <button type="submit">chercher</button>
            </form>

        </div>
        <div class="table-card">
            <table class="table">
                <thead>
                    <tr>
                        <th>
                            <form action="search-order-compteur" method="POST">
                                <input type="hidden" name="nom_client" value="<?= htmlspecialchars($nom_recherche); ?>">

                                <input type="hidden" name="order" value="codecompteur">
                                <button class="btn-reset" type="submit">Code du compteur</button>
                            </form>
                        </th>
                        <th>
                            <form action="search-order-compteur" method="POST">
                                <input type="hidden" name="nom_client" value="<?= htmlspecialchars($nom_recherche); ?>">

                                <input type="hidden" name="order" value="type">
                                <button class="btn-reset" type="submit">type</button>
                            </form>
                        </th>
                        <th>
                            <form action="search-order-compteur" method="POST">
                                <input type="hidden" name="nom_client" value="<?= htmlspecialchars($nom_recherche); ?>">

                                <input type="hidden" name="order" value="pu">
                                <button class="btn-reset" type="submit">pu</button>
                            </form>
                        </th>
                        <th>
                            <form action="search-order-compteur" method="POST">
                                <input type="hidden" name="nom_client" value="<?= htmlspecialchars($nom_recherche); ?>">

                                <input type="hidden" name="order" value="compteur.codecli">
                                <button class="btn-reset" type="submit">codecli</button>
                            </form>
                        </th>
                        <th>
                            <form action="search-order-compteur" method="POST">
                                <input type="hidden" name="nom_client" value="<?= htmlspecialchars($nom_recherche); ?>">

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
                    <?php if (!empty($compteurs)) : ?>
                        <?php foreach ($compteurs as $compt) : ?>
                            <tr>
                                <td><?= htmlspecialchars($compt[0]) ?></td>
                                <td><?= htmlspecialchars($compt[1]) ?></td>
                                <td><?= htmlspecialchars($compt[2]) ?></td>
                                <td><?= htmlspecialchars($compt[3]) ?></td>
                                <td><?= htmlspecialchars($compt[4]) ?></td>
                                <td>
                                    <form action="modifier-compteur" method="POST">
                                        <input type="hidden" value="<?= $compt[0] ?>" name="codec">
                                        <button type="submit">modifier</button>

                                    </form>
                                </td>
                                <td>
                                    <form action="supprimer-compteur" method="post">
                                        <input type="hidden" value="<?= $compt[0] ?>" name="codeco">
                                        <button type="submit">supprimer</button>

                                    </form>
                                </td>

                            </tr>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="6">Aucun compteur trouvé.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

    </div>
    <div class="cli-sec-card">
        <div class="<?= in_array($divActive, ['div1', 'div2']) ? "create-cli" : 'none'; ?>">
            <label class="c-title-label" for="">Ajouter un nouveau compteur</label>
            <form action="menu-ajout-compteur" method="POST" class="create-cli-form">
                <div class="cadre"> <label for="type" class="cr-label">type du compteur</label><br>
                    <input type="text" class="c-input" name="type" placeholder="type"><br>
                </div>
                <div class="cadre"> <label for="pu" class="cr-label">pu</label><br>
                    <input type="text" class="c-input" name="pu" placeholder="pu"><br>
                </div>
                <div class="cadre"><label for="codecli" class="cr-label">codecli</label><br>

                    <input type="text" class="c-input" name="codecli" placeholder="codecli"><br>
                </div>
                <button type="submit">créer compteur</button><br>
            </form>
        </div>

        <div class="<?= ($divActive === 'div3') ? "create-cli" : 'none'; ?>">
            <label class="c-title-label" for="">modifier compteur</label>
            <form action="confirmer-modifier-compteur" class="create-cli-form" method="POST">
                <input type="hidden" name="codecompteur" value="<?php echo htmlspecialchars($compteur['codecompteur'] ?? ''); ?>">
                <div class="cadre"> <label for="" class="cr-label">type du compteur</label><br>
                    <input type="text" class="c-input" name="type" value="<?php echo htmlspecialchars($compteur['type'] ?? ''); ?>"><br>
                </div>
                <div class="cadre"> <label for="" class="cr-label">pu</label><br>
                    <input type="text" class="c-input" name="pu" value="<?php echo htmlspecialchars($compteur['pu'] ?? ''); ?>"><br>
                </div>
                <div class="cadre"><label for="" class="cr-label">codecli</label><br>
                    <input type="text" class="c-input" name="codecli" value="<?php echo htmlspecialchars($compteur['codecli'] ?? ''); ?>"><br>
                </div>
                <button type="submit">modifier compteur</button><br>
            </form>
            <!------------hehllooooo-----><!-----teo ah da tsy teo indreo----->
        </div>
        <div class="<?= ($divActive === 'div4') ? "create-cli" : 'none'; ?>">
            <label class="c-title-label" for="">supprimer compteur</label>
            <form action="confirme-supprimer" class="create-cli-form" method="POST">
                <div class="cadre"> <label for="" class="cr-label">code du compteur</label><br>
                    <input type="text" class="c-input" name="codecompteur" placeholder="exemple: C001" value="<?php echo htmlspecialchars($compteur['codecompteur'] ?? ''); ?>"><br>

                </div>

                <button type="submit">supprimer le compteur</button><br>
            </form>
        </div>


    </div>
</div>