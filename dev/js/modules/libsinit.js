(function(global){
    
    
    /**
     * Object App
     * 
     * @type object |global.App|global.App
     */
    var App = global.App || {};
    
    /**
     * Object jQuery
     * 
     * @type global.jQuery
     */
    var $ = global.jQuery;
    
    /**
     * Constructor Libs init
     * 
     * @param {Object} selector
     * @returns {registrationL#1.FormHandler}
     */
    function LibsInit() {}
    
    /**
     * Init libs object and his settings
     * 
     * @returns {undefined}
     */
    LibsInit.prototype.initDcAccrodion = function (selector, obj) {
        
        $(selector).dcAccordion(obj);

    };
    
    LibsInit.prototype.initJqueryUiDialog = function (selector) {
        $(selector).dialog({
            title: 'Оставить отзыв',
            autoOpen: false,
            width: 450,
            modal: true,
            resizible: false,
            draggable: false,
            show: {
                effect: "blind",
                duration: 1000
            },
            hide: {
                effect: "explode",
                duration: 1000
            },
            buttons: {
                "Добавить отзыв": function () {
                    var dataForm = $('.form').serialize();
                    var parent = $('#parent').val();
                    
                    $.ajax({
                        type: 'post',
                        url: '/product',
                        data: dataForm,
                        success: function (res) {
                            
                            var showComment = "<li class='new-comment'>" + res + "</li>";
                            
                            console.log('Ajax', showComment);
                            
                            if (parent == 0) {
                                $('ul.comments').append(showComment);
                            } else {
                                var parentComment = $this.closest('li');
                                var child = parentComment.children('ul');
                                if (child.length) {
                                    child.append(showComment);
                                } else {
                                    parentComment.append('<ul>' + showComment + '</ul>')
                                }
                            }
                            //$("#result").html(res);
                        },
                        error: function (xhr, str) {
                            alert("Возникла ошибка!");
                        }
                    });
                },
                "Отмена": function () {
                    $(this).dialog('close');
                }
            }
        });
        
        $('.comment-open-btn').on('click', function () {
            
            $this = $(this);
            
//            var parentComment = $this.closest('li');
//            var child = parentComment.find('ul');
//            console.log('Parent comment', child.length);
            
            var parent = $(this).attr('data');
            
            if (!parseInt(parent)) {
                parent = 0;
            }
            
            $('input[name="parent"]').attr('value', parent);
            
            $(selector).dialog('open');
            
        });
    };
    
    App.LibsInit = LibsInit;
    global.App = App;
    
})(window);


