export const addCar = async (vehicleType, carModel, vehicleImmatriculation) => {
    const response = await fetch('index.php?component=addCar', {
        method: 'POST',
        headers : {'X-Requested-With': 'XMLHttpRequest'},
        body: new URLSearchParams({
            vehicleType,
            carModel,
            vehicleImmatriculation
        })
    });
    return response.json();
}

export const editCar = async (vehicleType, carModel, vehicleImmatriculation, id) => {
    const response = await fetch('index.php?component=addCar', {
        method: 'POST',
        headers : {'X-Requested-With': 'XMLHttpRequest'},
        body: new URLSearchParams({
            vehicleType,
            carModel,
            vehicleImmatriculation,
            id
        })
    });
    return response.json();
}