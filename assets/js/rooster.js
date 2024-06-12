document.addEventListener('DOMContentLoaded', (event) => {
    // VARIABLES DECLARATION
    let roosterButton = document.querySelector('#rooster');
    let isActive = false;
    let rooster = document.querySelector('#crow');
    let buttonContainer = document.querySelector('#home-button-container');
    let home = document.querySelector('#home');
    let title = document.querySelector('h1');
    let homeCatch = document.querySelector('p');

    // FUNCTION DECLARATION
    function setActive() {
        isActive = !isActive;
        sing();
        disappear();
        appear();
    }

    function disappear() {
        buttonContainer.style.animation = "disappear .3s ease-in-out .3s forwards";
    }

    function appear() {
        home.style.animation = "appear 0.3s ease-in-out .3s forwards"
        title.style.animation = "transform-x 0.6s ease-in-out .6s forwards"
        homeCatch.style.animation = "transform-x 0.6s ease-in-out .9s forwards"

    }

    function sing() {
        isActive ? rooster.play() : rooster.pause();
    }

    // EVENT LISTENERS
    // The rooster sings after clicking on the button
    roosterButton.onclick = () => setActive();
});