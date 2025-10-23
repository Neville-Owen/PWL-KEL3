document.querySelectorAll('.transition-link').forEach(link => {
  link.addEventListener('click', function(e) {
    e.preventDefault();
    const target = this.getAttribute('href');
    
    document.body.classList.add('fade-out');
    
    setTimeout(() => {
      window.location.href = target;
    }, 300);
  });
});

function isValidEmail(email) {
  const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  return emailRegex.test(email);
}

function isValidPassword(password) {
  return password.length >= 6;
}

document.getElementById("registerBtn").addEventListener("click", function(e) {
  e.preventDefault();

  const fullname = document.getElementById("fullname").value.trim();
  const email = document.getElementById("email").value.trim();
  const username = document.getElementById("username").value.trim();
  const password = document.getElementById("password").value.trim();
  const confirmPassword = document.getElementById("confirmPassword").value.trim();

  if (fullname === "" || email === "" || username === "" || password === "" || confirmPassword === "") {
    alert("Semua field harus diisi!");
    return;
  }

  if (!isValidEmail(email)) {
    alert("Format email tidak valid!");
    return;
  }

  if (!isValidPassword(password)) {
    alert("Password minimal 6 karakter!");
    return;
  }

  if (password !== confirmPassword) {
    alert("Password dan konfirmasi password tidak sama!");
    return;
  }

  const userData = {
    fullname: fullname,
    email: email,
    username: username,
    password: password
  };

  const existingUsers = JSON.parse(localStorage.getItem('users') || '[]');
  const userExists = existingUsers.some(user => 
    user.username === username || user.email === email
  );

  if (userExists) {
    alert("Username atau email sudah terdaftar!");
    return;
  }

  existingUsers.push(userData);
  localStorage.setItem('users', JSON.stringify(existingUsers));

  alert("Registrasi berhasil! 🎉");
  window.location.href = "login.HTML";
});