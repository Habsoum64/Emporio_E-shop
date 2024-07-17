function fetchUserData() {
    $.ajax({
        url: 'admin_actions.php',
        method: 'POST',
        data: { action: 'fetch_user_data' },
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
                        <td>${user.name}</td>
                        <td>${user.email}</td>
                        <td>${user.user_role}</td>
                        <td><button type="button" class="btn btn-outline-primary m-2" onClick=deleteUser(${user.id})>Delete</button></td>
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
    $.ajax({
        url: 'admin_actions.php',
        method: 'POST',
        data: { action: 'delete_user', 'user_id': user_id },
        success: function (response) {
            console.log("User deleted successfully.");
            alert('User deleted successfully.');
        },
        error: function (xhr, status, error) {
            console.error('Error fetching users:', error);
            alert('Failed to fetch users.');
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
                        <td>${product.product_cat}</td>
                        <td>${product.product_brand}</td>
                        <td>${product.product_title}</td>
                        <td>${product.product_price}</td>
                        <td>${product.product_desc}</td>
                        <td>${product.product_keywords}</td>
                        <td><a class='btn btn-sm btn-primary' href='#'>Delete</a></td>
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
                            <a class='btn btn-sm btn-primary' href='#'>Confirm</a>
                            <a class='btn btn-sm btn-primary' href='#'>Cancel</a>
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

function showNotification(message) {
    const notification = $('<div class="notification"></div>').text(message);
    $('body').append(notification);
    setTimeout(() => {
        notification.fadeOut(500, () => notification.remove());
    }, 3000);
}
