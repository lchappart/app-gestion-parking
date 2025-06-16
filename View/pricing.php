<h1>Gestion des tarifs</h1>
<form id="pricing-form">
    <select name="vehicle-type" id="vehicle-type">
        <option value="car">Voiture</option>
        <option value="electric-car">Voiture électrique</option>
        <option value="motorcycle">Moto</option>
        <option value="electric-motorcycle">Moto électrique</option>
        <option value="handicapped">Handicapé</option>
    </select>
    <label for="pricing">Tarifs</label>
    <input type="number" id="pricing" name="pricing">
    <button type="submit">Enregistrer</button>
</form>

<script type="module" src="./Assets/JS/Services/pricing.js"></script>
<script type="module">
    import { getPricing } from "./Assets/JS/Services/pricing.js";
    document.addEventListener("DOMContentLoaded", async () => {
        const pricing = await getPricing();
        console.log(pricing);

    });
</script>