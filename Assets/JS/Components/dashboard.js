export const printTables = (data, tableContainer, selectValue, editFile) => {
    tableContainer.innerHTML = ''
    if (editFile == null) {
        editFile = 'selectValue'
    }
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
        const tr = document.createElement('tr')
        for (let j = 0; j < columnNames.length; j++) {
            const td = document.createElement('td')
            td.textContent = data[i][columnNames[j]]
            tr.appendChild(td)
        }
        const editButton = document.createElement('a')
        editButton.textContent = 'Edit'
        editButton.setAttribute('href', `${editFile}?action=edit&id=${data[i].id}`)
        const deleteButton = document.createElement('a')
        deleteButton.textContent = 'Delete'
        deleteButton.setAttribute('href', `${editFile}?action=delete&id=${data[i].id}`)
        tr.appendChild(editButton)
        tr.appendChild(deleteButton)
        tbody.appendChild(tr)
    }
    table.appendChild(tbody)
    tableContainer.appendChild(table)
}