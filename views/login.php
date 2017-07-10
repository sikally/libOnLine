
//Affichage du message
<?php if(!empty($message)): ?>
<div class="alert alert-info">
    <?= $message ?>
</div>
<?php endif; ?>


<form method="post" action="index.php?controller=login">
    <div class="form-group">
        <label>
            email
            <input type="email" name="email" class="form-control">
        </label>
    </div>
    
    <div class="form-group">
        <label>
            Mot de passe
            <input type="password" name="motDePasse" class="form-control">
        </label>
    </div>
    
    <div class="form-group">
        <button type="submit" name="submit" value="submit" class="btn btn-primary">Valider</button>
    </div>
</form>
