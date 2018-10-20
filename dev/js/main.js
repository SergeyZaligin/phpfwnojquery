(function (global) {
    'use strict';

    

    /*beginConstants*/
    var FORM_SIGNUP_SELECTOR = '#signup-form';
    var DC_ACCORDION_SELECTOR = '.my-menu';
    var JQUERY_UI_DIALOG_SELECTOR = '#form-wrapp';
    /*endConstants*/

    /*beginGlobals*/
    var App = global.App;
    var $ = global.jQuery;
    /*endGlobals*/

    console.log('App===>', App);

    /*beginCommonFunction*/

    function ajax($formData, method, url, $result) {
        
        var msg = $($formData).serialize();

        $.ajax({
            type: method,
            url: url,
            data: msg,
            success: function (res) {
                
                $($result).html(res);
                //if ($("#results").val() == "SUCCESS VALIDATION") {
                //    addData();
                //}
                //console.log(data);
            },
            error: function (xhr, str) {
                alert("Возникла ошибка!");
            }
        });

    }
    /*endCommonFunction*/

    /*beginSignupFormHandler*/
    var FormHandler = new App.FormHandler(FORM_SIGNUP_SELECTOR);
    FormHandler.validationSignupForm(FORM_SIGNUP_SELECTOR, {

        submitHandler: function (form) {
            console.log('FORM ===>', form);
            ajax('#signup-form', 'POST', '/user/signup', '#results');
        },
        rules: {
            login: {
                required: true,
                minlength: 3
            },
            email: {
                required: true
            },
            password: {
                required: true,
                minlength: 6
            }
        },
        messages: {
            login: {
                required: "Поле 'Логин' обязательно к заполнению",
                minlength: "Введите не менее 3-х символов в поле 'Логин'"
            },
            email: {
                required: "Поле 'Email' обязательно к заполнению",
                email: "Необходим формат адреса email"
            },
            password: {
                required: "Поле 'Пароль' обязательно к заполнению",
                minlength: "Введите не менее 6 символов в поле 'Пароль'"
            }
        }

    });
    /*endSignupFormHandler*/


    /*beginLibsInit*/
    var LibsInit = new App.LibsInit();
    LibsInit.initDcAccrodion(DC_ACCORDION_SELECTOR, {});
    LibsInit.initJqueryUiDialog(JQUERY_UI_DIALOG_SELECTOR);
    /*endLibsInit*/



})(window);
