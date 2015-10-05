var pagination = function(formName, current_page, max_page, submit)
{
    var pagination_button = $('.pagination a');

    var pagination_page = $('#' + formName + '_pagination_page');
    var pagination_items_on_page = $('#' + formName + '_pagination_items_on_page');

    pagination_items_on_page.change(function(){
        pagination_page.val(1);
        submit();
    });

    pagination_button.click(function(){
        console.info('oooo');
      var page = $(this).data('page');
        if(current_page != page){
            pagination_page.val(page);
            submit();
        }
    });
};

var order = function(formName, fields, submit)
{
    var order_type_asc = 'ASC';
    var order_type_desc = 'DESC';

    var order_type = $('#' + formName + '_order_type');
    var order_field = $('#' + formName + '_order_field');

    var setOrderType = function(field){
        if(field === order_field.val()) {
            if(order_type_asc === order_type.val()){
                order_type.val(order_type_desc);
            } else {
                order_type.val(order_type_asc);
            }
        } else {
            order_type.val(order_type_asc);
        }
    };

    fields.forEach(function(val, key){
        $('[data-order="' + val + '"]').click(function(){
            var field = $('[data-order="' + val + '"]').data('order');

            setOrderType(field);
            order_field.val(field);
            submit();
        })
    });
};

var myPriceFormat = function(e){
    return e.priceFormat({
        prefix: '',
        centsSeparator: '',
        centsLimit: 0,
        thousandsSeparator: ','
    })
};

var mathMeterPrice = function (areaElem, priceElem, meterPriceElem) {
    var meters = parseFloat(areaElem.val());
    var price = parseFloat(priceElem.val().replace(/,/g, ''));
    var meterPrice = null;
    if (!isNaN(meters) && !isNaN(price)) {
        meterPrice = (price / meters).toFixed(0);
    }

    myPriceFormat(meterPriceElem.val(meterPrice));
};
