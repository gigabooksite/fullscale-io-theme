(() => {
    let init = () => {
        const btnProceed = document.getElementById('btn_proceed');

        if (btnProceed) {
            btnProceed.addEventListener('click', (e) => {
                e.preventDefault();
                
                // set cookie for up to 7 days
                setCookie('is-proceed', 1, 7);
                
                // hide data-privacy modal
                let dataPrivacyModal = document.querySelector('.modal.data-privacy');
                dataPrivacyModal.style.display = 'none';
            });
        }

        let setCookie = (cname, cvalue, exdays) => {
            const d = new Date();
            d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
            let expires = "expires="+d.toUTCString();
            document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
        }
        
        /**
         * @description Dialog Box
         * 
         * @author Ryan Sutana
         */
        const btnDialogClose = document.getElementById('dialog_close')

        if (btnDialogClose) {
            btnDialogClose.addEventListener('click', (e) => {
                e.preventDefault();

                console.log(e)
                
                // do nothing if dialog is not not even visible
                if (!document.body.classList.contains('dialog-open')) {
                    return
                }
                
                // now hides the dialog box
                document.body.classList.remove('dialog-open')
            })
        }
    }

    window.addEventListener('load', init());
})();

/**
 * @description Make CSS equal height
 * 
 */
(function($) {
    $.fn.equalHeightify = function() {
        // keep track of the greatest height
        let highest = 0; 

        // loop all provided DOM elements
        jQuery(this).each(function() {
            // compare heights
            if (jQuery(this).height() > highest) {
                highest = jQuery(this).height();
            }
        });

        // set new height
        jQuery(this).height(highest); 
    }
})(jQuery);