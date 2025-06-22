const isBrowserInDarkMode = window.matchMedia('(prefers-color-scheme: dark)');
const body = document.getElementsByTagName('body');
const description = document.getElementsByClassName('description');

if (isBrowserInDarkMode.matches) {
    body[0].style.backgroundColor = '#1a1a1a';
    Array.from(description).forEach(el => el.style.color = '#e0e0e0');
} else {
    body[0].style.backgroundColor = 'white';
    Array.from(description).forEach(el => el.style.color = '#333');
}