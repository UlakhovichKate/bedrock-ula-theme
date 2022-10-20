/**
 * Carousel
 * ---------
 * @component App/Foundation
 * @version 1.0
 *
 */
'use strict';

import Swiper, { Navigation, Pagination, Scrollbar } from 'swiper';

class Carousel {

    constructor(el) {
        this.carousel = document.querySelectorAll(el);
        if (this.carousel == null) return;

        this.carousel.forEach((entry) => {
            this.init(entry, el);
        });
    }

    init(slider, el) {

        Swiper.use([Navigation, Pagination, Scrollbar]);

        new Swiper('.swiper', {
            speed: 800,
            slidesPerView: 1,
            spaceBetween: 20,
            centeredSlides: true,
            loop: true,
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            scrollbar: {
                el: '.swiper-scrollbar',
                hide: true,
            },
            breakpoints: {
                500: {
                    centeredSlides: false,
                    slidesPerView: 2,
                    spaceBetween: 60,
                },
            },
        });
    }
}

new Carousel('.gallery');
