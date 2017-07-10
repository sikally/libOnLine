<?php if($message != ""): ?>
    <div class="alert alert-danger">
        <?php echo $message; ?>
    </div>
<?php endif ?>

<form method="post" action="index.php?controller=inscriptionController">
    <div class="form-group">
        <label>Nom
            <input type="text" 
                   name="nom" 
                   placeholder="votre nom" 
                   class="form-control">
        </label>
    </div>
    
    <div class="form-group">
        <label>E-mail
            <input type="email" 
                   name="email" 
                   placeholder="votre email" 
                   class="form-control">
        </label>
    </div>
    
    <div class="form-group">
        <label>Mot de passe
            <input type="password" 
                   name="pass" 
                   placeholder="votre mot de passe" 
                   class="form-control">
        </label>
    </div>
    
    <div class="form-group">
        <label>Confirmation du mot de passe
            <input type="password" 
                   name="pass-confirm" 
                   placeholder="confirmation de votre mot de passe" 
                   class="form-control">
        </label>
    </div>
    
    <div class="form-group">
        <button type="submit" 
                name="submit" 
                value="submit" 
                class="btn btn-primary">
            Valider</button>
    </div>
</form>
