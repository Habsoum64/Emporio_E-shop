function userNav() {
    const user_nav = document.getElementById("user_nav");
    if (!checkLogin()) {
        user_nav.innerHTML = `
            <a href="../login/signin.html" class="my-auto">
                <i class="fas fa-power-off fa-2x"></i>
            </a>
        `;
    } else {
        user_nav.innerHTML = `
            <a href="#" class="my-auto">
                
            </a>
            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                    <i class="fas fa-user fa-2x"></i>
                </a>
                <div class="dropdown-menu m-0 bg-secondary rounded-0">
        `;
        if (user_role == "customer") {
            userNav.innerHTML += `
                    <a href="../user_dashboard/index.html" class="dropdown-item">Dashboard</a>
                `
        } else if (user_role == "admin") {
            userNav.innerHTML += `
                    <a href="../admin_dashboard/home.html" class="dropdown-item">Dashboard</a>
                `
        }

        user_nav.innerHTML += `
                    <a href="../actions/logout.php" class="dropdown-item">Logout</a>
                </div>
            </div>
        `
    }
}

