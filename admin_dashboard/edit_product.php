<?php
include '../settings/session_check.php';


// Debugging code to verify session variables
echo "User ID: " . $_SESSION['user_id'] . "<br>";
echo "User Role: " . $_SESSION['user_role'] . "<br>";
echo "User Email: " . $_SESSION['user_email'] . "<br>";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>DASHMIN - Bootstrap Admin Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <div class="container-fluid position-relative bg-white d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Sidebar Start -->
        <div class="sidebar pe-4 pb-3">
            <nav class="navbar bg-light navbar-light">
                <a href="index.html" class="navbar-brand mx-4 mb-3">
                    <h3 class="text-primary"></i>Emporio</h3>
                </a>
                <div class="d-flex align-items-center ms-4 mb-4">
                    <div class="position-relative">
                        <img class="rounded-circle" src="img/user.jpg" alt="" style="width: 40px; height: 40px;">
                        <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
                    </div>
                    <div class="ms-3">
                        <h6 class="mb-0">John Doe</h6>
                        <span>Admin</span>
                    </div>
                </div>
                <div class="navbar-nav w-100">
                    <a href="index.html" class="nav-item nav-link active"><i class="fa fa-tachometer-alt me-2"></i>Dashboard</a>                    
                    <!-- Products Dropdown -->
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-table me-2"></i>Products</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="view_products.php" class="dropdown-item">View Products</a>
                            <a href="add_product.php" class="dropdown-item">Add Product</a>
                            <a href="edit_product.php" class="dropdown-item">Edit Product</a>
                        </div>
                    </div>
                    
                    <a href="manage_users.php" class="nav-item nav-link"><i class="fa fa-users -alt me-2"></i>Users</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="far fa-file-alt me-2"></i>Pages</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="signin.php" class="dropdown-item">Sign In</a>
                            <a href="signup.php" class="dropdown-item">Sign Up</a>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
        
        <!-- Sidebar End -->


        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            <nav class="navbar navbar-expand bg-light navbar-light sticky-top px-4 py-0">
                <a href="index.html" class="navbar-brand d-flex d-lg-none me-4">
                    <h2 class="text-primary mb-0"><i class="fa fa-hashtag"></i></h2>
                </a>
                <a href="#" class="sidebar-toggler flex-shrink-0">
                    <i class="fa fa-bars"></i>
                </a>
                <form class="d-none d-md-flex ms-4">
                    <input class="form-control border-0" type="search" placeholder="Search">
                </form>
                <div class="navbar-nav align-items-center ms-auto">
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <i class="fa fa-envelope me-lg-2"></i>
                            <span class="d-none d-lg-inline-flex">Message</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                            <a href="#" class="dropdown-item">
                                <div class="d-flex align-items-center">
                                    <img class="rounded-circle" src="img/user.jpg" alt="" style="width: 40px; height: 40px;">
                                    <div class="ms-2">
                                        <h6 class="fw-normal mb-0">Jhon send you a message</h6>
                                        <small>15 minutes ago</small>
                                    </div>
                                </div>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item">
                                <div class="d-flex align-items-center">
                                    <img class="rounded-circle" src="img/user.jpg" alt="" style="width: 40px; height: 40px;">
                                    <div class="ms-2">
                                        <h6 class="fw-normal mb-0">Jhon send you a message</h6>
                                        <small>15 minutes ago</small>
                                    </div>
                                </div>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item">
                                <div class="d-flex align-items-center">
                                    <img class="rounded-circle" src="img/user.jpg" alt="" style="width: 40px; height: 40px;">
                                    <div class="ms-2">
                                        <h6 class="fw-normal mb-0">Jhon send you a message</h6>
                                        <small>15 minutes ago</small>
                                    </div>
                                </div>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item text-center">See all message</a>
                        </div>
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <i class="fa fa-bell me-lg-2"></i>
                            <span class="d-none d-lg-inline-flex">Notificatin</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                            <a href="#" class="dropdown-item">
                                <h6 class="fw-normal mb-0">Profile updated</h6>
                                <small>15 minutes ago</small>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item">
                                <h6 class="fw-normal mb-0">New user added</h6>
                                <small>15 minutes ago</small>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item">
                                <h6 class="fw-normal mb-0">Password changed</h6>
                                <small>15 minutes ago</small>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item text-center">See all notifications</a>
                        </div>
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <img class="rounded-circle me-lg-2" src="img/user.jpg" alt="" style="width: 40px; height: 40px;">
                            <span class="d-none d-lg-inline-flex">John Doe</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                            <a href="#" class="dropdown-item">My Profile</a>
                            <a href="#" class="dropdown-item">Settings</a>
                            <a href="#" class="dropdown-item">Log Out</a>
                        </div>
                    </div>
                </div>
            </nav>
            <!-- Navbar End -->



            <!-- Edit Product Form Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-sm-12 col-xl-6">
                        <div class="bg-light text-center rounded p-4">
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <h6 class="mb-0">Edit Product</h6>
                            </div>
                            <form id="editProductForm" action="../actions/update_product.php" method="post" enctype="multipart/form-data">
                                <input type="hidden" id="product_id" name="product_id">
                                <div class="mb-3">
                                    <label for="product_cat" class="form-label">Product Category</label>
                                    <select class="form-control" id="product_cat" name="product_cat" required>
                                        <option value="">Select Category</option>
                                        <option value="1">Fruits</option>
                                        <option value="2">Vegetables</option>
                                        <option value="3">Herbs</option>
                                        <option value="4">Leafy Greens</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="product_brand" class="form-label">Product Brand</label>
                                    <select class="form-control" id="product_brand" name="product_brand" required>
                                        <option value="">Select Brand</option>
                                        <!-- Options will be populated dynamically -->
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="product_title" class="form-label">Product Title</label>
                                    <input type="text" class="form-control" id="product_title" name="product_title" required>
                                </div>
                                <div class="mb-3">
                                    <label for="product_price" class="form-label">Product Price</label>
                                    <input type="number" class="form-control" id="product_price" name="product_price" step="0.01" required>
                                </div>
                                <div class="mb-3">
                                    <label for="product_desc" class="form-label">Product Description</label>
                                    <textarea class="form-control" id="product_desc" name="product_desc" rows="3" required></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="product_keywords" class="form-label">Product Keywords</label>
                                    <input type="text" class="form-control" id="product_keywords" name="product_keywords" required>
                                </div>
                                <div class="mb-3">
                                    <label for="product_image" class="form-label">Product Image</label>
                                    <input type="file" class="form-control" id="product_image" name="product_image">
                                </div>
                                <button type="submit" class="btn btn-primary">Save Changes</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Edit Product Form End -->
        </div>
        <!-- Content End -->

        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/chart/chart.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <<!-- Template Javascript -->
    <script src="js/main.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const urlParams = new URLSearchParams(window.location.search);
            const productId = urlParams.get('id');
            
            if (productId) {
                fetch(`../actions/get_product_details.php?id=${productId}`)
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById('product_id').value = data.product_id;
                        document.getElementById('product_cat').value = data.product_cat;
                        document.getElementById('product_brand').value = data.product_brand;
                        document.getElementById('product_title').value = data.product_title;
                        document.getElementById('product_price').value = data.product_price;
                        document.getElementById('product_desc').value = data.product_desc;
                        document.getElementById('product_keywords').value = data.product_keywords;
                    })
                    .catch(error => console.error('Error fetching product details:', error));

                fetch('../actions/fetch_brands.php')
                    .then(response => response.json())
                    .then(data => {
                        const brandSelect = document.getElementById('product_brand');
                        data.forEach(brand => {
                            const option = document.createElement('option');
                            option.value = brand.brand_id;
                            option.textContent = brand.brand_name;
                            brandSelect.appendChild(option);
                        });
                    })
                    .catch(error => console.error('Error fetching brands:', error));
            }

            document.getElementById('editProductForm').addEventListener('submit', function(event) {
                event.preventDefault();
                
                const formData = new FormData(event.target);
                
                fetch('../actions/update_product.php', {
                    method: 'POST',
                    body: formData,
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Redirect to the view products page
                        window.location.href = 'view_products.html';
                    } else {
                        alert('Failed to update product: ' + data.message);
                    }
                })
                .catch(error => console.error('Error updating product:', error));
            });
        });
    </script>

</body>
</html>
