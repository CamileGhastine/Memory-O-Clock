var divTable = document.querySelector('#table');
var divProgressBar = document.querySelector('#progressBar');

var numberOfSymbols = 14
var numberOfColumns = 7

var firstCardPosition = -1
var play = 0
var progression = 0

var cards = shuffleCards()

function shuffleCards() {

    let rankedCard = []
    let RandomizedCards = []

    for (i = 0; i < numberOfSymbols; i++) {
        rankedCard.push([i + 1, 0])
        rankedCard.push([i + 1, 0])
    }

    while (rankedCard.length > 0) {
        let indice = Math.floor(Math.random() * rankedCard.length)
        RandomizedCards.push(rankedCard[indice])
        rankedCard.splice(indice, 1)
    }

    return RandomizedCards
}

function displayCards() {

    let table = '<table>'

    for (i = 0; i < 2 * numberOfSymbols; i++) {

        image = cards[i][1] === 0 ? 0 : cards[i][0]

        if (i === 0) table += '<tr>'

        table += '<td onClick=compareCards(' + i + ')><img src="img/' + image + '.png" alt="image de fruit"></td>'

        if ((i + 1) % numberOfColumns === 0) table += '</tr><tr>'

        if (i === numberOfSymbols - 1) table += '</tr>'
    }

    table += '</table>'

    divTable.innerHTML = table
}

function compareCards(cardPosition) {

    if (firstCardPosition === cardPosition) {
        return
    }

    play++

    cards[cardPosition] = [cards[cardPosition][0], 1]

    displayCards()

    if (play === 1) {
        firstCardPosition = cardPosition
        return
    }

    if (cards[firstCardPosition][0] !== cards[cardPosition][0]) {
        
        cards[firstCardPosition][1] = 0
        cards[cardPosition][1] = 0

        setTimeout(() => {
            displayCards()
        }, 1000);
    } else {
        progression++
    }

    play = 0
    firstCardPosition = -1

    displayProgression()
}

function displayProgression() {
    let progressBar = '<progress value="' + progression + '" max="' + numberOfSymbols + '"></progress> '

    divProgressBar.innerHTML = progressBar

    if (progression === numberOfSymbols) {
        window.alert('Vous avez Gagné en XXX s !!!')
    }
}

displayProgression()

displayCards()
