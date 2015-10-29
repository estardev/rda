/**
 * Created by gianlu on 10/29/15.
 */
function secondLevel() {
    $('.secondLevel').each(function () {

            $(this).closest('div').hide();

        }
    );
}

function firstLevel(options) {


    var o = options;
    $('.firstLevel').each(function () {
            var patt = new RegExp(/form_(.*)+-[0-9]+/);

            var name = patt.exec(this.id)[1];

            $(this).find('input[type="radio"]').on('click', function () {

                if (o[name].indexOf($('input[name="' + this.name + '"]:checked').val()) != -1) {
                    $(this).closest('.form-group').next().show("slow");
                } else {
                    $(this).closest('.form-group').next().hide("slow");
                }

            })

        }
    );
}

