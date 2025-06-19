export const fillReservationsContainer = (reservations) => {
    const reservationsContainer = document.getElementById('reservations-container');
    reservationsContainer.innerHTML = '';
    let status = ""
    for (let i = 0; i < reservations.length; i++) {
        if (reservations[i].status == "confirmed") {
            status = "Confirmée"
        } else if (reservations[i].status == "canceled") {
            status = "Annulée"
        }
        const reservation = reservations[i];        
        const reservationElement = document.createElement('div');
        reservationElement.innerHTML = `
            <div class="reservation-card">
                <h3>Date de la réservation : ${reservation.date}</h3>
                <p>Heure de début : ${reservation.start_time}</p>
                <p>Heure de fin : ${reservation.end_time}</p>
                <p>Véhicule : ${reservation.vehicle_name}</p>
                <p>Place : ${reservation.place_number}</p>
                <p>Prix : ${reservation.price}</p>
                <p>Statut : ${status}</p>
                <button class="button-primary cancel-reservation-button" data-id="${reservation.id}">Annuler</button>
            </div>
        `;
        reservationsContainer.appendChild(reservationElement);
    };
};