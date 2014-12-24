/*
 |-----------------------------
 | Select2
 |-----------------------------
 */
$("[select2]").select2();

/*
 |-----------------------------
 | Input Mask for decimal
 |-----------------------------
 */
InputmaskDecimal();
InputmaskInteger();
function InputmaskDecimal() {
    $("[data-inputmask=decimal]").inputmask(
        "decimal", {radixPoint: ".", digits: 2, autoGroup: true, groupSeparator: ",", groupSize: 3, allowMinus: false}
    );
}
function InputmaskInteger() {
    $("[data-inputmask=integer]").inputmask(
        "integer", {autoGroup: true, groupSeparator: ",", groupSize: 3, allowMinus: false}
    );
}

/*
 |-----------------------------
 | BV Tab and Reset form
 |-----------------------------
 */
$('#bvForm')
    .bootstrapValidator()
    // Called when a field is invalid
    .on('error.field.bv', function (e, data) {
        // data.element --> The field element

        var $tabPane = data.element.parents('.tab-pane'),
            tabId = $tabPane.attr('id');

        $('a[href="#' + tabId + '"][data-toggle="tab"]')
            .parent()
            .find('i')
            .removeClass('fa-check')
            .addClass('fa-times');
    })
    // Called when a field is valid
    .on('success.field.bv', function (e, data) {
        // data.bv      --> The BootstrapValidator instance
        // data.element --> The field element

        var $tabPane = data.element.parents('.tab-pane'),
            tabId = $tabPane.attr('id'),
            $icon = $('a[href="#' + tabId + '"][data-toggle="tab"]')
                .parent()
                .find('i')
                .removeClass('fa-check fa-times');

        // Check if the submit button is clicked
        if (data.bv.getSubmitButton()) {
            // Check if all fields in tab are valid
            var isValidTab = data.bv.isValidContainer($tabPane);
            $icon.addClass(isValidTab ? 'fa-check' : 'fa-times');
        }
    });


$('input[type="reset"]').click(function () {
    $('#bvForm').data('bootstrapValidator').resetForm(true);
    $('a[href][data-toggle="tab"]')
        .parent()
        .find('i')
        .removeClass('fa-check fa-times');
});

/*
 |-----------------------------
 | Other function
 |-----------------------------
 */
//Str Starts With
function strStartsWith(str, prefix) {
    return str.indexOf(prefix) === 0;
}
// Str Ends With
function strEndsWith(str, suffix) {
    return str.match(suffix + "$") == suffix;
}
// Round Number
function roundNumber(number, decimals) {
    var newString;// The new rounded number
    decimals = Number(decimals);
    if (decimals < 1) {
        newString = (Math.round(number)).toString();
    } else {
        var numString = number.toString();
        if (numString.lastIndexOf(".") == -1) {// If there is no decimal point
            numString += ".";// give it one at the end
        }
        var cutoff = numString.lastIndexOf(".") + decimals;// The point at which to truncate the number
        var d1 = Number(numString.substring(cutoff, cutoff + 1));// The value of the last decimal place that we'll end up with
        var d2 = Number(numString.substring(cutoff + 1, cutoff + 2));// The next decimal, after the last one we want
        if (d2 >= 5) {// Do we need to round up at all? If not, the string will just be truncated
            if (d1 == 9 && cutoff > 0) {// If the last digit is 9, find a new cutoff point
                while (cutoff > 0 && (d1 == 9 || isNaN(d1))) {
                    if (d1 != ".") {
                        cutoff -= 1;
                        d1 = Number(numString.substring(cutoff, cutoff + 1));
                    } else {
                        cutoff -= 1;
                    }
                }
            }
            d1 += 1;
        }
        if (d1 == 10) {
            numString = numString.substring(0, numString.lastIndexOf("."));
            var roundedNum = Number(numString) + 1;
            newString = roundedNum.toString() + '.';
        } else {
            newString = numString.substring(0, cutoff) + d1.toString();
        }
    }
    if (newString.lastIndexOf(".") == -1) {// Do this again, to the new string
        newString += ".";
    }
    var decs = (newString.substring(newString.lastIndexOf(".") + 1)).length;
    for (var i = 0; i < decimals - decs; i++) newString += "0";
    //var newNumber = Number(newString);// make it a number if you like
    return newString; // Output the result to the form field (change for your purposes)
}
