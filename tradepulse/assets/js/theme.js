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

  function initOfferSliders() {
    document.querySelectorAll('[data-offer-slider]').forEach(function(slider){
      var cards = Array.prototype.slice.call(slider.querySelectorAll('[data-offer-card]'));
      var prev = slider.querySelector('[data-offer-prev]');
      var next = slider.querySelector('[data-offer-next]');
      var dotsWrap = slider.querySelector('[data-offer-dots]');
      var currentPage = 0;

      if (!cards.length || !prev || !next || !dotsWrap) { return; }

      function perPage() {
        if (window.matchMedia('(max-width: 760px)').matches) { return 2; }
        if (window.matchMedia('(max-width: 1120px)').matches) { return 4; }
        return 8;
      }

      cards.forEach(function(card){
        var img = card.querySelector('.offer-card__logo img');

        if (!img) { return; }

        img.addEventListener('error', function(){
          img.classList.add('is-missing');
        });

        if (img.complete && img.naturalWidth === 0) {
          img.classList.add('is-missing');
        }
      });

      function renderDots(totalPages) {
        dotsWrap.innerHTML = '';

        for (var i = 0; i < totalPages; i += 1) {
          var dot = document.createElement('button');
          dot.type = 'button';
          dot.className = 'offer-slider__dot';
          dot.setAttribute('aria-label', 'Show offer page ' + (i + 1));
          dot.dataset.offerPage = i;
          dotsWrap.appendChild(dot);
        }
      }

      function update() {
        var visibleCount = perPage();
        var totalPages = Math.max(1, Math.ceil(cards.length / visibleCount));

        if (dotsWrap.children.length !== totalPages) {
          renderDots(totalPages);
        }

        currentPage = Math.min(currentPage, totalPages - 1);

        cards.forEach(function(card, index){
          var cardPage = Math.floor(index / visibleCount);
          card.hidden = cardPage !== currentPage;
        });

        Array.prototype.forEach.call(dotsWrap.children, function(dot, index){
          var isActive = index === currentPage;
          dot.classList.toggle('is-active', isActive);
          dot.setAttribute('aria-current', isActive ? 'true' : 'false');
        });
      }

      prev.addEventListener('click', function(){
        var totalPages = Math.max(1, Math.ceil(cards.length / perPage()));
        currentPage = (currentPage - 1 + totalPages) % totalPages;
        update();
      });

      next.addEventListener('click', function(){
        var totalPages = Math.max(1, Math.ceil(cards.length / perPage()));
        currentPage = (currentPage + 1) % totalPages;
        update();
      });

      dotsWrap.addEventListener('click', function(event){
        var dot = event.target.closest('[data-offer-page]');
        if (!dot) { return; }

        currentPage = parseInt(dot.dataset.offerPage, 10) || 0;
        update();
      });

      window.addEventListener('resize', update);
      slider.classList.add('is-ready');
      update();
    });
  }

  function initCouponModal() {
    var modal = document.querySelector('[data-coupon-modal]');
    if (!modal) { return; }

    var dialog = modal.querySelector('.coupon-modal__dialog');
    var closeButtons = modal.querySelectorAll('[data-coupon-close]');
    var logo = modal.querySelector('[data-coupon-logo]');
    var initials = modal.querySelector('[data-coupon-initials]');
    var name = modal.querySelector('[data-coupon-name]');
    var rating = modal.querySelector('[data-coupon-rating]');
    var discount = modal.querySelector('[data-coupon-discount]');
    var code = modal.querySelector('[data-coupon-code]');
    var details = modal.querySelector('[data-coupon-details]');
    var status = modal.querySelector('[data-coupon-status]');
    var copyButton = modal.querySelector('[data-coupon-copy]');
    var copyLabel = modal.querySelector('[data-coupon-copy-label]');
    var link = modal.querySelector('[data-coupon-link]');
    var linkName = modal.querySelector('[data-coupon-link-name]');
    var lastTrigger = null;

    function copyText(text) {
      if (navigator.clipboard && navigator.clipboard.writeText) {
        return navigator.clipboard.writeText(text);
      }

      var input = document.createElement('textarea');
      input.value = text;
      input.setAttribute('readonly', '');
      input.style.position = 'fixed';
      input.style.opacity = '0';
      document.body.appendChild(input);
      input.select();
      document.execCommand('copy');
      document.body.removeChild(input);
      return Promise.resolve();
    }

    function openModal(card) {
      lastTrigger = card;
      logo.classList.remove('is-missing');
      if (card.dataset.offerLogo) {
        logo.src = card.dataset.offerLogo;
      } else {
        logo.removeAttribute('src');
        logo.classList.add('is-missing');
      }
      initials.textContent = card.dataset.offerInitials || '';
      name.textContent = card.dataset.offerName || '';
      rating.textContent = card.dataset.offerRating || '';
      discount.textContent = card.dataset.offerDiscount || '';
      code.textContent = card.dataset.offerCode || '';
      details.textContent = card.dataset.offerDetails || '';
      status.textContent = 'Ready to copy.';
      if (copyLabel) { copyLabel.textContent = 'Copy Code'; }
      link.href = card.dataset.offerUrl || '#';
      linkName.textContent = card.dataset.offerName || '';

      modal.hidden = false;
      document.body.classList.add('coupon-modal-open');

      window.requestAnimationFrame(function(){
        modal.classList.add('is-open');
        if (dialog) { dialog.focus(); }
      });
    }

    function closeModal() {
      modal.classList.remove('is-open');
      document.body.classList.remove('coupon-modal-open');
      modal.hidden = true;

      if (lastTrigger) {
        lastTrigger.focus();
      }
    }

    document.querySelectorAll('[data-offer-card]').forEach(function(card){
      card.addEventListener('click', function(){
        openModal(card);
      });

      card.addEventListener('keydown', function(event){
        if (event.key !== 'Enter' && event.key !== ' ') { return; }
        event.preventDefault();
        openModal(card);
      });
    });

    closeButtons.forEach(function(button){
      button.addEventListener('click', closeModal);
    });

    if (copyButton) {
      copyButton.addEventListener('click', function(){
        copyText(code.textContent).then(function(){
          status.textContent = 'Copied to clipboard.';
          if (copyLabel) { copyLabel.textContent = 'Copied'; }
        }).catch(function(){
          status.textContent = 'Copy failed. Select the code manually.';
          if (copyLabel) { copyLabel.textContent = 'Copy Code'; }
        });
      });
    }

    if (logo) {
      logo.addEventListener('error', function(){
        logo.classList.add('is-missing');
      });
    }

    document.addEventListener('keydown', function(event){
      if (event.key === 'Escape' && !modal.hidden) {
        closeModal();
      }
    });
  }

  // Run on DOM ready
  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', function(){ useNativeSinglePostScroll(); reveal(); updateHeader(); refreshMarketData(); initOfferSliders(); initCouponModal(); });
  } else {
    useNativeSinglePostScroll(); reveal(); updateHeader(); refreshMarketData(); initOfferSliders(); initCouponModal();
  }

  window.addEventListener('scroll', requestHeaderUpdate, { passive: true });
  window.setInterval(refreshMarketData, 5 * 60 * 1000);
})();
