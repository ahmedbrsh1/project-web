 const  container=document.querySelector('.container');
 const  LoginLink=document.querySelector('.signInLink')
 const RegisterLink=document.querySelector('.signUpLink')
 const loginError = document.getElementById('error');
 const registerError = document.getElementById('error2');
RegisterLink.addEventListener('click',()=>{
    container.classList.add('active');
    loginError.innerText = ''
})
LoginLink.addEventListener('click',()=>{
    container.classList.remove('active');
    registerError.innerText = ''

})
