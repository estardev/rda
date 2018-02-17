$(document).ready(function()
{
    //Modifica il css della parte Gruppi Utente per aggiungere il boolean Amministratore in linea
    $(".gruppiutenteCheckbox").closest(".form-group").css("width","100%");
    $(".gruppiutenteCheckbox").closest(".form-group").css("float","left");

    $(".gruppiutenteCheckbox").closest(".form-group").find("label:first-child").css("width","100%");
    $(".gruppiutenteCheckbox").closest(".form-group").find("label:first-child").css("float","left");
    $(".gruppiutenteCheckbox").closest(".form-group").find("label:first-child").css("text-align","left");

    $(".gruppiutenteCheckbox").closest(".form-group").append('<div class="amministratoriCheckbox"></div>');

    //Variabile dei gruppi amministrati
    var gruppiAmministrati = document.getElementById('form_gruppiAmministrati').value;
    var res = gruppiAmministrati.split('-');

    //Crea i Checkbox Amministratore, disabilitati
    $(".gruppiutenteCheckbox input[type='checkbox']").each(function() {
        var gruppoVal = $(this).val();
        var $classus= "#form_gruppiutente_" + gruppoVal;

        if($($classus).is(':checked')){
            //alert("mio"+gruppoVal);
            var ceccato = (res.indexOf(gruppoVal) == -1) ? "": " checked ";
            var isAmministratoreHtml = '<div class="checkbox amministratoriCheckbox_'+ gruppoVal +'">' +
                '<input type="checkbox" id="amministratoriCheckbox_'+gruppoVal+'" name="amministratoriCheckboxInput[]" value="'+ gruppoVal +'" ' +ceccato+' "> Amministratore</label></div>';
            $(this).closest(".checkbox").closest(".form-group").find(".amministratoriCheckbox").append(isAmministratoreHtml);

        }else {
            //alert(gruppoVal);
            var isAmministratoreHtml = '<div class="checkbox amministratoriCheckbox_'+ gruppoVal +'"><label style="color: #999999"><input type="checkbox" id="amministratoriCheckbox_'+gruppoVal+'" name="amministratoriCheckboxInput[]" value="'+ gruppoVal +'" disabled="disabled"> Amministratore</label></div>';
            $(this).closest(".checkbox").closest(".form-group").find(".amministratoriCheckbox").append(isAmministratoreHtml);

        }
        });



    //Listener che abilita il booleano in base al Gruppo selezionato o no
    $(document).on("click", ".gruppiutenteCheckbox input[type='checkbox']", function () {

        var gruppoCliccato = $(this).val();
        var divToShowHide = ".amministratoriCheckbox_" + gruppoCliccato;

        if ($(this).is(':checked')) {
            $(divToShowHide).find("input").removeAttr('disabled');
            $(divToShowHide).find("label").removeAttr('style');
        }
        else{
            $(divToShowHide).find("input").attr('checked', false);
            $(divToShowHide).find("input").attr('disabled','disabled');
            $(divToShowHide).find("label").css("color","#999999");
        }

     });

});