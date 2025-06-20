<form data-car-id="<?php echo isset($car) ? $car['id'] : ''; ?>" class="form-container" id="add-car-form">
    <label for="vehicle-type-select">Type de véhicule</label>
    <select required id="vehicle-type-select" class="input">
      <option disabled <?php echo isset($car) ? '' : 'selected'; ?>>Type de voiture</option>
      <option value="car" <?php echo isset($car) && $car['type'] == 'car' ? 'selected' : ''; ?>>Voiture</option>
      <option value="electric-car" <?php echo isset($car) && $car['type'] == 'electric-car' ? 'selected' : ''; ?>>Voiture électrique</option>
      <option value="motorcycle" <?php echo isset($car) && $car['type'] == 'motorcycle' ? 'selected' : ''; ?>>Moto</option>
      <option value="electric-motorcycle" <?php echo isset($car) && $car['type'] == 'electric-motorcycle' ? 'selected' : ''; ?>>Moto électrique</option>
    </select>
    <label for="carModel">Modèle du véhicule</label>
    <input required type="text" name="carModel" class="input" placeholder="Entrez le modèle du véhicule" id="car-model-input" value="<?php echo isset($car) ? $car['model'] : ''; ?>">
    <label for="vehicle-immatrticulation-input">Immatriculation du véhicule</label>
    <input required type="text" class="input" placeholder="Entrez l'immatriculation du véhicule" id="vehicle-immatrticulation-input" value="<?php echo isset($car) ? $car['immatriculation'] : ''; ?>">
    <button type="button" class="button-primary" id="<?php echo isset($car) ? 'edit-vehicle-button' : 'add-vehicle-button'; ?>">Ajouter le véhicule</button>
</form>

<script type="module" src="./Assets/JS/Services/addCar.js"></script>
<script type="module">
    import { addCar } from "./Assets/JS/Services/addCar.js";
    import { editCar } from "./Assets/JS/Services/addCar.js";
    document.addEventListener("DOMContentLoaded", () => {
        const carId = document.querySelector("#add-car-form").getAttribute("data-car-id");
        const addVehicleButton = document.querySelector("#add-vehicle-button");
        const editVehicleButton = document.querySelector("#edit-vehicle-button");
        if (addVehicleButton) {
            addVehicleButton.addEventListener("click", async () => {
            const addCarForm = document.querySelector("#add-car-form");
            if (!addCarForm.checkValidity()) {
                addCarForm.reportValidity()
                return
            }
            const vehicleType = document.querySelector("#vehicle-type-select").value;
            const carModel = document.querySelector("#car-model-input").value;
            const vehicleImmatriculation = document.querySelector("#vehicle-immatrticulation-input").value;
            const addCarResult = await addCar(vehicleType, carModel, vehicleImmatriculation);
            if (addCarResult.success) {
                alert("Votre véhicule a été ajouté avec succès");
                } else {
                    alert("Une erreur est survenue lors de l'ajout de votre véhicule");
                }
                window.location.href = "index.php?component=cars";
            })
        }
        if (editVehicleButton) {
            editVehicleButton.addEventListener("click", async () => {
                const addCarForm = document.querySelector("#add-car-form");
                if (!addCarForm.checkValidity()) {
                    addCarForm.reportValidity()
                    return
                }
                const vehicleType = document.querySelector("#vehicle-type-select").value;
                const carModel = document.querySelector("#car-model-input").value;
                const vehicleImmatriculation = document.querySelector("#vehicle-immatrticulation-input").value;
                const addCarResult = await editCar(vehicleType, carModel, vehicleImmatriculation, carId);
                if (addCarResult.success) {
                    alert("Votre véhicule a été modifié avec succès");
                } else {
                    alert("Une erreur est survenue lors de la modification de votre véhicule");
                }
                window.location.href = "index.php?component=cars";
            })
        }
    })
</script>