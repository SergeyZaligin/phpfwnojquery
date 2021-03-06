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
        if (this.selector) {
            this.selector.addEventListener('submit', e => {
                e.preventDefault();
                const formEntries = new FormData(this.selector).entries();
                const dataForm = JSON.stringify(Object.assign(...Array.from(formEntries, ([x,y]) => ({[x]:y}))));

                fetch('/user/signup', {
                   method: "post",
                   headers: {
                       "Accept": 'application/json, text/plain, */*',
                       "Content-Type": "application/json"
                   },
                   body: dataForm
                }).then(function(res) {  
                        return res.text();  
                    }).then(function(data){
                        console.log(data);
                    });
            });
        } else {
            return false;
        }
        
        
    };
    
    App.SignupHandler = SignupHandler;
    global.App = App;
    
})(window);
