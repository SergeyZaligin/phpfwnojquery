(global => {
    'use strict';
    
    const App = global.App || {};
    
    function $ (selector) {
       
        const elems = document.querySelectorAll(selector);
        
        return new Elems(elems);
        
    };
    
    function Elems (elems) {
        
        this.elems = elems || [];
        
        this.hide = (type = 'none') => {
            
            const cnt = elems.length-1;
            
            for (let i = cnt; i >= 0; i--) {
                elems[i].style.display = type;
            }
            
            return this;
        };
        
        this.show = (type = 'block') => {
            
            const cnt = elems.length-1;
            
            for (let i = cnt; i >= 0; i--) {
                elems[i].style.display = type;
            }
            
            return this;
        };
    }
    
    App.$ = $;
    global.App = App;
    
})(window);


