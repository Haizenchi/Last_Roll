const menuButton = document.querySelector("#menuButton");
const mainNav = document.querySelector("#mainNav");

menuButton.addEventListener("click", function() {
    mainNav.classList.toggle("open");
});

const loginForm = document.querySelector("#loginForm");

loginForm.addEventListener("submit", function(event) {
    event.preventDefault();
    alert("La connexion n'est pas encore disponible.");
});
