@extends('layouts.app')
<meta name="csrf-token" content="{{ csrf_token() }}">

<div style="margin-top: 5%">

    <div class="alert-info">User and Theme Details Here</div><br><br>

    <div style="margin-left: 25%;margin-right: 30%" class="panel panel-default bootstrap-basic">
        <div class="panel-heading">
            <h3 class="panel-title">Enter Card Details</h3>
        </div>
        <form action="/payCard" method="post" id="checkout-form" class="panel-body">
            <div class="row">
                <div class="form-group col-xs-8">
                    <label class="control-label">Card Number</label>
                    <!--  Hosted Fields div container -->
                    <div class="form-control" id="card-number"></div>
                    <span class="helper-text"></span>
                </div>
                <div class="form-group col-xs-4">
                    <div class="row">
                        <label class="control-label col-xs-12">Expiration Date</label>
                        <div class="col-xs-6">
                            <!--  Hosted Fields div container -->
                            <div class="form-control" id="expiration-month"></div>
                        </div>
                        <div class="col-xs-6">
                            <!--  Hosted Fields div container -->
                            <div class="form-control" id="expiration-year"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-xs-6">
                    <label class="control-label">Security Code</label>
                    <!--  Hosted Fields div container -->
                    <div class="form-control" id="cvv"></div>
                </div>
                <div class="form-group col-xs-6">
                    <label class="control-label">Zipcode</label>
                    <!--  Hosted Fields div container -->
                    <div class="form-control" id="postal-code"></div>
                </div>
            </div>

            <!--hidden fields-->
            <input type="hidden" id="token" value="{{$token}}">
            <input type="hidden" name="payment-method-nonce">
            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
            <input type="hidden" name="theme_id" value="{{$theme_id}}">
            <input type="hidden" name="user_id" value="{{$user_id}}">

            <button style="float: right" value="submit" id="btnsubmit" class="btn btn-success btn-lg center-block">Pay with <span id="card-type">Card</span></button>
            <script src="https://www.paypalobjects.com/api/button.js?"
                    data-merchant="braintree"
                    data-id="paypal-button"
                    data-button="checkout"
                    data-color="silver"
                    data-size="medium"
                    data-shape="pill"
                    data-button_type="submit"
                    data-button_disabled="false"
            ></script>
        </form>
    </div>

</div>


<!-- Load the Client component. -->
<script src="https://js.braintreegateway.com/web/3.6.3/js/paypal.min.js"></script>
<script src="https://js.braintreegateway.com/web/3.6.3/js/client.min.js"></script>

<!-- Load the Hosted Fields component. -->

<script src="https://js.braintreegateway.com/web/3.6.3/js/hosted-fields.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script>
    // We generated a client token for you so you can test out this code
    // immediately. In a production-ready integration, you will need to
    // generate a client token on your server (see section below).
    var submit = document.querySelector('#btnsubmit');
    var form = document.querySelector('#checkout-form');
    var paypalButton = document.querySelector('.paypal-button');


    braintree.client.create({
        authorization: document.getElementById("token").value
    }, function (clientErr, clientInstance) {
        if (clientErr) {
            alert("first");// Handle error in client creation
            return;
        }

        braintree.hostedFields.create({
            client: clientInstance,
            styles: {
                'input': {
                    'font-size': '14pt'
                },
                'input.invalid': {
                    'color': 'red'
                },
                'input.valid': {
                    'color': 'green'
                }
            },
            fields: {
                number: {
                    selector: '#card-number',
                    placeholder: '4111 1111 1111 1111'
                },
                cvv: {
                    selector: '#cvv',
                    placeholder: '123'
                },
                expirationMonth: {
                    selector: '#expiration-month',
                    placeholder: '12'
                },
                expirationYear: {
                    selector: '#expiration-year',
                    placeholder: '2029'
                },

                postalCode: {
                    selector: '#postal-code',
                    placeholder: '54000'
                }
            }
        }, function (hostedFieldsErr, hostedFieldsInstance) {
            if (hostedFieldsErr) {
                alert(hostedFieldsErr);// Handle error in Hosted Fields creation
                return;
            }

            submit.removeAttribute('disabled');

            form.addEventListener('submit', function (event) {
                event.preventDefault();

                hostedFieldsInstance.tokenize(function (tokenizeErr, payload) {
                    if (tokenizeErr) {
                        // Handle error in Hosted Fields tokenization
                        return;
                    }

                    // Put `payload.nonce` into the `payment-method-nonce` input, and then
                    // submit the form. Alternatively, you could send the nonce to your server
                    // with AJAX.
                    document.querySelector('input[name="payment-method-nonce"]').value = payload.nonce;
                    form.submit();
                });
            }, false);

        });
    });


    braintree.client.create({
        authorization: document.getElementById("token").value
    }, function (clientErr, clientInstance) {
        // Create PayPal component
        braintree.paypal.create({
            client: clientInstance
        }, function (err, paypalInstance) {
            paypalButton.addEventListener('click', function () {
                // Tokenize here!
                paypalInstance.tokenize({
                    flow: 'checkout', // Required
                    amount: 10.00, // Required
                    currency: 'USD', // Required
                    locale: 'en_US',
                    enableShippingAddress: false,
                    shippingAddressEditable: false,
                    shippingAddressOverride: {
                        recipientName: 'Scruff McGruff',
                        line1: '1234 Main St.',
                        line2: 'Unit 1',
                        city: 'Chicago',
                        countryCode: 'US',
                        postalCode: '60652',
                        state: 'IL',
                        phone: '123.456.7890'
                    }
                }, function (err, tokenizationPayload) {
                    // Tokenization complete
                    // Send tokenizationPayload.nonce to server
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: "POST",
                        url: "/payPaypal?theme_id=23",
                        data: 'nonce=' + tokenizationPayload.nonce,
                        success: function(response) {
                            document.write(response);
                        }
                    });
                });
            });
        });
    });

</script>



<!-- Configuration options:
  data-color: "blue", "gold", "silver"
  data-size: "tiny", "small", "medium"
  data-shape: "pill", "rect"
  data-button_disabled: "false", "true"
  data-button_type: "submit", "button"
--->

