!function(e){"use strict";e(document).ready((function(){var t=e(".tp-preview-images");if(e(".right-canvas .tp_demo").hover((function(o){var n=e(this).attr("data-preview");n&&(t.find("img").attr("src",n),t.show())}),(function(){t.hide()})),e(".right-canvas .tp_demo").mousemove((function(e){var o=e.clientY;t.css("top",o-250)})),jQuery("#tp_style_selector").each((function(){var t=jQuery(this);e(".style-toggle.toggle-demo").click((function(e){e.preventDefault(),t.toggleClass("show")})),jQuery("body").on("click",".tp-style-selector.show",(function(e){jQuery(e.target).hasClass("show")&&jQuery(e.target).find(".style-toggle.toggle-demo").trigger("click")})),jQuery(document).on("keyup",(function(e){27===e.keyCode&&t.hasClass("show")&&t.find(".style-toggle.toggle-demo").trigger("click")}))})),jQuery(document).ready((function(){var e=[];jQuery(".tp-filters-wrapper .tp-filters-cats input").on("change",(function(t){var o=jQuery(this).closest(".tp-style-selector"),n=o.find(".tp-demo"),r=o.find(".tp-filters-cats"),i={},s=1;t.preventDefault(),r.each((function(e){var t=jQuery(this),o=t.data("type"),n=new Array;t.find("input:checked").each((function(){if("all"===this.value)return!1;n.push(this.value)})),0<n.length&&(i[o]=n)})),jQuery.each(e,(function(e,t){clearTimeout(t)})),n.hide().addClass("demo-hidden"),n.each((function(){var t=jQuery(this),o=t.data(),n=0;jQuery.each(o,(function(e,t){var o;void 0!==i[e]&&""!==t&&(-1===t.indexOf(",")&&(t+=","),o=t.split(","),jQuery.each(o,(function(t,o){if(-1!==jQuery.inArray(o,i[e]))return n++,!1})))})),n===Object.keys(i).length&&(t.show(),e.push(setTimeout((function(){t.removeClass("demo-hidden")}),50*s)),s++)}))}))})),"loading"in HTMLImageElement.prototype){document.querySelectorAll("img.lazyload").forEach((e=>{e.src=e.dataset.src}))}else{let e=document.createElement("script");e.async=!0,e.src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/4.1.8/lazysizes.min.js",document.body.appendChild(e)}e(".toggle-color").hover((function(){e(".color-preview-wraper").show()}))}))}(jQuery);