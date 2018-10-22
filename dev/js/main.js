(global => {
    'use strict';
    
    /*beginConstants*/
    const FORM_SIGNUP_SELECTOR = '#signup-form';
    const CATEGORY_MENU_SELECTOR = '.category-list';
    const REVIEW_SELECTOR = '#form-wrapp';
    /*endConstants*/

    /*beginGlobals*/
    const App = global.App;
    /*endGlobals*/

    console.log('App===>', App);

    /*beginCommonFunction*/
    /*endCommonFunction*/

    /*beginCategoryMenu*/
    const CategoryMenu = new App.CategoryMenu(CATEGORY_MENU_SELECTOR);
    CategoryMenu.init();
    /*endCategoryMenu*/

    /*beginSignupFormHandler*/
    const SignupHandler = new App.SignupHandler(FORM_SIGNUP_SELECTOR);
    SignupHandler.init();
    /*endSignupFormHandler*/
    
    /*beginReview*/
    const Review = new App.Review(REVIEW_SELECTOR);
    Review.init();
    /*endReview*/
  
})(window);