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

        /**
         * Dialog
         */
        const btnDialogClose = document.getElementById('dialog_close')

        btnDialogClose.addEventListener('click', (e) => {
            e.preventDefault();
            
            // do nothing if dialog is not not even visible
            if (!document.body.classList.contains('dialog-open')) {
                return
            }

            // now hides the dialog box
            document.body.classList.remove('dialog-open')
        })
    }
    
    let setCookie = (cname, cvalue, exdays) => {
        const d = new Date();
        d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
        let expires = "expires="+d.toUTCString();
        document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
    }

    window.addEventListener('load', init());
})();