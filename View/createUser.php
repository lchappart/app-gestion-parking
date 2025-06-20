  
    <form class="form-container">
        <h1>Créer un compte</h1>
        <label for="username-input">Nom d'utilisateur</label>
        <input value="<?php echo isset($user) ? $user['username'] : ''; ?>" required type="text" class="input" placeholder="Entrez un nom d'utilisateur" id="username-input">
        <label for="password-input">Mot de passe</label>
        <input value="<?php echo isset($user) ? $user['password'] : ''; ?>" required type="password" class="input" placeholder="Entrez un mot de passe" id="password-input">
        <label for="password-confirm-input">Confirmer le mot de passe</label>
        <input required type="password" class="input" placeholder="Confirmez le mot de passe" id="password-confirm-input">
        <label for="email-input">Email</label>
        <input required value="<?php echo isset($user) ? $user['email'] : ''; ?>" type="email" class="input" placeholder="Entrez votre email" id="email-input">
        <label for="phone-number-input">Numéro de téléphone</label>
        <input required value="<?php echo isset($user) ? $user['phone_number'] : ''; ?>" type="tel" class="input" placeholder="Entrez votre numéro de téléphone" id="phone-number-input">
        <button type="button" class="button-primary" id="<?php echo isset($user) ? 'edit-user-button' : 'create-user-button'; ?>">Créer le compte</button>
        <?php
        if (!isset($_GET['action'])) {
            echo "<p>Déjà un compte ?</p><a href=\"login\">Se connecter</a>";
        }
        ?>
        <p>En créant un compte, vous acceptez nos <a href="#">conditions d'utilisation</a>.</p>
    </form>

    <script src="Assets/JS/Services/createUser.js" type="module"></script>
    <script type="module">
        import { createUser, editUser } from "./Assets/JS/Services/createUser.js";
        document.addEventListener("DOMContentLoaded", () => {
            const createUserButton = document.querySelector("#create-user-button")
            const editUserButton = document.querySelector("#edit-user-button")
            const usernameInput = document.querySelector("#username-input")
            const passwordInput = document.querySelector("#password-input")
            const passwordConfirmInput = document.querySelector("#password-confirm-input")
            const emailInput = document.querySelector("#email-input")
            const phoneNumberInput = document.querySelector("#phone-number-input")
            const createUserForm = document.querySelector("form")
            
            if (createUserButton) {
                createUserButton.addEventListener("click", async () => {
                    if (!createUserForm.checkValidity()) {
                        createUserForm.reportValidity()
                        return
                    }
                    const createUserResult = await createUser(usernameInput.value, passwordInput.value, passwordConfirmInput.value, emailInput.value, phoneNumberInput.value);
                    if (createUserResult.success === true) {
                        window.location.href = 'index.php';
                    } else if (createUserResult.errors) {
                        alert(createUserResult.errors.join('\n'));
                    }
                })
            }
            
            if (editUserButton) {
                editUserButton.addEventListener("click", async () => {
                    if (!createUserForm.checkValidity()) {
                        createUserForm.reportValidity()
                        return
                    }
                    const editUserResult = await editUser(usernameInput.value, passwordInput.value, passwordConfirmInput.value, emailInput.value, phoneNumberInput.value);
                })
            }
        })
    </script>
