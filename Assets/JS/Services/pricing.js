export const getPricing = async () => {
    const response = await fetch("index.php?component=pricing&action=list", {
        method: "GET",
        headers: {
        "X-Requested-With": "XMLHttpRequest",
    },
    });
    return await response.json();
}

export const savePricing = async (vehicleType, pricing) => {
    const response = await fetch("index.php?component=pricing&action=edit", {
        method: "POST",
        body: new URLSearchParams({
            vehicleType,
            pricing
        }),
        headers: {
            "X-Requested-With": "XMLHttpRequest",
        },
    });
    return await response.json();
}

