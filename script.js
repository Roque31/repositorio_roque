const themeToggle = document.getElementById('theme-toggle');
const body = document.body;

// Set initial theme
body.classList.add('light-mode');

themeToggle.addEventListener('click', () => {
    if (body.classList.contains('light-mode')) {
        body.classList.replace('light-mode', 'dark-mode');
    } else {
        body.classList.replace('dark-mode', 'light-mode');
    }
});
