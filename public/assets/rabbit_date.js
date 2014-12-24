/*
 |-----------------------------
 | Date Picker ((http://eternicode.github.io/bootstrap-datepicker/)
 |-----------------------------
 */
$("[date-picker2]").datepicker({
    format: "yyyy-mm-dd",
    autoclose: true,
    todayBtn: "linked",
    todayHighlight: true,
    clearBtn: true,
    startDate: "",
    endDate: ""
}).on('changeDate', function(e, data) {
    // Revalidate the date field
    $('#bvForm').bootstrapValidator('revalidateField', $(this).attr('name'));
});
// Add calendar icon
$("[date-picker2]").wrap('<div class="input-group">');
$("[date-picker2]").after('<span class="input-group-addon"><i class="fa fa-calendar"></i></span>');
$("[date-picker2]").inputmask("yyyy-mm-dd", {"placeholder": "YYYY-MM-DD"});

/*
 |-----------------------------
 | Date Range Picker
 |-----------------------------
 */
// Date range picker
$("[date-range-picker]").daterangepicker({
    format: 'YYYY-MM-DD',
    showDropdowns: true,
    separator: ' To ',
    singleDatePicker: false
});
// Add calendar icon
$("[date-range-picker]").wrap('<div class="input-group">');
$("[date-range-picker]").after('<span class="input-group-addon"><i class="fa fa-calendar"></i></span>');
$("[date-range-picker]").inputmask("9999-99-99 To 9999-99-99", {"placeholder": "YYYY-MM-DD To YYYY-MM-DD"});

/*
 |-----------------------------
 | Date Picker
 |-----------------------------
 */
// Date picker
$("[date-picker]").datetimepicker({
    format: "YYYY-MM-DD",
    pickTime: false
}).on('dp.change dp.show', function (e, data) {
    $('#bvForm').bootstrapValidator('revalidateField', $(this).attr('name'));
});
// Add calendar icon
$("[date-picker]").attr("placeholder", "YYYY-MM-DD");
$("[date-picker]").wrap('<div class="input-group">');
$("[date-picker]").after('<span class="input-group-addon"><i class="fa fa-calendar"></i></span>');
$("[date-picker]").inputmask("yyyy-mm-dd", {"placeholder": "YYYY-MM-DD"});

/*
 |-----------------------------
 | Datetime Picker
 |-----------------------------
 */
// Datetime picker
$("[datetime-picker]").datetimepicker({
    format: "YYYY-MM-DD HH:mm:ss",
    useSeconds: true
}).on('dp.change dp.show', function (e, data) {
    $('#bvForm').bootstrapValidator('revalidateField', $(this).attr('name'));
});
// Add calendar icon
$("[datetime-picker]").attr("placeholder", "YYYY-MM-DD HH:mm:ss");
$("[datetime-picker]").wrap('<div class="input-group">');
$("[datetime-picker]").after('<span class="input-group-addon"><i class="fa fa-calendar"></i></span>');

/*
 |-----------------------------
 | Time Picker
 |-----------------------------
 */
// Time picker
$("[time-picker]").datetimepicker({
    format: 'HH:mm:ss',
    pickDate: false,
    useSeconds: true
}).on('dp.change dp.show', function (e, data) {
    $('#bvForm').bootstrapValidator('revalidateField', $(this).attr('name'));
});
// Add calendar icon
$("[time-picker]").attr("placeholder", "HH:mm:ss");
$("[time-picker]").wrap('<div class="input-group">');
$("[time-picker]").after('<span class="input-group-addon"><i class="fa fa-clock-o"></i></span>');

/*
 |-----------------------------
 | Date From-To Picker
 |-----------------------------
 */
// Date From picker
$("[datefrom-picker]").datetimepicker({
    format: "YYYY-MM-DD",
    pickTime: false
}).on('dp.change dp.show', function (e, data) {
    $('#bvForm').bootstrapValidator('revalidateField', $(this).attr('name'));
});
// Add calendar icon
$("[datefrom-picker]").attr("placeholder", "YYYY-MM-DD");
$("[datefrom-picker]").wrap('<div class="input-group">');
$("[datefrom-picker]").after('<span class="input-group-addon"><i class="fa fa-calendar"></i></span>');
$("[datefrom-picker]").inputmask("yyyy-mm-dd", {"placeholder": "YYYY-MM-DD"});
// Date To picker
$("[dateto-picker]").datetimepicker({
    format: "YYYY-MM-DD",
    pickTime: false
}).on('dp.change dp.show', function (e, data) {
    $('#bvForm').bootstrapValidator('revalidateField', $(this).attr('name'));
});
// Add calendar icon
$("[dateto-picker]").attr("placeholder", "YYYY-MM-DD");
$("[dateto-picker]").wrap('<div class="input-group">');
$("[dateto-picker]").after('<span class="input-group-addon"><i class="fa fa-calendar"></i></span>');
$("[dateto-picker]").inputmask("yyyy-mm-dd", {"placeholder": "YYYY-MM-DD"});
// Range
$("[datefrom-picker]").on("dp.change", function (e) {
    $('[dateto-picker]').data("DateTimePicker").setMinDate(e.date);
});
$("[dateto-picker]").on("dp.change", function (e) {
    $('[datefrom-picker]').data("DateTimePicker").setMaxDate(e.date);
});

