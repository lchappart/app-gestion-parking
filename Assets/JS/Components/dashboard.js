export const printTables = (data, tableContainer) => {
    tableContainer.innerHTML = ''
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
        tbody.appendChild(tr)
    }
    table.appendChild(tbody)
    tableContainer.appendChild(table)
}