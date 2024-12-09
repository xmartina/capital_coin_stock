<?php require_once('header.php'); ?>

<div class="row py-5">
    <div class="col-lg-4"></div>
    <div class="col-lg-4">
        <div class="form-container rounded py-4 px-3 ">
            <h3>
                Deposit Form
            </h3>
            <div class="depo-1">
                <div class="note-dash text-success text-center py-3">
                    Note: only use this form if you are ready to make a deposit now
                    <!--                --><?php //echo $userID; ?>
                </div>
                <form method="POST">
                    <div class="form-group input-group">
                        <div class="row align-items-center">
                            <div class="col-sm-4 pr-0">User Name</div>
                            <div class="col-sm-8 pl-2">
                                <input disabled name="username w-100" class="form-control w-100"
                                       value="<?= $_SESSION['username'] ?>"
                                       placeholder="Full name" type="text">
                            </div>
                        </div>
                    </div> <!-- form-group// -->
                    <!--<div class="form-group input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"> <i class="fa fa-phone"></i> </span>
                        </div>
                        <select class="custom-select" style="max-width: 120px;">
                            <option selected="">+971</option>
                            <option value="1">+972</option>
                            <option value="2">+198</option>
                            <option value="3">+701</option>
                        </select>
                        <input name="" class="form-control" placeholder="Phone number" type="text">
                    </div>-->

                    <!-- Include jQuery library -->


                    <div class="form-group input-group">
                        <div class="btc-exp">
                            Use the wallet address below to make your deposit
                        </div>

                        <div class="my-4">
                            <div class="col-auto my-1">
                                <label class="mr-sm-2" for="inlineFormCustomSelect">Select your preferred address</label>

                                <div class="addressSelectError d-none my-3 text-danger text-center" id="addressSelectError">Please select a wallet address to complete your transaction
                                <div class="my-2 below-addressSelectError text-center text-info font-weight-bold">Also, don't forget to add your deposit amount.</div>
                                </div>

                                <select class="custom-select" id="inlineFormCustomSelect" name="ec_type">
                                    <option >Select</option>
                                    <option value="1">Bitcoin</option>
                                    <option value="2">Ethereum</option>
                                    <option value="3">USDT (TRC20)</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group input-group">
                            <div class="row align-items-center walletAddress1 w-100">
                                <div class="col-sm-2 pr-0">Bitcoin</div>
                                <div class="col-sm-8 ">
                                    <input id="btc-address" class="form-control crypto-select"
                                           value="bc1qldk0yfuj66hs6406murakdewqs9e6drjezzdd0" type="text">
                                </div>
                                <div class="col-sm-2">
                                    <button id="copy-btc" class="rounded-2 bg-dark text-light"
                                            data-clipboard-target="#btc-address">Copy
                                    </button>
                                </div>
                            </div>
                            <div class="row align-items-center walletAddress2 w-100">
                                <div class="col-sm-2 pr-0">Ethereum</div>
                                <div class="col-sm-8 ">
                                    <input id="eth-address" class="form-control crypto-select"
                                           value="0x164D7861b0d36cf6fD895eb5A3603A01B35B1CD1" type="text">
                                </div>
                                <div class="col-sm-2">
                                    <button id="copy-eth" class="rounded-2 bg-dark text-light"
                                            data-clipboard-target="#eth-address">Copy
                                    </button>
                                </div>
                            </div>
                            <div class="row align-items-center walletAddress3 w-100">
                                <div class="col-sm-2 pr-0">USDT (TRC20)</div>
                                <div class="col-sm-8">
                                    <input id="usdt-address" class="form-control crypto-select"
                                           value="TNmGnAYTctsEH44o1GDquwjpXxBhREKiGP" type="text">
                                </div>
                                <div class="col-sm-2">
                                    <button id="copy-usdt" class="rounded-2 bg-dark text-light"
                                            data-clipboard-target="#usdt-address">Copy
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="depo-amunt pb-3">
                            Amount to deposit.
                            <div class="py-4 px-3 text-danger text-center auth-error d-none" id="auth-error">Error:
                                Amount too small or lesser than 0 please check and try again
                            </div>
                        </div>
                        <div class="infu w-100">
                            <input name="deposit_amount" class="form-control crypto-select w-100" id="deposit-amount"
                                   placeholder="e.g 500"
                                   type="text">
                        </div>
                    </div> <!-- form-group// -->
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-4 offset-8 ">
                                <div class="btn btn-primary btn-block" id="confirm-form">Next</div>
                            </div>
                        </div>
                    </div>
            </div> <!-- deposit-group// -->
            <div class="depo-2">
                <div class="pt-5 pb-3 px-3 conf-depo text-center ">
                    Confirm your deposit
                </div>
                <div class="make-depo text-center">
                    After making your deposit, enter your transaction id or reference id below
                </div>
                <div class="depo">
                    <div class="py-4">
                        <div class="form-group">
                            <div class="depo-amunt pb-3">
                                Enter your (Transaction Id / Transaction Reference Id / Reference Id )
                            </div>
                            <input  class="form-control crypto-select w-100" id="trans_id" placeholder="Input your transaction id here" type="text">
                        </div>
                        <div class="form-group py-3">
                            <div class="row">
                                <div class="col-sm-5">
                                    <div class="btn btn-primary btn-block" id="back-amount-form">Prev</div>
                                </div>
                                <div class="col-sm-7">
                                    <button type="submit" class="btn btn-primary btn-block"> Submit deposit for review</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </div>
<!--    google translator-->
    <div class="py-5 col-lg-4 offset-4">
        <div class="fixed-con">
            <div id='google_translate_element'></div>
        </div>
    </div>
</div>

<?php require_once('footer.php'); ?>

