$(document).ready(function () {
    $("#form_milk").change(function () {
        var input_val = $("#form_milk").val();
        if (input_val == 1) {
            $("#form_milk_type").show();
            $("#form_milk_type").siblings('label').show();
        }
        if (input_val == 0) {
            $("#form_milk_type").hide();
            $("#form_milk_type").siblings('label').hide();
        }
    });
});