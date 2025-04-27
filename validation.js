const form = document.getElementById('form');
const form2 = document.getElementById('form2');
const username = document.getElementById('username');
const username2 = document.getElementById('username2');
const password = document.getElementById('password');
const password2 = document.getElementById('password2');
const email = document.getElementById('email');
const phone = document.getElementById('phone');
const errorElement = document.getElementById('error');
const errorElement2 = document.getElementById('error2');
const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
const usernameRegex = /^[a-zA-Z0-9 _]+$/;
const phoneRegex = /^\d{11}$/;
const passwordRegex = /^(?=.[A-Za-z])(?=.\d)(?=.[!@#$%^&()_+\-=\[\]{};':"\\|,.<>\/?]).{6,20}$/;

form.addEventListener('submit', (e) => {
    let messages = [];

    if (username.value === '' || username.value == null) {
        messages.push('Username is required');
    } else if (!usernameRegex.test(username.value)) {
        messages.push('Username can only contain letters, numbers, spaces, and underscores');
    }

    if (password.value === '' || password.value == null) {
        messages.push('Password is required');
    } else if (password.value.length <= 6) {
        messages.push("Password must be longer than 6 characters");
    } else if (password.value.length >= 20) {
        messages.push("Password must be less than 20 characters");
    } else if (!passwordRegex.test(password.value)) {
        messages.push("Password must contain at least one letter, one number, and one special character");
    }

    if (messages.length > 0) {
        e.preventDefault();
        errorElement.innerHTML = messages.map(msg => <li>${msg}</li>).join('');
    }
});

form2.addEventListener('submit', (e) => {
    let messages = [];

    if (username2.value === '' || username2.value == null) {
        messages.push('Username is required');
    } else if (!usernameRegex.test(username2.value)) {
        messages.push('Username can only contain letters, numbers, spaces, and underscores');
    }

    if (email.value === '' || email.value == null) {
        messages.push('Email is required');
    } else if (!emailRegex.test(email.value)) {
        messages.push('Please enter a valid email address');
    }

    if (phone.value === '' || phone.value == null) {
        messages.push('Phone is required');
    } else if (!phoneRegex.test(phone.value)) {
        messages.push('Phone number must be exactly 11 digits');
    }

    if (password2.value === '' || password2.value == null) {
        messages.push('Password is required');
    } else if (password2.value.length <= 6) {
        messages.push("Password must be longer than 6 characters");
    } else if (password2.value.length >= 20) {
        messages.push("Password must be less than 20 characters");
    } else if (!passwordRegex.test(password2.value)) {
        messages.push("Password must contain at least one letter, one number, and one special character");
    }

    if (messages.length > 0) {
        e.preventDefault();
        errorElement2.innerHTML = messages.map(msg => <li>${msg}</li>).join('');
    }
});
