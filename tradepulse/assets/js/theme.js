(function(){
  var header = document.querySelector('.site-header');
  var menuToggle = document.querySelector('.menu-toggle');
  var navigation = document.querySelector('.main-navigation');

  function updateHeader() {
    if (header) {
      header.classList.toggle('is-scrolled', window.scrollY > 12);
    }
  }

  if (menuToggle && navigation) {
    menuToggle.addEventListener('click', function(){
      var isOpen = navigation.classList.toggle('is-open');
      menuToggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
    });
  }

  // Reveal elements without relying on heavy frameworks
  function reveal() {
    document.querySelectorAll('.will-reveal').forEach(function(el){
      el.classList.add('is-visible');
    });
  }

  // Simple market value updater: looks for elements with data-base-value and sets text
  function updateMarketValues(){
    document.querySelectorAll('[data-base-value]').forEach(function(el){
      var v = el.getAttribute('data-base-value');
      if(v){ el.textContent = (parseFloat(v) >= 0 ? '+' : '') + parseFloat(v).toFixed(2) + '%'; }
    });
  }

  // Run on DOM ready
  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', function(){ reveal(); updateMarketValues(); updateHeader(); });
  } else {
    reveal(); updateMarketValues(); updateHeader();
  }

  window.addEventListener('scroll', updateHeader, { passive: true });
})();
