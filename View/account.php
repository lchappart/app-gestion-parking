<div class="form-container account-container">
    <h1>Votre compte</h1>
    
    <form id="account-form" action="index.php?component=account&action=edit" method="post" class="account-form">
        <div class="form-section">
            <h2>Informations personnelles</h2>
            <div class="form-group">
                <label for="username">
                    <i class="fas fa-user"></i>
                    Nom d'utilisateur
                </label>
                <input type="text" name="username" id="username" value="<?php echo $user['username']; ?>" class="input">
            </div>

            <div class="form-group">
                <label for="email">
                    <i class="fas fa-envelope"></i>
                    Email
                </label>
                <input type="email" name="email" id="email" value="<?php echo $user['email']; ?>" class="input">
            </div>

            <div class="form-group">
                <label for="phone">
                    <i class="fas fa-phone"></i>
                    Téléphone
                </label>
                <input type="tel" name="phone" id="phone" value="<?php echo $user['phone']; ?>" class="input">
            </div>
        </div>

        <div class="form-section">
            <h2>Sécurité</h2>
            <div class="form-group">
                <label for="password">
                    <i class="fas fa-lock"></i>
                    Mot de passe
                </label>
                <input type="password" name="password" id="password" class="input" placeholder="Laissez vide pour ne pas modifier">
            </div>

            <div class="form-group">
                <label for="confirm-password">
                    <i class="fas fa-lock"></i>
                    Confirmer le mot de passe
                </label>
                <input type="password" name="confirm-password" id="confirm-password" class="input" placeholder="Confirmez votre nouveau mot de passe">
            </div>
        </div>

        <div class="form-actions">
            <button type="button" id="save-account" class="button-primary">
                <i class="fas fa-save"></i>
                Enregistrer les modifications
            </button>
        </div>
    </form>
</div>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<script type="module" src="./Assets/JS/Services/account.js"></script>
<script type="module">
    import { saveAccount } from './Assets/JS/Services/account.js';
    
    document.addEventListener('DOMContentLoaded', () => {
        const accountForm = document.getElementById('account-form');
        const saveAccountButton = document.getElementById('save-account');
        
        saveAccountButton.addEventListener('click', async () => {
            if (!accountForm.checkValidity()) {
                accountForm.reportValidity();
                return;
            }
            
            const username = document.getElementById('username').value;
            const email = document.getElementById('email').value;
            const phone = document.getElementById('phone').value;
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('confirm-password').value;
            
            try {
                const result = await saveAccount(username, email, phone, password, confirmPassword);
                if (result.success) {
                    alert('Vos modifications ont été enregistrées avec succès !');
                }
            } catch (error) {
                alert('Une erreur est survenue lors de la sauvegarde de vos modifications.');
                console.error(error);
            }
        });
    });
</script>
