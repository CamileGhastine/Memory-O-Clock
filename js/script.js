var divTable = document.querySelector('#table');

arrayTable = [
    [0, 0, 0, 0, 0, 0, 0],
    [0, 0, 0, 0, 0, 0, 0],
    [0, 0, 0, 0, 0, 0, 0],
    [0, 0, 0, 0, 0, 0, 0],
]

function displayTable() {
    var table = "<table>"
    arrayTable.forEach(tr => {
        table += "<tr>"
        tr.forEach(td => {
            table += '<td><img src="img/0.png" alt="image de fruit"></td>'
        })
        table += '</tr>'
    });
    table += '</table>'
    return table
}

console.log(table);
divTable.innerHTML = displayTable();