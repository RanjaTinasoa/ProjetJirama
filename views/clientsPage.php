<?php
$divActive = isset($divActive) ? $divActive : 'div1'; // Récupérer la variable passée depuis le controller


// Récupération des clients depuis le contrôleur
?>

<div class="client-container">
    <div class="<?= in_array($divActive, ['div1', 'div3', 'div4', 'div2']) ? "cli-pri-card" : 'none'; ?>" id="div1">
        <div class="title">
            <a href="client">Liste des Clients</a>
            <a href="menu-ajout-client">Ajouter des clients</a>
        </div>
        <div class="searchBar">
            <form action="search-order-client" method="POST">
                <input type="text" name="nom" placeholder="Chercher client" value="">
                <button type="submit">chercher</button>
            </form>

        </div>
        <div class="table-card">
            <table class="table">
                <thead>
                    <tr>
                        <th>
                            <form action="search-order-client" method="POST">
                                <input type="hidden" name="order" value="codecli">
                                <button class="btn-reset" type="submit">Code Client</button>
                            </form>
                        </th>
                        <th>
                            <form action="search-order-client" method="POST">
                                <input type="hidden" name="order" value="nom">
                                <button class="btn-reset" type="submit">Nom</button>
                            </form>
                        </th>
                        <th>
                            <form action="search-order-client" method="POST">
                                <input type="hidden" name="order" value="sexe">
                                <button class="btn-reset" type="submit">Sexe</button>
                            </form>
                        </th>
                        <th>
                            <form action="search-order-client" method="POST">
                                <input type="hidden" name="order" value="quartier">
                                <button class="btn-reset" type="submit">Quartier</button>
                            </form>
                        </th>
                        <th>
                            <form action="search-order-client" method="POST">
                                <input type="hidden" name="order" value="niveau">
                                <button class="btn-reset" type="submit">Niveau</button>
                            </form>
                        </th>
                        <th>
                            <form action="search-order-client" method="POST">
                                <input type="hidden" name="order" value="mail">
                                <button class="btn-reset" type="submit">Email</button>
                            </form>
                        </th>
                        <div class="t-no-style">
                            <th></th>
                            <th></th>
                        </div>

                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($users)) : ?>
                        <?php foreach ($users as $client) : ?>
                            <tr>
                                <td><?= htmlspecialchars($client[0]) ?></td>
                                <td><?= htmlspecialchars($client[1]) ?></td>
                                <td><?= htmlspecialchars($client[2]) ?></td>
                                <td><?= htmlspecialchars($client[3]) ?></td>
                                <td><?= htmlspecialchars($client[4]) ?></td>
                                <td><?= htmlspecialchars($client[5]) ?></td>

                                <td>
                                    <form action="modifier-client" method="POST">
                                        <input type="hidden" value="<?= $client[0] ?>" name="id">
                                        <button type="submit">modifier</button>

                                    </form>
                                </td>
                                <td>
                                    <form action="supprimer-client" method="post">
                                        <input type="hidden" value="<?= $client[0] ?>" name="ide">
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
            <label class="c-title-label" for="">créer un nouveau client</label>
            <form action="ajouter-client" method="POST" class="create-cli-form">
                <div class="cadre"> <label for="nom" class="cr-label">nom du client</label><br>
                    <input type="text" class="c-input" name="nom" placeholder="nom"><br>
                </div>
                <div class="cadre"> <label for="sexe" class="cr-label">sexe</label><br>
                    <input type="text" class="c-input" name="sexe" placeholder="sexe"><br>
                </div>
                <div class="cadre"><label for="quartier" class="cr-label">quartier</label><br>

                    <input type="text" class="c-input" name="quartier" placeholder="quartier"><br>
                </div>
                <div class="cadre"> <label for="niveau" class="cr-label">niveau</label><br>

                    <input type="text" class="c-input" name="niveau" placeholder="niveau"><br>
                </div>
                <div class="cadre"> <label for="mail" class="cr-label">mail</label><br>

                    <input type="text" class="c-input" name="mail" placeholder="mail"><br>
                </div>
                <button type="submit">créer client</button><br>
            </form>
        </div>

        <div class="<?= ($divActive === 'div3') ? "create-cli" : 'none'; ?>">
            <label class="c-title-label" for="">modifier client</label>

            <form action="confirmer-modifier-client" class="create-cli-form" method="POST">
                <input type="hidden" name="codecli" value="<?php echo htmlspecialchars($user['codecli'] ?? ''); ?>">
                <div class="cadre"> <label for="" class="cr-label">nom du client</label><br>
                    <input type="text" class="c-input" name="nom" value="<?php echo htmlspecialchars($user['nom'] ?? ''); ?>"><br>
                </div>
                <div class="cadre"> <label for="" class="cr-label">sexe</label><br>
                    <input type="text" class="c-input" name="sexe" value="<?php echo htmlspecialchars($user['sexe'] ?? ''); ?>"><br>
                </div>
                <div class="cadre"><label for="" class="cr-label">quartier</label><br>
                    <input type="text" class="c-input" name="quartier" value="<?php echo htmlspecialchars($user['quartier'] ?? ''); ?>"><br>
                </div>
                <div class="cadre"> <label for="" class="cr-label">niveau</label><br>
                    <input type="text" class="c-input" name="niveau" value="<?php echo htmlspecialchars($user['niveau'] ?? ''); ?>"><br>
                </div>
                <div class="cadre"> <label for="" class="cr-label">email</label><br>
                    <input type="text" class="c-input" name="mail" value="<?php echo htmlspecialchars($user['mail'] ?? ''); ?>"><br>
                </div>
                <button type="submit">modifier client</button><br>
            </form>

        </div>
        <div class="<?= ($divActive === 'div4') ? "create-cli" : 'none'; ?>">
            <label class="c-title-label" for="">supprimer client</label>
            <form action="confirme-supprimer-client" class="create-cli-form" method="POST">
                <div class="cadre"> <label for="" class="cr-label">code du client</label><br>
                    <input type="text" class="c-input" name="codecli" placeholder="exemple: C001" value="<?php echo htmlspecialchars($user['codecli'] ?? ''); ?>"><br>

                </div>

                <button type="submit">supprimer le client</button><br>
            </form>
        </div>


    </div>
</div>