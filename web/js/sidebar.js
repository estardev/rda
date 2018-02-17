$(document).ready(function()
{
    $(document).on("click", ".scelteSidebar", function () {
        $('.scelteSidebar').removeClass('active');
        $(this).addClass('active');

    });

});