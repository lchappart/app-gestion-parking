<div class="form-container reservations-container">
    <div class="reservations-header">
        <h1>Vos réservations</h1>
        <a href="index.php?component=reserve" class="button-primary add-reservation-button">
            <i class="fas fa-plus"></i>
            Nouvelle réservation
        </a>
    </div>

    <div class="reservations-grid" id="reservations-container">
    </div>
</div>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<script type="module" src="./Assets/JS/Services/reservations.js"></script>
<script type="module" src="./Assets/JS/Components/reservations.js"></script>s
<script type="module">
    import { getReservations } from './Assets/JS/Services/reservations.js';
    import { fillReservationsContainer } from './Assets/JS/Components/reservations.js';
    document.addEventListener("DOMContentLoaded", async() => {
        const reservations = await getReservations()
        fillReservationsContainer(reservations)
    });
</script>