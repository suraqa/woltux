const stripe = Stripe(document.getElementById("stripe-key").value);

const elements = stripe.elements();

const card = elements.create("card", {
    hidePostalCode: true,
    iconStyle: "solid"
})

card.mount("#card-element")

const form = document.getElementById("payment-form")

form.addEventListener("submit", event => {
    event.preventDefault()
    stripe.confirmCardPayment(document.getElementById("client-secret").value, {
        receipt_email: document.getElementById("email"),
        payment_method: {
            card: card,
            billing_details: {
              name: 'Jenny Rosen',
            }
        }
    }).then(result => {
        if(result.error) {
            console.log("error: ", result.error)
        } else {
            console.log("success: ", result)
            form.submit();
        }
    })

})
