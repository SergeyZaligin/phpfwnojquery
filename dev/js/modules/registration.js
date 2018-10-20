(global => {
    'use strict';
   
    
    /**
     * Object App
     * 
     * @type object |global.App|global.App
     */
    const App = global.App || {};
    
    //const LibsInit = new App.LibsInit;
    
    /**
     * Constructor handler form signup
     * 
     * @param {Object} selector
     * @returns {registrationL#1.FormHandler}
     */
    function FormHandler(selector) {
        if (!selector) {
            throw new Error('No selector provided');
        }
    }
    

    
    
   
    App.FormHandler = FormHandler;
    global.App = App;
    
})(window);
