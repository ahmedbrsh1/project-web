const editBtn = document.getElementById('editBtn');
const saveBtn = document.getElementById('saveBtn');
const formInputs = document.querySelectorAll('.account-form input');

editBtn.addEventListener('click', () => {
  formInputs.forEach(input => {
    input.disabled = false;
    input.style.backgroundColor = "#fff";
  });
  editBtn.style.display = "none";
  saveBtn.style.display = "block";
});

document.getElementById('accountForm').addEventListener('submit', (e) => {
  e.preventDefault();
  formInputs.forEach(input => {
    input.disabled = true;
    input.style.backgroundColor = "#f2f2f2";
  });
  editBtn.style.display = "block";
  saveBtn.style.display = "none";
  alert('Profile updated successfully!');
});
