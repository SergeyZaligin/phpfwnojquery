(global => {
    'use strict';
   
    const App = global.App || {};
    
    function Review (selector) {
        if (!selector) {
            throw new Error('No selector provided');
        } else {
            this.selector = document.querySelector(selector);
        }
    }
    
    Review.prototype.init = function () {
        
        if (this.selector) {
           
        } else {
            return false;
        }
        
    }
    
    App.Review = Review;
    global.App = App;
    
})(window);




