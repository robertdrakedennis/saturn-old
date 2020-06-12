function count(){
    let maxLength = 1000;
    let txtVal = $('textarea').val();
    let chars = txtVal.length;

    if(chars > maxLength){
        $('#counter').html("You've reached the maximum character limit.");
        $('#submit').prop('disabled', true)

    } else {
        $('#counter').html(chars + '/' + maxLength);
        $('#submit').prop('disabled', false)
    }
}
count();

//used for steam api key
function togglePassword(id) {
	let password = $("#" + id);
	password.attr("type", password.attr("type") === "password" ? "text" : "password");
}

$('textarea').on('keyup propertychange paste', function(){
    count();
});

$('document').ready(function(){
    $("#color").spectrum({
        containerClassName: 'color-picker',
        cancelText: '',
        chooseText: 'close',
        preferredFormat: "hex",
        showInput: true,
        move: function(color) {
            $("#color").val(color.toHexString());
            let hexColor = "transparent";
            if(color) {
                hexColor = color.toHexString();
            }
            $("#fontAwesomeIcon").css("color", hexColor);
        },
    });

});