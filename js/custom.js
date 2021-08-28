jQuery(document).ready(function ($) {
    /* 
    select количества товаров на странице
    */
    $('select#limit').attr({
        'class': 'selectpicker',
        'data-style': 'btn-default btn-block'
    }).show();

    /* Выбор первого изображения в airslider при смене вида каталога */
    var block = $('.vm-trumb-slider');
    if(block){
        $('.product-view a').click(function() {
            var topHeight = $(document).scrollTop();
            $('.slick-dots li:first-child button').trigger('click');
            $('html, body').scrollTop(topHeight);
            return false;
        });
    }
    
    /*
    radio button в настраиваемых полях
    */
    function radioField(){
        $('.product-field-type-S label.radio').addClass('radio-blue');
        $('.product-field-type-S label.radio input').attr('data-toggle', 'radio');
        $('.product-field-type-S label.radio').click(function(){
           $(this).find('input').prop( "checked", true ); 
        });
    }
    radioField();
    
    /*
    выбор первой radio кнопки
    */
    function radioFirst() {
        $('.addtocart-area .product-field-type-S').each(function(){
            $(this).find('input[type="radio"]:first').prop("checked", true );
        });
    }
    radioFirst();
    
    /*
    автофокус при показе поля поиска в шапке
    */
    $('.block-search .fa-search').click(function(){
        setTimeout(function(){$('.block-search input#mod_virtuemart_search').focus();}, 700);
    });
    
    /*
    select в настраиваемых полях
    */
    function selectFiels() {
        $('.product-field-type-S select, .product-field-type-C select').addClass('selectpicker').attr({
            'data-style': 'btn-default btn-block',
            'data-menu-style': 'dropdown-blue'
        });
    }
    selectFiels();
    
    /*
    Переключение табов при просмотре отзывов
    */
    var hash = window.location.hash;
    if(hash == '#review-tab'){
        $('.tab-home, .tab-content #home').removeClass('active');
        $('.tab-reviews').addClass('active');
        $('.tab-content #reviews').addClass('active in');
        $('.nav-tabs li').click(function() {
            var topHeight = $(document).scrollTop();
            window.location.hash = ''; 
            $('html, body').scrollTop(topHeight);
        });
    } 
    
    /*
    КОРЗИНА VP One Page
    */
    function cartVirtuemart(){
        /*удалить всплывающие подсказки у полей в корзине*/
        setTimeout(function(){
           $('.view-cart .hover-tootip').removeAttr('data-tiptext'); 
        }, 1500);

        /*активировать чекбокс tos (скрыт по умолчанию) в контактных данных*/
        $('.view-cart .proopc-bt-address input.terms-of-service').attr('checked', 'checked');
    }
    cartVirtuemart();
    
    /*скрипты после ajax обновления корзины */
    jQuery(document).ajaxComplete(function(event, xhr, settings) {       
        if(settings.data == "task=procheckout"){
            jQuery('#phone_1_field').mask('+7(999) 999-99-99').attr('placeholder','');
            cartVirtuemart();
        }
    });   
    
    /*
    КОРЗИНА ONE PAGE
    */
    /*способы доставки*/
    function cartShipment(){
        $('#shipment_select :radio').radio();
        $('#shipment_select :radio').on('toggle', function() {
            setshipment(); 
        });   
    }
    cartShipment();  
    
    /*способы оплаты*/
    function cartPayment(){
        $('#payment_select :radio').radio();
        $('#payment_select :radio').on('toggle', function() {
            setpayment(); 
        });          
    }
    cartPayment(); 
    
    /*label для полей*/
    $('#billto_inputdiv input').each(function(){
        console.log( this )
        var titleInput = $(this).attr('placeholder'); // название поля

        /**
         *  Or css
         * .opg-width-1-1 :first-child+label {
                display: none;
            }
         */
        if (typeof titleInput === 'undefined' || titleInput === '' ) return ;

        var fotInput = $(this).attr('id'); // id поля
        var requiredInput = ($(this).hasClass('required')) ? ' <span class="asterisk">*</span>' : ''; 
        $(this).before("<label class='col-lg-3 col-md-3 col-sm-4 col-xs-12 control-label'></label>");
        $(this).prev('label').attr({'for':fotInput}).html(titleInput + requiredInput);
        $(this).removeAttr('placeholder').addClass('form-control');

    });
    
    /*активация условия обслуживания по умолчанию и его скрытие в списке всех полей*/
    $('.view-cart input#tos').prop('checked', true);
    $('.view-cart label[for="tos"]').closest('div').addClass('hidden');
    
    /*вызов окна с условиями обслуживания*/
    $('.tos-field').click(function(){
        $('a#terms-of-service').trigger('click');
    });
    $('.view-cart input#squaredTwo').checkbox();
    
    /*
    //КОРЗИНА ONE PAGE
    */
    
    /*
    страница благодартности за заказ
    */
    $('.vm-order-done a').attr('class', 'btn btn-primary btn-sm');
    
    /*
    страница просмотра всех заказов
    */
    $('.view-orders #com-form-order-submit input').addClass('btn btn-primary');
    
    /*
    страница аккаунта
    */
    $('form#com-form-login input[type="submit"]').addClass('btn btn-primary');
    $('form#com-form-login label[for="remember"]').prepend($('form#com-form-login input#remember').attr('data-toggle','checkbox')).addClass('checkbox checkbox-blue').show();
    $('form#adminForm label[for="tos"]').closest('tr').addClass('tos-block');
    $('form#adminForm label[for="tos"]').prepend($('form#adminForm input#tos').attr('data-toggle','checkbox')).addClass('checkbox checkbox-blue');
    $('form#adminForm button[type="submit"]').addClass('btn btn-primary');
    $('form#adminForm button[type="reset"]').addClass('btn btn-default');
    $('form#form-login input[type="submit"]').addClass('btn btn-default');
    
    /*
    страница стандартного входа joomla
    */
    $('.view-login div.checkbox label').addClass('checkbox');
    $('.view-login div.checkbox input').attr('data-toggle', 'checkbox');
    $('.view-login div.checkbox').removeClass('checkbox');
    
    /*
    страница восстановления логина и пароля
    */
    $('.view-reset button[type="submit"]').addClass('btn btn-primary');
    
    /*
    страница блока материалов
    */
    $('.blog .readmore-link').addClass('btn btn-primary');
    
    /*
    замена имени пользователя на email в форме входа
    необходимо если активирован плагин VM Clean Redistration
    в личном кабинете правки внесены в файле /templates/trendshop/html/com_virtuemart/sublayouts/login.php
    */
    $('.view-cart #userlogin_username').attr({
       'alt' : 'Email',
        'placeholder' : ' Email'
    });
});