<div class="form-container profile-container">
    <h1 id="hello-user-title">Bonjour, <?php echo $_SESSION['username']; ?></h1>
    
    <div class="profile-menu">
        <div class="profile-section">
            <h2>Compte</h2>
            <div class="profile-links">
                <a href="account" class="profile-link">
                    <i class="fas fa-user"></i>
                    <span>Mon compte</span>
                </a>
                <a href="?disconnect=true" class="profile-link">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Se déconnecter</span>
                </a>
            </div>
        </div>

        <div class="profile-section">
            <h2>Véhicules</h2>
            <div class="profile-links">
                <a href="cars" class="profile-link">
                    <i class="fas fa-car"></i>
                    <span>Gérer les véhicules</span>
                </a>
            </div>
        </div>

        <div class="profile-section">
            <h2>Réservations</h2>
            <div class="profile-links">
                <a href="reservations" class="profile-link">
                    <i class="fas fa-calendar-alt"></i>
                    <span>Consulter les réservations</span>
                </a>
            </div>
        </div>

        <div class="profile-section danger-zone">
            <h2>Zone de danger</h2>
            <div class="profile-links">
                <a href="index.php?component=account&action=delete" class="profile-link delete-account">
                    <i class="fas fa-trash-alt"></i>
                    <span>Supprimer le compte</span>
                </a>
            </div>
        </div>
    </div>
</div>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">