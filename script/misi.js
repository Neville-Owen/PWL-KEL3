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

// ========== HANDLE TASK COMPLETION ==========
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
