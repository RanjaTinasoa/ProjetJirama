<div class="facture">
    <div class="title-facture">
        <form action="">
            <input type="hidden">
            <button type="submit">créer facture</button>
        </form>
    </div>


    <div class="table-facture">
        <div class="facture-card">
            <div class="titre">
                <h1>JIRO SY RANO MALAGASY</h1>
                <h2>Votre facture mois de :<?php $mois ?></h2>
            </div>
        </div>
        <div class="donnees">
            <label for="">Titulaire du compte : <?php $nom ?></label>
            <label for="">Date de présentation : <?php $date_presentation ?></label>
        </div>
        <div class="donnees">
            <label for="">Réference client <?php $codecli ?></label>
            <label for="">Date limite paiement : <?php $date_limite_paie ?></label>
        </div>
        <div class="info">
            <label for="">adresse installation : <?php $quartier ?></label>
            <label for="">N compteur électricité : <?php $codecompteur ?></label>
            <label for="">N compteur eau : <?php $codecompteur ?></label>
        </div>
        <div class="titre-tab">Votre facture en détail</div>
        <div class="tab-facture">
            <thead>
                <tr>
                    <th></th>
                    <th>électricité</th>
                    <th>eau</th>
                </tr>
            </thead>
            <tbody>

                <tr>
                    <td>PU(Ar)</td>
                    <td>Valeur</td>
                    <td>Total</td>
                </tr>
                <tr>

                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>

                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </tbody>
        </div>
    </div>
</div>