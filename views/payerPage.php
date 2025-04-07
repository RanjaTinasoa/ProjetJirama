<?php
$divActive = isset($divActive) ? $divActive : 'div1'; // Récupérer la variable passée depuis le controller
#bonjour Ranja
// Vérifier si une recherche a été soumise
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['nom_client'])) {
    $_SESSION['nom_recherche'] = $_POST['nom_client']; // Stocker la valeur dans la session
}

// Récupérer la valeur de la recherche si elle existe
$nom_recherche = isset($_SESSION['nom_recherche']) ? $_SESSION['nom_recherche'] : "";
// Récupération des paiement depuis le contrôleur
?>

<div class="client-container">
    <div class="<?= in_array($divActive, ['div1', 'div3', 'div4', 'div2']) ? "cli-pri-card" : 'none'; ?>" id="div1">
        <div class="title">
            <a href="paiement">Liste des paiement</a>
            <a href="paiement">Ajouter des paiement</a>
        </div>
        <div class="searchBar">
            <form action="search-order-payer" method="POST">
                <input type="text" name="nom_client" placeholder="Chercher code du paye ou code du client ou nom client " value="<?= htmlspecialchars($nom_recherche); ?>">
                <button type="submit">chercher</button>
            </form>

        </div>
        <div class="table-card">
            <table class="table">
                <thead>
                    <tr>
                        <th>
                            <form action="search-order-payer" method="POST">
                                <input type="hidden" name="nom_client" value="<?= htmlspecialchars($nom_recherche); ?>">

                                <input type="hidden" name="order" value="idpaye">
                                <button class="btn-reset" type="submit">Code payer</button>
                            </form>
                        </th>
                        <th>
                            <form action="search-order-payer" method="POST">
                                <input type="hidden" name="nom_client" value="<?= htmlspecialchars($nom_recherche); ?>">

                                <input type="hidden" name="order" value="codecli">
                                <button class="btn-reset" type="submit">codecli</button>
                            </form>
                        </th>
                        <th>
                            <form action="search-order-payer" method="POST">
                                <input type="hidden" name="nom_client" value="<?= htmlspecialchars($nom_recherche); ?>">

                                <input type="hidden" name="order" value="date_paie">
                                <button class="btn-reset" type="submit">date_paie</button>
                            </form>
                        </th>
                        <th>
                            <form action="search-order-payer" method="POST">
                                <input type="hidden" name="nom_client" value="<?= htmlspecialchars($nom_recherche); ?>">

                                <input type="hidden" name="order" value="montant">
                                <button class="btn-reset" type="submit">montant</button>
                            </form>
                        </th>
                        <th>
                            <form action="search-order-payer" method="POST">
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
                    <?php if (!empty($paiements)) : ?>
                        <?php foreach ($paiements as $payer) : ?>
                            <tr>
                                <td><?= htmlspecialchars($payer[0]) ?></td>
                                <td><?= htmlspecialchars($payer[1]) ?></td>
                                <td><?= htmlspecialchars($payer[2]) ?></td>
                                <td><?= htmlspecialchars($payer[3]) ?></td>
                                <td><?= htmlspecialchars($payer[4]) ?></td>

                                <td>
                                    <form action="modifier-paiement" method="POST">
                                        <input type="hidden" value="<?= $payer[0] ?>" name="id">
                                        <button type="submit">modifier</button>

                                    </form>
                                </td>
                                <td>
                                    <form action="supprimer-paiement" method="post">
                                        <input type="hidden" value="<?= $payer[0] ?>" name="ide">
                                        <button type="submit">supprimer</button>

                                    </form>
                                </td>



                            </tr>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="6">Aucun client trouvé.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

    </div>
    <div class="cli-sec-card">
        <div class="<?= in_array($divActive, ['div1', 'div2']) ? "create-cli" : 'none'; ?>">
            <label class="c-title-label" for="">Ajouter un paiement</label>
            <form action="ajouter-paiement" method="POST" class="create-cli-form">
                <div class="cadre"> <label for="codecli" class="cr-label">codecli du client</label><br>
                    <input type="text" class="c-input" name="codecli" placeholder="codecli"><br>
                </div>
                <div class="cadre"> <label for="date_paie" class="cr-label">date du paiement</label><br>
                    <input type="text" class="c-input" name="date_paie" placeholder="date de paie"><br>
                </div>
                <div class="cadre"><label for="montant" class="cr-label">montant</label><br>

                    <input type="text" class="c-input" name="montant" placeholder="montant"><br>
                </div>
                <button type="submit">confirmer le paiement</button><br>
            </form>
        </div>

        <div class="<?= ($divActive === 'div3') ? "create-cli" : 'none'; ?>">
            <label class="c-title-label" for="">modifier le paiement</label>
            <?php showArray($paie) ?>

            <form action="confirmer-modifier-paiement" class="create-cli-form" method="POST">
                <input type="hidden" name="idpaye" value="<?php echo htmlspecialchars($paie['idpaye'] ?? ''); ?>">

                <div class="cadre"> <label for="" class="cr-label">code du client payeur</label><br>
                    <input type="text" class="c-input" name="codecli" value="<?php echo htmlspecialchars($paie['codecli'] ?? ''); ?>"><br>
                </div>
                <div class="cadre"> <label for="" class="cr-label">date_paie</label><br>
                    <input type="text" class="c-input" name="date_paie" value="<?php echo htmlspecialchars($paie['date_paie'] ?? ''); ?>"><br>
                </div>
                <div class="cadre"><label for="" class="cr-label">montant</label><br>
                    <input type="text" class="c-input" name="montant" value="<?php echo htmlspecialchars($paie['montant'] ?? ''); ?>"><br>
                </div>
                <button type="submit">modifier client</button><br>
            </form>

        </div>
        <div class="<?= ($divActive === 'div4') ? "create-cli" : 'none'; ?>">
            <?php showArray($paie) ?>
            <label class="c-title-label" for="">supprimer client</label>
            <form action="confirmer-supprimer-paiement" class="create-cli-form" method="POST">
                <div class="cadre"> <label for="" class="cr-label">code du client</label><br>
                    <input type="text" class="c-input" name="idpaye" placeholder="exemple: C001" value="<?php echo htmlspecialchars($paie['idpaye'] ?? ''); ?>"><br>

                </div>

                <button type="submit">supprimer le client</button><br>
            </form>
        </div>


    </div>
</div>