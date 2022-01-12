const createFaqItemBtn = document.querySelector('#createFaqItem');
const items = document.querySelector('#faqItems');

/**
 * jQuery UI sortable
 */
jQuery(function() {
    jQuery('#faqItems').sortable({
        handle: '.grab-handle',
        cursor: 'grabbing'
    });
});
