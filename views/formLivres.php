<div class="col-xs-12">

    <form method="post" action="index.php?controller=ajoutModifLivre">

        <!--<div class="col-md-6">-->

        <div class="form-group col-md-6">
            <label>
                Titre
                <input type="text" name="titre" class="form-control" value="<?= $livre['titre'] ?>">
            </label>
        </div>

        <div class="form-group col-md-6">
            <label>
                Sous titre
                <input type="text" name="sous_titre" class="form-control" value="<?= $livre['sous_titre'] ?>">
            </label>
        </div>

        <div class="form-group col-md-4">
            <label>
                Description
                <textarea name="description" class="form-control" rows="20" cols="30"><?= $livre['description'] ?></textarea>
            </label>
        </div>

            <div class="form-group col-md-4">
                <label>
                    ISBN
                    <input type="text" name="isbn" class="form-control" value="<?= $livre['isbn'] ?>">
                    <input type="hidden" name="livre_id" class="form-control" value="<?= $livre['id'] ?>">
                </label>
            </div>



        <!--</div>-->
        <!--<div class="col-md-6">-->

            <div class="form-group col-md-4">
                <label>
                    Date publication
                    <input type="date" name="date_publication" class="form-control"
                           value="<?= $livre['date_publication'] ?>">
                </label>
            </div>

            <div class="form-group col-md-4">
                <label>
                    Nb pages
                    <input type="number" name="nb_pages" class="form-control" value="<?= $livre['nb_pages'] ?>">
                </label>
            </div>

            <div class="form-group col-md-4">
                <label>
                    Prix
                    <input type="number" min="0" step="0.1" name="prix" class="form-control" value="<?= $livre['prix'] ?>">
                </label>
            </div>

            <div class="form-group col-md-4">
                <label>
                    Langue
                    <select class="form-control" name="id_langue">
                        <option value="0">Choisissez une langue</option>
                        <?php foreach ($listeLangues as $item): ?>
                            <option value="<?= $item['id'] ?>"
                                <?= $item['id'] == $livre['id_langue'] ? "selected" : "" ?>
                            >
                                <?= $item['libelle_langue'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </label>
            </div>

            <div class="form-group col-md-4">
                <label >
                    Éditeur
                    <select class="form-control" name=id_editeur>
                        <option value="0">Choisissez un éditeur</option>
                        <?php foreach ($listeEditeurs as $item): ?>
                            <option value="<?= $item['id'] ?>"
                                <?= $item['id'] == $livre['id_editeur'] ? "selected" : "" ?>
                            >
                                <?= $item['nom'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </label>
            </div>

        <div class="form-group col-md-8">
            <label>
                Lien
                <input type="url" name="lien" class="form-control" value="<?= $livre['lien'] ?>">
            </label>
        </div>

        <div class="form-group col-md-8">
            <label>
                Image
                <input type="text" name="image" class="form-control" value="<?= $livre['image'] ?>">
            </label>
        </div>
        <!--</div>-->

        <div class="col-md-12">

            <div class="form-group col-md-12">
                <button type="submit" name="submit" value="submit" class="btn btn-primary">
                    Valider
                </button>
            </div>
        </div>
    </form>
</div>