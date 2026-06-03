function showText(rec_id) {
    var element = document.getElementById(rec_id);
    if (element.style.height === "40px" || element.style.height === "") {
        element.style.height = "auto";
    } else {
        element.style.height = "40px";
    }
}
