(function(global){
    'use strict';
   
    
    /**
     * Object App
     * 
     * @type object |global.App|global.App
     */
    var App = global.App || {};
    
    const LibsInit = new App.LibsInit;
    
    /**
     * Object jQuery
     * 
     * @type global.jQuery
     */
    var $ = global.jQuery;
    
    
    
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
        
        this.$formElement = $(selector);

    }
    
    FormHandler.prototype.validationSignupForm = function (selector, obj) {
        
        $(selector).validate(obj);
        
    }
   
    App.FormHandler = FormHandler;
    global.App = App;
    
})(window);
