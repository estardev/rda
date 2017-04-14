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
        //alert("selezionato: " + homepageSelectCategoria);
        if (  homepageSelectCategoria==22
            || homepageSelectCategoria==23
            || homepageSelectCategoria==24
            || homepageSelectCategoria==25
            || homepageSelectCategoria==26
        ){
            //alert("sonoentrato: " + homepageSelectCategoria);
            $.ajax({
                success: function(dataset)
                {   //alert("qui: " + homepageSelectCategoria);
                    window.location.replace("http://portale-mav.estav-centro.toscana.it/RNP_index.php?dbForm_RNP_Form1_startInsert=Nuova+richiesta");
                }
            });

        }else{
            //alert("else: " + homepageSelectCategoria);
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
        }
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

    $(document).on("click", "#homepageMostraTutte", function () {

        var homepageSelectCategoria = $('#homepageSelectCategoria').val();
        //alert("Bottone: " + homepageSelectCategoria);
        window.location.replace(Routing.generate('richiesta_bycategoria', {'idCategoria': homepageSelectCategoria}));

    });

    $(document).on("click", "#allview", function () {
        $('#homepageSelectBtnCategoria').prop('disabled',true);
        $('#homepageMostraTutte').attr('disabled',true);

        //alert("Bottone: ");
        var all = "all";
        window.location.replace(Routing.generate('richiesta_viewall', {'all': all}));
    });

});