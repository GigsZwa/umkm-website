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

// === PRODUK ===================================
(function() {
    const grid = document.getElementById('productGrid');
    const searchInput = document.getElementById('searchInput');
    const sortSelect = document.getElementById('sortSelect');
    const filterBtns = document.querySelectorAll('.filter-pill:not(.kategori-pill)');
    const kategoriTabs = document.querySelectorAll('.kategori-pill');
    const resultCount = document.getElementById('resultCount');
    const emptyFilter = document.getElementById('emptyFilter');

    if (!grid) return;

    // Ambil kategori dari URL
    const urlParams = new URLSearchParams(window.location.search);
    let activeKategori = urlParams.get('kategori') || 'all';
    let activeBestFilter = 'all';

    // Set kategori awal
    kategoriTabs.forEach(tab => {
      tab.classList.toggle('active', tab.dataset.kategori === activeKategori);
    });

    function getCards() {
      return Array.from(grid.querySelectorAll('.product-card'));
    }

    function applyFilters() {
      const query = searchInput.value.toLowerCase().trim();
      const sort = sortSelect.value;
      let cards = getCards();

      // SORT
      cards.sort((a, b) => {
        if (sort === 'harga-asc') return +a.dataset.harga - +b.dataset.harga;
        if (sort === 'harga-desc') return +b.dataset.harga - +a.dataset.harga;
        if (sort === 'nama-asc') return a.dataset.nama.localeCompare(b.dataset.nama);
        return 0;
      });
      cards.forEach(c => grid.appendChild(c));

      // FILTER
      let visible = 0;
      cards.forEach(card => {
        const matchSearch = !query || card.dataset.nama.includes(query);
        const matchBest = activeBestFilter === 'all' || (activeBestFilter === 'best' && card.dataset.bestseller === 'true');
        const matchKategori = activeKategori === 'all' || card.dataset.kategori === activeKategori;

        const show = matchSearch && matchBest && matchKategori;
        card.style.display = show ? '' : 'none';

        if (show) visible++;
      });

      // RESULT
      resultCount.textContent = visible + ' produk ditemukan';
      emptyFilter.style.display = visible === 0 ? 'flex' : 'none';
      grid.style.display = visible === 0 ? 'none' : '';

      // UPDATE URL
      const newUrl = new URL(window.location.href);
      if (activeKategori === 'all') {
        newUrl.searchParams.delete('kategori');
      } else {
        newUrl.searchParams.set('kategori', activeKategori);
      }
      window.history.replaceState(null, '', newUrl.toString());

      // AUTO RESET VISUAL (opsional tapi rapi)
      if (
        activeKategori === 'all' &&
        activeBestFilter === 'all' &&
        !searchInput.value &&
        sortSelect.value === 'default'
      ) {
        kategoriTabs.forEach(t => t.classList.remove('active'));
        kategoriTabs[0].classList.add('active');
        filterBtns.forEach(b => b.classList.remove('active'));
      }
    }

    // === KATEGORI TOGGLE ===
    kategoriTabs.forEach(tab => {
      tab.addEventListener('click', () => {
        const isActive = tab.classList.contains('active');

        kategoriTabs.forEach(t => t.classList.remove('active'));

        if (isActive) {
          activeKategori = 'all';
          kategoriTabs[0].classList.add('active'); // balik ke semua
        } else {
          tab.classList.add('active');
          activeKategori = tab.dataset.kategori;
        }

        applyFilters();
      });
    });

    // === BEST SELLER TOGGLE ===
    filterBtns.forEach(btn => {
      btn.addEventListener('click', () => {
        const isActive = btn.classList.contains('active');

        filterBtns.forEach(b => b.classList.remove('active'));

        if (isActive) {
          activeBestFilter = 'all';
        } else {
          btn.classList.add('active');
          activeBestFilter = btn.dataset.filter;
        }

        applyFilters();
      });
    });

    // === INPUT EVENTS ===
    searchInput.addEventListener('input', applyFilters);
    sortSelect.addEventListener('change', applyFilters);

    // INIT
    applyFilters();

    // RESET MANUAL
    window.resetFilter = function() {
      searchInput.value = '';
      sortSelect.value = 'default';

      filterBtns.forEach(b => b.classList.remove('active'));
      kategoriTabs.forEach(t => t.classList.remove('active'));

      kategoriTabs[0].classList.add('active');

      activeBestFilter = 'all';
      activeKategori = 'all';

      applyFilters();
    };

  })();

  // === Index Page ===================================
 // Salin kode promo ke clipboard
  function copyPromo(btn) {
    const code = btn.dataset.code;
    navigator.clipboard.writeText(code).then(() => {
      const orig = btn.textContent;
      btn.textContent = '✓ Disalin!';
      btn.classList.add('copied');
      setTimeout(() => {
        btn.textContent = orig;
        btn.classList.remove('copied');
      }, 2000);
    });
  }

  (function() {
    const btns = document.querySelectorAll('.produk-filter-btn');
    const cards = document.querySelectorAll('#productGrid .product-card');
    const empty = document.getElementById('emptyState');

    btns.forEach(btn => {
      btn.addEventListener('click', () => {
        btns.forEach(b => b.classList.remove('active'));
        btn.classList.add('active');

        const filter = btn.dataset.filter;
        let visible = 0;

        cards.forEach(card => {
          const match = filter === 'Semua' || card.dataset.kategori === filter;
          if (match) {
            card.style.display = '';
            card.style.animation = 'none';
            void card.offsetWidth; // reflow
            card.style.animation = '';
            card.style.animationDelay = (visible * 0.07) + 's';
            visible++;
          } else {
            card.style.display = 'none';
          }
        });

        empty.style.display = visible === 0 ? 'flex' : 'none';
      });
    });
  })();

    // === Detail Porduk ===================================
    // Tab switching
document.querySelectorAll('.spec-tab-btn').forEach(btn => {
  btn.addEventListener('click', () => {
    document.querySelectorAll('.spec-tab-btn').forEach(b => b.classList.remove('active'));
    document.querySelectorAll('.spec-tab-content').forEach(c => c.classList.remove('active'));
    btn.classList.add('active');
    document.getElementById('tab-' + btn.dataset.tab).classList.add('active');
  });
});

// Share
function shareProduct() {
  if (navigator.share) {
    navigator.share({
      title: document.title,
      url: window.location.href
    });
  } else {
    navigator.clipboard.writeText(window.location.href).then(() => {
      const btn = document.querySelector('.btn-share');
      btn.innerHTML = '✓';
      setTimeout(() => btn.innerHTML = `<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="18" height="18"><circle cx="18" cy="5" r="3"/><circle cx="6" cy="12" r="3"/><circle cx="18" cy="19" r="3"/><path d="m8.59 13.51 6.83 3.98M15.41 6.51l-6.82 3.98"/></svg>`, 2000);
    });
  }
}