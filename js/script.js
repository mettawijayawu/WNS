// Toggle class active
const navbarNav = document.querySelector(".navbar-nav");
// Ketika menu diklick
document.querySelector("#menu").onclick = () => {
  navbarNav.classList.toggle("active");
};

// Klick diluar sidebar untuk menghilangkan nav
const menu = document.querySelector("#menu");
document.addEventListener("click", function (e) {
  if (!menu.contains(e.target) && !navbarNav.contains(e.target)) {
    navbarNav.classList.remove("active");
  }
});

// Klick searchicon menampilkan/menghilangkan box
document.getElementById("search-icon").addEventListener("click", function (e) {
  e.preventDefault(); // Mencegah reload halaman
  const searchBox = document.getElementById("search-box");
  searchBox.classList.toggle("hidden"); // Toggle kelas hidden untuk tampil/sembunyi
});

// document.querySelectorAll(".menu-card").forEach(function (card) {
//   card.addEventListener("click", function () {
//     // Show the order box and the "Bayar" button
//     const orderBox = card.querySelector(".order-box");
//     const payButton = document.getElementById("pay-btn");
//     const totaltext = document.getElementById("overall-total");
//     orderBox.style.display = "block";
//     payButton.style.display = "block";
//     totaltext.style.display = "block";
//   });
// });

document.querySelectorAll(".minus-btn").forEach(function (minusBtn) {
  minusBtn.addEventListener("click", function () {
    const input = this.nextElementSibling;
    let value = parseInt(input.value);
    if (value > 0) {
      input.value = value - 1;
      calculateTotal(); // Pastikan calculateTotal dipanggil
    }
  });
});

document.querySelectorAll(".plus-btn").forEach(function (plusBtn) {
  plusBtn.addEventListener("click", function () {
    const input = this.previousElementSibling;
    input.value = parseInt(input.value) + 1;
    calculateTotal(); // Pastikan calculateTotal dipanggil
  });
});




