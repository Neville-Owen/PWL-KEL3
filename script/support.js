// support.js
document.addEventListener('DOMContentLoaded', function() {
  const kirimBtn = document.getElementById('kirim-btn');
  const feedbackInput = document.getElementById('feedback');
  const overlay = document.getElementById('overlay');

  kirimBtn.addEventListener('click', function() {
    const inputValue = feedbackInput.value.trim();

    if (inputValue === "") {
      alert("Umpan balik kosong");
    } else {
      overlay.style.display = "flex";
      setTimeout(function() {
        overlay.style.display = "none";
        feedbackInput.value = "";
      }, 2000);
    }
  });

  // Optional: Submit on Enter key
  feedbackInput.addEventListener('keypress', function(e) {
    if (e.key === 'Enter') {
      kirimBtn.click();
    }
  });
});