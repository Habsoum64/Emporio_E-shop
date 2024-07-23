const user_id = null;
const user_role = null;
const user_email = null;

// Check session on page load
function checkLogin() {
    $.ajax({
        url: '../settings/session.php',
        method: 'POST',
        data: 'check_login',
        success: function(response) {
            var result = response;
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

function getSesionVars() {
    $.ajax({
        url: '../settings/session.php',
        method: 'POST',
        data: 'get_session_vars',
        success: function(response) {
            const vars = JSON.parse(response);
            user_id = vars.user_id;
            user_role = vars.user_role;
            user_email = vars.user_email;
        }
    });
}