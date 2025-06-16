<h1>Gestion des tarifs</h1>
<form id="pricing-form">
    <select name="vehicle-type" id="vehicle-type">
        <option selected disabled value="">Sélectionnez un type de véhicule</option>
        <option value="car">Voiture</option>
        <option value="electric-car">Voiture électrique</option>
        <option value="motorcycle">Moto</option>
        <option value="electric-motorcycle">Moto électrique</option>
        <option value="handicapped">Handicapé</option>
    </select>
    <label for="pricing">Tarifs</label>
    <input type="number" id="pricing" name="pricing">
    <button type="button" id="save-pricing">Enregistrer</button>
</form>

<script type="module" src="./Assets/JS/Services/pricing.js"></script>
<script type="module">
    import { getPricing, savePricing } from "./Assets/JS/Services/pricing.js"
    document.addEventListener("DOMContentLoaded", async () => {
        const pricing = await getPricing()
        const vehicleType = document.getElementById("vehicle-type")
        const savePricingButton = document.getElementById("save-pricing")
        vehicleType.addEventListener("change", async () => {
            const selectedVehicleType = vehicleType.value
            const pricePerHour = pricing.find(p => p.label === selectedVehicleType).price_per_hour
            document.getElementById("pricing").value = pricePerHour
        })
        savePricingButton.addEventListener("click", async () => {
            const vehicleType = document.getElementById("vehicle-type").value
            const pricing = document.getElementById("pricing").value
            await savePricing(vehicleType, pricing)
            window.location.reload()
        })
    });
</script>