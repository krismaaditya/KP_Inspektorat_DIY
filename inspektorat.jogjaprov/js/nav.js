
// Get the modal
var logModal = document.getElementById("loginModal");
var regModal = document.getElementById("registerModal");

// Get the button that opens the modal
var logBtn = document.getElementById("loginBtn");
var regBtn = document.getElementById("registerBtn");

// Get the <span> element that closes the modal
var logspan = document.getElementsByClassName("logclose")[0];
var regspan = document.getElementsByClassName("regclose")[0];

// When the user clicks on the button, open the modal
logBtn.onclick = function() {
  // regModal.style.display = "none";
  logModal.style.display = "block";
}

regBtn.onclick = function() {
  // modal.style.display = "none";
  regModal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
logspan.onclick = function() {
  logModal.style.display = "none";
}

regspan.onclick = function() {
  regModal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(loginevent) {
  if (loginevent.target == logModal) {
  logModal.style.display = "none";
  }
}

window.onclick = function(regevent) {
  if (regevent.target == regModal) {
  regModal.style.display = "none";
  }
}

//====SEARCH DROPDOWN & USER MENU DROPDOWN FUNCTION====//
function searchMenu()
{
  document.getElementById("searchDropdown").classList.toggle("show");
}

function userMenu()
{
  document.getElementById("userDropdown").classList.toggle("show-user-menu");
}

//Close the dropdown if the user clicks outside of it
window.onclick = function(e)
{
  if (!e.target.matches('.user-button'))
  {
    var uDropdown = document.getElementById("userDropdown");
    if (uDropdown.classList.contains('show-user-menu'))
    {
      uDropdown.classList.remove('show-user-menu');
    }
  }
}

function openBurger()
{
  var x = document.getElementById("mainNavbar");
  if(x.className === "navbar")
  {
    x.className += " responsive";
  }
  else {
    x.className = "navbar";
  }
}

//==AJAX SERVER SIDE LOGIN FORM VALIDATION==//
$('#loginsubmit').click(function() {
    var login_data = {
        email: $('#email').val(),
        password: $('#password').val()
    };

    $.ajax({
        url: urllogin,
        type: 'POST',
        data: login_data,
        success: function(response) {
            if (response == 1){
              $('#alert-msg').html('<div class="pesan-login-berhasil">Login berhasil, </div>');
              window.location = urlwelcome;
            }
            else if (response == 0){
              $('#alert-msg').html('<div class="pesan-login-gagal">Email atau password anda salah.</div>');
            }
            else{
              $('#alert-msg').html('<div class="pesan-login-unknown">Email atau password tidak ditemukan fam</div>');
            }
        }
    });
    return false;
  });
