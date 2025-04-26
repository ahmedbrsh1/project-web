const form = document.getElementById('form')
const form2 = document.getElementById('form2')
const username = document.getElementById('username')
const password = document.getElementById('password')
const email = document.getElementById('email')
const phone = document.getElementById('phone')
const errorElement = document.getElementById('error')
const errorElement2 = document.getElementById('error2')


form.addEventListener('submit', (e) => {
    let messages = []
    
    if (username.value === '' || username.value == null) {
        messages.push('Username is required')
    }

    if (password.value === '' || password.value == null) {
        messages.push('Password is required')
    }
    else if (password.value.length <= 6) {
        messages.push("password must be longer than 6 characters")
    }
    else if (password.value.length >= 20) {
        messages.push("password must be less than 20 characters")
    }


    if (messages.length > 0) {
        e.preventDefault()
        errorElement.innerText = messages.join(', ')
    }

})

form2.addEventListener('submit', (e) => {
    let messages = []
    
    if (username.value === '' || username.value == null) {
        messages.push('Username is required')
    }

    if(email.value === '' || email.value == null) {
        messages.push('Email is required')
    }

    if(phone.value === '' || phone.value == null) {
        messages.push('Phone is required')
    }
    else if (phone.value.length !== 11) {
        messages.push("Phone number must be 11 digits")
    }   

    if (password.value === '' || password.value == null) {
        messages.push('Password is required')
    }
    else if (password.value.length <= 6) {
        messages.push("password must be longer than 6 characters")
    }
    else if (password.value.length >= 20) {
        messages.push("password must be less than 20 characters")
    }


    if (messages.length > 0) {
        e.preventDefault()
        errorElement2.innerText = messages.join(', ')
    }
})

