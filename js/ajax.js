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
    
    // view profile
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
                }
            ]
            
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
                
                // okay, our data is ready now open dialog-box
                document.body.classList.add('dialog-open')
                
                const data = {
                    action:	'view_profile',
                    lang: lang,
                    talentId: talentId,
                    talentUniqueId: talentUniqueId,
                    endpoint_url: fs_ajax_params.endpoint,
                }
                
                const profileSingle = document.getElementById('profile_single')

                // set our loading
                profileSingle.innerHTML = loader()

                $.post( fs_ajax_params.ajaxurl, data, function(data) {
                    // repopulate data
                    profileSingle.innerHTML = data
                }, 'json')
            })
        })
    }

    let postRequest = (params) => {
        // okay, our data is ready now open dialog-box
        // document.body.classList.add('dialog-open')
        
        const data = [params]
        
        console.log(data)
        
        // $.post( fs_ajax_params.ajaxurl, data, function(data) {
        //     const profileSingle = document.getElementById('profile_single')
        
        //     profileSingle.innerHTML = data
        // }, 'json')
    }

    let loader = (loadingText = 'loading...') => {
        return `
            <div id="profile_single" class="profile-single">
                <section class="elementor-section elementor-top-section elementor-element elementor-section-boxed elementor-section-height-default elementor-section-height-default">
                    <div class="elementor-container elementor-column-gap-default">
                        <div class="elementor-column elementor-col-100 elementor-top-column elementor-element">
                            <div class="elementor-widget-wrap elementor-element-populated">
                                <div class="rounded-md dialog__body">
                                    <div class="profile-single__inner">
                                        ${loadingText}
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