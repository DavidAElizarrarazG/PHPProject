/**
 * Kashi Foods — Walkthrough Tour Engine
 * Lightweight guided tour system. No dependencies.
 */
(function () {
  'use strict';

  // Tour state
  let currentSteps = [];
  let currentStep = 0;
  let spotlightEl = null;
  let tooltipEl = null;
  let overlayEl = null;

  /**
   * Start (or restart) the tour for the current page.
   * @param {Array} steps - Array of { target, title, description }
   * @param {boolean} force - If true, show even if already seen
   */
  window.startTour = function (steps, force) {
    const pageKey = 'wt_seen_' + location.pathname.replace(/\//g, '_');
    if (!force && localStorage.getItem(pageKey)) return;

    currentSteps = steps;
    currentStep = 0;

    // Create overlay elements
    if (!overlayEl) {
      overlayEl = document.createElement('div');
      overlayEl.className = 'wt-overlay';
      document.body.appendChild(overlayEl);
    }

    if (!spotlightEl) {
      spotlightEl = document.createElement('div');
      spotlightEl.className = 'wt-spotlight';
      document.body.appendChild(spotlightEl);
    }

    if (!tooltipEl) {
      tooltipEl = document.createElement('div');
      tooltipEl.className = 'wt-tooltip';
      document.body.appendChild(tooltipEl);
    }

    showStep(0);
  };

  function showStep(idx) {
    if (idx >= currentSteps.length) {
      endTour();
      return;
    }
    currentStep = idx;
    const step = currentSteps[idx];
    const target = document.querySelector(step.target);

    if (!target) {
      // Skip missing targets
      showStep(idx + 1);
      return;
    }

    // Scroll target into view
    target.scrollIntoView({ behavior: 'smooth', block: 'center' });

    setTimeout(function () {
      const rect = target.getBoundingClientRect();
      const pad = 8;

      // Position spotlight
      spotlightEl.style.display = 'block';
      spotlightEl.style.top = (rect.top - pad) + 'px';
      spotlightEl.style.left = (rect.left - pad) + 'px';
      spotlightEl.style.width = (rect.width + pad * 2) + 'px';
      spotlightEl.style.height = (rect.height + pad * 2) + 'px';

      // Build tooltip content
      tooltipEl.innerHTML = '<h4>' + step.title + '</h4>' +
        '<p>' + step.description + '</p>' +
        '<div class="wt-tooltip-footer">' +
        '  <span class="wt-steps">' + (idx + 1) + ' / ' + currentSteps.length + '</span>' +
        '  <div class="wt-tooltip-btns">' +
        '    <button class="wt-btn wt-btn-skip" onclick="endTour()">Skip</button>' +
        '    <button class="wt-btn wt-btn-next" onclick="nextTourStep()">' +
        (idx === currentSteps.length - 1 ? 'Finish' : 'Next →') +
        '    </button>' +
        '  </div>' +
        '</div>';

      // Position tooltip
      tooltipEl.style.display = 'block';
      positionTooltip(rect);
    }, 350);
  }

  function positionTooltip(rect) {
    const tw = 320;
    const th = tooltipEl.offsetHeight || 150;
    const gap = 16;
    const vw = window.innerWidth;
    const vh = window.innerHeight;

    let top, left;

    // Try below
    if (rect.bottom + gap + th < vh) {
      top = rect.bottom + gap;
      left = rect.left + rect.width / 2 - tw / 2;
    }
    // Try above
    else if (rect.top - gap - th > 0) {
      top = rect.top - gap - th;
      left = rect.left + rect.width / 2 - tw / 2;
    }
    // Try right
    else if (rect.right + gap + tw < vw) {
      top = rect.top;
      left = rect.right + gap;
    }
    // Fallback: left
    else {
      top = rect.top;
      left = rect.left - gap - tw;
    }

    // Clamp to viewport
    left = Math.max(12, Math.min(left, vw - tw - 12));
    top = Math.max(12, Math.min(top, vh - th - 12));

    tooltipEl.style.top = top + 'px';
    tooltipEl.style.left = left + 'px';
    tooltipEl.style.maxWidth = tw + 'px';
  }

  window.nextTourStep = function () {
    showStep(currentStep + 1);
  };

  window.endTour = function () {
    const pageKey = 'wt_seen_' + location.pathname.replace(/\//g, '_');
    localStorage.setItem(pageKey, '1');

    if (spotlightEl) spotlightEl.style.display = 'none';
    if (tooltipEl) tooltipEl.style.display = 'none';
    if (overlayEl) overlayEl.style.display = 'none';
  };

  // Reposition on resize
  window.addEventListener('resize', function () {
    if (currentSteps.length && currentStep < currentSteps.length) {
      const target = document.querySelector(currentSteps[currentStep].target);
      if (target) {
        const rect = target.getBoundingClientRect();
        const pad = 8;
        spotlightEl.style.top = (rect.top - pad) + 'px';
        spotlightEl.style.left = (rect.left - pad) + 'px';
        spotlightEl.style.width = (rect.width + pad * 2) + 'px';
        spotlightEl.style.height = (rect.height + pad * 2) + 'px';
        positionTooltip(rect);
      }
    }
  });
})();
