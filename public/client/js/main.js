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

  // FAQ accordion functionality
  // (function initFAQAccordion() {
  //   const faqListQuickdetails = document.getElementById("faqListQuickdetails");

  //   if (!faqListQuickdetails) {
  //     console.warn("FAQ list element not found");
  //     return;
  //   }

  //   faqListQuickdetails.addEventListener("click", function (e) {
  //     const btn = e.target.closest(".faq-question-quickdetails");
  //     if (!btn) return;

  //     const item = btn.closest(".faq-item-quickdetails");
  //     const currentlyOpen = faqListQuickdetails.querySelector(
  //       '.faq-item-quickdetails[data-open="true"]'
  //     );

  //     // Close previously open item if it's different
  //     if (currentlyOpen && currentlyOpen !== item) {
  //       closeFAQItem(currentlyOpen);
  //     }

  //     // Toggle current item
  //     const isOpen = item.getAttribute("data-open") === "true";
  //     if (isOpen) {
  //       closeFAQItem(item);
  //     } else {
  //       openFAQItem(item);
  //     }
  //   });

  //   function openFAQItem(item) {
  //     item.setAttribute("data-open", "true");
  //     const btn = item.querySelector(".faq-question-quickdetails");
  //     const icon = item.querySelector(".faq-icon-quickdetails");

  //     if (btn) btn.setAttribute("aria-expanded", "true");
  //     if (icon) icon.textContent = "−";
  //   }

  //   function closeFAQItem(item) {
  //     item.setAttribute("data-open", "false");
  //     const btn = item.querySelector(".faq-question-quickdetails");
  //     const icon = item.querySelector(".faq-icon-quickdetails");

  //     if (btn) btn.setAttribute("aria-expanded", "false");
  //     if (icon) icon.textContent = "+";
  //   }
  // })();
   const observer = new IntersectionObserver(
    (entries, obs) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          entry.target.classList.add("show-animation-sectionss");
          obs.unobserve(entry.target);
        }
      });
    },
    {
      threshold: 0.15, 
    }
  );

  document.querySelectorAll(".animation-sectionss").forEach((el) => observer.observe(el));
})