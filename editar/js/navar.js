window.addEventListener('scroll', function() {
    var navbar = document.getElementById('navbar');
    if (window.scrollY > 0) {
        navbar.style.backgroundColor = 'rgba(237, 243, 243, 0.1)'; // Ajusta el valor de alfa para hacerlo más transparente
    } else {
        navbar.style.backgroundColor = 'rgb(237, 243, 243)';
    }
});