export const reserve = async (reservationDate, reservationStartTime, reservationEndTime, vehicleSelect, price) => {
    try {
        // Validation des données côté client
        if (!reservationDate || !reservationStartTime || !reservationEndTime || !vehicleSelect || !price) {
            throw new Error('Veuillez remplir tous les champs');
        }

        // Vérification de la date
        const selectedDate = new Date(reservationDate);
        const today = new Date();
        today.setHours(0, 0, 0, 0);
        
        if (selectedDate < today) {
            throw new Error('La date de réservation ne peut pas être dans le passé');
        }

        // Vérification des heures
        const startDateTime = new Date(`${reservationDate}T${reservationStartTime}`);
        const endDateTime = new Date(`${reservationDate}T${reservationEndTime}`);
        
        if (endDateTime <= startDateTime) {
            throw new Error('L\'heure de fin doit être après l\'heure de début');
        }

        const response = await fetch('index.php?component=reserve', {
            method: 'POST',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Content-Type': 'application/x-www-form-urlencoded;charset=UTF-8'
            },
            body: new URLSearchParams({
                reservationDate,
                reservationStartTime,
                reservationEndTime,
                vehicleSelect,
                price: price.toString()
            })
        });

        if (!response.ok) {
            const error = await response.json();
            throw new Error(error.message || 'Une erreur est survenue lors de la réservation');
        }

        const result = await response.json();
        
        if (result.success) {
            alert(`Réservation confirmée! Votre place est la N°${result.placeNumber}`);
            window.location.href = 'index.php?component=reservations';
        } else {
            throw new Error(result.message || 'Une erreur est survenue lors de la réservation');
        }
        
        return result;
    } catch (error) {
        console.error('Erreur lors de la réservation:', error);
        alert(error.message || 'Une erreur est survenue lors de la réservation');
        throw error;
    }
}

export const getUsersVehicles = async () => {
    try {
        const response = await fetch('index.php?component=cars&action=getCars', {
            method: 'GET',
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        });

        if (!response.ok) {
            throw new Error('Erreur lors de la récupération des véhicules');
        }

        return response.json();
    } catch (error) {
        console.error('Erreur:', error);
        throw error;
    }
}

export const calculatePrice = (startTime, endTime, price) => {
    try {
        const start = new Date(`1970-01-01T${startTime}`);
        const end = new Date(`1970-01-01T${endTime}`);
        
        if (isNaN(start.getTime()) || isNaN(end.getTime())) {
            throw new Error('Heures invalides');
        }

        const durationHours = (end - start) / 1000 / 60 / 60;
        
        if (durationHours < 0) {
            const adjustedDuration = durationHours + 24;
            return (adjustedDuration * price).toFixed(2);
        }
        
        return (durationHours * price).toFixed(2);
    } catch (error) {
        console.error('Erreur lors du calcul du prix:', error);
        return "0.00";
    }
}

export const getPriceByHour = async () => {
    try {
        const response = await fetch('index.php?component=reserve&action=getPrice', {
            method: 'GET',
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        });

        if (!response.ok) {
            throw new Error('Erreur lors de la récupération des tarifs');
        }

        return response.json();
    } catch (error) {
        console.error('Erreur:', error);
        throw error;
    }
}