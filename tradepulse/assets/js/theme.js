(function(){
  var header = document.querySelector('.site-header');
  var menuToggle = document.querySelector('.menu-toggle');
  var navigation = document.querySelector('.main-navigation');
  var headerTicking = false;
  var headerIsScrolled = null;

  function updateHeader() {
    if (header) {
      var isScrolled = window.scrollY > 12;

      if (isScrolled !== headerIsScrolled) {
        header.classList.toggle('is-scrolled', isScrolled);
        headerIsScrolled = isScrolled;
      }
    }
  }

  function requestHeaderUpdate() {
    if (headerTicking) { return; }

    headerTicking = true;
    window.requestAnimationFrame(function(){
      updateHeader();
      headerTicking = false;
    });
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

  function applyMarketData(data) {
    if (!data || !data.markets) { return; }

    Object.keys(data.markets).forEach(function(key){
      var market = data.markets[key];
      document.querySelectorAll('[data-market-price="' + key + '"]').forEach(function(el){
        el.textContent = market.price;
      });
      document.querySelectorAll('[data-market-change="' + key + '"]').forEach(function(el){
        el.textContent = market.change_label;
        el.classList.toggle('is-negative', !!market.is_negative);
      });
      document.querySelectorAll('[data-market-name="' + key + '"]').forEach(function(el){
        el.textContent = market.name;
      });
    });

    var status = document.querySelector('[data-market-status]');
    var live = document.querySelector('[data-market-live]');
    if (status) {
      status.classList.toggle('is-demo', data.status === 'demo');
      var statusText = status.querySelector('b');
      if (statusText) { statusText.textContent = data.status_message; }
    }
    if (live) {
      live.classList.toggle('is-demo', data.status === 'demo');
      var liveText = live.querySelector('b');
      if (liveText) { liveText.textContent = data.status_label; }
    }

    var primary = data.markets[data.primary_key] || data.markets.stocks;
    var primaryName = document.querySelector('[data-market-primary-name]');
    var primaryPrice = document.querySelector('[data-market-primary-price]');
    var primaryChange = document.querySelector('[data-market-primary-change]');
    if (primaryName) { primaryName.textContent = primary.name; }
    if (primaryPrice) { primaryPrice.textContent = primary.price; }
    if (primaryChange) {
      primaryChange.textContent = primary.change_label;
      primaryChange.classList.toggle('is-negative', !!primary.is_negative);
    }

    var updated = document.querySelector('[data-market-updated]');
    if (updated && data.updated_label) { updated.textContent = data.updated_label; }

    if (data.chart_paths) {
      var area = document.querySelector('[data-market-chart-area]');
      var line = document.querySelector('[data-market-chart-line]');
      var point = document.querySelector('[data-market-chart-point]');
      if (area) { area.setAttribute('d', data.chart_paths.area); }
      if (line) { line.setAttribute('d', data.chart_paths.line); }
      if (point) {
        point.setAttribute('cx', data.chart_paths.last_x);
        point.setAttribute('cy', data.chart_paths.last_y);
      }
    }
  }

  function refreshMarketData() {
    if (!window.tradepulseMarket || !window.tradepulseMarket.endpoint) { return; }
    fetch(window.tradepulseMarket.endpoint, { credentials: 'same-origin' })
      .then(function(response){ return response.ok ? response.json() : null; })
      .then(applyMarketData)
      .catch(function(){ /* Keep the last server-rendered values. */ });
  }

  function useNativeSinglePostScroll() {
    if (document.body && document.body.classList.contains('single-post')) {
      document.documentElement.classList.add('single-post-native-scroll');
    }
  }

  // Run on DOM ready
  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', function(){ useNativeSinglePostScroll(); reveal(); updateHeader(); refreshMarketData(); });
  } else {
    useNativeSinglePostScroll(); reveal(); updateHeader(); refreshMarketData();
  }

  window.addEventListener('scroll', requestHeaderUpdate, { passive: true });
  window.setInterval(refreshMarketData, 5 * 60 * 1000);
})();
