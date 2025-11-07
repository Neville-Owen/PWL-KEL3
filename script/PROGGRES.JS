// Handle logo image error
document.addEventListener('DOMContentLoaded', function() {
    const logoImage = document.getElementById('logoImage');
    
    if (logoImage) {
        logoImage.onerror = function() {
            this.style.display = 'none';
            this.parentElement.innerHTML = '<span style="font-size: 20px; font-weight: bold; color: #4a148c;">Q</span>';
        };
    }

    // Set all progress bars to 0% first
    const progressBars = document.querySelectorAll('.progress-bar');
    progressBars.forEach(bar => {
        bar.dataset.originalWidth = bar.style.width;
        bar.style.width = '0%';
    });

    // Animate bars slowly from 0%
    setTimeout(() => {
        progressBars.forEach(bar => {
            bar.style.width = bar.dataset.originalWidth || '0%';
        });
    }, 300);

    // Tambahkan otomatis box soal untuk progress bar yang belum punya tugas
    autoAddMissingTasks();

    // Initialize buttons
    initializeButtons();
});

// ✅ Tambahkan otomatis soal untuk progress bar yang belum punya tugas
function autoAddMissingTasks() {
    const subjects = {
        bahasa_inggris: {
            title: 'Bahasa Inggris',
            desc: 'Kerjakan latihan teks deskriptif tentang “My Favorite Place”.'
        },
        bahasa_indonesia: {
            title: 'Bahasa Indonesia',
            desc: 'Tulis teks eksposisi bertema lingkungan sekolah dengan minimal 3 paragraf.'
        },
        ipas: {
            title: 'IPAS',
            desc: 'Amati proses daur air di lingkungan rumahmu dan tulis hasil pengamatanmu.'
        }
    };

    const main = document.querySelector('main');
    if (!main) return;

    // Buat section baru di bawah tugas terakhir
    const section = document.createElement('section');
    section.className = 'task-section';
    section.innerHTML = <h2>Tugas Tambahan</h2>;

    // Tambahkan 3 tugas baru
    for (let key in subjects) {
        const s = subjects[key];
        const div = document.createElement('div');
        div.className = 'task-card';
        div.dataset.subject = key;
        div.innerHTML = `
            <div class="task-header">
                <h3>${s.title}</h3>
                <div class="menu-dots">⋮</div>
            </div>
            <p>${s.desc}</p>
            <div class="task-actions">
                <button class="btn-edit">Edit</button>
                <button class="btn-delete">Delete</button>
                <button class="btn-select">Select</button>
            </div>
        `;
        section.appendChild(div);
    }

    main.appendChild(section);
}

// Initialize all buttons
function initializeButtons() {
    document.querySelectorAll('.btn-delete').forEach(btn => {
        btn.addEventListener('click', handleDelete);
    });

    document.querySelectorAll('.btn-edit').forEach(btn => {
        btn.addEventListener('click', handleEdit);
    });

    document.querySelectorAll('.menu-dots').forEach(btn => {
        btn.addEventListener('click', handleMenu);
    });

    document.querySelectorAll('.btn-select').forEach(btn => {
        btn.addEventListener('click', handleSelect);
    });
}

// Delete task
function handleDelete() {
    if (confirm('Apakah Anda yakin ingin menghapus tugas ini?')) {
        const card = this.closest('.task-card');
        card.style.opacity = '0';
        card.style.transform = 'scale(0.8)';
        setTimeout(() => card.remove(), 300);
    }
}

// Edit task
function handleEdit() {
    const card = this.closest('.task-card');
    const desc = card.querySelector('p').textContent;
    const newDesc = prompt('Edit deskripsi tugas:', desc);
    if (newDesc !== null && newDesc.trim() !== '') {
        card.querySelector('p').textContent = newDesc;
        alert('Tugas berhasil diperbarui!');
    }
}

// Menu dots
function handleMenu() {
    const choice = prompt('Pilih opsi:\n1. Tandai prioritas\n2. Pindahkan folder\n3. Duplikat\n4. Batal');
    switch (choice) {
        case '1':
            alert('Ditandai prioritas!');
            break;
        case '2':
            alert('Fitur pindah folder belum aktif.');
            break;
        case '3':
            alert('Tugas berhasil diduplikat!');
            break;
        default:
            break;
    }
}

// ✅ Select task → tambah progress bar
function handleSelect() {
    const btn = this;
    const subject = btn.closest('.task-card').dataset.subject;
    const progressBar = document.querySelector(progress-bar[data-subject = "${subject}"]);

    if (!progressBar) return;

    let current = parseFloat(progressBar.style.width) || 0;
    current += 1;
    if (current > 100) current = 100;

    progressBar.style.width = current + '%';

    // Tombol animasi
    btn.textContent = 'Selected';
    btn.style.background = 'white';
    btn.style.color = '#4a148c';
    btn.style.border = 'none';

    setTimeout(() => {
        btn.textContent = 'Select';
        btn.style.background = 'transparent';
        btn.style.color = 'white';
        btn.style.border = '2px solid white';
    }, 1000);
}

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