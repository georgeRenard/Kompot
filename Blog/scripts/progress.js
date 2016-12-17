function progressHandler(event) {

    var percentage = (event.loaded / event.total) * 100;
    document.getElementById('upload-line').width = percentage;
    document.getElementById("progress-label").innerHTML = Math.round(percentage) + "% uploaded...";

}

function completeHandler(event) {

    document.getElementById("progress-label").innerHTML = event.target.responseText;
}

function abortHandler(event) {

    document.getElementById("progress-label").innerHTML = "Upload aborted";

}

function errorHandler(event) {

    document.getElementById("progress-label").innerHTML = event.target.responseText;

}

function uploadFile() {

    var file = document.getElementById("file").files[0];
    var formdata = new FormData();
    formdata.append("file", file);
    console.log(file);
    document.getElementById("progress-label").innerHTML = "0% uploaded...";
    document.getElementById("upload-line").setAttribute("style","width:1%")
    // Ajax request
    
    var ajax = new XMLHttpRequest();
    
    ajax.upload.addEventListener("progress", progressHandler, false);
    ajax.addEventListener("load", completeHandler, false);
    ajax.addEventListener("error", errorHandler, false);
    ajax.addEventListener("abort", abortHandler, false);
    ajax.open("POST","../web/tune_upload.php");
    ajax.send(formdata);
}
