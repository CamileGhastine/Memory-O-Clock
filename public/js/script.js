const divTable = document.getElementById('table');
const divProgressBar = document.getElementById('progressBar');
const divTimer = document.getElementById('timer');

const numberOfSymbols = 14
const numberOfColumns = 7

const initialTimer = 120
var timer = initialTimer
var progression = 0
var loose = 0

var firstCardPosition = -1
var play = 0

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

        let image = cards[i][1] === 0 ? 0 : cards[i][0]
        let action = cards[i][1] === 0 ? 'onClick=compareCards(' + i + ')' : ''

        if (i === 0) table += '<tr>'

        table += '<td ' + action + '><img src="img/' + image + '.png" alt="image de fruit"></td>'

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
        if (loose === 0) {
            progression++
        }
    }

    play = 0
    firstCardPosition = -1

    displayProgression()
}

function displayProgression() {

    let progressBar = loose === 0 ? '<progress value="' + progression + '" max="' + numberOfSymbols + '"></progress>' : '<p id="alert">Vous pouvez continuer la partie, mais votre temps ne sera pas enregistré.</p>'

    divProgressBar.innerHTML = progressBar

    if (progression === numberOfSymbols) {
        clearInterval(timerInterval)
        // divTimer.innerHTML = '<p>Votre temps est de ' + (initialTimer - timer) + ' s</p>'
        testFetch(initialTimer - timer)
        window.alert('Vous avez gagné en ' + (initialTimer - timer) + ' s !!!')
    }
}

var timerInterval = setInterval(() => {

    timer--
    divTimer.innerHTML = timer

    if (timer === 0) {
        loose = 1
        divProgressBar.innerHTML = ''
        clearInterval(timerInterval)
        window.alert('Vous avez perdu !!!')
    }

}, 1000)

function testFetch(result) {

    let formData = new FormData();
    formData.append('result', result);

    fetch("?page=add", {
        method: "POST",
        body: formData
    })
        .then(response => response.text())
        .then(response => {
            divTimer.innerHTML = response
        })
        .catch(error => alert("Erreur : " + error));
}

displayCards()
