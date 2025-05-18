const form = document.getElementById("form");
const form2 = document.getElementById("form2");

const username = document.getElementById("username");
const password = document.getElementById("password");
const email = document.getElementById("email");
const phone = document.getElementById("phone");
const username2 = document.getElementById("username2");
const password2 = document.getElementById("password2");

const errorElement = document.getElementById("error");
const errorElement2 = document.getElementById("error2");
const loginErrorDiv = document.getElementById("login-error");
const registerErrorDiv = document.getElementById("register-error");

const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
const usernameRegex = /^[a-zA-Z0-9 _]+$/;
const phoneRegex = /^\d{11}$/;

// Login form validation + fetch
form.addEventListener("submit", (e) => {
  e.preventDefault();

  let messages = [];
  loginErrorDiv.innerText = "";
  errorElement.innerHTML = "";

  if (!username.value) {
    messages.push("Username is required");
  }
  if (!password.value) {
    messages.push("Password is required");
  }

  if (messages.length > 0) {
    errorElement.innerHTML = messages.map((msg) => `<li>${msg}</li>`).join("");
    return;
  }

  const formData = new FormData(form);

  fetch("login.php", {
    method: "POST",
    body: formData,
  })
    .then((res) => res.json())
    .then((data) => {
      if (data.success) {
        window.location.href = "index.php";
      } else {
        loginErrorDiv.innerText = data.error || "Login failed";
      }
    })
    .catch(() => {
      loginErrorDiv.innerText = "Network error, try again.";
    });
});

// Register form validation + fetch
form2.addEventListener("submit", (e) => {
  e.preventDefault();

  let messages = [];
  registerErrorDiv.innerText = "";
  errorElement2.innerHTML = "";

  if (!username2.value) {
    messages.push("Username is required");
  } else if (!usernameRegex.test(username2.value)) {
    messages.push(
      "Username can only contain letters, numbers, spaces, and underscores"
    );
  }

  if (!email.value) {
    messages.push("Email is required");
  } else if (!emailRegex.test(email.value)) {
    messages.push("Please enter a valid email address");
  }

  if (!phone.value) {
    messages.push("Phone is required");
  } else if (!phoneRegex.test(phone.value)) {
    messages.push("Phone number must be exactly 11 digits");
  }

  if (!password2.value) {
    messages.push("Password is required");
  } else if (password2.value.length <= 6) {
    messages.push("Password must be longer than 6 characters");
  } else if (password2.value.length >= 20) {
    messages.push("Password must be less than 20 characters");
  }

  if (messages.length > 0) {
    errorElement2.innerHTML = messages.map((msg) => `<li>${msg}</li>`).join("");
    return;
  }

  const formData = new FormData(form2);

  fetch("register.php", {
    method: "POST",
    body: formData,
  })
    .then((res) => res.json())
    .then((data) => {
      if (data.success) {
        window.location.href = "index.php";
      } else {
        registerErrorDiv.innerText = data.error || "Registration failed";
      }
    })
    .catch(() => {
      registerErrorDiv.innerText = "Network error, try again.";
    });
});
