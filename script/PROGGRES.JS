document.addEventListener('DOMContentLoaded', function() {
    const logoImage = document.getElementById('logoImage');
    
    if (logoImage) {
        logoImage.onerror = function() {
            this.style.display = 'none';
            this.parentElement.innerHTML = '<span style="font-size: 20px; font-weight: bold; color: #4a148c;">Q</span>';
        };
    }

    // Animasi progress bars
    const progressBars = document.querySelectorAll('.progress-bar');
    progressBars.forEach(bar => {
        const targetWidth = bar.style.width;
        bar.style.width = '0%';
        setTimeout(() => {
            bar.style.width = targetWidth;
        }, 300);
    });

    // Event listener untuk klik progress bar
    const progressContainers = document.querySelectorAll('.progress-bar-container');
    progressContainers.forEach(container => {
        container.addEventListener('click', function() {
            const subject = this.getAttribute('data-subject');
            openModal(subject);
        });
    });

    // Auto hide alerts
    setTimeout(function() {
        const alerts = document.querySelectorAll('.alert-success, .alert-error, .alert-rankup');
        alerts.forEach(alert => {
            alert.style.opacity = '0';
            setTimeout(() => alert.remove(), 500);
        });
    }, 5000);
});

// Buka modal
function openModal(subject) {
    const modal = document.getElementById('taskModal');
    const modalSubject = document.getElementById('modalSubject');
    const subjectNames = {
        'bahasa_inggris': 'Bahasa Inggris',
        'bahasa_indonesia': 'Bahasa Indonesia',
        'ipas': 'IPAS',
        'matematika': 'Matematika',
        'pendidikan_agama': 'Pendidikan Agama',
        'pjok': 'PJOK',
        'seni_budaya': 'Seni Budaya',
        'pkn': 'PKN'
    };
    
    modalSubject.value = subject;
    
    const modalTitle = modal.querySelector('h2');
    modalTitle.textContent = 'Tambah Tugas - ' + subjectNames[subject];
    
    modal.style.display = 'block';
}

// Tutup modal
function closeModal() {
    const modal = document.getElementById('taskModal');
    modal.style.display = 'none';
    document.getElementById('addTaskForm').reset();
}

// Buka modal edit
function openEditModal(taskId, taskName, difficulty, weight) {
    const modal = document.getElementById('editTaskModal');
    document.getElementById('editTaskId').value = taskId;
    document.getElementById('editTaskName').value = taskName;
    document.getElementById('editDifficulty').value = difficulty;
    document.getElementById('editWeight').value = weight;
    modal.style.display = 'block';
}

// Tutup modal edit
function closeEditModal() {
    const modal = document.getElementById('editTaskModal');
    modal.style.display = 'none';
    document.getElementById('editTaskForm').reset();
}

// Event listener untuk tombol close
const closeBtn = document.querySelector('.close');
if (closeBtn) {
    closeBtn.addEventListener('click', closeModal);
}

// Tutup modal jika klik di luar modal
window.addEventListener('click', function(event) {
    const taskModal = document.getElementById('taskModal');
    const editModal = document.getElementById('editTaskModal');
    
    if (event.target == taskModal) {
        closeModal();
    }
    
    if (event.target == editModal) {
        closeEditModal();
    }
});

// Smooth scroll
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function(e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
            target.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }
    });
});