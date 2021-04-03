let cartItems;

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

const updateQuantity = operator => {
    const quantityElement = document.getElementById("quantity")
    switch (operator) {
        case "+":
            quantityElement.value++
            break
        case "-":
            if (quantityElement.value > 1) {
                quantityElement.value--
                break
            }
            default:
            break
    }
}

const addToCart = (id) => {
    const quantityElement = document.getElementById("quantity")
    $.ajax({
        url: "/cart/add/" + id,
        data: {
            "quantity": quantityElement.value
        },
        type: 'get',
        success: response => {
            // cartItems = response
            if (response) {
                cartItems = response
                let content = ""
                $.each(cartItems, (key, value) => {
                    content +=
                    `<div class="cartItem">
                        <h1 id="title" class="mt-5"> ${value.name.toUpperCase()}</h1>
                        <p class="mt-3 mb-0">BASE PRICE:<strong> $${value.price}.</strong></p>
                        <p class="mb-0">QUANTITY:<strong> ${value.quantity}</strong></p>
                        <p class="mb-0">SUB-TOTAL:<strong> $${value.price * value.quantity}</strong></p>
                        <a href="#" onclick="deleteCart(${key})" class="text-danger">Delete item</a>
                    </div>`
                });
                document.getElementById("cartItems").innerHTML = content
                document.querySelector(".modal-footer").classList.remove("d-none");
            } else {
                console.log("nothin received")
            }
        }
    });
}

const getCart = () => {
    $.ajax({
        url: "/cart/get",
        type: 'get',
        success: response => {
            let content = ""
            if (response && Object.keys(response).length != 0) {
                cartItems = response
                $.each(cartItems, (key, value) => {
                    content +=
                        `<div class="cartItem">
                            <h1 id="title" class="mt-5"> ${value.name.toUpperCase()}</h1>
                            <p class="mt-3 mb-0">BASE PRICE:<strong> $${value.price}.</strong></p>
                            <p class="mb-0">QUANTITY:<strong> ${value.quantity}</strong></p>
                            <p class="mb-0">SUB-TOTAL:<strong> $${value.price * value.quantity}</strong></p>
                            <a href="#" onclick="deleteCart(${key})" class="text-danger">Delete item</a>
                        </div>`
                });
                document.querySelector(".modal-footer").classList.remove("d-none");
            } else {
                content =
                `<div class="cartItem my-5">
                    <h3>Your cart is empty!!</h3>
                    <h3>Add products to your cart</h3>
                </div>`
                document.querySelector(".modal-footer").classList.add("d-none");
            }
            document.getElementById("cartItems").innerHTML = content
        }
    });
}



const deleteCart = id => {

    $.ajax({
        url: "/cart/delete/" + id,
        type: "delete",
        success: response => {
            $("#modal").load(" #modal");
            getCart();

            $(".table-left").load(" .table-left");
            console.log(response)
        }
    })
}

const updateCart = (operator, pId) => {
    const quantityElement = document.getElementById(`quantity-${pId}`)
    switch (operator) {
        case "+":
            quantityElement.value++
            break
        case "-":
            if (quantityElement.value > 1) {
                quantityElement.value--
                break
            }
        default:
            break
    }

    $.ajax({
        url: `/cart/update/${pId}`,
        type: "put",
        data: {
            quantity: quantityElement.value
        },
        success: response => {
            const subtotalElement = document.getElementById(`subtotal-${pId}`)
            subtotalElement.innerHTML = response[pId]["quantity"] * response[pId]["price"]
            let total = 0
            for(const pId in response ) {
                total += (response[pId]["quantity"] * response[pId]["price"])
            }
            document.getElementById("total").innerHTML = total
        }
    });
}
