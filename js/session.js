import Swal from '../lib/sweetalert2/sweetalert2.js';

// Check session on page load
function checkLogin() {
    $.ajax({
        url: '../settings/session.php',
        method: 'POST',
        data: 'check_login',
        success: function(response) {
            var result = JSON.parse(response);
            if (result == 'true') {
                return true;
            } else {
                return false;
            }
        }
    });
}

function login() {
    $.ajax({
        url: '../actions/login_action.php',
        method: 'POST',
        data: {
        },
        success: function() {
            Swal.fire({
                icon: "success",
                title: "Logged in successfully",
                showConfirmButton: false,
                timer: 1500
            });

            window.location.href = '../view/index.html';
        }
    })
}
