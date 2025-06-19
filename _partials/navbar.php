<nav class="navbar">
    <div class="navbar-container">
        <a href="home"><img src="Includes/Img/logo.png" style="width: 100px; height: 100px; margin-top: -20px; margin-bottom: -30px;" alt="logo" class="navbar-logo"></a>
        <ul class="navbar-menu">
            <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin') {
                echo '<li><a href="dashboard">Tableau de bord</a></li>';
                echo '<li><a href="pricing">Tarifs</a></li>';
            } ?>
            <?php if (!isset($_SESSION['auth'])) {
                echo '<li><a class="button-primary" href="login">Connexion</a></li>';
                echo '<li><a href="createUser">Inscription</a></li>';
            } else {
                echo '<li><a href="reserve">Réserver une place</a></li>';
                echo '<li><a href="profile">Mon profil</a></li>';
            } ?>
        </ul>
    </div>
</nav>