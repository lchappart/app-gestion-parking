export const getReservations = async () => {
    const response = await fetch("index.php?component=reservations&action=listByUser", {
        method: "GET",
        headers: {
            "X-Requested-With": "XMLHttpRequest",
        },
    });
    return response.json();
};