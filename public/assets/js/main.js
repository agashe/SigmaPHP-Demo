// handle theming 
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

// set active link in navbar
const navLinks = document.getElementsByClassName('nav-link');
Array.from(navLinks).forEach(el => el.classList.remove('active'));

if (window.location.href.includes('blog')) {
    document.getElementById('blog-nav').classList.add('active');
}
else if (window.location.href.includes('about')) {
    document.getElementById('about-nav').classList.add('active');
}
else if (window.location.href.includes('contact')) {
    document.getElementById('contact-nav').classList.add('active');
}
else {
    document.getElementById('home-nav').classList.add('active');
}

// search form handler
const searchButton = document.getElementById('search-btn');
const searchText = document.getElementById('search-text');

function searchHandler() { 
    window.location.href = '/blog/search/' + searchText.value;
}

searchButton.addEventListener('click', searchHandler);

searchText.addEventListener('keydown', function(event) {
    if (event.key === 'Enter') {
        event.preventDefault();
        searchHandler();
    }
});