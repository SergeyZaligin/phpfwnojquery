(global => {
    'use strict';
   
    
    /**
     * Object App
     * 
     * @type object |global.App|global.App
     */
    const App = global.App || {};
    
    /**
     * Constructor category menu
     * 
     * @param {Object} selector
     * @returns {registrationL#1.FormHandler}
     */
    function CategoryMenu (selector) {
        if (!selector) {
            throw new Error('No selector provided');
        } else {
            this.selector = selector;
        }
    }
    
    CategoryMenu.prototype.init = function () {
        console.log('Category menu', this.selector);
    }
    
    
   
    App.CategoryMenu = CategoryMenu;
    global.App = App;
    
})(window);



