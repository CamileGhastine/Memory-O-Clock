var divTable = document.querySelector('#table');

var arrayTable = [
    [0, 0, 0, 0, 0, 0, 0],
    [0, 0, 0, 0, 0, 0, 0],
    [0, 0, 0, 0, 0, 0, 0],
    [0, 0, 0, 0, 0, 0, 0],
]

var arraySolution = [
    [2, 4, 6, 8, 10, 12, 14],
    [2, 4, 6, 8, 10, 12, 14],
    [1, 3, 5, 7, 9, 11, 13],
    [1, 3, 5, 7, 9, 11, 13],
]

function displayTable() {
    var table = "<table>"
    var row = 0

    arrayTable.forEach(tr => {
        var column = 0
        table += "<tr>"

        tr.forEach(td => {
            table += '<td onClick=show("' + row + column + '")><img src="img/' + td + '.png" alt="image de fruit"></td>'

            column++
        })

        row++
        table += '</tr>'
    })

    table += '</table>'

    divTable.innerHTML = table;
}

function show(td) {
    var rowTd = td.charAt(0)
    var columnTd = td.charAt(1)

    arrayTable[rowTd][columnTd] = arraySolution[rowTd][columnTd]

    displayTable()
}

displayTable();