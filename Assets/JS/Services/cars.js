export const getCars = async () => {
    const response = await fetch('index.php?component=cars&action=getCars', {
        headers : {'X-Requested-With': 'XMLHttpRequest'},
    });
    return await response.json();
}

export const deleteCar = async (id) => {
    const response = await fetch('index.php?component=cars&action=delete&id=' + id, {
        headers : {'X-Requested-With': 'XMLHttpRequest'},
    });
    return await response.json();
}