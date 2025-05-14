jQuery(document).ready(function ($) {
  // === Tab Navigation ===
  $(".tabs-nav").on("click", "li", function () {
    const tabId = $(this).data("tab");

    $(".tabs-nav li").removeClass("active");
    $(this).addClass("active");

    $(".tab-pane").removeClass("active");
    const $pane = $("#" + tabId).addClass("active");

    if ($pane.find(".insight-item").length === 0) {
      loadInsights($pane);
    }
  });

  function getQueryParam(param) {
    const urlParams = new URLSearchParams(window.location.search);
    return urlParams.get(param);
  }
  
  function activateTabBySlug(slug) {
    const $tab = $(`.tabs-nav li[data-tab="tab-${slug}"]`);
    if ($tab.length) {
      $tab.trigger("click");
    }
  }
  
  const initialCategory = getQueryParam("category");
  if (initialCategory) {
    activateTabBySlug(initialCategory);
  }
  

  // === Category Draggable Nav ===
  const navWrapper = document.querySelector(".tabs-nav-wrapper");
  if (navWrapper) {
    let isDown = false, startX, scrollLeft, isDragging = false;
    const dragThreshold = 5;
  
    navWrapper.addEventListener("mousedown", (e) => {
      isDown = true;
      startX = e.pageX - navWrapper.offsetLeft;
      scrollLeft = navWrapper.scrollLeft;
    });
  
    ["mouseup", "mouseleave"].forEach(event => {
      navWrapper.addEventListener(event, () => {
        isDown = false;
        if (isDragging) endDrag();
      });
    });
  
    navWrapper.addEventListener("mousemove", (e) => {
      if (!isDown) return;
      const x = e.pageX - navWrapper.offsetLeft;
      const walk = (x - startX) * 1.5;
  
      if (Math.abs(walk) > dragThreshold) {
        isDragging = true;
        navWrapper.classList.add("dragging");
        document.body.classList.add("no-select");
        e.preventDefault();
        navWrapper.scrollLeft = scrollLeft - walk;
      }
    });
  
    function endDrag() {
      document.body.classList.remove("no-select");
      navWrapper.classList.remove("dragging");
      window.getSelection().removeAllRanges();
      isDragging = false;
    }
  }
  
  // === AJAX Loader ===
  function loadInsights($pane, paged = 1, append = false) {
    const term = $pane.data("term");
    const search = $(".search-input").val();
    const $wrapper = $pane.find(".insights-wrapper");
    const $loadMoreBtn = $pane.find(".load-more-btn");
    const $spinner = $pane.find('.loading-spinner');
    const $searchSpinner = $('.search-loading-spinner');
    const $searchIcon = $('.search-button');
    const $resetBtn = $('.search-reset');

    $spinner.show();
    $searchIcon.hide();
    $searchSpinner.show();

    if (search) {
      $resetBtn.show();
    } else {
      $resetBtn.hide();
    }

    $.ajax({
      url: mcd_ajax_object.ajaxurl,
      method: "POST",
      data: {
        action: "ajax_insights_load_posts",
        term,
        paged,
        search,
      },
      success(response) {
        append ? $wrapper.append(response.html) : $wrapper.html(response.html);
        $pane.data("paged", paged);
        response.has_more ? $loadMoreBtn.show() : $loadMoreBtn.hide();
      },
      complete() {
        $spinner.hide();
        $searchIcon.show();
        $searchSpinner.hide();
      },
    });
  }

  // === Initial Load for Active Tab ===
  loadInsights($(".tab-pane.active"));

  // === Load More Button ===
  $(".load-more-btn").on("click", function () {
    const $pane = $(this).closest(".tab-pane");
    const paged = parseInt($pane.data("paged"), 10) + 1;
    loadInsights($pane, paged, true);
  });

  // === Debounced Search Input ===
  let debounceTimeout;
  $(".search-input").on("input", function () {
    clearTimeout(debounceTimeout);
    debounceTimeout = setTimeout(() => {
      const $activePane = $(".tab-pane.active");
      $activePane.data("paged", 1);
      loadInsights($activePane);
    }, 300);
  });

  // === Search Reset Button ===
  $('.search-reset').on('click', function () {
    $('.search-input').val('');
    $(this).hide();
    const $activePane = $('.tab-pane.active');
    $activePane.data('paged', 1);
    loadInsights($activePane, 1, false);
  });

  // === Slick Slider Initialization ===
  $('.services-slider-slick').slick({
    dots: true,
    infinite: true,
    speed: 500,
    slidesToShow: 1,
    slidesToScroll: 1,
    autoplay: false,
    autoplaySpeed: 3000,
    prevArrow: '<button type="button" class="mcd-slick-prev custom-arrow"><i class="elementor-icons-manager__tab__item__icon icon icon-mcd-left-chevron-icon"></i></button>',
    nextArrow: '<button type="button" class="mcd-slick-next custom-arrow"><i class="elementor-icons-manager__tab__item__icon icon icon-mcd-right-chevron-icon"></i></button>'
  });  
});