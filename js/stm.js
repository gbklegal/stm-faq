/**
 * stm object is an equivalent to the STM PHP class
 * @origin this is copied from the 'Bestellungen' plugin
 */
const stm = {
    /**
     * advanced confirm method
     * @method confirm
     * @param {string} text 
     * @param {string} redirectUrl (optional)
     * @returns {bool}
     */
    confirm(text, redirectUrl = '') {
        let confirmResult = window.confirm(text);

        if (confirmResult === true) {
            if (redirectUrl !== '')
                window.location.href = redirectUrl;
            return true;
        }

        return false;
    },

    /**
     * add notification (info bar)
     * @method addNotification
     * @param {int} typeIndex
     * @param {string} content
     * @param {string} details (optional)
     * @param {bool} hideable (optional)
     * @returns {bool}
     */
    addNotification(typeIndex, content, details = '', hideable = false) {
        const notificationClasses = [
            'notice notice-success',
            'notice notice-warning',
            'notice notice-error',
            'notice notice-notice',
            'notice notice-info'
        ];
        const className = notificationClasses[typeIndex];
        let notification = document.createElement('div');
        let contentDetails = '';

        if (typeIndex > notificationClasses.length || typeIndex < 0) {
            return false;
        }

        if (details !== '') {
            contentDetails = `
                <a href="${details}">Details ansehen</a>
            `;
        }

        notification.style.display = 'none';
        notification.style.position = 'relative';
        notification.className = className;
        notification.innerHTML = `
            <p>
                ${content}
                ${contentDetails}
            </p>
        `;



        if (hideable === true) {
            notification.innerHTML += `
                <button onclick="jQuery(this.parentElement).slideUp()" type="button" class="notice-dismiss"></button>
            `;
        }

        let parentElmt = document.querySelector('#stm-faq');
        let hrElmt = document.querySelectorAll('#stm-faq hr')[0];

        parentElmt.insertBefore(notification, hrElmt);
        jQuery(notification).slideDown();

        return true;
    },


    /**
     * Evaluates from the location the hash
     * @method hash
     */
    hash() {
        const hash = window.location.hash;
        const hashValue = hash.split('#')[1];

        function clearHash() {
            const url = window.location.pathname + window.location.search;
            history.pushState('', document.title, url);
        }

        switch (hashValue) {
            case 'success_saved_position':
                stm.addNotification(0, 'Die Reihenfolge der FAQs Elemente wurde erfolgreich gespeichert.', '');
                break;

            case 'failed_saved_position':
                stm.addNotification(2, 'Die Reihenfolge der FAQs Elemente konnte nicht gespeichert werden.', '');
                break;

            case 'success_saved_faq_item':
                stm.addNotification(0, 'Das FAQ Element wurde erfolgreich gespeichert.', '');
                break;

            case 'failed_saved_faq_item':
                stm.addNotification(2, 'Das FAQ Element konnte nicht gespeichert werden.', '');
                break;

            case 'success_created_faq_item':
                stm.addNotification(0, 'Das FAQ Element wurde erfolgreich erstellt.', '');
                break;

            case 'failed_created_faq_item':
                stm.addNotification(2, 'Das FAQ Element konnte nicht erstellt werden.', '');
                break;

            case 'success_removed_faq_item':
                stm.addNotification(0, 'Das FAQ Element wurde erfolgreich gelöscht.', '');
                break;

            case 'failed_removed_faq_item':
                stm.addNotification(2, 'Das FAQ Element konnte nicht gelöscht werden.', '');
                break;
        }

        if (hashValue !== '')
            clearHash();
    },


    /**
     * returns in the console a brief info
     * @method info
     */
    info() {
        console.info('stm object v0.2');
    }
}