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

function handleCredentialResponse(response) {
  const responsePayload = parseJwt(response.credential);
  
  console.log("ID: " + responsePayload.sub);
  console.log('Full Name: ' + responsePayload.name);
  console.log('Email: ' + responsePayload.email);
  console.log("Image URL: " + responsePayload.picture);
  
  const googleUser = {
    fullname: responsePayload.name,
    email: responsePayload.email,
    username: responsePayload.email.split('@')[0],
    googleId: responsePayload.sub,
    picture: responsePayload.picture
  };
  
  localStorage.setItem('currentUser', JSON.stringify(googleUser));
  localStorage.setItem('loginMethod', 'google');
  
  alert("Login dengan Google berhasil! 🎉");
  window.location.href = "beranda.html";
}

function parseJwt(token) {
  const base64Url = token.split('.')[1];
  const base64 = base64Url.replace(/-/g, '+').replace(/_/g, '/');
  const jsonPayload = decodeURIComponent(atob(base64).split('').map(function(c) {
    return '%' + ('00' + c.charCodeAt(0).toString(16)).slice(-2);
  }).join(''));
  return JSON.parse(jsonPayload);
}

document.getElementById("loginBtn").addEventListener("click", function(e) {
  e.preventDefault();

  const usernameOrEmail = document.getElementById("username").value.trim();
  const password = document.getElementById("password").value.trim();

  if (usernameOrEmail === "" || password === "") {
    alert("Isi username/email dan password!");
    return;
  }

  const users = JSON.parse(localStorage.getItem('users') || '[]');
  
  const user = users.find(u => 
    (u.username === usernameOrEmail || u.email === usernameOrEmail) && 
    u.password === password
  );

  if (user) {
    localStorage.setItem('currentUser', JSON.stringify(user));
    localStorage.setItem('loginMethod', 'normal');
    
    alert("Login berhasil! 🎉");
    window.location.href = "beranda.html";
  } else {
    alert("Username/email atau password salah!");
  }
});

document.querySelector('.forgot').addEventListener('click', function(e) {
  e.preventDefault();
  alert("Fitur reset password akan segera hadir!");
});