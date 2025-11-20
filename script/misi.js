document.addEventListener('DOMContentLoaded', function() {
    // Filter kategori
    const categoryButtons = document.querySelectorAll('.category-btn');
    const categorySections = document.querySelectorAll('.category-section');
    
    // Sembunyikan semua section kecuali yang pertama
    if (categorySections.length > 0) {
        categorySections.forEach((section, index) => {
            if (index !== 0) {
                section.style.display = 'none';
            }
        });
        
        // Set active button pertama
        if (categoryButtons.length > 0) {
            categoryButtons[0].classList.add('active');
        }
    }
    
    categoryButtons.forEach(button => {
        button.addEventListener('click', function() {
            const selectedCategory = this.getAttribute('data-category');
            
            // Remove active class dari semua button
            categoryButtons.forEach(btn => btn.classList.remove('active'));
            
            // Add active class ke button yang diklik
            this.classList.add('active');
            
            // Tampilkan/sembunyikan section berdasarkan kategori
            categorySections.forEach(section => {
                const sectionCategory = section.getAttribute('data-category');
                if (sectionCategory === selectedCategory) {
                    section.style.display = 'block';
                } else {
                    section.style.display = 'none';
                }
            });
        });
    });
    
    // Auto hide alerts
    setTimeout(function() {
        const alerts = document.querySelectorAll('.alert-success, .alert-rankup');
        alerts.forEach(alert => {
            alert.style.opacity = '0';
            alert.style.transition = 'opacity 0.5s ease';
            setTimeout(() => alert.remove(), 500);
        });
    }, 5000);
    
    // Konfirmasi sebelum menyelesaikan tugas
    const missionForms = document.querySelectorAll('.mission-form');
    missionForms.forEach(form => {
        form.addEventListener('submit', function(e) {
            const confirmed = confirm('Apakah kamu yakin sudah menyelesaikan tugas ini?');
            if (!confirmed) {
                e.preventDefault();
            }
        });
    });
});