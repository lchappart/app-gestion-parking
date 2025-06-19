export const editPlace = async (id, number, type) => {
    const response = await fetch(`index.php?component=place&action=edit&id=${id}`, {
        method: 'POST',
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
        },
        body: new URLSearchParams({
            number,
            type,
        }),
    });
    const data = await response.json();
    return data;
}

export const addPlace = async (number, type) => {
    const response = await fetch(`index.php?component=place&action=add`, {
        method: 'POST',
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
        },
        body: new URLSearchParams({
            number,
            type,
        }),
    });
    const data = await response.json();
    return data;
}