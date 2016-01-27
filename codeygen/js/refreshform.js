$(document).ready(function() {
    $("#submit").click(function() {
        var regno = $("#regno").val();
        var name = $("#name").val();
        var email = $("#email").val();
        var phno = $("#phno").val();

        // Returns successful data submission message when the entered information is stored in database.
        $.post("refreshform.php", {
            regno1: regno,
            name1: name,
            email1: email,
            phno1: phno
        }, function(data) {
            alert(data);
            $('#form')[0].reset(); // To reset form fields
        });
    });
});
