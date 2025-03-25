<!-------------------

<div class="corele-container">
    <div class="releve">
        <div class="title-releve">
            <h1>relevé eau</h1>
        </div>
        <div class="releve-form">


            <form class="r-form" action="">
                <div class="compteur-input">
                    <div class="compteur-label"> <label for="">valeur </label>

                        <input type="text" name="" placeholder="valeur du compteur de l'eau">
                        <label for="">date relevé</label>

                        <input type="text" name="" placeholder="date du relevé de l'eau">
                        <label for="">date présentation</label>

                        <input type="text" name="" placeholder="date de présentation">
                        <label for="">date limite</label>

                        <input type="text" name="" placeholder="date limite du paie">
                    </div>



            </form>
        </div>
    </div>
    <div class="compteur-button"><button name="" type="submit">insérer relevé</button>
        <button name="" type="submit">modifier relevé</button>
    </div>
</div>
<div class="compteur">
    <div class="title-compteur">
        <h1>compteur</h1>
    </div>
    <div class="compteur-form">
        <form class="c-form">
            <input type="text" name="" placeholder="type(eau/électricité)"><br>
            <input type="text" name="" placeholder="prix unitaire"><br>
            <input type="text" name="" placeholder="le client propriétaire "><br>

        </form>
    </div>
    <div class="compteur-button"><button name="" type="submit">créer compteur</button>
        <button class="button" type="submit">modifier compteur</button>
    </div>
</div>

</div>

------>
<div class="corele-container">
    <div class="releve">
        <!-- Onglets pour basculer entre Eau et Électricité -->
        <div class="releve-tabs">
            <button class="tab-btn active"><a href="">Relevé Eau</a></button>
            <button class="tab-btn"><a href="">Relevé Électricité</a></button>
        </div>

        <!-- Section Relevé Eau -->
        <div class="releve-section" id="releve-eau">
            <h2>Relevé Eau</h2>
            <form class="r-form">
                <div class="compteur-input">
                    <label for="">Valeur :</label>

                    <input type="text" placeholder="Valeur du compteur de l'eau">
                    <label for="">Date relevé</label>

                    <input type="text" placeholder="Date du relevé de l'eau">
                    <label for="">Date présentation</label>

                    <input type="text" placeholder="Date de présentation">
                    <label for="">Date limite</label>

                    <input type="text" placeholder="Date limite de paiement">
                </div>
                <div class="compteur-button">
                    <button type="submit">Insérer / Modifier Relevé</button>
                </div>
            </form>
            <!-- Suppression Relevé Eau -->
            <div class="suppression">
                <input type="text" placeholder="Code Eau">
                <button type="submit">Supprimer</button>
            </div>
        </div>

        <!-- Section Relevé Électricité (invisible par défaut) -->
        <div class="releve-section" id="releve-elec" style="display: none;">
            <h2>Relevé Électricité</h2>
            <form class="r-form">
                <div class="compteur-label">
                </div>
                <div class="compteur-input">
                    <label for="">Valeur :</label>

                    <input type="text" placeholder="Valeur du compteur électrique">
                    <label for="">Date relevé</label>

                    <input type="text" placeholder="Date du relevé d'électricité">
                    <label for="">Date présentation</label>

                    <input type="text" placeholder="Date de présentation">
                    <label for="">Date limite</label>

                    <input type="text" placeholder="Date limite de paiement">
                </div>
                <div class="compteur-button">
                    <button type="submit">Insérer / Modifier Relevé</button>
                </div>
            </form>
            <!-- Suppression Relevé Électricité -->
            <div class="suppression">
                <input type="text" placeholder="Code Électricité">
                <button type="submit">Supprimer</button>
            </div>
        </div>
    </div>

    <!-- Section Compteur -->
    <div class="compteur">
        <h2>Compteur</h2>
        <div class="compte">
            <form class="c-form">
                <input type="text" name="" placeholder="Type (Eau / Électricité)">
                <input type="text" name="" placeholder="Prix unitaire">
                <input type="text" name="" placeholder="Le client propriétaire">
            </form>
        </div>
        <div class="compteur-button">
            <button type="submit">Créer Compteur</button>
            <button type="submit">Modifier Compteur</button>
        </div>
        <!-- Suppression Compteur -->
        <div class="suppression">
            <input type="text" placeholder="Code Compteur">
            <button type="submit">Supprimer</button>
        </div>
    </div>
</div>