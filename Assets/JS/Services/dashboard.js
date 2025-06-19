export const getValues = async (selectValue) => {
    const response = await fetch(`index.php?component=${selectValue}&action=list`,{
        method: 'GET',
        headers : {'X-Requested-With': 'XMLHttpRequest'},
    })
    return await response.json()
}