export const saveAccount = async (username, email, phone, password, confirmPassword) => {
    const response = await fetch('index.php?component=account&action=edit', {
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
        },
        method: 'POST',
        body: new URLSearchParams({ username, email, phone, password, confirmPassword }),
    });
    return response.json();
};