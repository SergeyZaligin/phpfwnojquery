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
        const formBtn = document.querySelector('.comment-open-btn');
            
            formBtn.addEventListener('click', function (e) {
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
        
        
    };
    
    App.Review = Review;
    global.App = App;
    
})(window);




