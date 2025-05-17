export const reserve = async (reservationDate, reservationStartTime, reservationEndTime, vehicleSelect) => {
    const response = await fetch('index.php?component=reserve', {
        method: 'POST',
        headers : {'X-Requested-With': 'XMLHttpRequest'},
        body: new URLSearchParams({
            reservationDate,
            reservationStartTime,
            reservationEndTime,
            vehicleSelect
        })
    });
    return response.json();
}

export const getUsersVehicles = async () => {
    const response = await fetch('index.php?component=cars&action=getCars', {
        method: 'GET',
        headers : {'X-Requested-With': 'XMLHttpRequest'},

    });
    return response.json();
}