<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Deposit Stat</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.2/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="row pt-5 align-items-center py-5">
            <div class="col-lg-4"></div>
            <div class="col-lg-4 rounded py-5 depo-stat-con">
                <div class="row gy-5 gx-5 align-items-center">
                    <div class="col-sm-2 d-flex justify-content-center align-items-center">
                        <div class="circle-container d-flex justify-content-center align-items-center rounded-circle bg-success text-white p-3">
                            <span class="material-symbols-outlined w-100 text-center">done</span>
                        </div>
                    </div>
                    <div class="col-sm-10 pt-4">
                        <span class="depo-stat-hd py-4 text-center">
                        Your deposit was has been submitted successfully
                        </span>
                    </div>
                    <div class="col-sm-2 py-4"></div>
                    <div class="col-sm-10 py-4">
                        <span class="depo-stat-bd py-4">
                            Remember to make your deposit using the wallet addresses provided for you in the previous page for your deposit to be approved
                        </span>

                        <div class="redirect-das py-1">
                            <div id="countdown">Redirecting in 10 seconds... or <span class="cursor-pointer text-warning" onclick="location.href='https://capitalcoin.online/?a=account'">click here to visit you dashboard</span></div>
                        </div>
                    </div>
                </div>
            </div>
            <!--    google translator-->
            <div class="py-5 col-lg-4 offset-4">
                <div class="fixed-con">
                    <div id='google_translate_element'></div>
                </div>
            </div>

        </div>
    </div>
</body>

<script>
    setTimeout(function() {
        window.location.href = 'https://capitalcoin.online/?a=account';
    }, 9000); 
</script>
<script>
    function googleTranslateElementInit() {
        new google.translate.TranslateElement({
            pageLanguage: 'en',
            autoDisplay: 'true',
            layout: google.translate.TranslateElement.InlineLayout.HORIZONTAL
        }, 'google_translate_element');
    }
</script>
<script src='//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit'></script>
</html>