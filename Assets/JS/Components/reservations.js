export const fillReservationsContainer = (reservations) => {
    const reservationsContainer = document.getElementById('reservations-container');
    reservationsContainer.innerHTML = '';
    for (let i = 0; i < reservations.length; i++) {
        const reservation = reservations[i];
        console.log(reservation);
        
        const reservationElement = document.createElement('div');
        reservationElement.innerHTML = `
            <div class="reservation-card">
                <h3>Date de la réservation : ${reservation.date}</h3>
                <p>Heure de début : ${reservation.start_time}</p>
                <p>Heure de fin : ${reservation.end_time}</p>
                <p>Véhicule : ${reservation.vehicle_name}</p>
                <p>Place : ${reservation.place_number}</p>
                <p>Prix : ${reservation.price}</p>
            </div>
        `;
        reservationsContainer.appendChild(reservationElement);
    };
};