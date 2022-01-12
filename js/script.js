const itemsElmt = document.querySelector('#faqItems');
const removeFaqItemBtns = document.querySelectorAll('.removeFaqItemBtn');
const saveFaqItemsPositionBtn = document.querySelector('#saveFaqItemsPosition');

/**
 * jQuery UI sortable
 */
jQuery(function() {
    jQuery('#faqItems').sortable({
        handle: '.grab-handle',
        cursor: 'grabbing'
    });
});


/**
 * position runner
 * this script runs through all items and collects there id, the array index is there position
 * which will be returned as array or string
 * @param {boolean} returnAsString
 * @returns {array|string}
 */
function positionRunner(returnAsString = false) {
    let items = document.querySelectorAll('#faqItems .item');
    let positions = [];

    items.forEach(item => positions.push(item.dataset.itemId))

    if (returnAsString)
        return positions.toString();

    return positions;
}


if (saveFaqItemsPositionBtn)
    saveFaqItemsPositionBtn.addEventListener('click', function(event) {
        event.preventDefault();

        let faqItemsPosition = positionRunner(true);

        window.location.href = this.href + '&items_position=' + faqItemsPosition;
});


if (removeFaqItemBtns)
    removeFaqItemBtns.forEach(btn => {
        btn.addEventListener('click', function (event) {
            event.preventDefault();

            stm.confirm('Bist du sicher, dass du dieses FAQ Element löschen willst?', this.href);
        });
    })


window.onhashchange = stm.hash;
window.onload = stm.hash;