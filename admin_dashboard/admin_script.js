function checkUserType() {
    $.ajax({
        url: '../settings/session.php',
        method: 'POST',
        data: { action: 'get_user_type'},
        success: function(response) {
            if (response != 'admin') {
                window.location.href = '../login/signin.html';
                console.log("User type: Not admin. Redirecting to Login");
            }
            console.log("User type: Admin");
        },
        error: function(xhr, status, error) {
            console.error('Error fetching user type:', error);
            alert('Failed to get user type.');
        }
    })
}

function fetchUserData(user_id) {
    $.ajax({
        url: 'admin_actions.php',
        method: 'POST',
        data: { action: 'fetch_user_data', uid: user_id },
        success: function(response) {
            console.log('Fetched data:', response);
            const inventoryList = $('#farmerInventory');
            inventoryList.empty();
            
            data.forEach(produce => {
                const listItem = $('<li></li>').html(produce.name + ' - $' + produce.price + ' - Quantity: ' + produce.quantity);
                const deleteButton = $('<button>Delete</button>').data('id', user.id);
                deleteButton.click(function() {
                    const produceId = $(this).data('id');
                    deleteProduce(produceId);
                });
                
                listItem.append(deleteButton);
                inventoryList.append(listItem);
            });
        },
        error: function(xhr, status, error) {
            console.error('Error fetching user data:', error);
            alert('Failed to fetch user data.');
        }
    });
}

function fetchUsers() {
    $.ajax({
        url: 'admin_actions.php',
        method: 'POST',
        data: { action: 'fetch_users' },
        success: function (response) {
            const users = JSON.parse(response);
            const usersTable = document.getElementById('users');
            usersTable.innerHTML = '';
            users.forEach(user => {
                usersTable.innerHTML += `
                    <tr>
                        <td>${user.id}</td>
                        <td>${user.first_name} ${user.last_name}</td>
                        <td>${user.email}</td>
                        <td>${user.user_role}</td>
                        <td><button type="button" class="btn btn-outline-primary m-2" onclick=deleteUser(${user.id})>Delete</button></td>
                    </tr>
                `;
            });
        },
        error: function (xhr, status, error) {
            console.error('Error fetching users:', error);
            alert('Failed to fetch users.');
        }
    });
}

function deleteUser(user_id) {
    Swal.fire({
        title: "Do you really want to delete this user?",
        showCancelButton: true,
        confirmButtonText: "delete",
      }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: 'admin_actions.php',
                method: 'POST',
                data: { action: 'delete_user', 'uid': user_id },
                success: function (response) {
                    if (JSON.parse(response) == true) {
                        console.log("User deleted successfully.");
                        alert('User deleted successfully.');}
                },
                error: function (xhr, status, error) {
                    console.error('Error fetching users:', error);
                    alert('Failed to fetch users.');
                }
            });
        } 
    });
}

function fetchProducts() {
    $.ajax({
        url: 'admin_actions.php',
        method: 'POST',
        data: { action: 'fetch_products' },
        success: function (response) {
            const products = JSON.parse(response);
            const productsTable = document.getElementById('products');
            productsTable.innerHTML = '';
            products.forEach(product => {
                productsTable.innerHTML += `
                    <tr>
                        <td>${product.product_id}</td>
                        <td>${product.category}</td>
                        <td>${product.brand}</td>
                        <td>${product.product_title}</td>
                        <td>${product.product_price}</td>
                        <td>${product.product_desc}</td>
                        <td>${product.product_keywords}</td>
                        <td><a class='btn btn-sm btn-primary' onclick=deleteProduct(${product.product_id})>Delete</a></td>
                    </tr>
                `;
            });
        },
        error: function (xhr, status, error) {
            console.error('Error fetching products:', error);
            alert('Failed to fetch products.');
        }
    });
}

function fetchOrders() {
    $.ajax({
        url: 'admin_actions.php',
        method: 'POST',
        data: { action: 'fetch_orders' },
        success: function (response) {
            const orders = JSON.parse(response);
            const ordersTable = document.getElementById('orders');
            ordersTable.innerHTML = '';
            orders.forEach(order => {
                ordersTable.innerHTML += `
                    <tr>
                        <td>${order.order_id}</td>
                        <td>${order.customer_id}</td>
                        <td>${order.invoice_no}</td>
                        <td>${order.order_date}</td>
                        <td>${order.order_status}</td>
                        <td>
                            <a class='btn btn-sm btn-primary' onclick=updateOrderStatus('Confirmed')>Confirm</a>
                            <a class='btn btn-sm btn-primary' onclick=updateOrderStatus('Canceled')>Cancel</a>
                        </td>
                    </tr>
                `;
            });
        },
        error: function (xhr, status, error) {
            console.error('Error fetching orders:', error);
            alert('Failed to fetch orders.');
        }
    });
}


function updateOrderStatus(orderId, status) {
    $.ajax({
        url: 'admin_actions',
        method: 'POST',
        data: { 
            action: updateOrderStatus,
            orderId: orderId,
            status: status
        },
        success: function(data) {
            if (data.success) {
                fetchUsers();
                showNotification('Order status changed successfully!');
            } else {
                showNotification('Failed to change order status.');
            }
        },
        error: function(xhr, status, error) {
            console.error('Error changing order status:', error);
            alert('Failed to change order status.');
        }
    });
}


function fetchTotalRevenue() {
    $.ajax({
        url: 'admin_actions.php', // Adjust the URL to your endpoint
        method: 'GET', // Use GET or POST as appropriate
        data: {action: calculate_total_revenue},
        success: function(response) {
            const data = JSON.parse(response);
            $('#total-sale').text(`$${data.total_revenue}`);
        },
        error: function(xhr, status, error) {
            console.error('Error fetching total revenue:', error);
            alert('Failed to fetch total revenue.');
        }
    });
}

$(document).ready(function () {
    fetchTotalRevenue();
});

function showNotification(message) {
    const notification = $('<div class="notification"></div>').text(message);
    $('body').append(notification);
    setTimeout(() => {
        notification.fadeOut(500, () => notification.remove());
    }, 3000);
}
