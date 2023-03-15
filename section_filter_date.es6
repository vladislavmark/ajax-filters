(function ($) {

    $(document).ready(function () {

        // category
        $('.cat-list_item').on('click', function () {
            $('.cat-list_item').removeClass('active');
            $(this).addClass('active');
        });

        // all filters
        $('#send').on('click', function () {
            let acf = $('#acf-cat').val();
            let cat = $('.cat-list_item.active').data('slug');
            let start = $('#start-date').val();
            let end = $('#end-date').val();

            let data = {
                action: 'filter_date_projects',
                acf: acf,
                start: start,
                end: end,
                cat: cat,
            }
            ajaxCustom(data);
        });

        function ajaxCustom(data) {
            $.ajax({
                url: ajaxMeta.ajaxurl,
                type: 'POST',
                data: data,
                success: function (result) {
                    $('.js-date').html(result);
                },
                error: function (result) {
                    console.warn(result);
                }
            });
        }


        'use strict';
        // настройки по умолчанию. Их можно добавить в имеющийся js файл,
        // если datepicker будет использоваться повсеместно на проекте и предполагается запускать его с разными настройками
        $.datepicker.setDefaults({
            closeText: 'Закрыть',
            prevText: '<Пред',
            nextText: 'След>',
            currentText: 'Сегодня',
            monthNames: ['Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'],
            monthNamesShort: ['Янв', 'Фев', 'Мар', 'Апр', 'Май', 'Июн', 'Июл', 'Авг', 'Сен', 'Окт', 'Ноя', 'Дек'],
            dayNames: ['воскресенье', 'понедельник', 'вторник', 'среда', 'четверг', 'пятница', 'суббота'],
            dayNamesShort: ['вск', 'пнд', 'втр', 'срд', 'чтв', 'птн', 'сбт'],
            dayNamesMin: ['Вс', 'Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб'],
            weekHeader: 'Нед',
            dateFormat: 'dd-mm-yy',
            firstDay: 1,
            showAnim: 'slideDown',
            isRTL: false,
            showMonthAfterYear: false,
            yearSuffix: ''
        });

        // Инициализация
        $('input[name*="date"], .datepicker').datepicker({dateFormat: 'yy-mm-dd'});
        // можно подключить datepicker с доп. настройками так:
        /*
        $('input[name*="date"]').datepicker({
            dateFormat : 'yy-mm-dd',
            onSelect : function( dateText, inst ){
    // функцию для поля где указываются еще и секунды: 000-00-00 00:00:00 - оставляет секунды
    var secs = inst.lastVal.match(/^.*?\s([0-9]{2}:[0-9]{2}:[0-9]{2})$/);
    secs = secs ? secs[1] : '00:00:00'; // только чч:мм:сс, оставим часы минуты и секунды как есть, если нет то будет 00:00:00
    $(this).val( dateText +' '+ secs );
            }
        });
        */

    });
})(jQuery);