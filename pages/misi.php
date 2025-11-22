<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Questify</title>
  <link href="https://fonts.googleapis.com/css2?family=Kdam+Thmor+Pro&display=swap" rel="stylesheet">
  <style>
    /* ===== Global ===== */
    body {
      margin: 0;
      font-family: "Kdam Thmor Pro", cursive;
      background: linear-gradient(180deg, #3f0071, #6a0dad, #7b1fa2);
      color: white;
    }

    header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      background: rgba(40, 0, 80, 0.6);
      padding: 15px 50px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.3);
    }

    .logo {
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .logo-img {
      width: 70px;
      height: 70px;
    }

    header h1 {
      font-size: 20px;
      font-weight: 600;
    }

    nav a {
      color: white;
      text-decoration: none;
      margin-left: 25px;
      font-weight: 500;
      transition: 0.3s;
    }

    nav a:hover {
      color: #ffd54f;
    }

    main {
      padding: 30px 60px;
    }

    /* ===== Profile Card ===== */
    .profile-card {
      background-color: rgba(255,255,255,0.05);
      border-radius: 12px;
      padding: 15px;
      margin-bottom: 50px;
    }

    .profile-info {
      display: flex;
      align-items: center;
      justify-content: space-between;
    }

    .avatar img {
      width: 150px;
      height: 140px;
      border-radius: 50%;
      background-color: transparent;
    }

    .details {
      flex: 1;
      margin-left: 30px;
      font-size: 16px;
    }

    .rank-icon {
      text-align: center;
    }

    .rank-icon img {
      width: 120px;
    }

    .rank-icon p {
      margin-top: 8px;
      font-weight: 600;
    }

    /* ===== Missions ===== */
    .missions h2,
    .kategori h2 {
      font-size: 25px;
      margin-bottom: 20px;
    }

    .mission {
      display: flex;
      align-items: center;
      justify-content: space-between;
      background: rgba(255,255,255,0.08);
      padding: 15px 20px;
      border-radius: 12px;
      margin-bottom: 15px;
      border: 1px solid rgba(255,255,255,0.1);
    }

    .mission p {
      flex: 1;
      font-size: 15px;
    }

    .reward {
      color: #ffd54f;
      font-weight: 600;
      margin-right: 20px;
    }

    .btn {
      background: white;
      color: #4a148c;
      border: none;
      padding: 7px 18px;
      border-radius: 20px;
      cursor: pointer;
      font-weight: 600;
      transition: 0.3s;
    }

    .btn:hover {
      background: #ba68c8;
      color: white;
    }

    .btn:disabled {
      background: #8e24aa;
      color: white;
      cursor: not-allowed;
    }

    .character {
      text-align: right;
      margin-top: 30px;
    }

    .character img {
      width: 120px;
      image-rendering: pixelated;
    }

    /* ===== Category Section ===== */
    .kategori {
      margin-top: 60px;
    }

    .category-buttons {
      display: flex;
      flex-wrap: wrap;
      gap: 10px;
      margin-bottom: 25px;
    }

    .category-buttons button {
      background: rgba(255,255,255,0.1);
      border: none;
      color: white;
      padding: 8px 16px;
      border-radius: 10px;
      font-weight: 500;
      cursor: pointer;
      transition: 0.3s;
    }

    .category-buttons button:hover {
      background: #5e35b1;
    }

    .kategori h3 {
      margin-top: 25px;
      margin-bottom: 15px;
      font-size: 20px;
    }

    /* ===== Footer ===== */
    footer {
      background: #2e004f;
      margin-top: 60px;
      padding: 40px 60px;
      border-top: 2px solid rgba(255,255,255,0.1);
    }

    .footer-content {
      display: flex;
      justify-content: space-around;
      flex-wrap: wrap;
      margin-bottom: 20px;
    }

    .footer-content h4 {
      margin-bottom: 10px;
      font-weight: 600;
    }

    .footer-content p {
      color: #ddd;
      font-size: 14px;
      line-height: 1.6;
    }

    footer .copyright {
      text-align: center;
      font-size: 13px;
      color: #ccc;
      margin-top: 20px;
    }

    /* ===== Notification Animations ===== */
    @keyframes slideIn {
      from { 
        transform: translateX(400px); 
        opacity: 0; 
      }
      to { 
        transform: translateX(0); 
        opacity: 1; 
      }
    }

    @keyframes slideOut {
      from { 
        transform: translateX(0); 
        opacity: 1; 
      }
      to { 
        transform: translateX(400px); 
        opacity: 0; 
      }
    }

    @keyframes levelUp {
      0%, 100% { 
        transform: scale(1); 
      }
      50% { 
        transform: scale(1.05); 
      }
    }

    .level-up-animation {
      animation: levelUp 0.5s ease-in-out;
    }

    @keyframes slideInMission {
      from {
        transform: translateY(-20px);
        opacity: 0;
      }
      to {
        transform: translateY(0);
        opacity: 1;
      }
    }

    .mission.new-mission {
      animation: slideInMission 0.5s ease-out;
    }
  </style>
</head>
<body>
  <header>
    <div class="logo">
      <img src="gambar/logo.png" alt="Logo" class="logo-img">
    </div>
    <nav>
      <a href="beranda.php">Beranda</a>
      <a href="misi.php">Misi</a>
      <a href="proggres.php">Progress</a>
      <a href="support.php">Support</a>
      
    </nav>
  </header>
 
  <main>
    <section class="profile-card">
      <div class="profile-info">
        <div class="avatar">
          <img src="gambar/Profile-removebg-preview (1).png" alt="User Avatar">
        </div>
        <div class="details">
          <p><strong>Nama:</strong> User</p>
          <p><strong>Rank:</strong> Novice</p>
          <p><strong>Exp:</strong> 0/100 Exp</p>
          <p><strong>Point:</strong> 0 point</p>
        </div>
        <div class="rank-icon">
          <img id="rankImage" src="gambar/novice1.png" alt="Novice">
        </div>
      </div>
    </section>
 
    <!-- Bagian Umum -->
    <section class="missions">
      <h2>Umum</h2>
      <div id="generalMissions">
        <div class="mission"><p>menulis ringkasan tentang materi yang disampaikan di kelas</p><span class="reward">+100 exp & 150 p</span><button class="btn">selesai</button></div>
        <div class="mission"><p>menonton 3 video edukasi </p><span class="reward">+50 exp & 200 p</span><button class="btn">selesai</button></div>
        <div class="mission"><p>Membaca buku 3 halaman</p><span class="reward">+50 exp & 100 p</span><button class="btn">selesai</button></div>
      </div>
      <div class="character"><img src="gambar/Ksatria Hitam.png" alt="Karakter Ksatria"></div>
    </section>
 
    <!-- Bagian Kategori -->
    <section class="kategori">
      <h2>Kategori</h2>
      <div class="category-buttons">
        <button>IPS</button>
        <button>Bahasa Inggris</button>
        <button>MTK</button>
        <button>IPA</button>
        <button>PPKN</button>
        <button>Bahasa Indonesia</button>
      </div>
 
      <h3>Mudah</h3>
      <div id="easyMissions">
        <div class="mission"><p>menghafal 5 flora dan 5 fauna yang terancam punah</p><span class="reward">+25 exp & 50 p</span><button class="btn">selesai</button></div>
        <div class="mission"><p>mengetahui apa saja iklim yang ada di dunia</p><span class="reward">+25 exp & 70 p</span><button class="btn">selesai</button></div>
        <div class="mission"><p>menghafal 5 sila Pancasila</p><span class="reward">+50 exp & 100 p</span><button class="btn">selesai</button></div>
      </div>
 
      <h3>Sedang</h3>
      <div id="mediumMissions">
        <div class="mission"><p>mengetahui semua bentuk kerja sama ekonomi antar negara</p><span class="reward">+75 exp & 100 p</span><button class="btn">selesai</button></div>
        <div class="mission"><p>mengetahui 5 letak astronomis berbagai negara di dunia</p><span class="reward">+100 exp & 200 p</span><button class="btn">selesai</button></div>
        <div class="mission"><p>melihat 3 video tentang materi astronomis dan geografis</p><span class="reward">+120 exp & 200 p</span><button class="btn">selesai</button></div>
      </div>
      <div class="character"><img src="gambar/wizard.png" alt="Karakter Penyihir"></div>
    </section>
  </main>
 
  <!-- Footer -->
  <footer>
    <div class="footer-content">
      <div>
        <h4>Kelompok</h4>
        <p>Nama anggota<br>Nama anggota<br>Nama anggota</p>
      </div>
      <div>
        <h4>Bantuan</h4>
        <p>FAQ<br>Kontak<br>Dukungan</p>
      </div>
      <div>
        <h4>Komunitas</h4>
        <p>Forum<br>Discord<br>Events</p>
      </div>
      <div>
        <h4>Navigasi</h4>
        <p>Beranda<br>Progress<br>Masuk</p>
      </div>
    </div>
    <p class="copyright">Copyright © 2025 QUESTIFY</p>
  </footer>

  <script>
    // ========== RANK SYSTEM ==========
    const RANKS = [
      { name: 'Novice', minExp: 0, maxExp: 300, image: 'gambar/novice.png' },
      { name: 'Apprentice', minExp: 300, maxExp: 600, image: 'gambar/Apprentice-removebg-preview.png' },
      { name: 'Adept', minExp: 600, maxExp: 1000, image: 'gambar/Adept-removebg-preview.png' },
      { name: 'Expert', minExp: 1000, maxExp: 1500, image: 'gambar/Expert-removebg-preview.png' },
      { name: 'Master', minExp: 1500, maxExp: Infinity, image: 'gambar/Master-removebg-preview.png' }
    ];

    // ========== MISSION BANK ==========
    const MISSION_BANK = {
      general: [
        { text: 'Membuat catatan dari 5 halaman buku pelajaran', exp: 50, point: 80 },
        { text: 'Mendengarkan podcast edukasi selama 20 menit', exp: 60, point: 90 },
        { text: 'Membuat mind map dari materi hari ini', exp: 25, point: 20 },
        { text: 'Menjelaskan materi kepada teman dengan kata-kata sendiri', exp: 110, point: 160 },
        { text: 'Membaca artikel ilmiah dan membuat rangkuman', exp: 50, point: 55 },
        { text: 'Menonton dokumenter edukatif dan menulis review', exp: 25, point: 30 },
        { text: 'Mengerjakan latihan soal dari buku panduan', exp: 70, point: 110 }
      ],
      easy: [
        { text: 'Menghafal 10 kosakata bahasa Inggris baru', exp: 30, point: 60 },
        { text: 'Menghafalkan rumus dasar matematika', exp: 35, point: 70 },
        { text: 'Mengenal 5 pahlawan nasional Indonesia', exp: 40, point: 80 },
        { text: 'Menghafal tabel perkalian 1-5', exp: 45, point: 90 },
        { text: 'Membaca cerita rakyat dan menuliskan pesan moralnya', exp: 30, point: 60 }
      ],
      medium: [
        { text: 'Membuat presentasi singkat tentang sistem tata surya', exp: 35, point: 50 },
        { text: 'Menyelesaikan 10 soal matematika tingkat menengah', exp: 90, point: 150 },
        { text: 'Menulis esai 300 kata tentang lingkungan hidup', exp: 25, point: 50 },
        { text: 'Membuat percobaan sains sederhana dan dokumentasikan', exp: 40, point: 60 },
        { text: 'Menganalisis puisi dan menjelaskan maknanya', exp: 20, point: 40 }
      ]
    };

    // ========== INITIALIZE USER DATA ==========
    let userData = {
      name: 'User',
      exp: 0,
      point: 0,
      rank: 'Novice',
      completedCount: {
        general: 3,
        easy: 3,
        medium: 3
      }
    };

    // ========== GET RANK BASED ON EXP ==========
    function getRankByExp(exp) {
      for (let rank of RANKS) {
        if (exp >= rank.minExp && exp < rank.maxExp) {
          return rank;
        }
      }
      return RANKS[RANKS.length - 1];
    }

    // ========== UPDATE PROFILE DISPLAY ==========
    function updateProfileDisplay(userData) {
      const currentRank = getRankByExp(userData.exp);
      
      document.querySelector('.details p:nth-child(1)').innerHTML = 
        `<strong>Nama:</strong> ${userData.name}`;
      
      document.querySelector('.details p:nth-child(2)').innerHTML = 
        `<strong>Rank:</strong> ${currentRank.name}`;
      
      const expText = currentRank.maxExp === Infinity ? 'MAX' : currentRank.maxExp;
      document.querySelector('.details p:nth-child(3)').innerHTML = 
        `<strong>Exp:</strong> ${userData.exp}/${expText} Exp`;
      
      document.querySelector('.details p:nth-child(4)').innerHTML = 
        `<strong>Point:</strong> ${userData.point} point`;
      
      // Update rank image
      document.getElementById('rankImage').src = currentRank.image;
      document.getElementById('rankImage').alt = currentRank.name;
    }

    // ========== PARSE REWARD FROM TEXT ==========
    function parseReward(rewardText) {
      const expMatch = rewardText.match(/\+(\d+)\s*exp/i);
      const pointMatch = rewardText.match(/&\s*(\d+)\s*p/i);
      
      return {
        exp: expMatch ? parseInt(expMatch[1]) : 0,
        point: pointMatch ? parseInt(pointMatch[1]) : 0
      };
    }

    // ========== SHOW NOTIFICATION ==========
    function showNotification(message, type = 'success') {
      const notification = document.createElement('div');
      notification.textContent = message;
      notification.style.cssText = `
        position: fixed;
        top: 20px;
        right: 20px;
        background: ${type === 'success' ? '#4caf50' : '#f44336'};
        color: white;
        padding: 15px 25px;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.3);
        z-index: 1000;
        animation: slideIn 0.3s ease-out;
        font-weight: 600;
      `;
      
      document.body.appendChild(notification);
      
      setTimeout(() => {
        notification.style.animation = 'slideOut 0.3s ease-out';
        setTimeout(() => notification.remove(), 300);
      }, 3000);
    }

    // ========== ADD NEW MISSION ==========
    function addNewMission(category) {
      const missions = MISSION_BANK[category];
      const currentCount = userData.completedCount[category];
      
      if (currentCount < missions.length + 3) {
        const missionIndex = currentCount - 3;
        if (missionIndex >= 0 && missionIndex < missions.length) {
          const newMission = missions[missionIndex];
          
          let container;
          if (category === 'general') {
            container = document.getElementById('generalMissions');
          } else if (category === 'easy') {
            container = document.getElementById('easyMissions');
          } else if (category === 'medium') {
            container = document.getElementById('mediumMissions');
          }
          
          const missionDiv = document.createElement('div');
          missionDiv.className = 'mission new-mission';
          missionDiv.innerHTML = `
            <p>${newMission.text}</p>
            <span class="reward">+${newMission.exp} exp & ${newMission.point} p</span>
            <button class="btn">selesai</button>
          `;
          
          container.appendChild(missionDiv);
          
          const button = missionDiv.querySelector('.btn');
          button.addEventListener('click', () => completeTask(button, category));
        }
      }
    }

    // --- HANDLE TASK COMPLETION ---
    function completeTask(button, category) {
      const missionCard = button.closest('.mission');
      const rewardText = missionCard.querySelector('.reward').textContent;
      const reward = parseReward(rewardText);
      
      const oldRank = getRankByExp(userData.exp);
      
      userData.exp += reward.exp;
      userData.point += reward.point;
      userData.completedCount[category]++;
      
      const newRank = getRankByExp(userData.exp);
      userData.rank = newRank.name;
      
      updateProfileDisplay(userData);
      
      button.innerText = "✔ selesai";
      button.style.background = "#8e24aa";
      button.style.color = "white";
      button.disabled = true;
      
      showNotification(`+${reward.exp} EXP & +${reward.point} Point!`);
      
      if (oldRank.name !== newRank.name) {
        setTimeout(() => {
          showNotification(`🎉 RANK UP! Sekarang kamu ${newRank.name}!`, 'success');
          const profileCard = document.querySelector('.profile-card');
          profileCard.classList.add('level-up-animation');
          setTimeout(() => profileCard.classList.remove('level-up-animation'), 500);
        }, 500);
      }
      
      // Add new mission after 1 second
      setTimeout(() => {
        addNewMission(category);
      }, 1000);
    }

    // ========== INITIALIZE ON PAGE LOAD ==========
    function init() {
      updateProfileDisplay(userData);
      
      // Setup general missions
      document.querySelectorAll("#generalMissions .btn").forEach((button) => {
        button.addEventListener("click", () => completeTask(button, 'general'));
      });
      
      // Setup easy missions
      document.querySelectorAll("#easyMissions .btn").forEach((button) => {
        button.addEventListener("click", () => completeTask(button, 'easy'));
      });
      
      // Setup medium missions
      document.querySelectorAll("#mediumMissions .btn").forEach((button) => {
        button.addEventListener("click", () => completeTask(button, 'medium'));
      });
    }

    // Run on page load
    if (document.readyState === 'loading') {
      document.addEventListener('DOMContentLoaded', init);
    } else {
      init();
    }
  </script>
</body>
</html>
