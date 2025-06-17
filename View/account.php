<h1>Votre compte</h1>
<form id="account-form" action="index.php?component=account&action=edit" method="post">
    <label for="username">Nom d'utilisateur</label>
    <input type="text" name="username" id="username" value="<?php echo $user['username']; ?>">
    <label for="email">Email</label>
    <input type="email" name="email" id="email" value="<?php echo $user['email']; ?>">
    <label for="password">Mot de passe</label>
    <input type="password" name="password" id="password">
    <label for="confirm-password">Confirmer le mot de passe</label>
    <input type="password" name="confirm-password" id="confirm-password">
    <label for="phone">Téléphone</label>
    <input type="tel" name="phone" id="phone" value="<?php echo $user['phone']; ?>">
    <button type="button" id="save-account">Enregistrer</button>
</form>
<script type="module" src="./Assets/JS/Services/account.js"></script>
<script type="module">
    import { saveAccount } from './Assets/JS/Services/account.js';
    document.addEventListener('DOMContentLoaded', () => {
        const accountForm = document.getElementById('account-form');
        const saveAccountButton = document.getElementById('save-account');
        saveAccountButton.addEventListener('click', async () => {
            if (!accountForm.checkValidity()) {
                accountForm.reportValidity();
            }
            const username = document.getElementById('username').value;
            const email = document.getElementById('email').value;
            const phone = document.getElementById('phone').value;
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('confirm-password').value;
            const result = await saveAccount(username, email, phone, password, confirmPassword);
        });
    });
</script>
