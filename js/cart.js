function changeQty(pid, cmd) {
    $.ajax({
        url: '../actions/cart.php',
        method: 'POST',
        data: {
            'action': "modify_product",
            'pid': pid,
            'cmd': cmd
        },
    });
}

function removeProduct(pid) {
    Swal.fire({
        title: "Do you really want to remove this product?",
        showCancelButton: true,
        confirmButtonText: "Remove",
      }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: '../actions/cart.php',
                method: 'POST',
                data: {
                    'action': "modify_product",
                    'pid': pid,
                    'cmd': "remove"
                },
                success: Swal.fire("Product removed!", "", "success")
            });
        } 
    });
}

function getProducts() {
    $.ajax({
        url: '../actions/cart.php',
        method: 'POST',
        data: { action: 'get_products'},
        success: function(response) {
            console.log("products fetched successfully")
            const products = JSON.parse(response);
            return products;
        },
        error: function(xhr, status, error) {
            console.error('Error fetching products:', error);
            alert('Failed to get products.');
        }
    })
}

function getQtys() {
    $.ajax({
        url: '../actions/cart.php',
        method: 'POST',
        data: { action: 'get_qtys'},
        success: function(response) {
            console.log("quantities fetched successfully")
            const products = JSON.parse(response);
            return products;
        },
        error: function(xhr, status, error) {
            console.error('Error fetching quantities:', error);
            alert('Failed to get quantities.');
        }
    })
}

function showProducts(products, qtys) {
    var index = 0;
    const list = document.getElementById('cartList');
    list.innerHTML = "";
    products.forEach(product => {
        const total = product.product_price * qtys[index];
        list.innerHTML += `
        <tr>
            <th scope="row">
                <div class="d-flex align-items-center">
                    <img src="../img/${product.image}" class="img-fluid me-5 rounded-circle" style="width: 80px; height: 80px;" alt="">
                </div>
            </th>
            <td>
                <p class="mb-0 mt-4">${product.product_name}</p>
            </td>
            <td>
                <p class="mb-0 mt-4">${product.product_price} $</p>
            </td>
            <td>
                <div class="input-group quantity mt-4" style="width: 100px;">
                    <div class="input-group-btn">
                        <button class="btn btn-sm btn-minus rounded-circle bg-light border" onclick="changeQty(${product.product_id}, 'decrease_qty')">
                        <i class="fa fa-minus"></i>
                        </button>
                    </div>
                    <input type="text" class="form-control form-control-sm text-center border-0" value="${qty[index]}">
                    <div class="input-group-btn">
                        <button class="btn btn-sm btn-plus rounded-circle bg-light border" onclick="changeQty(${product.product_id}, 'increase_qty')">
                            <i class="fa fa-plus"></i>
                        </button>
                    </div>
                </div>
            </td>
            <td>
                <p class="mb-0 mt-4">${total} $</p>
            </td>
            <td>
                <button class="btn btn-md rounded-circle bg-light border mt-4" onclick="removeProduct(${product.product_id})">
                    <i class="fa fa-times text-danger"></i>
                </button>
            </td>
        </tr>
        `              
        index++;
    });
}

function cartTotal(products) {
    const shipping = 3;
    const subTotal = 0

    products.forEach(product=> {
        subTotal += product[1] * product[0].product_price;
    })

    const total = shipping + subTotal;
    const bill = document.getElementById("bill");

    bill.innerHTML = `
    <div class="col-8"></div>
    <div class="row g-4 justify-content-end">
        <div class="col-8"></div>
        <div class="col-sm-8 col-md-7 col-lg-6 col-xl-4">
            <div class="bg-light rounded">
                <div class="p-4">
                    <h1 class="display-6 mb-4">Cart <span class="fw-normal">Total</span></h1>
                    <div class="d-flex justify-content-between mb-4">
                        <h5 class="mb-0 me-4">Subtotal:</h5>
                        <p class="mb-0">$${subTotal}</p>
                    </div>
                    <div class="d-flex justify-content-between">
                        <h5 class="mb-0 me-4">Shipping</h5>
                        <div class="">
                            <p class="mb-0">Flat rate: $${shipping}</p>
                        </div>
                    </div>
                    <p class="mb-0 text-end">Shipping to Ac</p>
                </div>
                <div class="py-4 mb-4 border-top border-bottom d-flex justify-content-between">
                    <h5 class="mb-0 ps-4 me-4">Total</h5>
                    <p class="mb-0 pe-4">$${total}</p>
                </div>
                <button class="btn border-secondary rounded-pill px-4 py-3 text-primary text-uppercase mb-4 ms-4" type="button">Proceed Checkout</button>
            </div>
        </div>
    </div>
    `
}