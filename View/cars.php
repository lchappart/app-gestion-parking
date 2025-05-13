<h1>Gérer les véhicules</h1>
<a href="index.php?component=addCar">+ Ajouter un véhicule</a>
<h2>Vos véhicules</h2>
<table>
    <thead>
        <tr>
            <th>Modèle</th>
            <th>Immatriculation</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody id="cars-container">
    </tbody>
</table>


<script type="module" src="Assets/JS/Services/cars.js"></script>
<script type="module" src="Assets/JS/Components/cars.js"></script>
<script type="module">
    import { getCars } from './Assets/JS/Services/cars.js';
    import { fillCarsContainer } from './Assets/JS/Components/cars.js';
    import { deleteCar } from './Assets/JS/Services/cars.js';
    document.addEventListener('DOMContentLoaded', async () => {


        const addActionsListeners = () => {
            const editCars = document.querySelectorAll('.edit-car');
            const deleteCars = document.querySelectorAll('.delete-car');
            for (let i = 0; i < editCars.length; i++) {
                editCars[i].addEventListener('click', (e) => {
                    window.location.href = `index.php?component=addCar&action=edit&id=${e.target.dataset.id}`;
                });
            }
            for (let i = 0; i < deleteCars.length; i++) {
                deleteCars[i].addEventListener('click', async (e) => {
                    deleteCar(e.target.dataset.id);
                    const response = await getCars();
                    fillCarsContainer(carsContainer, response);
                    addActionsListeners();
                });
            }
        };


        const carsContainer = document.getElementById('cars-container');
        const carsResult = await getCars();
        fillCarsContainer(carsContainer, carsResult);
        addActionsListeners();
    });
</script>

