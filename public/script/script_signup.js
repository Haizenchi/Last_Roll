const menuButton = document.querySelector("#menuButton");
const mainNav = document.querySelector("#mainNav");

menuButton.addEventListener("click", function() {
    mainNav.classList.toggle("open");
});

const signupForm = document.querySelector("#signupForm");

signupForm.addEventListener("submit", function(event) {
    const password = document.querySelector("#Password").value;
    const confirmPassword = document.querySelector("#ConfirmPassword").value;

    if (password !== confirmPassword) {
        event.preventDefault();
        alert("Les mots de passe ne correspondent pas.");
    }
});
