<div class="form-container reservation-container">
    <h1>Réserver une place</h1>
    <p> Si l'heure de fin est avant celle de début, cela comptera comme le jour d'après</p>
    <form action="index.php?component=reserve" method="post" class="reservation-form">
        <div class="form-group">
            <label for="reservation-date">Date de réservation</label>
            <input required type="date" class="input" id="reservation-date" name="reservation-date">
        </div>

        <div class="form-group time-group">
            <div class="time-input">
                <label for="reservation-start-time">Heure de début</label>
                <input required type="time" class="input" id="reservation-start-time" name="reservation-start-time">
            </div>
            <div class="time-input">
                <label for="reservation-end-time">Heure de fin</label>
                <input required type="time" class="input" id="reservation-end-time" name="reservation-end-time">
            </div>
        </div>

        <div class="form-group">
            <label for="place-type-select">Type de place</label>
            <select name="placeType" id="place-type-select" class="input">
                <option selected value="1">Standard</option>
                <option value="0">Handicapée</option>
            </select>
        </div>

        <div class="form-group">
            <label for="vehicle-select">Véhicule</label>
            <select name="vehicle-select" class="input" id="vehicle-select" required>
                <option disabled selected value="">Sélectionnez votre véhicule</option>
            </select>
        </div>

        <div class="price-display">
            <p id="price-paragraph">Prix total : <span id="price-display" class="price">0.00</span> €</p>
        </div>
            <div id="paypal-button-container" class="paypal-container"></div>
    </form>
</div>

<script src="https://www.paypal.com/sdk/js?client-id=AST8MWJvkyetmYynNQt3vcRL6Q0UTuMNxLMV9rt_VdGtVQI8YkME-thCsQBUuiVjGOXsk0EoLqWSBOo1&currency=EUR"></script>

<script type="module" src="./Assets/JS/Services/reserve.js"></script>
<script type="module">
    import { reserve, getUsersVehicles, calculatePrice, getPriceByHour} from "./Assets/JS/Services/reserve.js";
    document.addEventListener("DOMContentLoaded", async () => {
        const priceByHour = await getPriceByHour()
        let selectedPrice = priceByHour[0].price_per_hour;
        const placeTypeSelect = document.querySelector("#place-type-select");
        const vehicleSelect = document.querySelector("#vehicle-select");
        const usersVehicles = await getUsersVehicles();
        for (let i = 0; i < usersVehicles.length; i++) {
            const option = document.createElement("option");
            option.value = usersVehicles[i].model;
            option.textContent = usersVehicles[i].model;
            vehicleSelect.appendChild(option);
        }

        const startTimeInput = document.getElementById("reservation-start-time");
        const endTimeInput = document.getElementById("reservation-end-time");
        const priceDisplay = document.getElementById("price-display");

        placeTypeSelect.addEventListener('change', async () => {
            updatePrice()
            const selectedType = placeTypeSelect.value
            selectedPrice = priceByHour[selectedType].price_per_hour;
        });

        const updatePrice = () => {
            if (startTimeInput.value && endTimeInput.value) {
                const calculatedPrice = calculatePrice(startTimeInput.value, endTimeInput.value, selectedPrice);
                priceDisplay.textContent = calculatedPrice ? calculatedPrice : "0.00";
            }
        }

        startTimeInput.addEventListener("change", updatePrice);
        endTimeInput.addEventListener("change", updatePrice);

        paypal.Buttons({
            createOrder: function(data, actions) {
                return actions.order.create({
                    purchase_units: [{
                        amount: {
                            value: parseFloat(priceDisplay.textContent.replace(",", ".")).toFixed(2)
                        }
                    }]
                });
            },
            onApprove: function(data, actions) {
                return actions.order.capture().then(function(details) {
                    const reservationDate = document.getElementById("reservation-date").value;
                    const reservationStartTime = document.getElementById("reservation-start-time").value;
                    const reservationEndTime = document.getElementById("reservation-end-time").value;
                    const vehicleSelect = document.getElementById("vehicle-select").value;
                    const price = priceDisplay.textContent;
                    if (!reservationDate || !reservationStartTime || !reservationEndTime || !vehicleSelect) {
                        alert("Veuillez remplir tous les champs");
                        return;
                    }

                    reserve(reservationDate, reservationStartTime, reservationEndTime, vehicleSelect, price);
                })
            }
        }).render('#paypal-button-container');
    })
</script>
