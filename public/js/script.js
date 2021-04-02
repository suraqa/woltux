
let cartItems;
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
                    // console.log(key, value)
                });
                document.getElementById("cartItems").innerHTML = content
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
            } else {
                console.log("nothin received")
            }
        }
    });
}



const deleteCart = (id) => {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: "/cart/delete/" + id,
        type: "delete",
        success: response => {
            $("#modal").load(" #modal");
            getCart();
        }
    })
    // console.log(id);
}
