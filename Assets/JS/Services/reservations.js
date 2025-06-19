export const getReservations = async () => {
    const response = await fetch("index.php?component=reservations&action=listByUser", {
        method: "GET",
        headers: {
            "X-Requested-With": "XMLHttpRequest",
        },
    });
    return response.json();
};

export const cancelReservation = async (id) => {
    const response = await fetch(`index.php?component=reservations&action=cancel&id=${id}`, {
        method: "POST",
        headers: {
            "X-Requested-With": "XMLHttpRequest",
        },
    });
    return response.json();
};