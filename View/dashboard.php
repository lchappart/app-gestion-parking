<div class="form-container dashboard-container">
    <h1>Tableau de bord</h1>
    <div class="dashboard-controls">
        <label for="dasboard-select">Sélectionnez une catégorie</label>
        <select name="dashboard-select" id="dasboard-select" class="input">
            <option data-edit="createUser" value="users">Utilisateurs</option>
            <option value="places">Places</option>
            <option data-edit="addCar" value="cars">Véhicules</option>
            <option value="reserve">Réservations</option>
        </select>
    </div>
    <div id="table-container" class="table-responsive"></div>
</div>

<style>
    .dashboard-container {
        max-width: 1200px;
        width: 100%;
    }

    .dashboard-controls {
        margin-bottom: 2rem;
    }

    .table-responsive {
        overflow-x: auto;
        background: white;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin: 1rem 0;
    }

    th, td {
        padding: 1rem;
        text-align: left;
        border-bottom: 1px solid #eee;
    }

    th {
        background-color: var(--background-color);
        color: var(--text-color);
        font-weight: 600;
    }

    tr:hover {
        background-color: rgba(255, 107, 53, 0.05);
    }

    a {
        display: inline-block;
        padding: 0.5rem 1rem;
        margin: 0 0.5rem;
        border-radius: 4px;
        text-decoration: none;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    a:first-of-type {
        color: var(--primary-color);
    }

    a:last-of-type {
        color: var(--error-color);
    }

    a:hover {
        transform: translateY(-2px);
    }

    a:first-of-type:hover {
        background-color: rgba(255, 107, 53, 0.1);
    }

    a:last-of-type:hover {
        background-color: rgba(211, 47, 47, 0.1);
    }
</style>

<script type="module" src="./Assets/JS/Components/dashboard.js"></script>
<script type="module" src="./Assets/JS/Services/dashboard.js"></script>
<script type="module">
    import { getValues } from './Assets/JS/Services/dashboard.js'
    import { printTables } from './Assets/JS/Components/dashboard.js'
    document.addEventListener('DOMContentLoaded', () => {
        const select = document.getElementById('dasboard-select')
        select.addEventListener('change', async () => {
            const tableContainer = document.getElementById('table-container')
            const selectValue = select.value
            const selectedOption = select.options[select.selectedIndex]
            const values = await getValues(selectValue)
            printTables(values, tableContainer, selectValue, selectedOption.getAttribute('data-edit'))
        })
    })
</script>

