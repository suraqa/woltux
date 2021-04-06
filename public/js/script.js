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
            for (const pId in response) {
                total += (response[pId]["quantity"] * response[pId]["price"])
            }
            document.getElementById("sub-total").innerHTML = total
            document.getElementById("total").innerHTML = total
        }
    });
}


const abc = el => {
    if (el.checked === true) {
        document.querySelector(".password-hide").classList.add("password-show")
    } else {
        document.querySelector(".password-hide").classList.remove("password-show")

    }
}

const stripe = Stripe('pk_test_51IRhvAKkz2PvTdyx6ypGaiwp7HRVdIQU8MuqBlnOfsRUzt45pnPG8Kom6MITMtANUX7PEJAHB3FvFByBBVWdx4Cb00pBOpFm66');

const elements = stripe.elements();
let cardNumberEl = elements.create('card');

// let expEl = elements.create("cardExpiry");
// let cvcEl = elements.create("cardCvc");

cardNumberEl.mount('#card-number');
// expEl.mount('#card-exp');
// cvcEl.mount('#card-cvc');

var form = document.getElementById('payment-form');

form.addEventListener('submit', function (event) {
    // We don't want to let default form submission happen here,
    // which would refresh the page.
    event.preventDefault();
    $.ajax({
        url: "/checkout",
        type: "post",
        headers: { "Content-type": "application/json; charset=UTF-8" },
        success: response => {
            console.log(response)
        }
    })

    // stripe.createPaymentMethod({
    //     type: 'card',
    //     card: cardNumberEl,
    //     billing_details: {
    //         // Include any additional collected billing details.
    //         name: 'Jenny Rosen',
    //     },
    // }).then(stripePaymentMethodHandler);
});

// function stripePaymentMethodHandler(result) {
//     if (result.error) {
//         // Show error in payment form
//     } else {
//         // Otherwise send paymentMethod.id to your server (see Step 4)

//         $.ajax({
//             url: "/checkout",
//             type: "post",
//             headers: { "Content-type": "application/json; charset=UTF-8" },
//             data: JSON.stringify({
//                 payment_method_id: result.paymentMethod.id
//             }),
//             success: response => {
//                 // console.log(response)
//             }
//         })


//         // fetch('/checkout', {
//         //     method: 'POST',
//         //     headers: { 'Content-Type': 'application/json' },
//         //     body: JSON.stringify({
//         //         payment_method_id: result.paymentMethod.id,
//         //     })
//         // }).then(function (result) {
//         //     // Handle server response (see Step 4)
//         //     result.json().then(function (json) {
//         //         console.log(1)
//         //     })
//         // });
//     }
// }
// function stripePaymentMethodHandler(result) {
//     if (result.error) {
//         // Show error in payment form
//     } else {
//         // Otherwise send paymentMethod.id to your server (see Step 4)
//         fetch('/pay', {
//             method: 'POST',
//             headers: { 'Content-Type': 'application/json' },
//             body: JSON.stringify({
//                 payment_method_id: result.paymentMethod.id,
//             })
//         }).then(function (result) {
//             // Handle server response (see Step 4)
//             result.json().then(function (json) {
//                 console.log(json);
//             })
//         });
//     }
// }




// fetch('https://jsonplaceholder.typicode.com/posts', {
//     method: "POST",
//     body: JSON.stringify(_data),
//     headers: { "Content-type": "application/json; charset=UTF-8" }
// })
//     .then(response => response.json())
//     .then(json => console.log(json))
//     .catch(err => console.log(err));
