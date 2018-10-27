(global => {
    'use strict';
    
    /*beginConstants*/
    const FORM_SIGNUP_SELECTOR = '#signup-form';
    const CATEGORY_MENU_SELECTOR = '.category-list';
    const REVIEW_SELECTOR = '#review-form';
    const MODAL_SELECTOR = '.modal__preview-btn';
    /*endConstants*/

    /*beginGlobals*/
    const App = global.App;
    /*endGlobals*/

    console.log('App===>', App);

    /*beginCommonFunction*/
    const $ = App.$;
    //console.log($);
    /*endCommonFunction*/

    /*beginCategoryMenu*/
    const CategoryMenu = new App.CategoryMenu(CATEGORY_MENU_SELECTOR);
    CategoryMenu.init();
    /*endCategoryMenu*/

    /*beginSignupFormHandler*/
    const SignupHandler = new App.SignupHandler(FORM_SIGNUP_SELECTOR);
    SignupHandler.init();
    /*endSignupFormHandler*/
    
    /*beginModal*/
    const Modal = new App.Modal(MODAL_SELECTOR);
    Modal.init();
    /*endModal*/
    
    /*beginReview*/
    const Review = new App.Modal(REVIEW_SELECTOR);
    Review.init();
    /*endReview*/
    
    $('a').on('click', function() {
        console.log('click');
    });
    $('a').on('click');
})(window);