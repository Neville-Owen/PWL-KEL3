// Smooth page transition when clicking Login tab
document.getElementById('loginTab').addEventListener('click', function(e) {
    e.preventDefault();
    document.body.classList.add('page-transition');
    setTimeout(function() {
        window.location.href = 'login.php';
    }, 400);
});

// Fade in animation on page load
window.addEventListener('load', function() {
    document.body.style.opacity = '0';
    setTimeout(function() {
        document.body.style.transition = 'opacity 0.5s ease-in-out';
        document.body.style.opacity = '1';
    }, 10);
});