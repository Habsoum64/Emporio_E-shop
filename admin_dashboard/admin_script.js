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
        success: function() {
            console.log('Users fetched successfuly');
        },
        error: function(xhr, status, error) {
            console.error('Error fetching users:', error);
            alert('Failed to fetch users.');
        }
    });
}

function deleteUser(userId) {
    $.ajax({
        url: 'admin_actions',
        method: 'POST',
        data: { 
            action: deleteUser,
            userId: userId 
        },
        success: function(data) {
            if (data.success) {
                fetchUsers();
                showNotification('User deleted successfully!');
            } else {
                showNotification('Failed to delete User.');
            }
        },
        error: function(xhr, status, error) {
            console.error('Error deleting user:', error);
            alert('Failed to delete user.');
        }
    });
}

function fetchOrders() {
    $.ajax({
        url: 'admin_actions.php',
        method: 'POST',
        data: { action: 'fetch_orders' },
        success: function(response) {
            console.log('Fetched data:', response);
            const orderList = $('#orders');
            orderList.empty();
            response.forEach(order => {
                const orderItem = $('<tr></tr>');
                order.forEach(info => {
                    const record = $('<td></td>').html(info);
                    orderItem.append(record);
                })
                const entry = $('<td></td>');
                const confirmButton = $('<button>Confirm</button>').data('class', "btn btn-sm btn-primary").data('id', order.id);
                confirmButton.click(function() {
                    const orderId = $(this).data('id');
                    updateOrderStatus(orderId, "Confirmed");
                });
                const cancelButton = $('<button>Cancel</button>').data('class', "btn btn-sm btn-primary").data('id', order.id);
                cancelButton.click(function() {
                    const orderId = $(this).data('id');
                    updateOrderStatus(orderId, "Canceled");
                });
                entry.append(confirmButton);
                entry.append(deleteButton);
                userItem.append(entry);
                userList.append(userItem);
            });
        },
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
