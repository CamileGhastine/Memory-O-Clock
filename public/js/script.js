const divCards = document.getElementById('cards');
const divUnderCards = document.getElementById('underCards');
const divProgressBar = document.getElementById('progressBar');
const divTimer = document.getElementById('timer');

const numberOfSymbols = 14; // Number of different pairs of symbols
const numberOfColumns = 7; // Number of column to display card (must be chosen concordantly with the number of pairs)
const initialTimer = 100; // Time to solve the memory before loosing

var timer = initialTimer; // Timer which decrease to zero 
var progression = 0; // Variable to follow the progression of the game (increase when player find a pair)
var loose = false; // Become true when timer is at zero and the player has lost

var firstCardPosition = -1; // Variable to save the position of the first card turn over
var play = 0; // Variable wich represents the card that has been turn (0: none, 1: first card, 2: second card)

/**
 * Array of array to stock the order of the cards and the state of each card (0: face down or 1: face down)
 * @example [[card1, state of card 1], [card 2, state of card 2], ...]
 */
var cards = shuffleCards();

displayCards();

window.alert('Prêt à commencer ?');

// Timer that decrease at zero
var timerInterval = setInterval(() => {

    timer--;
    divTimer.innerHTML = timer;

    // when timer is at zero player lost
    if (timer === 0) {
        loose = true;
        divUnderCards.innerHTML = '';
        clearInterval(timerInterval);
        window.alert('Vous avez perdu !!!');
    }

}, 1000);

/**
 * Shuffle randomly the card to set up the variable { Array } cards
 * 
 * @returns { Array }
 */
function shuffleCards() {

    let rankedCard = [];
    let RandomizedCards = [];

    for (i = 0; i < numberOfSymbols; i++) {
        rankedCard.push([i + 1, 0]);
        rankedCard.push([i + 1, 0]);
    }

    while (rankedCard.length > 0) {
        let indice = Math.floor(Math.random() * rankedCard.length);
        RandomizedCards.push(rankedCard[indice]);
        rankedCard.splice(indice, 1);
    }

    return RandomizedCards;
}

/**
 * Create a <table> element which represente the display of the card and place it in the DOM
 */
function displayCards() {

    let table = '<table>';

    for (i = 0; i < 2 * numberOfSymbols; i++) {

        let image = cards[i][1] === 0 ? 0 : cards[i][0];
        let action = cards[i][1] === 0 ? 'onClick=compareCards(' + i + ')' : '';

        if (i === 0) table += '<tr>';

        table += '<td ' + action + '><img src="img/' + image + '.png" alt="image de fruit"></td>';

        if ((i + 1) % numberOfColumns === 0) table += '</tr><tr>';

        if (i === numberOfSymbols - 1) table += '</tr>';
    }

    table += '</table>';

    divCards.innerHTML = table;
}

/**
 * show the cards that has been selected and compare them
 * 
 * @param { Number} cardPosition 
 */
function compareCards(cardPosition) {

    // Prevent double clicking on the same image
    if (firstCardPosition === cardPosition) {
        return;
    }

    play++;

    // Change the state of the card that has been turn over
    cards[cardPosition] = [cards[cardPosition][0], 1];

    displayCards();

    // Save the position of the first card that has been turn over
    if (play === 1) {
        firstCardPosition = cardPosition;
        return;
    }

    if (cards[firstCardPosition][0] !== cards[cardPosition][0]) {
        // Case where the two turn over cards are differents

        cards[firstCardPosition][1] = 0;
        cards[cardPosition][1] = 0;

        // Wait 1 second before turn it back face down
        setTimeout(() => {
            displayCards();
        }, 1000);
    } else {
        if (!loose) {
            // Case where the two turn over cards are the same

            progression++;
        }
    }

    play = 0;
    firstCardPosition = -1;

    displayProgression();
}

/**
 *  Create a <progress> element (a progress bar)and place it in the DOM
 */
function displayProgression() {

    let progressBar = '<progress value="' + progression + '" max="' + numberOfSymbols + '"></progress>';

    divProgressBar.innerHTML = progressBar;

    // Case if player find all the cards and win
    if (progression === numberOfSymbols) {
        clearInterval(timerInterval);
        testFetch(initialTimer - timer);
        window.alert('Vous avez gagné en ' + (initialTimer - timer) + ' s !!!');
    }
}

/**
 * AJAX request to send the result (time to solve the problem) to the sever 
 * and place the response (HTMLElement) in the DOM
 * @param {Number} result 
 */
function testFetch(result) {

    let formData = new FormData();
    formData.append('result', result);

    fetch("/game/add", {
            method: "POST",
            body: formData
        })
        .then(response => response.text())
        .then(response => {
            divUnderCards.innerHTML = response;
        })
        .catch(error => alert("Erreur : " + error));
}