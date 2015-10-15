$(document).on("click", "#homepageSelectBtnCategoria", function(){

    var homepageSelectCategoria = $('#homepageSelectCategoria').val();
    //alert("CategoriaId: " + homepageSelectCategoria);

    var url = "formtemplate/"+homepageSelectCategoria+"/new";

    window.location.replace(url);


});