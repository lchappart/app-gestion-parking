export const getPricing = async () => {
    const response = await fetch("index.php?component=pricing&action=list", {
        method: "GET",
        headers: {
        "X-Requested-With": "XMLHttpRequest",
    },
    });
    return await response.json();
}

