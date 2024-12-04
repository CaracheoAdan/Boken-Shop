<!DOCTYPE html>
<html lang="">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Boken testing</title>

        <script src="https://www.paypal.com/sdk/js?client-id=AQsxsK4wEmHiCkJxQcL-H3k3Mkmac04BT2wuVNF9olRNNnvGf4Lt-JXMtK7rMYPafD_FcCVowfgoSCWe&currency=MXN"></script>
    </head>
    <body>
        <div id="paypal-button-container"></div>
        <script>
            paypal.Buttons({
                style: {
                    shape: 'pill',
                    color: 'blue',
                    label: 'pay'
                },
                createOrder: function($data, actions) {
                    return actions.order.create({
                        purchase_units: [{
                            amount: {
                                value: '100.00',
                                currency_code: 'MXN'
                            }
                        }]
                    });
                },
                onApprove: function($data, actions) {
                    return actions.order.capture().then(function(detalles) {
                        alert('Pago aceptado!');
                        console.log(detalles); // Nos regresa detalles del pago
                    });
                },
                onCancel: function($data) {
                    alert("Pago cancelado");
                    console.log($data); // Nos regresa un token que nos puede ayudar a registrar si se cancelo algun pago
                }
            }).render('#paypal-button-container');
        </script>
    </body>
</html>