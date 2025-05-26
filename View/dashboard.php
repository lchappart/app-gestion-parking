<select name="dashboard-select" id="dasboard-select">
    <option value="users">Utilisateurs</option>
    <option value="posts">Posts</option>
</select>
<div id="table-container"></div>
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
            const values = await getValues(selectValue)
            printTables(values, tableContainer)
        })
    })
</script>

