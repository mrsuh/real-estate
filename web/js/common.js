var pagination = function(formName, current_page, max_page, submit)
{
    var pagination_start = $('#pagination_start');
    var pagination_fin = $('#pagination_fin');

    var pagination_previous = $('#pagination_previous');
    var pagination_next = $('#pagination_next');

    var pagination_page = $('#' + formName + '_pagination_page');
    var pagination_items_on_page = $('#' + formName + '_pagination_items_on_page');

    pagination_items_on_page.change(function(){
        pagination_page.val(1);
        submit();
    });

    pagination_next.click(function(){
        var c_page = current_page;
        if(++c_page <= max_page) {
            pagination_page.val(c_page);
            submit();
        }
    });

    pagination_previous.click(function(){
        var c_page = current_page;
        if(--c_page >= 1) {
            pagination_page.val(c_page);
            submit();
        }
    });

    pagination_start.click(function(){
        if(current_page != 1) {
            pagination_page.val(1);
            submit();
        }
    });

    pagination_fin.click(function(){
        if(current_page != max_page) {
            pagination_page.val(max_page);
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
