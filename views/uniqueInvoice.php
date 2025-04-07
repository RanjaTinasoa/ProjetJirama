<div id="unique-facture-container">
    <div class="facture">
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

    <style>
        #unique-facture-container {
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
    </style>