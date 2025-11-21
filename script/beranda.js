// script/BERANDA.JS
document.addEventListener('DOMContentLoaded', function() {
    const isLoggedIn = window.userData.isLoggedIn;
    const userName = window.userData.userName;
    
    // Elements
    const usernameDisplay = document.querySelector('.username-display');
    const authBtn = document.querySelector('.auth-btn');
    const readyPlayerBtn = document.getElementById('readyPlayerBtn');
    const ctaSubtitle = document.querySelector('.cta-subtitle');
    const navMisi = document.querySelector('.nav-misi');
    const navProgress = document.querySelector('.nav-progress');
    const footerNavMisi = document.querySelector('.footer-nav-misi');
    const footerNavProgress = document.querySelector('.footer-nav-progress');
    const footerNavLogin = document.querySelector('.footer-nav-login');
    
    // Update UI berdasarkan status login
    if (isLoggedIn) {
        // User sudah login
        usernameDisplay.textContent = 'Halo, ' + userName + '!';
        authBtn.textContent = 'Logout';
        authBtn.href = '../be/be-logout.php';
        authBtn.classList.remove('login-btn');
        authBtn.classList.add('logout-btn');
        
        // CTA Button - arahkan ke progress untuk buat misi
        readyPlayerBtn.href = 'proggres.php';
        ctaSubtitle.textContent = 'Klik untuk mulai membuat misi pertamamu!';
        
        // Show navigation untuk misi dan progress
        if (navMisi) navMisi.style.display = 'block';
        if (navProgress) navProgress.style.display = 'block';
        if (footerNavMisi) footerNavMisi.style.display = 'block';
        if (footerNavProgress) footerNavProgress.style.display = 'block';
        if (footerNavLogin) footerNavLogin.style.display = 'none';
        
    } else {
        // User belum login
        usernameDisplay.textContent = '';
        authBtn.textContent = 'Login';
        authBtn.href = 'login.php';
        authBtn.classList.remove('logout-btn');
        authBtn.classList.add('login-btn');
        
        // CTA Button - arahkan ke login
        readyPlayerBtn.href = 'login.php';
        ctaSubtitle.textContent = 'Login dulu untuk memulai petualangan!';
        
        // Hide navigation untuk misi dan progress
        if (navMisi) navMisi.style.display = 'none';
        if (navProgress) navProgress.style.display = 'none';
        if (footerNavMisi) footerNavMisi.style.display = 'none';
        if (footerNavProgress) footerNavProgress.style.display = 'none';
        if (footerNavLogin) footerNavLogin.style.display = 'block';
    }
    
    // Smooth scroll untuk arrow indicators
    const scrollArrows = document.querySelectorAll('.scroll-arrow');
    scrollArrows.forEach(arrow => {
        arrow.addEventListener('click', function() {
            const currentSection = this.closest('.section, .header');
            const nextSection = currentSection.nextElementSibling;
            
            if (nextSection) {
                nextSection.scrollIntoView({ behavior: 'smooth' });
            }
        });
    });
});