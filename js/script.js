var divTable = document.querySelector('#table');
var divTable2 = document.querySelector('#table2');

var numberOfSymbols = 14
var numberOfColumns = 7

var cards = createRandomTable()
var firstCardPosition = 0
var play = 0

function createRandomTable() {
    var randomTable = []

    for (i = 0; i < numberOfSymbols; i++) {
        randomTable.push([i + 1, 0])
        randomTable.push([i + 1, 0])
    }

    return randomTable
}

function displayGame() {
    var table = '<table>'

    for (i = 0; i < 2 * numberOfSymbols; i++) {

        image = cards[i][1] === 0 ? 0 : cards[i][0]

        if (i === 0) table += '<tr>'

        table += '<td onClick=show(' + i + ')><img src="img/' + image + '.png" alt="image de fruit"></td>'

        if ((i + 1) % numberOfColumns === 0) table += '</tr><tr>'

        if (i === numberOfSymbols - 1) table += '</tr>'
    }

    table += '</table>'

    divTable2.innerHTML = table
}

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

var play = 0
var rowFirstCard = ''
var columnFirstCard = ''

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

function show(cardPosition) {

    if (rowFirstCard + columnFirstCard === cardPosition) {
        return
    }

    play++

    var rowCard = cardPosition.charAt(0)
    var columnCard = cardPosition.charAt(1)

    arrayTable[rowCard][columnCard] = arraySolution[rowCard][columnCard]

    displayTable()

    if (play > 1) {

        play = 0

        if (arraySolution[rowCard][columnCard] !== arraySolution[rowFirstCard][columnFirstCard]) {
            arrayTable[rowCard][columnCard] = 0
            arrayTable[rowFirstCard][columnFirstCard] = 0

            setTimeout(() => {
                displayTable()
            }, 1000);
        }
    }

    rowFirstCard = rowCard
    columnFirstCard = columnCard
}

displayTable();