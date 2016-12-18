/*globals $, WOW, Masonry */
$(document).ready(function () {
    'use strict';
    $('.sp-wrap').smoothproducts();

    var container = document.querySelector('#masonry-grid'),
        msnry = new Masonry(container, {
            // options
            itemSelector: '.grid-item',
            percentPosition: true
        });

    new WOW().init();
});
