    // Efek tombol "selesai"
document.querySelectorAll(".btn").forEach((button) => {
  button.addEventListener("click", () => {
    button.innerText = "✔ selesai";
    button.style.background = "#8e24aa";
    button.style.color = "white";
  });
});