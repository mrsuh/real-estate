var pagination = function(formName, current_page, max_page)
{
    var form = $('[name="' + formName + '"]');

    var pagination_start = $('#pagination_start');
    var pagination_fin = $('#pagination_fin');

    var pagination_previous = $('#pagination_previous');
    var pagination_next = $('#pagination_next');

    var pagination_page = $('#' + formName + '_pagination_page');
    var pagination_items_on_page = $('#' + formName + '_pagination_items_on_page');

    pagination_items_on_page.change(function(){
        pagination_page.val(1);
        form.submit();
    });

    pagination_next.click(function(){
        var c_page = current_page;
        if(++c_page <= max_page) {
            pagination_page.val(c_page);
            form.submit();
        }
    });

    pagination_previous.click(function(){
        var c_page = current_page;
        if(--c_page >= 1) {
            pagination_page.val(c_page);
            form.submit();
        }
    });

    pagination_start.click(function(){
        if(current_page != 1) {
            pagination_page.val(1);
            form.submit();
        }
    });

    pagination_fin.click(function(){
        if(current_page != max_page) {
            pagination_page.val(max_page);
            form.submit();
        }
    });
};
