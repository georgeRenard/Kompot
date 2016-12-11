function progressHandler(event) {

    var percentage = (event.loaded / event.total) * 100;
    document.getElementById("progress-label").innerHTML = Math.round(percentage) + "% uploaded...";

}

function completeHandler(event) {

    document.getElementById("progress-label").innerHTML = "Tune ready for upload";

}

function abortHandler(event) {

    document.getElementById("progress-label").innerHTML = "Upload aborted";

}

function errorHandler(event) {

    document.getElementById("progress-label").innerHTML = "Upload failed, please try again";

}

function uploadFile() {

    var file = document.getElementById("file").files[0];
    var formdata = new FormData();
    formdata.append("file_to_temporary_dir", file);
    console.log(file);
    // Ajax request
    
    var ajax = new XMLHttpRequest();
    
    ajax.upload.addEventListener("progress", progressHandler, false);
    ajax.addEventListener("load", completeHandler, false);
    ajax.addEventListener("error", errorHandler, false);
    ajax.addEventListener("abort", abortHandler, false);
    ajax.open("POST","tune_upload.php");
    ajax.send(formdata);
}
