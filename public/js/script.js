var divTable = document.querySelector('#table');

var numberOfSymbols = 14
var numberOfColumns = 7

var cards = createRandomTable()
var firstCardPosition = -1
var play = 0

function createRandomTable() {
    var rankedCard = []
    var RandomizedCards = []

    for (i = 0; i < numberOfSymbols; i++) {
        rankedCard.push([i + 1, 0])
        rankedCard.push([i + 1, 0])
    }
    
    while (rankedCard.length >0) {
        var indice = Math.floor(Math.random() * rankedCard.length)
        RandomizedCards.push(rankedCard[indice])
        rankedCard.splice(indice, 1)
    }
    
    return RandomizedCards
}

function displayCards() {
    var table = '<table>'

    for (i = 0; i < 2 * numberOfSymbols; i++) {

        image = cards[i][1] === 0 ? 0 : cards[i][0]

        if (i === 0) table += '<tr>'

        table += '<td onClick=show(' + i + ')><img src="img/' + image + '.png" alt="image de fruit"></td>'

        if ((i + 1) % numberOfColumns === 0) table += '</tr><tr>'

        if (i === numberOfSymbols - 1) table += '</tr>'
    }

    table += '</table>'

    divTable.innerHTML = table
}


function show(cardPosition) {

    if (firstCardPosition === cardPosition) {
        return
    }

    play++

    cards[cardPosition] = [cards[cardPosition][0], 1]

    displayCards()

    if (play > 1 && cards[firstCardPosition][0] !== cards[cardPosition][0]) {
        cards[firstCardPosition][1] = 0
        cards[cardPosition][1] = 0

        setTimeout(() => {
            displayCards()
        }, 1000);
    }

    firstCardPosition = cardPosition

    if (play > 1) {
        play = 0
        firstCardPosition = -1
    }
}

displayCards()
