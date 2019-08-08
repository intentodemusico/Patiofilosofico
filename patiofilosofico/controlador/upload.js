$$(document).ready(function() {
    $('form').submit(function() {
        var formdata = $(this).serialize();
      // validate and process form here 
    });
});

  //alert (dataString);return false;
$.ajax({
    type: "POST",
    url: "upload.php",
    data: form-data,
    success: function() {
    $('#contact_form').html("<div id='message'></div>");
    $('#message').html("<h2>¡Archivo enviado!</h2>")
    .append("<p>We will be in touch soon.</p>")
    .hide()
    .fadeIn(1500, function() {
        $('#message').append("<img id='checkmark' src='images/check.png' />");
    });
    }
});
return false;