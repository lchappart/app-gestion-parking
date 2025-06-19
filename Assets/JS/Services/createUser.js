export const createUser = async (username, password, confirmPassword, email, phoneNumber) => {
    try {
        if (!username || !password || !confirmPassword || !email || !phoneNumber) {
            throw new Error('Veuillez remplir tous les champs');
        }

        if (username.length < 3) {
            throw new Error('Le nom d\'utilisateur doit contenir au moins 3 caractères');
        }

        if (password.length < 8) {
            throw new Error('Le mot de passe doit contenir au moins 6 caractères');
        }

        if (password !== confirmPassword) {
            throw new Error('Les mots de passe ne correspondent pas');
        }

        if (!email.includes('@')) {
            throw new Error('L\'adresse email n\'est pas valide');
        }

        const response = await fetch(`index.php?component=createUser`, {
            method: 'POST',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Content-Type': 'application/x-www-form-urlencoded;charset=UTF-8'
            },
            body: new URLSearchParams({
                username,
                password,
                confirmPassword,
                email,
                phoneNumber
            })
        });

        if (!response.ok) {
            const error = await response.json();
            throw new Error(error.errors ? error.errors[0] : 'Une erreur est survenue');
        }

        const result = await response.json();
        
        if (result.success) {
            alert(result.message || 'Utilisateur créé avec succès');
            window.location.href = 'index.php?component=login';
        } else {
            throw new Error(result.errors ? result.errors[0] : 'Une erreur est survenue');
        }

        return result;
    } catch (error) {
        console.error('Erreur lors de la création de l\'utilisateur:', error);
        alert(error.message || 'Une erreur est survenue lors de la création de l\'utilisateur');
        throw error;
    }
}

export const editUser = async (id, username, email, phoneNumber) => {
    try {
        if (!id || !username || !email || !phoneNumber) {
            throw new Error('Veuillez remplir tous les champs');
        }

        if (username.length < 3) {
            throw new Error('Le nom d\'utilisateur doit contenir au moins 3 caractères');
        }

        if (!email.includes('@')) {
            throw new Error('L\'adresse email n\'est pas valide');
        }

        const response = await fetch(`index.php?component=createUser&action=edit&id=${id}`, {
            method: 'POST',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Content-Type': 'application/x-www-form-urlencoded;charset=UTF-8'
            },
            body: new URLSearchParams({
                username,
                email,
                phoneNumber
            })
        });

        if (!response.ok) {
            const error = await response.json();
            throw new Error(error.errors ? error.errors[0] : 'Une erreur est survenue');
        }

        const result = await response.json();
        
        if (result.success) {
            alert(result.message || 'Utilisateur mis à jour avec succès');
            return result;
        } else {
            throw new Error(result.errors ? result.errors[0] : 'Une erreur est survenue');
        }

    } catch (error) {
        console.error('Erreur lors de la modification de l\'utilisateur:', error);
        alert(error.message || 'Une erreur est survenue lors de la modification de l\'utilisateur');
        throw error;
    }
}