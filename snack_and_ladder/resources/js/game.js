// Load Howler.js for sound
import { Howl } from 'https://cdnjs.cloudflare.com/ajax/libs/howler/2.2.3/howler.min.js';

// Load sounds
const diceSound = new Howl({ src: ["/sounds/dice.mp3"] });
const snakeSound = new Howl({ src: ["/sounds/snake.mp3"] });
const ladderSound = new Howl({ src: ["/sounds/ladder.mp3"] });

// Handle dice roll
window.rollDice = function (url) {
    const rollButton = document.querySelector("#rollButton");
    rollButton.disabled = true;
    rollButton.innerHTML = '<i class="fas fa-dice fa-spin"></i> Rolling...';
    diceSound.play();

    setTimeout(() => {
        window.location.href = url;
    }, 1200);
};

// Play result sound (optional)
window.playEffect = function (type) {
    if (type === 'snake') snakeSound.play();
    else if (type === 'ladder') ladderSound.play();
};
