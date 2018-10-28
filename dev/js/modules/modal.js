(global => {
    'use strict';
   
    const App = global.App || {};
    
    function Modal (selector) {
        if (!selector) {
            throw new Error('No selector provided');
        } else {
            this.selector = document.querySelector(selector);
        }
    };
    
    Modal.prototype.init = function () {
        if (this.selector) {
            this.selector.addEventListener('click', function (e) {
                console.log('click');

                //                 var parent = $(this).attr('data');
                //
                //                 if (!parseInt(parent)) {
                //                     parent = 0;
                //                 }
                //
                //                 $('input[name="parent"]').attr('value', parent);
                //
                //                 $(selector).dialog('open');

                             });

        } else {
            return false;
        }
            
                    
        
    };
    
    App.Modal = Modal;
    global.App = App;
    
})(window);




