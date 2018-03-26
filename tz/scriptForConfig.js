var colorInput = document.getElementById('color');
var fontInput = document.getElementById('font');

function Send(f)
{
        
    $.ajax({
        url: "ajaxForConfig.php",
        type: "POST",
        data: {
            color: colorInput.value,
            font: fontInput.value,
            },
        success: function(data) {
            alert(data);
        }
        });
    return false;
    
}