/*
 * @author Ryan Sutana
 * @description Pass all datas requested through wp-ajax
 * @since v 1.0
 */

jQuery(document).ready(function($) {
    let clientOnboardingForms = document.querySelectorAll('.client-onboarding-forms')

    if (clientOnboardingForms.length > 0) {
        clientOnboardingForms.forEach(el => {
            el.addEventListener('submit', (e) => {
                e.preventDefault();

                let message = el.querySelector('#message'),
                    gettingStartedBtn = el.querySelector('#getting_started_btn'),
                    loaderImg = el.querySelector('#loader'),
                    nonce = el.querySelector('#fs_client_onboarding_nonce'),
                    email = el.querySelector('#email'),
                    env = el.querySelector('#env')

                let contents = { 
                    action:	'client_onboarding',
                    nonce:	nonce.value,
                    email:  email.value,
                    env:  env.value
                }
                
                gettingStartedBtn.setAttribute('disabled', 'disabled')
                loaderImg.style.display = 'block'
                
                $.post( client_onboarding.ajaxurl, contents, function(data) {
                    // console.log(data)?
                    gettingStartedBtn.removeAttribute('disabled')
                    loaderImg.style.display = 'none'
                
                    if (200 == data.status) {
                        // message.innerHTML = `<p class="success">${data.message}</p>`
                        
                        // redirect to Client Portal
                        window.location.href = data.redirection_url
                    }
                    else {
                        message.innerHTML = `<p class="error">${data}</p>`
                    }
                })
            })
        })
    }
    
    // view profile
    const btnProfiles = document.querySelectorAll('.tech-talents .btn-profile')
    
    if (btnProfiles.length > 0) {
        btnProfiles.forEach(profile => {
            profile.addEventListener('click', (e) => {
                e.preventDefault();
                
                const profileId = profile.getAttribute('data-id')

                // scroll-top
                window.scroll({
                    top: 200,
                    left: 0,
                    behavior: 'smooth'
                });
                
                // display view-profile dialog blox
                document.body.classList.add('dialog-open')

                console.log(profileId)
                // ajax request goes here!!!!
            })
        })
    }

    
});