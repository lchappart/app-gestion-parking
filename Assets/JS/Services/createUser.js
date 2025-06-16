export const createUser = async (username, password, confirmPassword, email, phoneNumber) => {
    const response = await fetch(`index.php?component=createUser`,{
        method: 'POST',
        headers : {'X-Requested-With': 'XMLHttpRequest'},
        body: new URLSearchParams({
            username,
            password,
            confirmPassword,
            email,
            phoneNumber
        })
    })
    return await response.json()
}

export const editUser = async (username, password, confirmPassword, email, phoneNumber) => {
    const response = await fetch(`index.php?component=createUser&action=edit`,{
        method: 'POST',
        headers : {'X-Requested-With': 'XMLHttpRequest'},
        body: new URLSearchParams({
            username,
            password,
            confirmPassword,
            email,
            phoneNumber
        })
    })
}