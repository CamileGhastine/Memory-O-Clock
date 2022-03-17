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


function show(cardPosition) {
    if (firstCardPosition === cardPosition) {
        return
    }

    play++

    cards[cardPosition] = [cards[cardPosition][0], 1]

    displayGame()

    if (play > 1) {
        play = 0

        if (cards[firstCardPosition][0] !== cards[cardPosition][0]) {
            cards[firstCardPosition][1] = 0
            cards[cardPosition][1] = 0

            setTimeout(() => {
                displayGame()
            }, 1000);
        }
    }

    firstCardPosition = cardPosition
}

displayGame()
