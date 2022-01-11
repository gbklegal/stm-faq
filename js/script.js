const createFaqItemBtn = document.querySelector('#createFaqItem');
const items = document.querySelector('#faqItems');

/**
 * sortable library
 * @see https://github.com/lukasoppermann/html5sortable#readme
 */
sortable(items, {
    connectWith: 'grab-handle',
    forcePlaceholderSize: true
});