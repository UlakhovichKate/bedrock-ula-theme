/**
* Newsletter
* ---------
* @component App/Foundation
* @version 1.0
*
*/

class Newsletter {

    constructor(el) {
        this.newsletter = document.querySelectorAll(el);
        if (this.newsletter == null) return;

        this.newsletter.forEach(entry => {
            this.submission(entry);
        });
    }

    isEmailFilled(newsletter) {
        let email = newsletter.querySelector('input[name="email"]');
        email.onkeyup = () => this.readyToSubmit(email, newsletter);
    }

    readyToSubmit(email, newsletter) {
        if (email.value.length != 0 && email.value != '' ) {
            newsletter.classList.add('is-submittable');
        } else {
            newsletter.classList.remove('is-submittable');
        }
    }

    lowerCase(email) {
        return String(email).toLowerCase();
    }

    subscribeSubmitting(newsletter) {
        newsletter.classList.add('is-submitting');
        newsletter.querySelector('.js-newsletter-text').innerHTML = 'Loading';
    }

    subscribeFail(newsletter) {
        newsletter.classList.add('has-failed');
        newsletter.classList.remove('is-submitting');
        newsletter.querySelector('.js-newsletter-text').innerHTML = 'Not subscribed';

        setTimeout(() => {
            this.subscribeReset(newsletter);
        }, 3000);
    }

    subscribeReset(newsletter) {
        newsletter.classList.remove('has-failed', 'has-success', 'is-submittable');
        newsletter.querySelector('.js-newsletter-text').innerHTML = 'subscribe';
        newsletter.reset();
    }

    subscribeSuccess(newsletter) {
        newsletter.classList.add('has-success');
        newsletter.classList.remove('is-submitting');
        newsletter.querySelector('.js-newsletter-text').innerHTML = 'Subscribed';

        setTimeout(() => {
            this.subscribeReset(newsletter);
        }, 10000);
    }

    submission(newsletter) {

        this.isEmailFilled(newsletter);

        newsletter.addEventListener('submit', (e) => {
            e.preventDefault();

            this.subscribeSubmitting(newsletter);

            let data = new FormData(newsletter);

            data.set('email', this.lowerCase(data.get('email')));
            data.set('action', 'mailchimp_subscribe');

            // Prepare Data
            data = new URLSearchParams(data);

            fetch(document.location.href + '/wp-admin/admin-ajax.php', {
                method: "POST",
                body: data,
            }).then(res => res.json())
                .catch(error => {
                    console.log(error);
                    this.subscribeFail(newsletter);
                })
            .then(response => {
                if (response === 0 || response.status === 'error') {
                    console.log(response);
                    this.subscribeFail(newsletter);
                    return;
                }
                this.subscribeSuccess(newsletter);
            });

        });
    }
}

new Newsletter('.js-newsletter-form');
