<div class="col-md-8 col-md-offset-2">
    <h1>Catalogue</h1>

    <!-- Formulaire de recherche -->
    <fieldset class="row">
        <form method="get">

            <input type="hidden" name="controller" value="catalogue">

            <legend>Recherche</legend>

            <div class="col-md-6">
                <div class="form-group">
                    <label class="">
                        Langue
                        <select class="form-control" name="choixLangue">
                            <option value="0">Choisissez une langue</option>
                            <?php foreach ($listeLangues as $item): ?>
                                <option value="<?= $item['id'] ?>"
                                    <?= $item['id'] == $choixLangue ? "selected" : "" ?>
                                >
                                    <?= $item['libelle_langue'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </label>
                </div>

                <div class="form-group">
                    <label class="">
                        Éditeur
                        <select class="form-control" name=choixEditeur>
                            <option value="0">Choisissez un éditeur</option>
                            <?php foreach ($listeEditeurs as $item): ?>
                                <option value="<?= $item['id'] ?>"
                                    <?= $item['id'] == $choixEditeur ? "selected" : "" ?>
                                >
                                    <?= $item['nom'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </label>
                </div>
            </div>

            <div class="col-md-6">

                <div class="form-group">
                    <label class="">
                        Catégorie
                        <select class="form-control" name="choixCategorie">
                            <option value="0">Choisissez une catégorie</option>
                            <?php foreach ($listeCategories as $item): ?>
                                <option value="<?= $item['id'] ?>"
                                    <?= $item['id'] == $choixCategorie ? "selected" : "" ?>
                                >
                                    <?= $item['categorie'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </label>
                </div>

                <div class="form-group">
                    <label class="">
                        Auteur
                        <select class="form-control" name="choixAuteur">
                            <option value="0">Choisissez un auteur</option>
                            <?php foreach ($listeAuteurs as $item): ?>
                                <option value="<?= $item['id'] ?>"
                                    <?= $item['id'] == $choixAuteur ? "selected" : "" ?>
                                >
                                    <?= $item['nom_complet'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </label>
                </div>
            </div>

            <div class="form-group col-md-12">
                <button type="submit" name="submit" value="submit" class="btn btn-primary">
                    Rechercher
                </button>
            </div>
        </form>
    </fieldset>
    <!-- Fin formulaire de recherche -->


    <!-- Affichage du catalogue -->
    <div class="col-md-12">
        <h2><?= $nbLivres ?> livre(s) trouvés</h2>

        <?php foreach ($listeLivres as $livre): ?>
            <div class="livre col-md-12">
                <div class="col-md-2">
                    <img src="<?= $livre['image'] ?>">
                </div>
                <div class="col-md-10">

                    <div class="col-md-9">
                        <h3><?= $livre['titre'] ?></h3>
                        <p class="text-muted"><?= $livre['sous_titre'] ?></p>
                    </div>
                    <div class="col-md-3">
                        <a href="index.php?controller=ajoutPanier&livre_id=<?= $livre['id']?>&pu=<?= $livre['prix']?>">
                            Ajouter au panier
                        </a><br>
                        <a href="index.php?controller=ajoutModifLivre&livre_id=<?= $livre['id']?>">
                            Modifier
                        </a>
                    </div>


                    <div class="col-md-6">
                        <p>
                            publié en <?= $livre['annee_publication'] ?>
                            par <?= $livre['editeur'] ?>

                        </p>

                        <p>
                            auteurs <?= $livre['liste_auteurs'] ?>
                        </p>

                        <p>
                            <?= $livre['langue'] ?>
                        </p>
                    </div>

                    <div class="col-md-6">
                        <p>
                            <?= $livre['liste_categories'] ?>
                        </p>

                        <p><?= $livre['prix'] ?> €</p>
                    </div>


                </div>
            </div>
        <?php endforeach ?>
    </div>
    <!-- Fin affichage du catalogue -->

    <!-- Pagination des résultats -->
    <div>
        <ul class="pagination">
            <?php for ($i = 1; $i <= $nbPages; $i++): ?>
                <li class="<?= $page == $i ? "active" : "" ?>">
                    <a href="<?= $url . "&page=$i" ?>">
                        <?= $i ?>
                    </a>
                </li>
            <?php endfor; ?>
        </ul>
    </div>
    <!-- Fin pagination -->

</div>