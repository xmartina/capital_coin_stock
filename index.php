<?php
$page_name = 'Stock Investment';
include_once __DIR__ . '/include/config.php';
include_once __DIR__ . '/partials/header.php';
?>
    <h4 class="page-title">Make Deposit</h4>
    <div class="row">
        <div class="col-md-12">
            <br>
            <form method="post" name="spendform"><input type="hidden" name="form_id" value="17335456725881"><input
                        type="hidden" name="form_token" value="7c48fed82118e274f861ec2ff8a8600a">
                <input type="hidden" name="a" value="deposit">

                Select a plan:<br>
                <div class="card">
                    <div class="card-body">
                        <table cellspacing="1" cellpadding="2" border="0" width="100%" class="tab">
                            <tbody>
                            <tr>
                                <td colspan="3">
                                    <input type="radio" name="h_id" value="4" checked="" onclick="updateCompound()">
                                    <b>Startup plan</b></td>
                            </tr>
                            <tr class="head">
                                <th class="inheader">Plan</th>
                                <th class="inheader" width="200">Spent Amount ($)</th>
                                <th class="inheader" width="100" nowrap="">
                                    <nobr> Profit (%)</nobr>
                                </th>
                            </tr>
                            <tr>
                                <td class="item">Startup plan</td>
                                <td class="item" align="right">$100.00 - $10000.00</td>
                                <td class="item" align="right">10.00</td>
                            </tr>
                            <tr>
                                <td colspan="3" align="right"><a href="javascript:openCalculator('4')">Calculate your
                                        profit
                                        &gt;&gt;</a></td>
                            </tr>
                            </tbody>
                        </table>
                        <br><br>
                        <script>
                            cps[4] = [];
                        </script>

                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <table cellspacing="1" cellpadding="2" border="0" width="100%" class="tab">
                            <tbody>
                            <tr>
                                <td colspan="3">
                                    <input type="radio" name="h_id" value="5" onclick="updateCompound()">
                                    <b>Silver Package</b></td>
                            </tr>
                            <tr class="head">
                                <th class="inheader">Plan</th>
                                <th class="inheader" width="200">Spent Amount ($)</th>
                                <th class="inheader" width="100" nowrap="">
                                    <nobr> Profit (%)</nobr>
                                </th>
                            </tr>
                            <tr>
                                <td class="item">Silver Package</td>
                                <td class="item" align="right">$4000.00 - $16000.00</td>
                                <td class="item" align="right">15.00</td>
                            </tr>
                            <tr>
                                <td colspan="3" align="right"><a href="javascript:openCalculator('5')">Calculate your
                                        profit
                                        &gt;&gt;</a></td>
                            </tr>
                            </tbody>
                        </table>
                        <br><br>
                        <script>
                            cps[5] = [];
                        </script>

                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <table cellspacing="1" cellpadding="2" border="0" width="100%" class="tab">
                            <tbody>
                            <tr>
                                <td colspan="3">
                                    <input type="radio" name="h_id" value="6" onclick="updateCompound()">
                                    <b>Gold Package</b></td>
                            </tr>
                            <tr class="head">
                                <th class="inheader">Plan</th>
                                <th class="inheader" width="200">Spent Amount ($)</th>
                                <th class="inheader" width="100" nowrap="">
                                    <nobr> Profit (%)</nobr>
                                </th>
                            </tr>
                            <tr>
                                <td class="item">Gold Package</td>
                                <td class="item" align="right">$10000.00 - $15999.00</td>
                                <td class="item" align="right">35.00</td>
                            </tr>
                            <tr>
                                <td colspan="3" align="right"><a href="javascript:openCalculator('6')">Calculate your
                                        profit
                                        &gt;&gt;</a></td>
                            </tr>
                            </tbody>
                        </table>
                        <br><br>
                        <script>
                            cps[6] = [];
                        </script>

                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <table cellspacing="1" cellpadding="2" border="0" width="100%" class="tab">
                            <tbody>
                            <tr>
                                <td colspan="3">
                                    <input type="radio" name="h_id" value="7" onclick="updateCompound()">
                                    <b>Diamond Package</b></td>
                            </tr>
                            <tr class="head">
                                <th class="inheader">Plan</th>
                                <th class="inheader" width="200">Spent Amount ($)</th>
                                <th class="inheader" width="100" nowrap="">
                                    <nobr> Profit (%)</nobr>
                                </th>
                            </tr>
                            <tr>
                                <td class="item">Diamond Package</td>
                                <td class="item" align="right">$16000.00 - $20000.00</td>
                                <td class="item" align="right">50.00</td>
                            </tr>
                            <tr>
                                <td colspan="3" align="right"><a href="javascript:openCalculator('7')">Calculate your
                                        profit
                                        &gt;&gt;</a></td>
                            </tr>
                            </tbody>
                        </table>
                        <br><br>
                        <script>
                            cps[7] = [];
                        </script>

                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <table cellspacing="1" cellpadding="2" border="0" width="100%" class="tab">
                            <tbody>
                            <tr>
                                <td colspan="3">
                                    <input type="radio" name="h_id" value="8" onclick="updateCompound()">
                                    <b>Traditional map</b></td>
                            </tr>
                            <tr class="head">
                                <th class="inheader">Plan</th>
                                <th class="inheader" width="200">Spent Amount ($)</th>
                                <th class="inheader" width="100" nowrap="">
                                    <nobr> Profit (%)</nobr>
                                </th>
                            </tr>
                            <tr>
                                <td class="item">Traditional map</td>
                                <td class="item" align="right">$29000.00 - $49000.00</td>
                                <td class="item" align="right">130.00</td>
                            </tr>
                            <tr>
                                <td colspan="3" align="right"><a href="javascript:openCalculator('8')">Calculate your
                                        profit
                                        &gt;&gt;</a></td>
                            </tr>
                            </tbody>
                        </table>
                        <br><br>
                        <script>
                            cps[8] = [];
                        </script>

                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <table cellspacing="1" cellpadding="2" border="0" width="100%" class="tab">
                            <tbody>
                            <tr>
                                <td colspan="3">
                                    <input type="radio" name="h_id" value="9" onclick="updateCompound()">
                                    <b>Black box package</b></td>
                            </tr>
                            <tr class="head">
                                <th class="inheader">Plan</th>
                                <th class="inheader" width="200">Spent Amount ($)</th>
                                <th class="inheader" width="100" nowrap="">
                                    <nobr> Profit (%)</nobr>
                                </th>
                            </tr>
                            <tr>
                                <td class="item">Black box package</td>
                                <td class="item" align="right">$50000.00 - $79999.00</td>
                                <td class="item" align="right">150.00</td>
                            </tr>
                            <tr>
                                <td colspan="3" align="right"><a href="javascript:openCalculator('9')">Calculate your
                                        profit
                                        &gt;&gt;</a></td>
                            </tr>
                            </tbody>
                        </table>
                        <br><br>
                        <script>
                            cps[9] = [];
                        </script>

                    </div>
                </div>

                <div class="bg-white rounded py-3 px-3">
                    <small>
                    </small>
                    <div class="h5 text-muted">
                        Your account balance <span class="text-info">($): $0.00</span>
                    </div>
                    <div class="my-2">

                        <div class="form-group">
                            <label for="exampleInputEmail1">Amount to Spend </label>
                            <input type="text" name="amount" value="100.00" class="form-control" size="15"
                                   style="text-align:right;">

                            <div class="d-flex justify-content-space-around flex-wrap">


                            </div>
                            <button class="btn bg-info px-3 py-2 text-light" type="submit" value="Spend">Submit

                            </button>
                        </div>
                    </div>
                    <div class="VIpgJd-ZVi9od-aZ2wEe-wOHMyf">
                        <div class="VIpgJd-ZVi9od-aZ2wEe-OiiCO">
                            <svg xmlns="http://www.w3.org/2000/svg" class="VIpgJd-ZVi9od-aZ2wEe" width="96px"
                                 height="96px"
                                 viewBox="0 0 66 66">
                                <circle class="VIpgJd-ZVi9od-aZ2wEe-Jt5cK" fill="none" stroke-width="6"
                                        stroke-linecap="round" cx="33" cy="33" r="30"></circle>
                            </svg>
                        </div>
                    </div>
                    <table cellspacing="0" cellpadding="2" border="0">
                        <tbody>
                        <tr>
                            <td>Your account balance ($):</td>
                            <td align="right">$0.00</td>


                            <!-- Modal -->

                            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
                            <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"></script>
                            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.7/umd/popper.min.js"></script>
                            <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.2/js/bootstrap.min.js"></script>
                            <script src="https://cdnjs.cloudflare.com/ajax/libs/chartist/0.11.4/chartist.min.js"></script>
                            <script src="https://cdnjs.cloudflare.com/ajax/libs/chartist-plugin-tooltip/0.0.11/chartist-plugin-tooltip.min.js"></script>
                            <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-notify/0.2.0/js/bootstrap-notify.min.js"></script>
                            <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
                            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-mapael/2.2.0/js/jquery.mapael.min.js"></script>
                            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-mapael/2.2.0/js/maps/world_countries.min.js"></script>
                            <script src="/new/assets/js/plugin/chart-circle/circles.min.js"></script>
                            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.scrollbar/0.2.11/jquery.scrollbar.min.js"></script>
                            <script src="/new/assets/js/ready.min.js"></script>


                            <!--Google Translator-->
                            <script>

                                function googleTranslateElementInit() {

                                    new google.translate.TranslateElement({

                                        pageLanguage: 'en',

                                        autoDisplay: 'true',

                                        layout: google.translate.TranslateElement.InlineLayout.HORIZONTAL

                                    }, 'google_translate_element');

                                }

                            </script>

                            <script src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
                            <!--End Google Translator-->
                            <!-- Jivo -->
                            <script src="//code.jivosite.com/widget/H7vKCE5O1A" async=""></script>


                        </tr>
                        </tbody>
                    </table>
                </div>
            </form>
        </div>
    </div>
<?php
include_once __DIR__ . '/partials/footer.php';
?>