export const fillCarsContainer = (carsContainer, carsResult) => {
    console.log(carsContainer);
    carsContainer.innerHTML = '';
    for (let i = 0; i < carsResult.length; i++) {
        const car = carsResult[i];
        const carElement = document.createElement('tr');
        carElement.innerHTML = `
            <td>${car.model}</td>
            <td>${car.immatriculation}</td>
            <td>
                <a href="#" class="edit-car" data-id="${car.id}">Modifier</a>
                <a href="#" class="delete-car" data-id="${car.id}">Supprimer</a>
            </td>
        `;
        carsContainer.appendChild(carElement);
    }
    
}
