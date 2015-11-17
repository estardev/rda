$(document).ready(function()
{
    var homepageSelectCategoria = $('#homepageSelectCategoria').val();
    //alert("selezionato: " + homepageSelectCategoria);

    var onResize = function() {
        // apply dynamic padding at the top of the body according to the fixed navbar height
        $("body").css("padding-top", $(".navbar-fixed-top").height());
        $(".container").css("padding-top", 20);

    };

    // attach the function to the window resize event
    $(window).resize(onResize);

    // call it also when the page is ready after load or reload
    $(function() {
        onResize();
    });

    $(".container").fadeIn(500);

    $(document).on("change", "#homepageSelectCategoria", function () {
        var homepageSelectCategoria = $('#homepageSelectCategoria').val();
        $('#homepageSelectBtnCategoria').attr('disabled',false);

        $.ajax({
            type: "POST",
            url: Routing.generate('navbarSelectedSessionSet'),
            async: false,
            data: {homepageSelectCategoria: homepageSelectCategoria},
            success: function(dataset)
            {
                var myjson = $.parseJSON(dataset);
                window.location.replace(Routing.generate('richiesta_bycategoria', {'idCategoria': homepageSelectCategoria}));
            }
        });


    });


    $(document).on("click", "#homepageSelectBtnCategoria", function () {

        var homepageSelectCategoria = $('#homepageSelectCategoria').val();
        //alert("Bottone: " + homepageSelectCategoria);
        window.location.replace(Routing.generate('formtemplate_new', {'idCategoria': homepageSelectCategoria}));

    });

});