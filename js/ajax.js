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

                let message             = el.querySelector('#message'),
                    gettingStartedBtn   = el.querySelector('#getting_started_btn'),
                    loaderImg           = el.querySelector('#loader'),
                    nonce               = el.querySelector('#fs_client_onboarding_nonce'),
                    email               = el.querySelector('#email'),
                    env                 = el.querySelector('#env')

                let contents = { 
                    action:	'client_onboarding',
                    nonce:	nonce.value,
                    email:  email.value,
                    env:  env.value
                }
                
                gettingStartedBtn.setAttribute('disabled', 'disabled')
                loaderImg.style.display = 'block'
                
                $.post( fs_ajax_params.ajaxurl, contents, function(data) {
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
    
    // view profile event propagation block, 
    // it reads/uses the dialog box document handler
    const profileDialogSingle = document.querySelector('.profile-single')
    if (profileDialogSingle) {
        profileDialogSingle.addEventListener('click', (e) => {
            
            if('A' !== e.target.tagName) {
                return
            }

            const lang              = e.target.getAttribute('data-lang')
            const talentId          = e.target.getAttribute('data-id')
            const talentUniqueId    = e.target.getAttribute('data-uid')
            
            // if the click anchor don't have unique ID, stop
            if (null === talentUniqueId) {
                return
            }

            // request, to display more talent info            
            const args = [
                {
                    action:	'view_profile',
                    lang: lang,
                    talentId: talentId,
                    talentUniqueId: talentUniqueId,
                    endpoint_url: fs_ajax_params.endpoint, 
                },
                'preparing talent profile...'
            ]
            
            const profileSingle = document.getElementById('profile_single')
                
            // set our loading
            profileSingle.innerHTML = loader('preparing talent profile...')

            // submit a POST request
            postRequest(...args)
        })
    }

    // shortcode btn 'view profile'
    const btnProfiles = document.querySelectorAll('.tech-talents .btn-profile')
    
    if (btnProfiles.length > 0) {
        btnProfiles.forEach(profile => {
            profile.addEventListener('click', (e) => {
                e.preventDefault()
                
                // scroll-top
                window.scroll({
                    top: 200,
                    left: 0,
                    behavior: 'smooth'
                });
                
                const lang              = profile.getAttribute('data-lang')
                const talentId          = profile.getAttribute('data-id')
                const talentUniqueId    = profile.getAttribute('data-uid')

                // if talentUniqueId is empty stop
                if ('' === talentUniqueId) {
                    return
                }
                
                // request, to display more talent info            
                const args = [
                    {
                        action:	'view_profile',
                        lang: lang,
                        talentId: talentId,
                        talentUniqueId: talentUniqueId,
                        endpoint_url: fs_ajax_params.endpoint,
                    },
                    'preparing talent profile...'
                ]
                
                const profileSingle = document.getElementById('profile_single')
                
                // set our loading
                profileSingle.innerHTML = loader('preparing talent profile...')
                
                // submit a POST request
                postRequest(...args)
            })
        })
    }

    /**
     * @description This submit post request
     * 
     * @param {Objec} data 
     * @param {String} loadingText 
     */
    let postRequest = (data, loadingText) => {
        // okay, our data is ready now open dialog-box
        document.body.classList.add('dialog-open')
        
        const profileSingle = document.getElementById('profile_single')
        
        // set our loading
        profileSingle.innerHTML = loader(loadingText)

        $.post( fs_ajax_params.ajaxurl, data, function(data) {
            // print HTML data to dialog view
            profileSingle.innerHTML = data
        }, 'json')
    }
    
    /**
     * @description Basic loader
     * 
     * @param {String} loadingText 
     */
    let loader = (loadingText = 'loading...') => {
        return `
            <div id="profile_single" class="profile-single">
                <section class="elementor-section elementor-top-section elementor-element elementor-section-boxed elementor-section-height-default elementor-section-height-default">
                    <div class="elementor-container elementor-column-gap-default">
                        <div class="elementor-column elementor-col-100 elementor-top-column elementor-element">
                            <div class="elementor-widget-wrap elementor-element-populated">
                                <div class="rounded-md dialog__body">
                                    <div class="profile-single__inner">
                                        
                                        <div class="text-center">
                                            <figure class="mb-0">
                                                <img src="${fs_ajax_params.stylesheet_directory}/images/three-dots.svg" />
                                            </figure>
                                            <p class="mb-0">${loadingText}</p>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        `
    }
    
});