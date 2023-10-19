/******/ (function() { // webpackBootstrap
/******/ 	"use strict";
/******/ 	var __webpack_modules__ = ({

/***/ "./src/widgets/js/archive-course.js":
/*!******************************************!*\
  !*** ./src/widgets/js/archive-course.js ***!
  \******************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": function() { return /* binding */ ArchiveCourse; }
/* harmony export */ });
/* harmony import */ var _wordpress_api_fetch__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/api-fetch */ "@wordpress/api-fetch");
/* harmony import */ var _wordpress_api_fetch__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_api_fetch__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _wordpress_url__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @wordpress/url */ "@wordpress/url");
/* harmony import */ var _wordpress_url__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_wordpress_url__WEBPACK_IMPORTED_MODULE_1__);


const SEKELETON = `<ul class="lp-skeleton-animation">
		<li style="width:100%"></li>
		<li style="width:100%"></li>
		<li style="width:100%"></li>
		<li style="width:100%"></li>
		<li style="width:100%"></li>
	</ul>`;
function ArchiveCourse() {
  if (!document.querySelectorAll('.thim-ekits-archive-course__skeleton').length) {
    return;
  }
  const elements = document.querySelectorAll('.thim-ekits-archive-course');
  async function getResponse(ele, params) {
    const courseEle = ele.querySelector('.thim-ekits-course__inner');
    const resultCount = ele.querySelector('.thim-ekits-archive-course__topbar__result');
    const paginationEle = ele.querySelectorAll('.thim-ekits-archive-course__pagination');
    courseEle.insertAdjacentHTML('beforebegin', SEKELETON);
    courseEle.innerHTML = '';
    try {
      const response = await _wordpress_api_fetch__WEBPACK_IMPORTED_MODULE_0___default()({
        method: 'POST',
        path: 'thim-ekit/archive-course/get-courses',
        data: {
          ...params
        }
      });
      if (response.status === 'error') {
        throw new Error(response.message);
      }
      paginationEle && paginationEle.forEach(pagination => {
        pagination.remove();
      });
      courseEle.innerHTML = response.data?.courses || '';
      courseEle.insertAdjacentHTML('afterend', response.data?.pagination || '');
      resultCount && (resultCount.textContent = response.data?.result_count || '');
      pagination(ele, {
        ...params,
        paged: response.data?.page || 1
      });
    } catch (error) {
      courseEle.insertAdjacentHTML('beforebegin', `<div>${error.message || 'Error when run ajax'}</div>`);
    } finally {
      const skeletons = ele.querySelectorAll('.lp-skeleton-animation');
      [...skeletons].map(ele => ele.remove());
    }
  }
  function pagination(ele, params) {
    const paginationEle = ele.querySelectorAll('.thim-ekits-archive-course__pagination');
    paginationEle.forEach(elePav => {
      const paginations = elePav.querySelectorAll('a.page-numbers');
      paginations.forEach(pagination => {
        pagination && pagination.addEventListener('click', e => {
          e.preventDefault();
          let page = params.page;
          if (pagination.classList.contains('prev')) {
            page = params.page - 1;
          } else if (pagination.classList.contains('next')) {
            page = params.page + 1;
          } else {
            page = parseInt(pagination.textContent.replace(/\D/g, ''));
          }
          getResponse(ele, {
            ...params,
            paged: page
          });
        });
      });
    });
  }
  function orderby(ele, params) {
    const orderby = ele.querySelector('select[name="order_by"]');
    orderby && orderby.addEventListener('change', e => {
      getResponse(ele, {
        ...params,
        orderby: orderby.value,
        params_url: lpGlobalSettings.lpArchiveSkeleton
      });
    });
  }
  if ('IntersectionObserver' in window) {
    const eleObserver = new IntersectionObserver((entries, observer) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          const ele = entry.target;
          if (ele.dataset.atts) {
            getResponse(ele, {
              atts: ele.dataset.atts,
              params_url: lpGlobalSettings.lpArchiveSkeleton
            }, true);

            //orderby( ele, { atts: ele.dataset.atts } );
          }

          eleObserver.unobserve(ele);
        }
      });
    });
    [...elements].map(ele => eleObserver.observe(ele));
  }
}

/***/ }),

/***/ "./src/widgets/js/archive-loadmore.js":
/*!********************************************!*\
  !*** ./src/widgets/js/archive-loadmore.js ***!
  \********************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": function() { return /* binding */ thimEkitLoadMoreArchive; }
/* harmony export */ });
function thimEkitLoadMoreArchive() {
  let parent = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : '.thim-ekits-archive-course';
  let inner = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : '.thim-ekits-course__inner';
  const archive = document.querySelector(parent);
  const innerHtml = archive.querySelector(inner);
  const loadMoreButton = archive.querySelector('.thim-ekits-archive__loadmore-button');
  const loadMoreBtn = archive.querySelector('.thim-ekits-archive__loadmore-btn');
  const loadMoreData = archive.querySelector('.thim-ekits-archive__loadmore-data');
  let isLoading = false;
  let currentPage = loadMoreData.dataset.page ? parseInt(loadMoreData.dataset.page) : 1;
  const maxPage = loadMoreData.dataset.maxPage ? parseInt(loadMoreData.dataset.maxPage) : 1;
  const isInfinityScroll = loadMoreData.dataset.infinityScroll ? parseInt(loadMoreData.dataset.infinityScroll) : false;
  const beforeLoading = () => {
    isLoading = true;
    loadMoreButton && loadMoreButton.classList.add('loading');
    if (loadMoreBtn) {
      loadMoreBtn.disabled = true;
    }
  };
  const afterLoading = () => {
    isLoading = false;
    loadMoreButton && loadMoreButton.classList.remove('loading');
    if (loadMoreBtn) {
      loadMoreBtn.disabled = false;
    }
  };
  const handleInfiniteScroll = () => {
    // Use observer to check if the element is visible in the viewport
    const observer = new IntersectionObserver(entries => {
      entries.forEach(entry => {
        if (isLoading) {
          return;
        }
        if (entry.isIntersecting) {
          handlePostsQuery();
        }
      });
    });
    observer.observe(loadMoreData);
  };
  const handlePostsQuery = () => {
    const nextPageUrl = loadMoreData.dataset.nextPage;
    if (currentPage >= maxPage) {
      return;
    }
    beforeLoading();
    currentPage++;
    return fetch(nextPageUrl).then(response => response.text()).then(html => {
      const parser = new DOMParser();
      const doc = parser.parseFromString(html, 'text/html');
      const nextData = doc.querySelector('.thim-ekits-archive__loadmore-data');
      const nextPosts = doc.querySelector(inner);
      loadMoreData.dataset.page = nextData.dataset.page;
      loadMoreData.dataset.nextPage = nextData.dataset.nextPage;
      innerHtml.insertAdjacentHTML('beforeend', nextPosts.innerHTML);
      if (!nextData.dataset.nextPage || currentPage >= maxPage) {
        loadMoreButton && loadMoreButton.remove();
      }
      afterLoading();
    });
  };
  loadMoreBtn && loadMoreBtn.addEventListener('click', e => {
    e.preventDefault();
    if (isLoading) {
      return;
    }
    if (currentPage >= maxPage && loadMoreButton) {
      loadMoreButton.remove();
      return;
    }
    handlePostsQuery();
  });
  if (isInfinityScroll) {
    handleInfiniteScroll();
  }
}

/***/ }),

/***/ "./src/widgets/js/countdown.js":
/*!*************************************!*\
  !*** ./src/widgets/js/countdown.js ***!
  \*************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": function() { return /* binding */ ThimCountDown; }
/* harmony export */ });
class ThimCountDown extends elementorModules.frontend.handlers.Base {
  onInit() {
    const self = this;
    const $countDown = this.$element.find('.thim-ekits-countdown-wrapper');
    if (!$countDown) {
      return;
    }
    this.elements = {
      days: $countDown.find('.countdown-days'),
      hours: $countDown.find('.countdown-hours'),
      minutes: $countDown.find('.countdown-minutes'),
      seconds: $countDown.find('.countdown-seconds')
    };
    this.endTime = new Date($countDown.data('date_end') * 1000);
    setInterval(function () {
      self.updateClock();
    }, 100);
  }
  updateClock() {
    const self = this,
      timeRemaining = this.getTimeRemaining(this.endTime);
    jQuery.each(timeRemaining.parts, function (timePart) {
      const $element = self.elements[timePart];
      let value = this.toString();
      if (1 === value.length) {
        value = 0 + value;
      }
      if ($element.length) {
        $element.text(value);
      }
    });
  }
  getTimeRemaining(endTime) {
    const timeRemaining = endTime - new Date();
    let seconds = Math.floor(timeRemaining / 1000 % 60),
      minutes = Math.floor(timeRemaining / 1000 / 60 % 60),
      hours = Math.floor(timeRemaining / (1000 * 60 * 60) % 24),
      days = Math.floor(timeRemaining / (1000 * 60 * 60 * 24));
    if (days < 0 || hours < 0 || minutes < 0) {
      seconds = minutes = hours = days = 0;
    }
    return {
      total: timeRemaining,
      parts: {
        days,
        hours,
        minutes,
        seconds
      }
    };
  }
}

/***/ }),

/***/ "./src/widgets/js/course-item-section.js":
/*!***********************************************!*\
  !*** ./src/widgets/js/course-item-section.js ***!
  \***********************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   getOffsetPopupHeaderHeight: function() { return /* binding */ getOffsetPopupHeaderHeight; },
/* harmony export */   stickySidebar: function() { return /* binding */ stickySidebar; }
/* harmony export */ });
/* harmony import */ var _utils_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./utils.js */ "./src/widgets/js/utils.js");


// get height class ekit-popup-header and set variable.
const getOffsetPopupHeaderHeight = element => {
  const popupHeader = element.querySelector('.ekit-popup-header');
  if (popupHeader) {
    const position = window.getComputedStyle(popupHeader).getPropertyValue('position');
    if (position === 'absolute' || position === 'fixed') {
      const popupHeaderHeight = popupHeader.offsetHeight;
      (0,_utils_js__WEBPACK_IMPORTED_MODULE_0__.setVariable)(element, '--thim-ekit-popup-header-height', popupHeaderHeight + 'px');
    }
    if (elementorFrontend.isEditMode()) {
      elementor.channels.editor.on('change', function (view) {
        // if popupHeader contain data-id value is view.container.id.
        if (popupHeader.dataset.id === view.container.id) {
          const changed = view.container.settings.changed;
          if (changed?.position === 'absolute' || changed?.position === 'fixed') {
            const popupHeaderHeight = popupHeader.offsetHeight;
            (0,_utils_js__WEBPACK_IMPORTED_MODULE_0__.setVariable)(element, '--thim-ekit-popup-header-height', popupHeaderHeight + 'px');
          } else {
            (0,_utils_js__WEBPACK_IMPORTED_MODULE_0__.setVariable)(element, '--thim-ekit-popup-header-height', '0px');
          }
        }
      });
    }
  }
};
const stickySidebar = element => {
  // sticky sidebar use fixed position.
  const popupCourse = element.querySelector('#popup-course');
  if (popupCourse) {
    const stickySidebar = popupCourse.querySelector('#ekit-sticky-sidebar');
    if (stickySidebar) {
      const eConInner = stickySidebar.querySelector('.e-con-inner');
      const popupContentRight = popupCourse.querySelector('.wrapper-popup-content-right');
      if (eConInner && popupContentRight) {
        const setSticky = () => {
          // only run in desktop.
          if (window.innerWidth <= 1024) {
            return;
          }
          const popupCourseRect = popupCourse.getBoundingClientRect();
          const popupContentRightRect = popupContentRight.getBoundingClientRect();
          const widthSidebarItems = stickySidebar.offsetWidth + 'px';
          if (popupCourseRect.top <= 0 && popupContentRightRect.top <= 0) {
            eConInner.style.position = 'fixed';
            eConInner.style.top = '0';
            eConInner.style.left = stickySidebar.offsetLeft + 'px';
            eConInner.style.width = 'var(--thim-width-sidebar-items, ' + widthSidebarItems + ')';
          } else {
            eConInner.style.position = 'relative';
            eConInner.style.top = 'auto';
            eConInner.style.left = 'auto';
            eConInner.style.width = '100%';
          }
        };

        // when scroll, set eConInner fixed position.
        window.addEventListener('scroll', setSticky);

        // when window resize, set eConInner fixed position.
        window.addEventListener('resize', setSticky);
      }
    }
  }
};

/***/ }),

/***/ "./src/widgets/js/mini-cart.js":
/*!*************************************!*\
  !*** ./src/widgets/js/mini-cart.js ***!
  \*************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": function() { return /* binding */ MiniCart; }
/* harmony export */ });
function MiniCart() {
  const cart = document.querySelector('.thim-ekits-mini-cart.side-cart'),
    cartBtn = cart && cart.querySelector('.minicart-icon'),
    closePopup = cart && cart.querySelector('.thim-ekits-mini-cart__close');
  if (!cart) {
    return;
  }
  const isCartOpen = () => {
    return cart.classList.contains('thim-ekits-mini-cart--is-show');
  };
  const showCart = () => {
    if (isCartOpen()) {
      return;
    }
    cart.classList.add('thim-ekits-mini-cart--is-show');
  };
  const hideCart = () => {
    if (!isCartOpen()) {
      return;
    }
    cart.classList.remove('thim-ekits-mini-cart--is-show');
  };
  const toggleCart = () => {
    if (isCartOpen()) {
      hideCart();
    } else {
      showCart();
    }
  };
  const onKeyDown = e => {
    if (e.keyCode === 27) {
      hideCart();
    }
  };
  cartBtn && cartBtn.addEventListener('click', e => {
    e.preventDefault();
    toggleCart();
  });
  document.addEventListener('click', e => {
    if (!isCartOpen()) {
      return;
    }
    const target = e.target;
    if (target.closest('.thim-ekits-mini-cart__content') || target.closest('.minicart-icon')) {
      return;
    }
    hideCart();
  });

  // Click close button.
  closePopup && closePopup.addEventListener('click', e => {
    e.preventDefault();
    hideCart();
  });
  document.addEventListener('keydown', onKeyDown, false); // click ESC button will hide popup
  jQuery(document.body).on('added_to_cart', showCart); // WooCommerce is required jQuery
}

/***/ }),

/***/ "./src/widgets/js/modal.js":
/*!*********************************!*\
  !*** ./src/widgets/js/modal.js ***!
  \*********************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": function() { return /* binding */ ModalPopup; }
/* harmony export */ });
function ModalPopup() {
  /* Opening modal window function */
  function openModal() {
    /* Get trigger element */
    var modalButton = document.getElementsByClassName('modalbutton');

    /* Set onclick event handler for all trigger elements */
    for (var i = 0; i < modalButton.length; i++) {
      modalButton[i].onclick = function (e) {
        e.preventDefault();
        var target = this.getAttribute('href').substr(1);
        var modalWindow = document.getElementById(target);
        modalWindow.classList ? modalWindow.classList.add('open') : modalWindow.className += ' ' + 'open';
      };
    }
  }
  function closeModal() {
    /* Get close button */
    var closeButton = document.getElementsByClassName('ModalClose');
    var closeOverlay = document.getElementsByClassName('ModalOverlay');

    /* Set onclick event handler for close buttons */
    for (var i = 0; i < closeButton.length; i++) {
      closeButton[i].onclick = function () {
        var modalWindow = this.parentNode.parentNode;
        modalWindow.classList ? modalWindow.classList.remove('open') : modalWindow.className = modalWindow.className.replace(new RegExp('(^|\\b)' + 'open'.split(' ').join('|') + '(\\b|$)', 'gi'), ' ');
      };
    }

    /* Set onclick event handler for modal overlay */
    for (var i = 0; i < closeOverlay.length; i++) {
      closeOverlay[i].onclick = function () {
        var modalWindow = this.parentNode;
        modalWindow.classList ? modalWindow.classList.remove('open') : modalWindow.className = modalWindow.className.replace(new RegExp('(^|\\b)' + 'open'.split(' ').join('|') + '(\\b|$)', 'gi'), ' ');
      };
    }
  }

  /* Handling domready event IE9+ */
  function ready(fn) {
    if (document.readyState != 'loading') {
      fn();
    } else {
      document.addEventListener('DOMContentLoaded', fn);
    }
  }

  /* Triggering modal window function after dom ready */
  ready(openModal);
  ready(closeModal);
}

/***/ }),

/***/ "./src/widgets/js/tabs.js":
/*!********************************!*\
  !*** ./src/widgets/js/tabs.js ***!
  \********************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": function() { return /* binding */ ThimEkitsTabs; }
/* harmony export */ });
/** https://developer.mozilla.org/en-US/docs/Web/Accessibility/ARIA/Roles/tab_role */
function ThimEkitsTabs() {
  const tabList = document.querySelector('.thim-ekit-tablist [role="tablist"]');
  if (!tabList) {
    return;
  }
  const tabs = document.querySelectorAll('.thim-ekit-tablist [role="tab"]');

  // Add a click event handler to each tab
  tabs.forEach(tab => {
    tab.addEventListener('click', changeTabs);
  });

  // Enable arrow navigation between tabs in the tab list
  let tabFocus = 0;
  tabList.addEventListener('keydown', e => {
    // Move right
    if (e.keyCode === 39 || e.keyCode === 37) {
      tabs[tabFocus].setAttribute('tabindex', -1);
      if (e.keyCode === 39) {
        tabFocus++;
        // If we're at the end, go to the start
        if (tabFocus >= tabs.length) {
          tabFocus = 0;
        }
        // Move left
      } else if (e.keyCode === 37) {
        tabFocus--;
        // If we're at the start, move to the end
        if (tabFocus < 0) {
          tabFocus = tabs.length - 1;
        }
      }
      tabs[tabFocus].setAttribute('tabindex', 0);
      tabs[tabFocus].focus();
    }
  });
}
function changeTabs(e) {
  const target = e.currentTarget;
  const parent = target.parentNode;
  const grandparent = parent.parentNode;

  // Remove all current selected tabs
  if (grandparent.classList.contains('thim-accordion-sections')) {
    grandparent.querySelectorAll('[aria-selected="true"]').forEach(t => t.setAttribute('aria-selected', false));
  } else {
    parent.querySelectorAll('[aria-selected="true"]').forEach(t => t.setAttribute('aria-selected', false));
  }

  // Set this tab as selected
  target.setAttribute('aria-selected', true);

  // Hide all tab panels
  grandparent.querySelectorAll('[role="tabpanel"]').forEach(p => p.setAttribute('hidden', true));

  // Show the selected panel
  grandparent.parentNode.querySelector(`#${target.getAttribute('aria-controls')}`).removeAttribute('hidden');
}
(function ($) {
  "use strict";

  $(document).on('click', '.thim-ekit-tablist a[href^="#"]', function (event) {
    event.preventDefault();
    $('html, body').animate({
      scrollTop: $($.attr(this, 'href')).offset().top - 100
    }, 500);
    $('.thim-ekit-tablist').find('.active').removeClass('active');
    $(this).addClass('active');
  });
})(jQuery);

/***/ }),

/***/ "./src/widgets/js/thim-slider.js":
/*!***************************************!*\
  !*** ./src/widgets/js/thim-slider.js ***!
  \***************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": function() { return /* binding */ ThimSlider; }
/* harmony export */ });
class ThimSlider extends elementorModules.frontend.handlers.SwiperBase {
  getDefaultSettings() {
    return {
      selectors: {
        carousel: '.thim-ekits-sliders',
        gallery: '.thim-ekits-gallery-thumbs',
        slideContent: '.swiper-slide'
      }
    };
  }
  getDefaultElements() {
    const selectors = this.getSettings('selectors');
    const elements = {
      $swiperContainer: this.$element.find(selectors.carousel),
      $swiperGallery: this.$element.find(selectors.gallery)
    };
    elements.$slides = elements.$swiperContainer.find(selectors.slideContent);
    return elements;
  }
  getSwiperOptions() {
    const elementSettings = this.getElementSettings(),
      slidesToShow = +elementSettings.slidesPerView || 3,
      isSingleSlide = 1 === slidesToShow,
      elementorBreakpoints = elementorFrontend.config.breakpoints,
      defaultSlidesToShowMap = {
        small_mobile: 1,
        mobile: 1,
        tablet: isSingleSlide ? 1 : 2
      };
    let swiperOptions = {
      slidesPerView: slidesToShow,
      loop: 'yes' === elementSettings.slider_loop,
      speed: elementSettings.slider_speed,
      // handleElementorBreakpoints: true,
      freeMode: false,
      watchSlidesProgress: true
    };
    if (this.elements.$swiperContainer.hasClass('thim-ekits-testimonial__avatars')) {
      swiperOptions = {
        slidesPerView: 'auto',
        loop: true,
        loopedSlides: +elementSettings.slidesPerView || 3,
        speed: elementSettings.slider_speed,
        handleElementorBreakpoints: true,
        centeredSlides: true,
        slideToClickedSlide: true,
        watchSlidesProgress: true
      };
      if ('yes' === elementSettings.slider_autoplay) {
        swiperOptions.autoplay = {
          delay: elementSettings.slider_speed,
          disableOnInteraction: 'yes' === elementSettings.pause_on_interaction
        };
      }
    } else {
      swiperOptions.breakpoints = {};
      let lastBreakpointSlidesToShowValue = slidesToShow,
        screenName;
      Object.keys(elementorBreakpoints).reverse().forEach(breakpointName => {
        if (elementorBreakpoints[breakpointName] == '1660') {
          screenName = 'widescreen';
        } else if (elementorBreakpoints[breakpointName] == '768') {
          screenName = 'tablet';
        } else if (elementorBreakpoints[breakpointName] == '480') {
          screenName = 'mobile';
        } else if (elementorBreakpoints[breakpointName] == '0') {
          screenName = 'small_mobile';
        }
        const defaultSlidesToShow = defaultSlidesToShowMap[screenName] ? defaultSlidesToShowMap[screenName] : lastBreakpointSlidesToShowValue;
        swiperOptions.breakpoints[elementorBreakpoints[breakpointName]] = {
          slidesPerView: +elementSettings['slidesPerView_' + screenName] || defaultSlidesToShow,
          slidesPerGroup: +elementSettings['slidesPerGroup_' + screenName] || 1,
          spaceBetween: +elementSettings['spaceBetween_' + screenName] || elementSettings.spaceBetween
        };
        lastBreakpointSlidesToShowValue = +elementSettings['slidesPerView_' + screenName] || defaultSlidesToShow;
      });
    }
    if ('yes' === elementSettings.centered_slides) {
      swiperOptions.centeredSlides = true;
    }
    if ('yes' === elementSettings.slider_autoplay) {
      swiperOptions.autoplay = {
        delay: elementSettings.slider_speed,
        disableOnInteraction: 'yes' === elementSettings.pause_on_interaction
      };
    }
    if (isSingleSlide) {
      swiperOptions.effect = elementSettings.effect;
      if ('fade' === elementSettings.effect) {
        swiperOptions.fadeEffect = {
          crossFade: true
        };
      }
    } else {
      swiperOptions.slidesPerGroup = +elementSettings.slidesPerGroup || 1;
    }
    if (elementSettings.spaceBetween) {
      swiperOptions.spaceBetween = elementSettings.spaceBetween;
    }
    if ('yes' === elementSettings.slider_show_arrow) {
      swiperOptions.navigation = {
        prevEl: `.elementor-element-${this.getID()} .thim-slider-nav-prev`,
        nextEl: `.elementor-element-${this.getID()} .thim-slider-nav-next`
      };
    }
    switch (elementSettings.slider_show_pagination) {
      case 'number':
        swiperOptions.pagination = {
          el: `.elementor-element-${this.getID()} .thim-slider-pagination`,
          clickable: true,
          renderBullet(index, className) {
            return '<span class="' + className + '">' + (index + 1) + '</span>';
          }
        };
        break;
      case 'scrollbar':
        swiperOptions.scrollbar = {
          el: `.elementor-element-${this.getID()} .thim-slider-pagination`,
          hide: true
        };
        break;
      case 'bullets':
      case 'progressbar':
      case 'fraction':
        swiperOptions.pagination = {
          el: `.elementor-element-${this.getID()} .thim-slider-pagination`,
          type: elementSettings.slider_show_pagination,
          clickable: true
        };
        break;
      case 'yes':
        swiperOptions.pagination = {
          el: `.elementor-element-${this.getID()} .thim-slider-pagination`,
          type: 'bullets',
          clickable: true
        };
        break;
    }
    return swiperOptions;
  }
  getSwiperOptionsGallery(carousel) {
    const elementSettings = this.getElementSettings();
    let swiper_opt_gallery = {
      loop: true,
      slidesPerView: 1,
      speed: elementSettings.slider_speed
    };
    swiper_opt_gallery.spaceBetween = 30;
    if (this.elements.$swiperContainer.hasClass('thim-ekits-testimonial__avatars')) {
      swiper_opt_gallery = {
        loop: true,
        // slidesPerView: 1,
        loopedSlides: +elementSettings.slidesPerView || 3,
        speed: elementSettings.slider_speed,
        autoplay: false
      };
    } else {
      swiper_opt_gallery.thumbs = {
        swiper: carousel
      };
    }
    if ('yes' === elementSettings.slider_show_arrow) {
      swiper_opt_gallery.navigation = {
        prevEl: `.elementor-element-${this.getID()} .thim-slider-nav-prev`,
        nextEl: `.elementor-element-${this.getID()} .thim-slider-nav-next`
      };
    }
    if ('yes' === elementSettings.slider_autoplay && !this.elements.$swiperContainer.hasClass('thim-ekits-testimonial__avatars')) {
      swiper_opt_gallery.autoplay = {
        delay: elementSettings.slider_speed,
        disableOnInteraction: 'yes' === elementSettings.pause_on_interaction
      };
    }
    return swiper_opt_gallery;
  }
  async onInit() {
    super.onInit(...arguments);
    const elementSettings = this.getElementSettings();
    if (!this.elements.$swiperContainer.length || 2 > this.elements.$slides.length) {
      return;
    }

    // const Swiper = elementorFrontend.utils.swiper;
    const Swiper = elementorFrontend.utils.swiper;
    this.swiper = await new Swiper(this.elements.$swiperContainer, this.getSwiperOptions());

    // Expose the swiper instance in the frontend
    this.elements.$swiperContainer.data('swiper', this.swiper);

    // gallery slider
    if (this.elements.$swiperGallery.length) {
      this.swiper_gallery = await new Swiper(this.elements.$swiperGallery, this.getSwiperOptionsGallery(this.swiper));
      this.elements.$swiperGallery.data('swiper', this.swiper_gallery);
      if (this.elements.$swiperContainer.hasClass('thim-ekits-testimonial__avatars')) {
        this.swiper_gallery.controller.control = this.swiper;
        this.swiper.controller.control = this.swiper_gallery;
        if ('yes' === elementSettings.pause_on_hover) {
          this.$element.on('mouseenter', () => {
            this.swiper.autoplay.stop();
          }).on('mouseleave', () => {
            this.swiper.autoplay.start();
          });
        }
      }
    }
    if ('yes' === elementSettings.pause_on_hover) {
      this.togglePauseOnHover(true);
    }
  }
  updateSwiperOption(propertyName) {
    const elementSettings = this.getElementSettings(),
      newSettingValue = elementSettings[propertyName],
      params = this.swiper.params;

    // Handle special cases where the value to update is not the value that the Swiper library accepts.
    switch (propertyName) {
      case 'autoplay_speed':
        params.autoplay.delay = newSettingValue;
        break;
      case 'speed':
        params.speed = newSettingValue;
        break;
    }
    this.swiper.update();
  }
  getChangeableProperties() {
    return {
      pause_on_hover: 'pauseOnHover',
      autoplay_speed: 'delay',
      speed: 'speed'
    };
  }
  onElementChange(propertyName) {
    const changeableProperties = this.getChangeableProperties();
    if (changeableProperties[propertyName]) {
      // 'pause_on_hover' is implemented by the handler with event listeners, not the Swiper library.
      if ('pause_on_hover' === propertyName) {
        const newSettingValue = this.getElementSettings('pause_on_hover');
        this.togglePauseOnHover('yes' === newSettingValue);
      } else {
        this.updateSwiperOption(propertyName);
      }
    }
  }

  // onEditSettingsChange(propertyName) {
  // 	if ('activeItemIndex' === propertyName) {
  // 		this.swiper.slideToLoop(this.getEditSettings('activeItemIndex') - 1);
  // 	}
  // }
}

/***/ }),

/***/ "./src/widgets/js/utils.js":
/*!*********************************!*\
  !*** ./src/widgets/js/utils.js ***!
  \*********************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   setVariable: function() { return /* binding */ setVariable; },
/* harmony export */   thimEkitsGetCookie: function() { return /* binding */ thimEkitsGetCookie; },
/* harmony export */   thimEkitsSetCookie: function() { return /* binding */ thimEkitsSetCookie; }
/* harmony export */ });
function thimEkitsSetCookie(cname, cvalue, exdays) {
  const d = new Date();
  d.setTime(d.getTime() + exdays * 24 * 60 * 60 * 1000);
  const expires = 'expires=' + d.toUTCString();
  document.cookie = cname + '=' + cvalue + ';' + expires + ';path=/';
}
function thimEkitsGetCookie(cname) {
  const name = cname + '=';
  const decodedCookie = decodeURIComponent(document.cookie);
  const ca = decodedCookie.split(';');
  for (let i = 0; i < ca.length; i++) {
    let c = ca[i];
    while (c.charAt(0) == ' ') {
      c = c.substring(1);
    }
    if (c.indexOf(name) == 0) {
      return c.substring(name.length, c.length);
    }
  }
  return '';
}
function setVariable(element, variable, value) {
  element.style.setProperty(variable, value);
}

/***/ }),

/***/ "./src/widgets.scss":
/*!**************************!*\
  !*** ./src/widgets.scss ***!
  \**************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "@wordpress/api-fetch":
/*!**********************************!*\
  !*** external ["wp","apiFetch"] ***!
  \**********************************/
/***/ (function(module) {

module.exports = window["wp"]["apiFetch"];

/***/ }),

/***/ "@wordpress/url":
/*!*****************************!*\
  !*** external ["wp","url"] ***!
  \*****************************/
/***/ (function(module) {

module.exports = window["wp"]["url"];

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/compat get default export */
/******/ 	!function() {
/******/ 		// getDefaultExport function for compatibility with non-harmony modules
/******/ 		__webpack_require__.n = function(module) {
/******/ 			var getter = module && module.__esModule ?
/******/ 				function() { return module['default']; } :
/******/ 				function() { return module; };
/******/ 			__webpack_require__.d(getter, { a: getter });
/******/ 			return getter;
/******/ 		};
/******/ 	}();
/******/ 	
/******/ 	/* webpack/runtime/define property getters */
/******/ 	!function() {
/******/ 		// define getter functions for harmony exports
/******/ 		__webpack_require__.d = function(exports, definition) {
/******/ 			for(var key in definition) {
/******/ 				if(__webpack_require__.o(definition, key) && !__webpack_require__.o(exports, key)) {
/******/ 					Object.defineProperty(exports, key, { enumerable: true, get: definition[key] });
/******/ 				}
/******/ 			}
/******/ 		};
/******/ 	}();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	!function() {
/******/ 		__webpack_require__.o = function(obj, prop) { return Object.prototype.hasOwnProperty.call(obj, prop); }
/******/ 	}();
/******/ 	
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	!function() {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = function(exports) {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	}();
/******/ 	
/************************************************************************/
var __webpack_exports__ = {};
// This entry need to be wrapped in an IIFE because it need to be isolated against other modules in the chunk.
!function() {
/*!************************!*\
  !*** ./src/widgets.js ***!
  \************************/
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _widgets_scss__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./widgets.scss */ "./src/widgets.scss");
/* harmony import */ var _widgets_js_tabs__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./widgets/js/tabs */ "./src/widgets/js/tabs.js");
/* harmony import */ var _widgets_js_mini_cart__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./widgets/js/mini-cart */ "./src/widgets/js/mini-cart.js");
/* harmony import */ var _widgets_js_modal__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./widgets/js/modal */ "./src/widgets/js/modal.js");
/* harmony import */ var _widgets_js_thim_slider__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ./widgets/js/thim-slider */ "./src/widgets/js/thim-slider.js");
/* harmony import */ var _widgets_js_countdown__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ./widgets/js/countdown */ "./src/widgets/js/countdown.js");
/* harmony import */ var _widgets_js_archive_course__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! ./widgets/js/archive-course */ "./src/widgets/js/archive-course.js");
/* harmony import */ var _widgets_js_archive_loadmore__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(/*! ./widgets/js/archive-loadmore */ "./src/widgets/js/archive-loadmore.js");
/* harmony import */ var _widgets_js_course_item_section__WEBPACK_IMPORTED_MODULE_8__ = __webpack_require__(/*! ./widgets/js/course-item-section */ "./src/widgets/js/course-item-section.js");




// import thimEkitsGridListPosts from './widgets/js/gridlist';





// import thimEkitsTriggerOrderby from './widgets/js/orderby';
// import thimEkitsGridList from './widgets/js/gridlist-course';
// import thimEkitsOfferEnd from './widgets/js/offerend';


// import './widgets/js/filter-ajax';

if (!window.ThimEkits) {
  window.ThimEkits = {
    ThimSlider: _widgets_js_thim_slider__WEBPACK_IMPORTED_MODULE_4__["default"],
    ThimEkitsTab: _widgets_js_tabs__WEBPACK_IMPORTED_MODULE_1__["default"],
    ThimCountDown: _widgets_js_countdown__WEBPACK_IMPORTED_MODULE_5__["default"]
  };
}
document.addEventListener('DOMContentLoaded', () => {
  (0,_widgets_js_tabs__WEBPACK_IMPORTED_MODULE_1__["default"])();
  (0,_widgets_js_mini_cart__WEBPACK_IMPORTED_MODULE_2__["default"])();
  (0,_widgets_js_modal__WEBPACK_IMPORTED_MODULE_3__["default"])();
  (0,_widgets_js_archive_course__WEBPACK_IMPORTED_MODULE_6__["default"])();
  //thimEkitsTriggerOrderby();
  // thimEkitsOfferEnd();
});

// callback in Elementor Editor.
document.body.addEventListener('thimEkitsEditor:init', function () {
  (0,_widgets_js_tabs__WEBPACK_IMPORTED_MODULE_1__["default"])();
  (0,_widgets_js_mini_cart__WEBPACK_IMPORTED_MODULE_2__["default"])();
  (0,_widgets_js_modal__WEBPACK_IMPORTED_MODULE_3__["default"])();
});

// callback in Elementor Editor.
document.body.addEventListener('thimEkitsEditor:miniCart', _widgets_js_mini_cart__WEBPACK_IMPORTED_MODULE_2__["default"]);
jQuery(window).on('elementor/frontend/init', () => {
  const addHandler = $element => {
    elementorFrontend.elementsHandler.addHandler(_widgets_js_thim_slider__WEBPACK_IMPORTED_MODULE_4__["default"], {
      $element
    });
    elementorFrontend.elementsHandler.addHandler(_widgets_js_tabs__WEBPACK_IMPORTED_MODULE_1__["default"], {
      $element
    });
  };
  elementorFrontend.hooks.addAction('frontend/element_ready/thim-ekits-list-course.default', addHandler);
  elementorFrontend.hooks.addAction('frontend/element_ready/thim-ekits-list-product.default', addHandler);
  elementorFrontend.hooks.addAction('frontend/element_ready/thim-ekits-list-blog.default', addHandler);
  elementorFrontend.hooks.addAction('frontend/element_ready/thim-ekits-post-related.default', addHandler);
  elementorFrontend.hooks.addAction('frontend/element_ready/thim-ekits-testimonial.default', addHandler);
  elementorFrontend.hooks.addAction('frontend/element_ready/thim-ekits-team.default', addHandler);
  elementorFrontend.hooks.addAction('frontend/element_ready/thim-list-event.default', addHandler);
  elementorFrontend.hooks.addAction('frontend/element_ready/thim-loop-product-countdown.default', $element => {
    elementorFrontend.elementsHandler.addHandler(_widgets_js_countdown__WEBPACK_IMPORTED_MODULE_5__["default"], {
      $element
    });
  });
  elementorFrontend.hooks.addAction('frontend/element_ready/thim-ekits-course-offer-end.default', $element => {
    elementorFrontend.elementsHandler.addHandler(_widgets_js_countdown__WEBPACK_IMPORTED_MODULE_5__["default"], {
      $element
    });
  });

  //
  elementorFrontend.hooks.addAction('frontend/element_ready/thim-tab.default', addHandler);
  elementorFrontend.hooks.addAction('frontend/element_ready/thim-ekits-slider.default', addHandler);
  elementorFrontend.hooks.addAction('frontend/element_ready/thim-ekits-course-item-section.default', $element => {
    (0,_widgets_js_course_item_section__WEBPACK_IMPORTED_MODULE_8__.getOffsetPopupHeaderHeight)($element[0]);
    (0,_widgets_js_course_item_section__WEBPACK_IMPORTED_MODULE_8__.stickySidebar)($element[0]);

    // when window resize, get height class ekit-popup-header and set variable.
    window.addEventListener('resize', () => {
      (0,_widgets_js_course_item_section__WEBPACK_IMPORTED_MODULE_8__.getOffsetPopupHeaderHeight)($element[0]);
    });
  });
  elementorFrontend.hooks.addAction('frontend/element_ready/thim-ekits-archive-course.default', $element => {
    (0,_widgets_js_archive_loadmore__WEBPACK_IMPORTED_MODULE_7__["default"])('.thim-ekits-archive-course', '.thim-ekits-course__inner');
  });
  elementorFrontend.hooks.addAction('frontend/element_ready/thim-ekits-archive-post.default', $element => {
    (0,_widgets_js_archive_loadmore__WEBPACK_IMPORTED_MODULE_7__["default"])('.thim-ekit-archive-post', '.thim-ekit-archive-post__inner');
  });
});
}();
/******/ })()
;
//# sourceMappingURL=widgets.js.map