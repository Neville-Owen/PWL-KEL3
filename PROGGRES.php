<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Questify - Progress</title>
    
    <!-- Google Font - Kdam Thmor Pro -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kdam+Thmor+Pro&display=swap" rel="stylesheet">
    
    <!-- CSS -->
    <link rel="stylesheet" href="PROGGRES.CSS">
</head>
<body>
    <header>
        <nav>
            <div class="logo">
                <div class="logo-container">
                    <!-- Ganti src dengan path logo Anda -->
                    <img src="gambar/logo.png" alt="Logo Questify" id="logoImage">
                </div>
                
            </div>
            <ul>
                <li><a href="beranda.html">Beranda</a></li>
                <li><a href="misi.html">Misi</a></li>
                <li><a href="progress.html">Progress</a></li>
                <li><a href="bantuan.html">Bantuan</a></li>
                <li><a href="masuk.html">Masuk</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <h1>Progress</h1>

        <!-- Progress Bars Section -->
        <div class="progress-section">
            <div class="progress-item">
                <div class="progress-bar-container">
                    <div class="progress-bar" style="width: 10%;">10%</div>
                </div>
            </div>

            <div class="progress-item">
                <div class="progress-bar-container">
                    <div class="progress-bar" style="width: 0%;">Bahasa Inggris</div>
                </div>
            </div>

            <div class="progress-item">
                <div class="progress-bar-container">
                    <div class="progress-bar" style="width: 15%;">MTK</div>
                </div>
            </div>

            <div class="progress-item">
                <div class="progress-bar-container">
                    <div class="progress-bar" style="width: 20%;">IPA</div>
                </div>
            </div>

            <div class="progress-item">
                <div class="progress-bar-container">
                    <div class="progress-bar" style="width: 35%;">Bahasa Indonesia</div>
                </div>
            </div>

            <div class="progress-item">
                <div class="progress-bar-container">
                    <div class="progress-bar" style="width: 25%;">IPAS</div>
                </div>
            </div>
        </div>

        <!-- Terselesaikan Section -->
        <div class="task-section">
            <h2>Terselesaikan</h2>

            <div class="task-card">
                <div class="task-info">
                    <h3>Mudah</h3>
                    <p>mengerjakan latihan soal yang tertera pada buku paket</p>
                </div>
                <div class="task-actions">
                    <button class="btn-select">selected</button>
                </div>
            </div>

            <div class="task-card">
                <div class="task-info">
                    <h3>Mudah</h3>
                    <p>Rangkum tentang 3 hukum newton dan berikan contohnya</p>
                </div>
                <div class="task-actions">
                    <button class="btn-select">selected</button>
                </div>
            </div>

            <div class="task-card">
                <div class="task-info">
                    <h3>Sulit</h3>
                    <p>mengerjakan pararellel 1 - 10</p>
                </div>
                <div class="task-actions">
                    <button class="btn-select">selected</button>
                </div>
            </div>
        </div>

        <!-- Riwayat Section -->
        <div class="task-section">
            <h2>Riwayat</h2>

            <div class="task-card">
                <div class="task-info">
                    <h3>Sedang</h3>
                    <p>mengerjakan 5 soal dari buku paket sejarah indonesia</p>
                </div>
                <div class="task-actions">
                    <button class="btn-delete">hapus</button>
                    <button class="btn-edit">✏️</button>
                    <button class="menu-dots">⋮</button>
                </div>
            </div>

            <div class="task-card">
                <div class="task-info">
                    <h3>Mudah</h3>
                    <p>mengamati tiga fenomena fisika dalam kehidupan</p>
                </div>
                <div class="task-actions">
                    <button class="btn-delete">hapus</button>
                    <button class="btn-edit">✏️</button>
                    <button class="menu-dots">⋮</button>
                </div>
            </div>

            <div class="task-card">
                <div class="task-info">
                    <h3>Sulit</h3>
                    <p>mengerjakan pararellel 1 - 10</p>
                </div>
                <div class="task-actions">
                    <button class="btn-delete">hapus</button>
                    <button class="btn-edit">✏️</button>
                    <button class="menu-dots">⋮</button>
                </div>
            </div>
        </div>
    </main>

    <!-- JavaScript -->
    <script src="PROGGRES.JS"></script>
</body>
</html>