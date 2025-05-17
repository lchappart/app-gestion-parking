<form action="index.php?component=reserve" method="post">
    <label for="reservation-date">Entrez la date voulue</label>
    <input type="date" class="input" id="reservation-date">
    <label for="reservation-start-time">Heure de début</label>
    <input type="time" class="input" id="reservation-start-time">
    <label for="reservation-end-time">Heure de fin</label>
    <input type="time" class="input" id="reservation-end-time">
    <label for="vehicle-select">Véhicule</label>
    <select name="vehicle-select" class="input" id="vehicle-select">
        <option disabled selected>Séléctionnez votre véhicule</option>
    </select>
    <p id="price-paragraph">Prix :</p>
    <button class="button-primary" id="reserve-button">Réserver</button>
</form>

<script type="module" src="./Assets/JS/Services/reserve.js"></script>
<script type="module">
    import { reserve, getUsersVehicles } from "./Assets/JS/Services/reserve.js";
    document.addEventListener("DOMContentLoaded", async () => {
        const vehicleSelect = document.querySelector("#vehicle-select");
        const usersVehicles = await getUsersVehicles();
        for (let i = 0; i < usersVehicles.length; i++) {
            const option = document.createElement("option");
            option.value = usersVehicles[i].id;
            option.textContent = usersVehicles[i].model;
            vehicleSelect.appendChild(option);
        }
        const reserveButton = document.getElementById("reserve-button");
        if (reserveButton) {
            reserveButton.addEventListener("click", () => {
                const reservationDate = document.getElementById("reservation-date").value;
                const reservationStartTime = document.getElementById("reservation-start-time").value;
                const reservationEndTime = document.getElementById("reservation-end-time").value;
                const vehicleSelect = document.getElementById("vehicle-select").value;
                reserve(reservationDate, reservationStartTime, reservationEndTime, vehicleSelect);
            });
        }
    });
</script>
