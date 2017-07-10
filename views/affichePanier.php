<div class="col-md-6 col-md-offset-3">
    
    <h2>Panier</h2>
    
    <table class="table table-bordered table-hover table-striped">
        <tr>
            <th>Ref</th>
            <th>Qt</th>
            <th>PU</th>
            <th>Total</th>
            <th>Action</th>
        </tr>
        
        <?php 
        $produits = $panier->getProduits();
        foreach ($produits as $livre):
        ?>
        <form method="post" action="index.php?controller=affichePanier">
            <tr>
                <td> <?=$livre['id'] ?> </td>
                <td> 
                    <input type="number"
                           name="qt"
                           value="<?= $livre['qt']?>"
                    >
                    <input type="hidden"
                           name="id"
                           value="<?= $livre['id']?>"
                    >
                </td>
                
                <td><?= $livre['pu']?> </td>
                <td><?= $livre['pu'] * $livre['qt'] ?> </td>
                <td>
                    <button type="submit" name="submit" value="recalculer" class="btn btn-sm btn-info">
                        Recalculer
                    </button>
                    <button type="submit" name="submit" value="supprimer" class="btn btn-sm btn-info">
                        Supprimer
                    </button>
                </td>
            </tr>
        </form>
        <?php endforeach; ?>
        <tr>
            <td colspan="3" class="text-right">TOTAL</td>
            <td colspan="2" class="text-right">
                <?= $panier->getTotalPanier() ?>
            </td>
        </tr>
    </table>
    
</div>

