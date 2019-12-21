
var blockchainExplorer = "https://testnet.smartbit.com.au/address/"; // testnet
//var blockchainExplorer = "https://smartbit.com.au/address/"; // main

$(document).ready(function () {

    $('#cartTotal').text(cartTotal);
    $('#description').text(description);

    var copyAddressBtn = document.querySelector('#copyToClipboard');

    copyAddressBtn.addEventListener('click', function (event) {

        var addressLink = document.querySelector('#bitcoinAddress');
        var range = document.createRange();
        range.selectNode(addressLink);
        window.getSelection().addRange(range);

        try {
            // Now that we've selected the anchor text, execute the copy command  
            var successful = document.execCommand('copy');
            var msg = successful ? 'successful' : 'unsuccessful';
            alert($('#bitcoinAddress').text() + " was copied to the clipboard");
            console.log('Copy address command was ' + msg);
        } catch (err) {
            alert('Oops, unable to copy address');
        }
        window.getSelection().removeAllRanges();
    });

    myData();

    interval = setInterval(function(){
        myData();
    },1000);

    function fillData(data){
        console.log(data);

        if(data == null){
            console.log('Input is invalid, please check your settings within payment-window-post.php');
            clearInterval(interval);
            return;
        }

        if(data !== null){
            $('#loading').fadeOut();
            $('#paymentWindow').fadeIn();
        }

        var btcReceived = data.SatoshisReceived / 100000000;
        var btcExpected = data.SatoshisExpected / 100000000;

        var warningMessage = ""; 

        var paymentValid = false;

        if(data == null){
            // no payment receeved or data error
            $('#loading').fadeIn();
            $('#paymentWindow').fadeOut();
        }
        else if(btcReceived == cartTotal){
            // Payment perfect
            paymentValid = true;
        }
        else if(btcReceived < cartTotal){
            // Payment received but not full amount
            warningMessage = btcReceived+" BTC has been received at this address but expecting " + btcExpected + " BTC";
        }
        else if(btcReceived > cartTotal){
            // // too much has been paid
            warningMessage = btcReceived+" BTC has been received at this address but expecting " + btcExpected + " BTC";
            paymentValid = true;
        }
        else{
            // no payment recieved
        }

        console.log(warningMessage);

        if(paymentValid === true){
            console.log('paymentvalid: ' + paymentValid);
            if(data.Confirmations >= 6){
                // payment confirmed
                console.log('confirmations: ' + data.Confirmations);
                clearInterval(interval);
                $('#awaitingPayment').hide();
                $('#receivedPayment').show();
            }
        }

        console.log("received: " + btcReceived);

        if(warningMessage !== "" && btcReceived > 0){
            $('#warning').fadeIn();
            $('#warningMessage').html(warningMessage);
        }else{
            $('#warning').fadeOut();
        }

        console.log(data.BitcoinAddress);

        setBitcoinAddress(data.BitcoinAddress);
        setBitcoinAmount(data.SatoshisExpected);
        console.log(data.SatoshisExpected);
    }

    function myData(){
        $.get('/payment-window-post.php',{ description: description, symbol: symbol, requestedAmount: cartTotal}, function(data){
            var myData = $.parseJSON(data);
            fillData(myData);
        });
    }

    function setBitcoinAddress(bitcoinAddress){
        $('#bitcoinAddress').text(bitcoinAddress);
        $("#blockchainExplorer").attr("href", blockchainExplorer + bitcoinAddress);
        $("#googleQr").attr("src","https://chart.googleapis.com/chart?chs=250x250&cht=qr&chl="+bitcoinAddress+"&choe=UTF-8");
    }
    
    function setBitcoinAmount(satoshis){
        var btc = satoshis / 100000000;
        $('.btcAmount').text(btc);
    }
});
