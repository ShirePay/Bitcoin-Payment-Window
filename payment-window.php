<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>ShirePay Payment Window</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Ubuntu:400,700&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="icons/favicon.ico" type="image/x-icon"/>
    <link rel="stylesheet" href="css/payment-window.css">

    <script>
        var cartTotal = 0.001;
        var description = "INV123";
        var symbol = "BTC";
    </script>
</head>
<body>
    <div class="container" style="margin-top: 30px;">
        
        <div class="row">
            <div class="col-md-6 text-left">
                <div class="col-md-2"><img src="images/bitcoin-logo.png" height="50x" /></div>
                <div class="col-md-4 align-left" style="font-size: 2em; font-weight: bold; height: 100px; line-height: 50px; height: 50px; background-color: transparent;">Pay Now</div>
            </div>
            <div id="description" class="col-md-6 text-right"></div>
        </div>
        <div id="loading" class="row">
            <div class="text-center">
                <img src="images/puff.svg" />
                <br />
                contacting servers...
            </div>
        </div>
        <div id="paymentWindow" style="display: none;">
            <div class="row text-center">
                <h2 style="background-color: #D3D3D3; font-weight: bold; padding: 6px; border-radius: 8px;" 
                class="col-md-offset-3 col-md-6 text-center">Bitcoin Address</h2>
            </div>
            <div class="row">
                <div id="bitcoinAddress" class="col-md-offset-3 col-md-5 text-left bitcoinAddress " style="color: #007bff;"></div>
                <div class="col-md-1 text-center">
                    <span><button style="color: #007bff;" id="copyToClipboard" type="button" class="glyphicon glyphicon-copy"></button></span>
                    <span>
                        <a id="blockchainExplorer" target="_blank" href="#" >
                            <button style="color: #007bff;" id="blockchainExplorer" type="button" class="glyphicon glyphicon-share"></button>
                        </a>
                    </span>
                </div>
            </div>
            <div id="awaitingPayment">
                <div class="row">
                    <div class="col-md-12 text-center"><img id="googleQr" src="" alt="QR code"></div>
                </div>
                <div class="row" style="font-weight: bold;">
                    <div class="col-md-offset-3 col-md-3 text-right btcAmount col-xs-offset-3 col-xs-3" style="background-color: transparent; font-size: 2.5em;"></div>
                    <div class="col-md-6 text-left col-xs-3" style="color: silver; font-size: 2.25em;">BTC</div>
                </div>
                <div class="row">
                    <div class="col-md-offset-3 col-md-6" style="border: 2px solid #007bff; border-radius: 8px; padding: 10px; font-size: 1.5em; color: #007bff;">
                        <div class="col-4 col-md-4 col-xs-4" style="margin-top: 5px;">
                            <div class="spinning-loader col-md-offset-11 col-xs-offset-0 align-middle"></div>
                        </div>
                        <div class="col-md-8 text-left">Awaiting Payment</div>
                    </div>
                </div>
                <br />
                <div class="row alert alert-warning"role="alert">
                    <div class="col-md-offset-1 col-md-10">
                        <div class="col-md-2" style="font-weight: bold;">Instructions:</div>
                        <div class="col-md-10">Please make one single payment of <span class="btcAmount"></span> BTC. Do not include the Bitcoin transaction fee in this amount.</div>
                        <br />
                        <div class="text-center">As soon as payment is received, the order will be automatically be confirmed.</div>
                    </div>
                </div>
                <div id="warning" class="row alert alert-danger"role="alert">
                    <div class="col-md-offset-1 col-md-10">
                        <div class="col-md-2" style="font-weight: bold;">Warning:</div>
                        <div id="warningMessage" class="col-md-10"></div>
                    </div>
                </div>
            </div>
            <div id="receivedPayment" class="row" style="display: none;">
                <div class="col-md-offset-3 col-md-6 alert alert-success"role="alert" style="margin-top: 20px;">
                    <div id="successMessage" class="text-center">Congratulations! We have received your payment of <span class="btcAmount"></span> BTC</div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 text-right">
                <a style="text-decoration: none; font-style: italic;" target="_blank" href="https://www.shirepay.com">secured via ShirePay&nbsp;<img width="35" src="/images/shirepay-logo.png" /></a>
            <div>
        </div>
    </div>
</body>
</html>



<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script src="js/payment-window.js"></script>