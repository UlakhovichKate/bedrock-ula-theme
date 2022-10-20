/**
* Masthead Scroll
* ---------
* @component app/masthead
* @version 1.0
*
* @doc https://wicky.nillia.ms/headroom.js/
*/
'use strict';

import Headroom from 'headroom.js';

class MastheadScroll {

    constructor(el, offset) {
        this.masthead = document.querySelector(el);
        if (this.masthead == null) return;
        this.setupHeadroom(offset);
    }

    setupHeadroom(offset) {

        const options = {
            offset : offset,
            classes : {
                // when element is initialised
                initial : "has--headroom",
                // when scrolling up
                pinned : "is--pinned",
                // when scrolling down
                unpinned : "is--unpinned",
                // when above offset
                top : "is--top",
                // when below offset
                notTop : "is--not-top",
                // when at bottom of scoll area
                bottom : "is--bottom",
                // when not at bottom of scroll area
                notBottom : "is--not-bottom",
                // when frozen method has been called
                frozen: "is--frozen"
            },
        };

        const headroom = new Headroom(this.masthead, options);
        headroom.init();
    }
}

new MastheadScroll('.header', 60);
