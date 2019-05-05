$(document).on('change', 'input[type=file]', function(e) {
    var fileName = document.getElementById("foto").value;
    var idxDot = fileName.lastIndexOf(".") + 1;
    var extFile = fileName.substr(idxDot, fileName.length).toLowerCase();
    if (extFile == "jpg" || extFile == "jpeg" || extFile == "png") {
        var TmpPath = URL.createObjectURL(e.target.files[0]);
        $('#algo').attr('src', TmpPath);
    } else {
        document.getElementById("foto").value("");
    }
});


