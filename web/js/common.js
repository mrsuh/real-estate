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
        $('#' + val).click(function(){
            var field = null;

            switch(true){
                case ((val.indexOf('id') + 1) > 0):
                    field = 'id';
                    break;
                case ((val.indexOf('name') + 1) > 0):
                    field = 'name';
                    break;
                case ((val.indexOf('phone') + 1) > 0):
                    field = 'phone';
                    break;
                case ((val.indexOf('create_time') + 1) > 0):
                    field = 'create_time';
                    break;
                case ((val.indexOf('update_time') + 1) > 0):
                    field = 'update_time';
                    break;
                case ((val.indexOf('hot') + 1) > 0):
                    field = 'hot';
                    break;
                case ((val.indexOf('mortgage') + 1) > 0):
                    field = 'mortgage';
                    break;
                case ((val.indexOf('status') + 1) > 0):
                    field = 'status';
                    break;
                case ((val.indexOf('user') + 1) > 0):
                    field = 'user';
                    break;
                case ((val.indexOf('city') + 1) > 0):
                    field = 'city';
                    break;
                case ((val.indexOf('region') + 1) > 0):
                    field = 'region';
                    break;
                case ((val.indexOf('price') + 1) > 0):
                    field = 'price';
                    break;
                case ((val.indexOf('expire_time') + 1) > 0):
                    field = 'expire_time';
                    break;
                default:
                    field = null;
            }

            if(null !== field) {
                setOrderType(field);
                order_field.val(field);
                submit();
            }

        })
    });
};
