
paypal.Buttons({
    style:{
        size: 'small',
        color:'blue'
    },
    createOrder: function(data, actions) {
      // This function sets up the details of the transaction, including the amount and line item details.
      return actions.order.create({
        purchase_units: [{
          amount: {
            value:gt   
         }
        }]
      });
    },
    onApprove: function(data, actions) {
      // This function captures the funds from the transaction.
      return actions.order.capture().then(function(details) {
        // This function shows a transaction success message to your buyer.
        console.log(details);
        alert('Transaction completed by ' + details.payer.name.given_name);
      });
    }
  }).render('#paypal-payment-button');
  //This function displays Smart Payment Buttons on your web page.
