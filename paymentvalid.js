// billing form validation
document.getElementById("billing-form").addEventListener("submit", function(event) {
    event.preventDefault();
  
    let valid = true;
  
    clearErrors("billing-form");
  
    const fullName = document.getElementById("full-name").value.trim();
    const streetAddress = document.getElementById("street-address").value.trim();
    const city = document.getElementById("city").value.trim();
    const postalCode = document.getElementById("postal-code").value.trim();
    const billingMessageDiv = document.getElementById("billing-message");
    if (fullName === "") {
      showError("full-name", "Full Name is required.");
      valid = false;
    }
    if (streetAddress === "") {
      showError("street-address", "Street Address is required.");
      valid = false;
    }
    if (city === "") {
      showError("city", "City is required.");
      valid = false;
    }
    if (postalCode === "") {
      showError("postal-code", "Postal Code is required.");
      valid = false;
    } else if (!/^\d+$/.test(postalCode)) {
      showError("postal-code", "Postal Code must contain only numbers.");
      valid = false;
    }
  
    if (valid) {
        billingMessageDiv.textContent = "Billing details saved successfully.";
        billingMessageDiv.classList.add("success-message");
    }
});

// card form validation
document.getElementById("card-form").addEventListener("submit", function(event) {
    event.preventDefault();
  
    let valid = true;
  
    clearErrors("card-form");
  
    const cardNumber = document.getElementById("card-number").value.trim();
    const expiryDate = document.getElementById("expiry-date").value.trim();
    const cvv = document.getElementById("cvv").value.trim();
    const cardMessageDiv = document.getElementById("card-message");
    if (cardNumber === "") {
      showError("card-number", "Card Number is required.");
      valid = false;
    } else if (!/^\d{16}$/.test(cardNumber)) {
      showError("card-number", "Card Number must be 16 digits.");
      valid = false;
    }
  
    if (expiryDate === "") {
      showError("expiry-date", "Expiry Date is required.");
      valid = false;
    } else if (!/^(0[1-9]|1[0-2])\/\d{2}$/.test(expiryDate)) {
      showError("expiry-date", "Expiry Date must be in MM/YY format.");
      valid = false;
    }
  
    if (cvv === "") {
      showError("cvv", "CVV is required.");
      valid = false;
    } else if (!/^\d{3}$/.test(cvv)) {
      showError("cvv", "CVV must be 3 digits.");
      valid = false;
    }
  
    if (valid) {
        cardMessageDiv.textContent = "Payment successful! Thank you for your purchase.";
        cardMessageDiv.className = "form-message success-message";
    }
});

function showError(inputId, message) {
    const input = document.getElementById(inputId);
    const error = document.createElement("div");
    error.className = "error-message";
    error.innerText = message;
    input.parentNode.appendChild(error);
}

function clearErrors(formId) {
    const form = document.getElementById(formId);
    const errors = form.querySelectorAll(".error-message");
    errors.forEach(error => error.remove());
}