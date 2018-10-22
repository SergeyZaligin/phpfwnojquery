(global => {
    'use strict';
   
    const App = global.App || {};
    
    function Review (selector) {
        if (!selector) {
            throw new Error('No selector provided');
        } else {
            this.selector = document.querySelector(selector);
        }
    };
    
    Review.prototype.init = function () {
        
            
        this.selector.addEventListener('click', function (e) {
            console.log('click');


         });
        
        
    };
    
    App.Review = Review;
    global.App = App;
    
})(window);


