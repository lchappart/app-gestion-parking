export const fillCarsContainer = (carsContainer, carsResult) => {
    carsContainer.innerHTML = '';
    
    if (carsResult.length === 0) {
        const emptyRow = document.createElement('tr');
        emptyRow.innerHTML = `
            <td colspan="3" class="empty-table">
                <div class="empty-state">
                    <i class="fas fa-car"></i>
                    <p>Vous n'avez pas encore ajouté de véhicule</p>
                </div>
            </td>
        `;
        carsContainer.appendChild(emptyRow);
        return;
    }

    for (let i = 0; i < carsResult.length; i++) {
        const car = carsResult[i];
        const carElement = document.createElement('tr');
        carElement.innerHTML = `
            <td>
                <div class="car-model">
                    <i class="fas fa-car"></i>
                    ${car.model}
                </div>
            </td>
            <td>
                <div class="car-plate">
                    <i class="fas fa-id-card"></i>
                    ${car.immatriculation}
                </div>
            </td>
            <td>
                <div class="car-actions">
                    <button class="action-button edit-car" data-id="${car.id}" title="Modifier">
                        <i class="fas fa-edit"></i>
                    </button>
                    <button class="action-button delete-car" data-id="${car.id}" title="Supprimer">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                </div>
            </td>
        `;
        carsContainer.appendChild(carElement);
    }
}
