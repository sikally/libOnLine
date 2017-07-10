<!DOCTYPE html>

<?php
    $client = unserialize($_SESSION['client']);

    $islogged = $client->getClientId()>0;
?>

<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width">
        <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="assets/styles.css" rel="stylesheet">
        <title>Mon site MVC</title>
    </head>

    <body class="container-fluid">
        
        <div class="row">
            <header class="col-md-12 well">
                
                <div class="col-md-9">
                <h1>Chapitre</h1>
                </div>
                
                <div class="col-md-3">
                    <?php
                    if(isset($_SESSION['panier'])){
                        $panier = unserialize($_SESSION['panier']);
                    } else {

                        $panier = new Panier($client,
                            new PanierDAO(getPDO()),
                            new PanierDTO()
                        );
                    }
                        
                        echo "<p>$panier</p>";
                    ?>
                    <?php echo linkToController('affichePanier', 'voir le panier')?>

                </div>
                
                <nav class="col-md-12">
                    <ul class="nav nav-pills">
                        <li><?php echo linkToController('mainController', 'Accueil')?></li>
                        <li><?php echo linkToController('testController', 'Test')?></li>
                        
                        <li><?php echo linkToController('catalogue', 'Catalogue')?></li>

                        <li><?php echo linkToController('ajoutModifLivre', 'Ajouter un livre')?></li>
                        
                        <?php
                        if(! $islogged):?>
                           <li><?php echo linkToController('inscriptionController', 'Inscription')?></li>
                           <li><?php echo linkToController('login', 'Login')?></li>
                           
                        <?php else: ?>
                           <li><?php echo linkToController('deconnexion', 'Déconnexion')?></li>
                        <?php endif ?>
                        
                    </ul>
                </nav>
            </header>

            <div class="col-md-12">
                <?php echo $viewContent ?>
            </div>
        </div>
    </body>
</html>


