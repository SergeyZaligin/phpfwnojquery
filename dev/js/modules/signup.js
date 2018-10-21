(global => {
    'use strict';
   
    
    /**
     * Object App
     * 
     * @type object |global.App
     */
    const App = global.App || {};
   
    /**
     * Constructor handler form signup
     * 
     * @param {Object} selector
     * @returns {registrationL#1.FormHandler}
     */
    function SignupHandler(selector) {
        if (!selector) {
            throw new Error('No selector provided');
        } else {
            this.selector = document.querySelector(selector);
        }
    }
    
    SignupHandler.prototype.init = function () {
        
        this.selector.addEventListener('submit', e => {
            e.preventDefault();
            const formEntries = new FormData(this.selector).entries();
            const json = Object.assign(...Array.from(formEntries, ([x,y]) => ({[x]:y})));
            fetch('/user/signup', {
                method: 'POST',
                body: JSON.stringify(json)
            });
            console.log(json);
            
        });
        
    };
    
    
   
    App.SignupHandler = SignupHandler;
    global.App = App;
    
})(window);
