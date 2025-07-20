const loginForm = document.getElementById('login-form');
const message = document.querySelector('.message');

loginForm.addEventListener('submit', (e) => {
    e.preventDefault();

    const username = loginForm.username.value;
    const password = loginForm.password.value;

    if (username === 'user' && password === 'password') {
        message.style.color = 'green';
        message.textContent = 'Login successful!';
        // Redirect to another page or perform other actions
    } else {
        message.style.color = 'red';
        message.textContent = 'Invalid username or password.';
    }
});
