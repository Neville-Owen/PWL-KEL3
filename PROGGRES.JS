// Handle logo image error
document.addEventListener('DOMContentLoaded', function() {
    const logoImage = document.getElementById('logoImage');
    
    if (logoImage) {
        logoImage.onerror = function() {
            this.style.display = 'none';
            this.parentElement.innerHTML = '<span style="font-size: 20px; font-weight: bold; color: #4a148c;">Q</span>';
        };
    }

    // Animate progress bars on load
    animateProgressBars();
    
    // Initialize button interactions
    initializeButtons();
});

// Function to animate progress bars
function animateProgressBars() {
    const progressBars = document.querySelectorAll('.progress-bar');
    progressBars.forEach(bar => {
        const width = bar.style.width;
        bar.style.width = '0%';
        setTimeout(() => {
            bar.style.width = width;
        }, 100);
    });
}

// Function to initialize all button interactions
function initializeButtons() {
    // Delete buttons
    document.querySelectorAll('.btn-delete').forEach(btn => {
        btn.addEventListener('click', handleDelete);
    });

    // Edit buttons
    document.querySelectorAll('.btn-edit').forEach(btn => {
        btn.addEventListener('click', handleEdit);
    });

    // Menu dots buttons
    document.querySelectorAll('.menu-dots').forEach(btn => {
        btn.addEventListener('click', handleMenu);
    });

    // Select buttons
    document.querySelectorAll('.btn-select').forEach(btn => {
        btn.addEventListener('click', handleSelect);
    });
}

// Handle delete task
function handleDelete() {
    if(confirm('Apakah Anda yakin ingin menghapus tugas ini?')) {
        this.closest('.task-card').style.opacity = '0';
        this.closest('.task-card').style.transform = 'scale(0.8)';
        setTimeout(() => {
            this.closest('.task-card').remove();
        }, 300);
    }
}

// Handle edit task
function handleEdit() {
    const taskCard = this.closest('.task-card');
    const taskTitle = taskCard.querySelector('h3').textContent;
    const taskDesc = taskCard.querySelector('p').textContent;
    
    const newDesc = prompt('Edit deskripsi tugas:', taskDesc);
    if (newDesc !== null && newDesc.trim() !== '') {
        taskCard.querySelector('p').textContent = newDesc;
        alert('Tugas berhasil diperbarui!');
    }
}

// Handle menu dots
function handleMenu() {
    const options = ['Tandai sebagai prioritas', 'Pindahkan ke folder', 'Duplikat tugas', 'Batal'];
    const choice = prompt('Pilih opsi:\n1. Tandai sebagai prioritas\n2. Pindahkan ke folder\n3. Duplikat tugas\n4. Batal\n\nMasukkan nomor (1-4):');
    
    switch(choice) {
        case '1':
            alert('Tugas ditandai sebagai prioritas!');
            break;
        case '2':
            alert('Fitur pindahkan folder akan segera hadir!');
            break;
        case '3':
            alert('Tugas berhasil diduplikat!');
            break;
        default:
            break;
    }
}

// Handle select task
function handleSelect() {
    const btn = this;
    if(btn.textContent === 'selected') {
        btn.textContent = 'select';
        btn.style.background = 'transparent';
        btn.style.color = 'white';
        btn.style.border = '2px solid white';
    } else {
        btn.textContent = 'selected';
        btn.style.background = 'white';
        btn.style.color = '#4a148c';
        btn.style.border = 'none';
    }
}

// Add smooth scroll behavior
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
            target.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }
    });
});