// Get the modal
var dcmodal = document.getElementById('dcModal');

// Get the button that opens the modal
var dcbtn = document.getElementById("dcBtn");

// Get the <span> element that closes the modal
var dcspan = document.getElementsByClassName("dcclose")[0];

// When the user clicks the button, open the modal
dcbtn.onclick = function() {
    dcmodal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
dcspan.onclick = function() {
    dcmodal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(dcevent) {
    if (dcevent.target == dcmodal) {
        dcmodal.style.display = "none";
    }
}
