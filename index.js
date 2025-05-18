const container = document.querySelector(".container");
const LoginLink = document.querySelector(".signInLink");
const RegisterLink = document.querySelector(".signUpLink");
const loginError = document.getElementById("login-error");
const registerError = document.getElementById("register-error");

RegisterLink.addEventListener("click", () => {
  container.classList.add("active");

  if (loginError) {
    loginError.innerText = "";
    loginError.style.display = "none";
  }
});

LoginLink.addEventListener("click", () => {
  container.classList.remove("active");

  if (registerError) {
    registerError.innerText = "";
    registerError.style.display = "none";
  }
});
