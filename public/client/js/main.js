document.addEventListener("DOMContentLoaded", () => {
   const secondBtn = document.getElementById("second-menu-btn");
  const secondSidebar = document.getElementById("second-mobile-sidebar");

  if (secondBtn && secondSidebar) {
    secondBtn.addEventListener("click", () => {
      secondSidebar.classList.toggle("show");
    });
  }

    const btn = document.getElementById("menu-btn");
  const menu = document.getElementById("mobile-menu");

  if (btn && menu) {
    btn.addEventListener("click", () => {
      menu.classList.toggle("show");
    });
  }

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

 window.toggleDropdown = function () {
    const dropdown = document.getElementById("locationDropdown");
    dropdown.style.display =
      dropdown.style.display === "block" ? "none" : "block";
  };

 document.addEventListener("click", function (e) {
    const inputBox = document.querySelector(".second-location-input");
    const dropdown = document.getElementById("locationDropdown");
    if (!inputBox.contains(e.target) && !dropdown.contains(e.target)) {
      dropdown.style.display = "none";
    }
  });
document.addEventListener("DOMContentLoaded", () => {
    let wrapper = document.querySelector(".course-logo");
    let slides = wrapper ? wrapper.getElementsByClassName("course-image-slide") : [];

   if (!slides || slides.length === 0) {
        wrapper.innerHTML += `
            <img src="/client/images/dummy.jpg" class="dummy-img" alt="Dummy" style="width:100%;object-fit:cover;">
        `;
        return;
    }

    
    if (slides.length === 1) {
        let prev = document.querySelector(".prev");
        let next = document.querySelector(".next");
        if (prev) prev.style.display = "none";
        if (next) next.style.display = "none";
    }

    
    let slideIndex = 1;
    showSlides(slideIndex);

    window.plusSlides = function (n) {
        showSlides(slideIndex += n);
    };

    function showSlides(n) {
        if (!slides || slides.length === 0) return;

        if (n > slides.length) slideIndex = 1;
        if (n < 1) slideIndex = slides.length;

        for (let i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";
        }

        slides[slideIndex - 1].style.display = "block";
    }

});


});
