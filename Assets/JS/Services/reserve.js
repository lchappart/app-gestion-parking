export const reserve = async (reservationDate, reservationStartTime, reservationEndTime, vehicleSelect) => {
    try {
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

        const result = await response.json();
        
        if (result.success) {
            alert(`Réservation confirmée! Votre place est la N°${result.placeNumber}`);
            window.location.href = 'index.php?component=home';
        } else {
            alert(result.message || 'Une erreur est survenue lors de la réservation');
        }
        
        return result;
    } catch (error) {
        console.error('Erreur lors de la réservation:', error);
        alert('Une erreur est survenue lors de la réservation');
        return { success: false, message: error.message };
    }
}

export const getUsersVehicles = async () => {
    const response = await fetch('index.php?component=cars&action=getCars', {
        method: 'GET',
        headers : {'X-Requested-With': 'XMLHttpRequest'},

    });
    return response.json();
}

export const calculatePrice = (startTime, endTime, price) => {
    const start = new Date(`1970-01-01T${startTime}`);
    const end = new Date(`1970-01-01T${endTime}`);
    const durationHours = (end - start) / 1000 / 60 / 60;
    let calculatedPrice = (durationHours * price).toFixed(2);
    if (calculatedPrice < 0) {
        calculatedPrice = calculatedPrice * -1 + 24 * price;
        return calculatedPrice.toFixed(2);
    }
    return calculatedPrice;
}

export const getPriceByHour = async () => {
    const response = await fetch('index.php?component=reserve&action=getPrice', {
        method: 'GET',
        headers : {'X-Requested-With': 'XMLHttpRequest'},

    });
    return response.json();
}