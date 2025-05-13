<form id="login-form" class="form-container">
    <label for="login-username-input">Nom d'utilisateur</label>
    <input required type="text" class="input" placeholder="Entrez un nom d'utilisateur" id="login-username-input">
    <label for="login-password-input">Mot de passe</label>
    <input required type="password" class="input" placeholder="Entree un mot de passe" id="login-password-input">
    <button type="button" class="button-primary" id="login-button">Se connecter</button>
    <p>Pas de compte ?</p><a href="index.php?component=createUser">Créer un compte</a>
    <script src="Assets/JS/Services/login.js" type="module"></script>
</form>
<script type="module" src="./Assets/JS/Services/login.js"></script>
<script type="module">
    import { login } from "./Assets/JS/Services/login.js";
    document.addEventListener("DOMContentLoaded", () => {
        const loginButton = document.querySelector("#login-button");
        const loginUsernameInput = document.querySelector("#login-username-input");
        const loginPasswordInput = document.querySelector("#login-password-input");
        const loginForm = document.querySelector("#login-form");
        loginButton.addEventListener("click", async () => {
            if (!loginForm.checkValidity()) {
                loginForm.reportValidity()
                return
            }

            const loginResult = await login(loginUsernameInput.value, loginPasswordInput.value);
            if (loginResult.authentication === true) {
                window.location.href = 'index.php?component=home';
            } else if (loginResult.errors) {
                alert(loginResult.errors.join('\n'));
            }
        })
    })
</script>