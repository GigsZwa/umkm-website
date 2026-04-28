/**
 * Simple JavaScript UMKM
 * - Toggle mobile menu
 * - Smooth scroll (sudah di CSS, tambahan fallback)
 * - Form validation
 * - Fade-in animation on scroll
 */
document.addEventListener('DOMContentLoaded', () => {
  // === MOBILE MENU TOGGLE ===
  const hamburger = document.getElementById('hamburger');
  const navMenu = document.getElementById('nav-menu');
  if (hamburger && navMenu) {
    hamburger.addEventListener('click', () => {
      navMenu.classList.toggle('active');
    });
    // Tutup menu saat link diklik
    navMenu.querySelectorAll('.nav-link').forEach(link => {
      link.addEventListener('click', () => {
        navMenu.classList.remove('active');
      });
    });
  }

  // === FORM VALIDATION (client-side) ===
  const form = document.getElementById('contactForm');
  if (form) {
    form.addEventListener('submit', function(e) {
      let valid = true;
      const nama = document.getElementById('nama');
      const email = document.getElementById('email');
      const pesan = document.getElementById('pesan');
      // Reset
      clearErrors();
      if (nama.value.trim().length < 3) {
        showError(nama, 'Nama minimal 3 karakter');
        valid = false;
      }
      if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email.value)) {
        showError(email, 'Email tidak valid');
        valid = false;
      }
      if (pesan.value.trim().length < 10) {
        showError(pesan, 'Pesan minimal 10 karakter');
        valid = false;
      }
      if (!valid) e.preventDefault();
    });
  }

  function showError(input, msg) {
    input.style.borderColor = '#e74c3c';
    const small = input.parentElement.querySelector('.error-msg');
    if (small) small.remove();
    const error = document.createElement('small');
    error.className = 'error-msg';
    error.style.color = '#e74c3c';
    error.textContent = msg;
    input.parentElement.appendChild(error);
  }
  function clearErrors() {
    document.querySelectorAll('.error-msg').forEach(el => el.remove());
    document.querySelectorAll('#contactForm input, #contactForm textarea').forEach(i => i.style.borderColor = '#ddd');
  }

  // === FADE-IN ANIMATION ON SCROLL ===
  const faders = document.querySelectorAll('.fade-in');
  const appearOptions = { threshold: 0.15, rootMargin: "0px 0px -50px 0px" };
  const appearOnScroll = new IntersectionObserver(function(entries, observer) {
    entries.forEach(entry => {
      if (!entry.isIntersecting) return;
      entry.target.style.opacity = 1;
      entry.target.style.transform = 'translateY(0)';
      observer.unobserve(entry.target);
    });
  }, appearOptions);
  faders.forEach(fader => {
    fader.style.opacity = 0;
    fader.style.transform = 'translateY(20px)';
    fader.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
    appearOnScroll.observe(fader);
  });
});