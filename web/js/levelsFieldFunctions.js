/**
 * Created by gianlu on 10/29/15.
 */
function secondLevel() {
    $('.secondLevel').each(function () {

            $(this).closest('.form-group').hide();

        }
    );
}

function firstLevel(options) {


    var o = options;
    $('.firstLevel').each(function () {
            var patt = new RegExp(/form_(.*)+-[0-9]+/);
            var patt2 = new RegExp(/(\w+)[|](\d+)/);

            var name = patt.exec(this.id)[1];

            $(this).find('input[type="radio"]').on('click', function () {

                var index = 0;
                for (var i = 0; i < o[name].length; i++) {
                    var id = patt2.exec(o[name][i])[2];
                    var option = patt2.exec(o[name][i])[1];

                    index = option.indexOf($('input[name="' + this.name + '"]:checked').val());
                    if (index != -1) {
                        $('[id^="form_"][id$=-' + id + ']').closest('.form-group').show("slow");
                        break;

                    } else {
                        $('[id^="form_"][id$=-' + id + ']').closest('.form-group').hide("slow");
                    }


                }


                //for (i = 0; i < o[name].length; i++) {
                //    if (i != index) {
                //        $(this).closest('.form-group').nextAll().eq(i).hide();
                //    }
                //}


                //    var index = o[name].indexOf($('input[name="' + this.name + '"]:checked').val());
                //    if ( index != -1) {
                //        //$(this).closest('.form-group .daNascondere').hide('slow');
                //        //$(this).closest('.form-group').next().addClass("daNascondere");
                //
                //        //$(this).closest('.form-group').next().show("slow");
                //        $(this).closest('.form-group').nextAll().eq(index).show('slow');
                //        for (var i=0;i<o[name].length-1;i++){
                //            if(i!=index){
                //                $(this).closest('.form-group').nextAll().eq(i).hide();
                //            }
                //        }
                //
                //    }
                //    //else {
                //    //    $(this).closest('.form-group').next().hide();
                //    //}
                //
            })

        }
    );
}

