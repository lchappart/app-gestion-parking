<nav class="navbar">
    <div class="navbar-container">
        <a href="index.php?component=home" class="navbar-logo">Park'Heure</a>
        <ul class="navbar-menu">
            <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin') {
                echo '<li><a href="dashboard">Tableau de bord</a></li>';
                echo '<li><a href="pricing">Tarifs</a></li>';
            } ?>
            <li><a href="home">Accueil</a></li>
            <li><a href="reserve">Réserver une place</a></li>
            <li><a href="profile">Mon profil</a></li>
        </ul>
    </div>
</nav>