document.addEventListener('DOMContentLoaded', async () => {
  const client_secret = $('.all-purchase').data('token');
  const pk_js = $('.all-purchase').data('pk-js');

  const stripe = Stripe(pk_js, {
      locale: $('.all-purchase').data('locale')
  });

  //const { client_secret } = await fetch('/intent.php').then(r => r.json());

  const options = {
      layout: "tabs"
  }

  const elements = stripe.elements({ clientSecret: client_secret });


  $('#EmailInput').change((e) => {
      var paymentElement = elements.getElement('payment');

      paymentElement.update({defaultValues: {billingDetails: {email: e.target.value}}});
  });

  const paymentElement = elements.create('payment', options);
  paymentElement.mount('#payment-element');
  // Create and mount the linkAuthentication Element to enable autofilling customer payment details
  const linkAuthenticationElement = elements.create("linkAuthentication");

  linkAuthenticationElement.mount("#link-authentication-element");

  // When the form is submitted...
  const form = document.getElementById('payment-form');
  let submitted = false;

  form.addEventListener('submit', async (e) => {
    e.preventDefault();

    // Disable double submission of the form
    if(submitted) { return; }
    submitted = true;
    form.querySelector('button').disabled = true;

    const nameInput = document.querySelector('#name');

    const result = await stripe.confirmPayment({
      elements,
      confirmParams: {
        return_url: `${window.location.origin}/payment-success?date=` + $('.all-purchase').data('slot-date') + '&user_id=' + $('.all-purchase').data('calendar-id'),
      }
    });

    if (result.paymentIntent && result.paymentIntent.status === 'succeeded') {
      // Payment succeeded, you can handle it here
      console.log('Payment succeeded !!!!');
    } else {
      alert(result.error.message);
      submitted = false;
      form.querySelector('button').disabled = false;
      return;
    }
  });
});
