/**
 * Modal
 * ---------
 * @component Components
 * @version 1.0
 *
 */
'use strict';

class Modal {

    constructor(el) {
        this.nodes = document.querySelectorAll(el);
        if (this.nodes == null) return;

        this.modalTiggerClick(this.nodes);
    }

    modalTiggerClick(nodes) {

        nodes.forEach(el => {

            const button = el.querySelector('.js-modal-open');
            console.log(button);
            if (button) {
                const modalID = button.dataset.modal;
                const modal = document.querySelector('[data-modal="js-modal-form"]');

                button.onclick = () => {
                    this.modalOpen(modal);
                }

                modal.querySelector('[data-modal-close="js-modal-form"]').onclick = () => {
                    this.modalClose(modal);
                }
            }

        });

    }

    modalOpen(el) {
        el.classList.remove('is-closed');
        el.classList.add('is-open');
        document.body.classList.add('js-has-modal-open');
    }

    modalClose(el) {
        el.classList.remove('is-open');
        el.classList.add('is-closed');
        document.body.classList.remove('js-has-modal-open');
    }

}
new Modal('.c-page__modal');
