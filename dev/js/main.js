(global => {
    'use strict';
    
    /*beginConstants*/
    const FORM_SIGNUP_SELECTOR = '#signup-form';
    const CATEGORY_MENU_SELECTOR = '.category-list';
    const JQUERY_UI_DIALOG_SELECTOR = '#form-wrapp';
    /*endConstants*/

    /*beginGlobals*/
    const App = global.App;
    /*endGlobals*/

    console.log('App===>', App);

    /*beginCommonFunction*/
    
    
        

//    function ajax($formData, method, url, $result) {
//        
//        var msg = $($formData).serialize();
//
//        $.ajax({
//            type: method,
//            url: url,
//            data: msg,
//            success: function (res) {
//                
//                $($result).html(res);
//                //if ($("#results").val() == "SUCCESS VALIDATION") {
//                //    addData();
//                //}
//                //console.log(data);
//            },
//            error: function (xhr, str) {
//                alert("Возникла ошибка!");
//            }
//        });
//
//    }
    /*endCommonFunction*/

    /*beginCategoryMenu*/
    const CategoryMenu = new App.CategoryMenu(CATEGORY_MENU_SELECTOR);
    CategoryMenu.init();
    /*endCategoryMenu*/

    /*beginSignupFormHandler*/
    const SignupHandler = new App.SignupHandler(FORM_SIGNUP_SELECTOR);
    SignupHandler.init();
    /*endSignupFormHandler*/
    
    /*beginLibsInit*/
    //const LibsInit = new App.SignupHandler();
   
    /*endLibsInit*/
    
    
    
//    parentItems.addEventListener('click', function (e) {
//        e.preventDefault();
//    });
    
    

})(window);