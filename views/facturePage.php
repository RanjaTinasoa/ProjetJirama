<div id="facture-container">

    <?php for ($i = 0; $i < count($facture['mois']); $i++): ?>
        <div class="facture" id="facture-<?= $i ?>">
            <label>Réf. facture : <?php echo "facture-" . $i; ?></label>

            <div class="table-facture">
                <div class="facture-card">
                    <div class="titre">
                        <h1>JI<span>RO</span> SY RA<span>NO</span> MALA<span>GASY</span></h1>
                        <h2>Facture de : <?php echo htmlspecialchars($facture['mois'][$i][0]); ?></h2>
                    </div>
                </div>

                <div class="donnees">
                    <label>Titulaire : <?php echo htmlspecialchars($facture['datas'][$i][0]); ?></label>
                    <label>Date présentation : <?php echo htmlspecialchars($facture['datas'][$i][3]); ?></label>
                </div>

                <div class="donnees">
                    <label>Réf. client : <?php echo htmlspecialchars($facture['datas'][$i][1]); ?></label>
                    <label>Date limite : <?php echo htmlspecialchars($facture['datas'][$i][4]); ?></label>
                </div>

                <div class="info">
                    <label>Adresse : <?php echo htmlspecialchars($facture['datas'][$i][2]); ?></label>
                    <label>Type : <?php echo htmlspecialchars($facture['datas'][$i][5]); ?></label>
                    <label>N° compteur : <?php echo htmlspecialchars($facture['datas'][$i][6]); ?></label>
                    <label>Réf. eau : <?php echo htmlspecialchars($facture['datas'][$i][7]); ?> | Réf. élec : <?php echo htmlspecialchars($facture['datas'][$i][8]); ?></label>
                </div>

                <div class="titre-tab">
                    <h3>Détail facture</h3>
                </div>

                <div class="tab-facture">
                    <table>
                        <thead>
                            <tr>
                                <th></th>
                                <th>Électricité</th>
                                <th>Eau</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>PU (Ar)</td>
                                <td><?php echo htmlspecialchars($facture['pu_elec']); ?></td>
                                <td><?php echo htmlspecialchars($facture['pu_eau']); ?></td>
                            </tr>
                            <tr>
                                <td>Valeur</td>
                                <td><?php echo htmlspecialchars($facture['valeur_elec'][$i][0]); ?></td>
                                <td><?php echo htmlspecialchars($facture['valeur_eau'][$i][0]); ?> m<sup>3</sup></td>
                            </tr>
                            <tr>
                                <td>Total</td>
                                <td>
                                    <?php
                                    $pu_elec = intval($facture['pu_elec']);
                                    $valeur_elec = intval($facture['valeur_elec'][$i][0]);
                                    echo number_format($pu_elec * $valeur_elec, 0, ',', ' ');
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    $pu_eau = intval($facture['pu_eau']);
                                    $valeur_eau = intval($facture['valeur_eau'][$i][0]);
                                    echo number_format($pu_eau * $valeur_eau, 0, ',', ' ');
                                    ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="montant">
                    <h3>Total à payer : <?php echo number_format($facture['montant_total'][$i][0], 0, ',', ' '); ?> Ar</h3>
                </div>
            </div>
        </div>
    <?php endfor; ?>


    <div class="navigation">
        <button id="prev" onclick="prevFacture()">Précédent</button>
        <div class="indicators">
            <?php for ($i = 0; $i < count($facture['mois']); $i++): ?>
                <div class="indicator <?= $i === 0 ? 'active' : '' ?>" onclick="showFacture(<?= $i ?>)"></div>
            <?php endfor; ?>
        </div>
        <button id="next" onclick="nextFacture()">Suivant</button>
    </div>
</div>

<div class="title-facture">
    <form action="imprimer-pdf" method="POST">
        <input type="hidden" name="codecli" value="<?= $facture['datas'][0][1] ?>">
        <input type="hidden" id="active-index" name="active_index" value="0">
        <button type="submit">Imprimer la facture</button>
    </form>
</div>


<style>
    #facture-container {
        position: relative;
        width: 100%;
        max-width: 900px;
        margin: 0 auto;
    }

    .facture {
        background: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        width: 100%;
        border-left: 3px solid orange;
        border-right: 3px solid orange;
        margin-bottom: 15px;
        display: none;
        font-size: 14px;
    }

    .facture:first-child {
        display: block;
    }

    /* En-tête de la facture */
    .titre h1 {
        text-align: center;
        font-size: 20px;
        text-transform: uppercase;
        margin-bottom: 5px;
        color: #000;
    }

    .titre span {
        color: orange;
    }

    .titre h2,
    h3 {
        text-align: center;
        font-size: 16px;
        font-weight: normal;
        margin-bottom: 10px;
    }

    /* Informations client */
    .donnees {
        display: flex;
        justify-content: space-between;
        margin-bottom: 5px;
        font-size: 13px;
    }

    .info {
        display: grid;
        grid-template-columns: 1fr;
        margin-bottom: 10px;
        font-size: 13px;
    }

    label {
        font-weight: bold;
        margin-bottom: 3px;
    }

    /* Titre du tableau */
    .titre-tab {
        margin-top: 15px;
        font-size: 16px;
        font-weight: bold;
        text-align: center;
    }

    .tab-facture {
        display: flex;
        align-items: center;
        justify-content: center;
        margin-top: 10px;
    }

    /* Tableau des détails */
    .tab-facture table {
        width: 100%;
        border-collapse: collapse;
    }

    .tab-facture th,
    .tab-facture td {
        padding: 8px;
        border: none;
        text-align: center;
        border-bottom: 1px solid orange;
        background-color: #fff;
        font-size: 13px;
    }

    .tab-facture th {
        background-color: rgb(255, 140, 0);
        color: white;
    }

    /* Montant total */
    .montant {
        margin-top: 15px;
        text-align: center;
    }

    .montant h3 {
        display: inline-block;
        padding: 8px 15px;
        background-color: #ff9d00;
        color: white;
        border-radius: 5px;
        font-size: 14px;
        font-weight: bold;
    }

    /* Bouton de création */
    .title-facture {
        /*  text-align: right;*/
        margin-bottom: 10px;
        z-index: 100;
        position: fixed;
        top: 50px;
        left: 50px;



    }

    .title-facture button {
        padding: 5px 10px;
        background-color: #ff9d00;
        color: white;
        border: none;
        border-radius: 3px;
        cursor: pointer;
        transition: background 0.3s;
        font-size: 12px;
        left: 0px;

    }

    .title-facture button:hover {
        background-color: #b36800;
    }

    /* Navigation - FIXED POSITION */
    .navigation {
        display: flex;
        justify-content: center;
        align-items: center;
        position: fixed;
        bottom: 0px;
        left: 0;
        right: 0;
        background-color: rgba(255, 255, 255, 0.9);
        padding: 10px;
        box-shadow: 0 -2px 5px rgba(0, 0, 0, 0.1);
        z-index: 100;
        border-radius: 0px 0px 50px 50px;
    }

    .navigation button {
        padding: 8px 15px;
        background-color: #ff9d00;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background 0.3s;
        margin: 0 10px;
        font-weight: bold;
    }

    .navigation button:hover {
        background-color: #b36800;
    }

    .navigation button:disabled {
        background-color: #ccc;
        cursor: not-allowed;
    }

    .indicators {
        display: flex;
        justify-content: center;
    }

    .indicator {
        width: 10px;
        height: 10px;
        border-radius: 50%;
        background-color: #ddd;
        margin: 0 4px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .indicator.active {
        background-color: #ff9d00;
    }

    /* Espacement en bas pour la navigation fixe */
    body {
        padding-bottom: 70px;
    }
</style>

<script>
    let currentFacture = 0;
    const totalFactures = <?= count($facture['mois']) ?>;

    function showFacture(index) {
        document.querySelectorAll('.facture').forEach((facture, i) => {
            facture.style.display = 'none';
            document.querySelectorAll('.indicator')[i].classList.remove('active');
        });

        document.getElementById('facture-' + index).style.display = 'block';
        document.querySelectorAll('.indicator')[index].classList.add('active');

        // Met à jour l'index actif dans le champ caché du formulaire
        document.getElementById('active-index').value = index;

        currentFacture = index;
        document.getElementById('prev').disabled = currentFacture === 0;
        document.getElementById('next').disabled = currentFacture === totalFactures - 1;
    }

    function prevFacture() {
        if (currentFacture > 0) {
            showFacture(currentFacture - 1);
        }
    }

    function nextFacture() {
        if (currentFacture < totalFactures - 1) {
            showFacture(currentFacture + 1);
        }
    }

    window.onload = function() {
        showFacture(0);

        document.addEventListener('keydown', function(event) {
            if (event.key === 'ArrowLeft') {
                prevFacture();
            } else if (event.key === 'ArrowRight') {
                nextFacture();
            }
        });

        // Ajoute un événement sur les indicateurs
        document.querySelectorAll('.indicator').forEach((indicator, index) => {
            indicator.addEventListener('click', function() {
                showFacture(index);
            });
        });
    };
</script>