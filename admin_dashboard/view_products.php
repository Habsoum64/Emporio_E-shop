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
                    
                    <a href="manage_users.html" class="nav-item nav-link"><i class="fa fa-users -alt me-2"></i>Users</a>
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




            <!-- View Product Table Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row">
                    <div class="col-12">
                        <h1 class="mb-4">View Products</h1>
                        <div class="mb-4">
                            <input type="text" id="searchInput" class="form-control" placeholder="Search for products...">
                        </div>
                        <div class="mb-4">
                            <select id="filterCategory" class="form-select" aria-label="Filter by Category">
                                <option value="">Filter by Category</option>
                                <option value="Fruits">Fruits</option>
                                <option value="Vegetables">Vegetables</option>
                                <option value="Herbs">Herbs</option>
                                <option value="Leafy Greens">Leafy Greens</option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <select id="filterBrand" class="form-select" aria-label="Filter by Brand">
                                <option value="">Filter by Brand</option>
                                <!-- Populate brands dynamically -->
                            </select>
                        </div>
                        <div class="table-responsive">
                            <table class="table text-start align-middle table-bordered table-hover mb-0">
                                <thead>
                                    <tr class="text-dark">
                                        <th scope="col">Product ID</th>
                                        <th scope="col">Category</th>
                                        <th scope="col">Brand</th>
                                        <th scope="col">Product Name</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Description</th>
                                        <th scope="col">Keywords</th>
                                        <th scope="col">Image</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="productsTableBody">
                                    <!-- Product rows will be populated here -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- View Product Table End -->

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
    <script src="js/main.js"></script>
    <script>
        let allProducts = [];

        function fetchProducts() {
            return fetch('../actions/fetch_products.php')
                .then(response => response.json())
                .then(data => {
                    allProducts = data;
                    console.log("Fetched Products:", allProducts); // Log fetched products
                    populateTable(allProducts);
                })
                .catch(error => console.error('Error fetching products:', error));
        }

        function fetchBrands() {
            return fetch('../actions/fetch_brands.php')
                .then(response => response.json())
                .then(data => {
                    const brandSelect = document.getElementById('filterBrand');
                    brandSelect.innerHTML = '<option value="">Filter by Brand</option>'; // Clear existing options

                    data.forEach(brand => {
                        const option = document.createElement('option');
                        option.value = brand.brand_name; // Assuming brand_name is used for filtering
                        option.textContent = brand.brand_name;
                        brandSelect.appendChild(option);
                    });
                })
                .catch(error => console.error('Error fetching brands:', error));
        }

        function filterProducts() {
            const searchTerm = document.getElementById('searchInput').value.toLowerCase();
            const selectedCategory = document.getElementById('filterCategory').value.toLowerCase();
            const selectedBrand = document.getElementById('filterBrand').value.toLowerCase();

            console.log("Search Term:", searchTerm);
            console.log("Selected Category:", selectedCategory);
            console.log("Selected Brand:", selectedBrand);

            const filteredProducts = allProducts.filter(product => {
                const matchesSearch = product.product_title.toLowerCase().includes(searchTerm) ||
                                    product.product_desc.toLowerCase().includes(searchTerm) ||
                                    product.product_keywords.toLowerCase().includes(searchTerm);

                const matchesCategory = selectedCategory === '' || product.category.toLowerCase() === selectedCategory;
                const matchesBrand = selectedBrand === '' || product.brand.toLowerCase() === selectedBrand;

                return matchesSearch && matchesCategory && matchesBrand;
            });

            console.log("Filtered Products:", filteredProducts);
            populateTable(filteredProducts);
        }

        function populateTable(products) {
            const tableBody = document.getElementById('productsTableBody');
            tableBody.innerHTML = '';

            products.forEach(product => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${product.product_id}</td>
                    <td>${product.category}</td>
                    <td>${product.brand}</td>
                    <td>${product.product_title}</td>
                    <td>${product.product_price}</td>
                    <td>${product.product_desc}</td>
                    <td>${product.product_keywords}</td>
                    <td><img src="../uploads/${product.product_image}" alt="${product.product_title}" style="width: 50px;"></td>
                    <td>
                        <button class="btn btn-sm btn-primary edit-btn" data-id="${product.product_id}">Edit</button>
                        <button class="btn btn-sm btn-danger delete-btn" data-id="${product.product_id}">Delete</button>
                    </td>
                `;
                tableBody.appendChild(row);
            });

            // Add event listeners for edit and delete buttons
            document.querySelectorAll('.edit-btn').forEach(button => {
                button.addEventListener('click', handleEdit);
            });
            document.querySelectorAll('.delete-btn').forEach(button => {
                button.addEventListener('click', handleDelete);
            });
        }

        function handleEdit(event) {
            const productId = event.target.dataset.id;
            window.location.href = `edit_product.html?id=${productId}`;
        }


        function handleDelete(event) {
            const productId = event.target.dataset.id;
            if (confirm('Are you sure you want to delete this product?')) {
                fetch(`../actions/delete_product.php?id=${productId}`, {
                    method: 'DELETE',
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        fetchProducts(); // Refresh the product list
                    } else {
                        alert('Failed to delete product');
                    }
                })
                .catch(error => console.error('Error deleting product:', error));
            }
        }

        document.getElementById('searchInput').addEventListener('input', filterProducts);
        document.getElementById('filterCategory').addEventListener('change', filterProducts);
        document.getElementById('filterBrand').addEventListener('change', filterProducts);

        // Initial population of the table and fetching brands
        document.addEventListener('DOMContentLoaded', () => {
            fetchProducts();
            fetchBrands();
        });

    </script>
</body>
</html>