export const printTables = (data, tableContainer, selectValue) => {
    tableContainer.innerHTML = ''
    let query = ''
    const table = document.createElement('table')
    const thead = document.createElement('thead')
    const tbody = document.createElement('tbody')
    const columnNames = Object.keys(data[0] || {})
    for (let i = 0; i < columnNames.length; i++) {
        const th = document.createElement('th')
        th.textContent = columnNames[i]
        thead.appendChild(th)
    }
    table.appendChild(thead)
    for (let i = 0; i < data.length; i++) {
        if (selectValue == 'places') {
            query = `index.php?component=place&action=delete&id=${data[i].id}`
        } else {
            query = `${selectValue}?action=delete&id=${data[i].id}`
        }
        const tr = document.createElement('tr')
        for (let j = 0; j < columnNames.length; j++) {
            const td = document.createElement('td')
            td.textContent = data[i][columnNames[j]]
            tr.appendChild(td)
        }
        const actionButton = document.createElement('a')
        if (selectValue == 'users') {
            const actionText = data[i].enabled == 1 ? 'Désactiver' : 'Activer'
            actionButton.textContent = actionText
            const id = data[i].id
            actionButton.addEventListener('click', async (e) => {
                e.preventDefault()
                const response = await fetch(`${selectValue}?action=toggle_enabled&id=${id}`,
                    {
                        method: 'POST',
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    }
                )
                const result = await response.json()
                if (result.success) {
                    actionButton.textContent = actionButton.textContent == 'Désactiver' ? 'Activer' : 'Désactiver'
                    console.log(actionButton.textContent);
                    
                }
            })
        } else if (selectValue == 'places') {
            actionButton.textContent = 'Modifier'
            actionButton.setAttribute('href', `place?action=edit&id=${data[i].id}`)
        } 
      
        const deleteButton = document.createElement('a')
        deleteButton.textContent = 'Delete'
        deleteButton.addEventListener('click', async (e) => {
            e.preventDefault()
            if (confirm('Voulez vous vraiment supprimer cette ligne ?')) {
            const response = await fetch(query,
                {
                    method: 'POST',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                }
            )
            const result = await response.json()
            if (result.success) {
                    tr.remove()
                }
            }
        })
        tr.appendChild(actionButton)
        tr.appendChild(deleteButton)
        tbody.appendChild(tr)
    }
    table.appendChild(tbody)
    tableContainer.appendChild(table)
}