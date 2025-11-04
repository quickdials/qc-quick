document.addEventListener("DOMContentLoaded", () => {
  // Mobile sidebar functionality
  const secondBtn = document.getElementById("second-menu-btn");
  const secondSidebar = document.getElementById("second-mobile-sidebar");

  if (secondBtn && secondSidebar) {
    secondBtn.addEventListener("click", () => {
      secondSidebar.classList.toggle("show");
    });
  }

  // Second Mobile sidebar functionality
  const btn = document.getElementById("menu-btn");
  const menu = document.getElementById("mobile-menu");

  if (btn && menu) {
    btn.addEventListener("click", () => {
      menu.classList.toggle("show");
    });
  }

  // Scroll animations
  const observer = new IntersectionObserver(
    (entries, obs) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          entry.target.classList.add("show-animation-sectionss");
          obs.unobserve(entry.target);
        }
      });
    },
    { threshold: 0.15 }
  );

  document.querySelectorAll(".animation-sectionss").forEach((el) => observer.observe(el));

  // ✅ Dropdown logic
  window.toggleDropdown = function () {
    const dropdown = document.getElementById("locationDropdown");
    dropdown.style.display =
      dropdown.style.display === "block" ? "none" : "block";
  };

  // ✅ Close dropdown when clicking outside
  document.addEventListener("click", function (e) {
    const inputBox = document.querySelector(".second-location-input");
    const dropdown = document.getElementById("locationDropdown");
    if (!inputBox.contains(e.target) && !dropdown.contains(e.target)) {
      dropdown.style.display = "none";
    }
  });
  
});
