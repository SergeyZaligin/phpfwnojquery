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
            this.selector = document.querySelector(selector);
        }
    }
    
    CategoryMenu.prototype.init = function () {
        
        this.selector.addEventListener('click', function (e) {
            
            e.stopPropagation();
 
            const parentLi = document.querySelectorAll('.parent-li');
            
            if (e.target.nodeName === 'A') {
                
                const a = e.target;
                
                if (e.target.parentNode.className === 'parent-li') {
                    e.preventDefault();
                    a.classList.toggle('active');
                    console.log('path');
                }
                
            }
            
        }, false);
    }
    
    
   
    App.CategoryMenu = CategoryMenu;
    global.App = App;
    
})(window);



