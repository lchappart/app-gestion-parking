<div class="form-container cars-container">
    <div class="cars-header">
        <h1>Gérer les véhicules</h1>
        <a href="index.php?component=addCar" class="button-primary add-car-button">
            <i class="fas fa-plus"></i>
            Ajouter un véhicule
        </a>
    </div>

    <div class="cars-table-container">
        <div class="table-wrapper">
            <table class="cars-table">
                <thead>
                    <tr>
                        <th>
                            <i class="fas fa-car"></i>
                            Modèle
                        </th>
                        <th>
                            <i class="fas fa-id-card"></i>
                            Immatriculation
                        </th>
                        <th>
                            <i class="fas fa-cog"></i>
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody id="cars-container">
                </tbody>
            </table>
        </div>
    </div>
</div>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<script type="module" src="Assets/JS/Services/cars.js"></script>
<script type="module" src="Assets/JS/Components/cars.js"></script>
<script type="module">
    import { getCars, deleteCar } from './Assets/JS/Services/cars.js';
    import { fillCarsContainer } from './Assets/JS/Components/cars.js';

    document.addEventListener('DOMContentLoaded', async () => {
        const addActionsListeners = () => {
            const editCars = document.querySelectorAll('.edit-car');
            const deleteCars = document.querySelectorAll('.delete-car');

            editCars.forEach(editButton => {
                editButton.addEventListener('click', (e) => {
                    e.preventDefault();
                    window.location.href = `index.php?component=addCar&action=edit&id=${e.target.dataset.id}`;
                });
            });

            deleteCars.forEach(deleteButton => {
                deleteButton.addEventListener('click', async (e) => {
                    e.preventDefault();
                    if (confirm('Êtes-vous sûr de vouloir supprimer ce véhicule ?')) {
                        try {
                            await deleteCar(e.target.dataset.id);
                            const response = await getCars();
                            fillCarsContainer(carsContainer, response);
                            addActionsListeners();
                        } catch (error) {
                            alert('Une erreur est survenue lors de la suppression du véhicule.');
                            console.error(error);
                        }
                    }
                });
            });
        };

        const carsContainer = document.getElementById('cars-container');
        try {
            const carsResult = await getCars();
            fillCarsContainer(carsContainer, carsResult);
            addActionsListeners();
        } catch (error) {
            alert('Une erreur est survenue lors du chargement des véhicules.');
            console.error(error);
        }
    });
</script>

