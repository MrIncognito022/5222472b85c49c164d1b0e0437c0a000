(function(){
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
    document.addEventListener('DOMContentLoaded', function(){ reveal(); updateMarketValues(); });
  } else {
    reveal(); updateMarketValues();
  }
})();