<script src="assets/js/jquery-1.12.0.min.js" type="text/javascript"></script>
<script src="content/js/sing_up.js" type="text/javascript"></script>
<!--<script src="assets/content/js/Resetpassword.js" type="text/javascript"></script>-->
<?php
session_start();

/*
 hello
 * my name is Emran
*/
if (isset($_POST['btnLogin'])) {
    //echo 'Hello';
    $mcnt_AccessCode = trim($_POST['mcnt_AccessCode']);
    $mcnt_TxnNo = trim($_POST['mcnt_TxnNo']);
    $mcnt_ShortName = trim($_POST['mcnt_ShortName']);
    $mcnt_OrderNo = trim($_POST['mcnt_OrderNo']);
    $mcnt_SecurityKey = trim($_POST['mcnt_SecurityKey']);
    $mcnt_TxnGroup = trim($_POST['mcnt_TxnGroup']);
    $mcnt_Amount = trim($_POST['mcnt_Amount']);
    $mcnt_Currency = trim($_POST['mcnt_Currency']);
    $mcnt_InvoiceTo = trim($_POST['mcnt_InvoiceTo']);
    $mcnt_CustomerServiceName = trim($_POST['mcnt_CustomerServiceName']);
    $mcnt_CustomerEmail = trim($_POST['mcnt_CustomerEmail']);
    $mcnt_CustomerAddress = trim($_POST['mcnt_CustomerAddress']);
    $mcnt_CustomerContact = trim($_POST['mcnt_CustomerContact']);
    $mcnt_CustomerGender = trim($_POST['mcnt_CustomerGender']);
    $mcnt_CustomerCity = trim($_POST['mcnt_CustomerCity']);
    $mcnt_CustomerPostcode = trim($_POST['mcnt_CustomerPostcode']);
    $mcnt_CustomerCountry = trim($_POST['mcnt_CustomerCountry']);
//    $datetime = date("YmdHis");

    $urlparam = http_build_query(
        array(
            'mcnt_AccessCode' => '20160204109',//No Need to Change            
            'mcnt_TxnNo' => $mcnt_TxnNo,
            'mcnt_ShortName' => $mcnt_ShortName,//No Need to Change
            'mcnt_OrderNo' => $mcnt_OrderNo,
            'mcnt_SecurityKey' => $mcnt_SecurityKey,//No Need to Change
            'mcnt_TxnGroup' => $mcnt_TxnGroup,//No Need to Change
            'mcnt_Amount' => $mcnt_Amount,
            'mcnt_Currency' => $mcnt_Currency,
            
            'mcnt_InvoiceTo' => $mcnt_InvoiceTo,
            'mcnt_CustomerServiceName' => $mcnt_CustomerServiceName,
            'mcnt_CustomerEmail' => $mcnt_CustomerEmail,
            'mcnt_CustomerAddress' => $mcnt_CustomerAddress,
            'mcnt_CustomerContact' => $mcnt_CustomerContact,
            'mcnt_CustomerGender' => $mcnt_CustomerGender,
            'mcnt_CustomerCity' => $mcnt_CustomerCity,
            'mcnt_CustomerState' => $mcnt_CustomerState,
            'mcnt_CustomerPostcode' => $mcnt_CustomerPostcode,
            'mcnt_CustomerCountry' => $mcnt_CustomerCountry
        )
    );
//$url = "receivemerchantpaymentrequest.php?".$urlparam;
    echo $url = "../fosterpayments/receivemerchantpaymentrequest.php?".$urlparam;
    header("Location:".$url);
}

?>
<!doctype html>
<!--[if lte IE 9]> <html class="lte-ie9" lang="en"> <![endif]-->
<!--[if gt IE 9]><!--> <html lang="en"> <!--<![endif]-->
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!-- Remove Tap Highlight on Windows Phone IE -->
        <meta name="msapplication-tap-highlight" content="no"/>

        <link rel="icon" type="image/png" href="assets/img/favicon-16x16.png" sizes="16x16">
        <link rel="icon" type="image/png" href="assets/img/favicon-32x32.png" sizes="32x32">

        <title>Foster Payments - Login</title>
        <!--<link href='https://fonts.googleapis.com/css?family=Rajdhani:400,500,600,700' rel='stylesheet' type='text/css'>-->
        <!--<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700,400italic,700italic' rel='stylesheet' type='text/css'>-->
        <link rel="stylesheet" href="assets/css/uikit.almost-flat.min.css"/>
        <link rel="stylesheet" href="assets/css/login_page.min.css" />
        <!--<link rel="stylesheet" href="assets/css/main.min.css" media="all">-->

    </head>
    <body class="login_page">

<div class="login-logo"><img src="assets/img/foster_payments_logo_white.png" width="168" height="76"></div>
        <div id="page_content" >
            <div id="page_content_inner">
                 <form method="post" name="login">
                <div class="md-card" style="width: 75%;padding-left: 100px;">
                    
                    <div class="md-card-content">
                        <div class="uk-grid">
                            <div class="uk-form-row">
                                <label for="mcnt_AccessCode">Access Code</label>
                                <input class="md-input" type="text" id="mcnt_AccessCode" name="mcnt_AccessCode" VALUE="20160204109"/>
                            </div>
                            <div class="uk-form-row">
                                <label for="mcnt_TxnNo">Txn No</label>
                                <input class="md-input" type="text" id="mcnt_TxnNo" name="mcnt_TxnNo" />
                            </div>
                            <div class="uk-form-row">
                                <label for="mcnt_ShortName">Short Name</label>
                                <input class="md-input" type="text" id="mcnt_ShortName" name="mcnt_ShortName" value="SHTD"/>
                            </div>
                            <div class="uk-form-row">
                                <label for="mcnt_TxnNo">Order No</label>
                                <input class="md-input" type="text" id="mcnt_OrderNo" name="mcnt_OrderNo" />
                            </div>                            
                        </div>
                    </div>

                    <div class="md-card-content">
                        <div class="uk-grid">
                            <div class="uk-form-row">
                                <label for="mcnt_TxnNo">Security Key</label>
                                <input class="md-input" type="text" id="mcnt_SecurityKey" name="mcnt_SecurityKey" value="2E029A1C07D3874B2DX14HC63B584C37"/>
                            </div>
                            <div class="uk-form-row">
                                <label for="mcnt_AccessCode">Txn Group</label>
                                <input class="md-input" type="text" id="mcnt_TxnGroup" name="mcnt_TxnGroup" value="TEST"/>
                            </div>
                            <div class="uk-form-row">
                                <label for="mcnt_TxnNo">Amount</label>
                                <input class="md-input" type="text" id="mcnt_Amount" name="mcnt_Amount" />
                            </div>
                            <div class="uk-form-row">
                                <label for="mcnt_TxnNo">Currency</label>
                                <input class="md-input" type="text" id="mcnt_Currency" name="mcnt_Currency" value="BDT"/>
                            </div>
                        </div>
                    </div>
                    <div class="md-card-content">
                        <div class="uk-grid">
                            <div class="uk-form-row">
                                <label for="mcnt_TxnNo">Invoice To</label>
                                <input class="md-input" type="text" id="mcnt_InvoiceTo" name="mcnt_InvoiceTo" />
                            </div>
                            <div class="uk-form-row">
                                <label for="mcnt_TxnNo">Customer Service Name</label>
                                <input class="md-input" type="text" id="mcnt_CustomerServiceName" name="mcnt_CustomerServiceName" />
                            </div>
                            <div class="uk-form-row">
                                <label for="mcnt_TxnNo">Customer Email</label>
                                <input class="md-input" type="text" id="mcnt_CustomerEmail" name="mcnt_CustomerEmail" />
                            </div>
                            <div class="uk-form-row">
                                <label for="mcnt_CustomerAddress">Customer Address</label>
                                <input class="md-input" type="text" id="mcnt_CustomerAddress" name="mcnt_CustomerAddress" />
                            </div>
                        </div>                            
                    </div>
                    <div class="md-card-content">
                        <div class="uk-grid">
                            <div class="uk-form-row">
                                <label for="mcnt_TxnNo">Customer Contact</label>
                                <input class="md-input" type="text" id="mcnt_CustomerContact" name="mcnt_CustomerContact" />
                            </div>
                            <div class="uk-form-row">
                                <label for="mcnt_CustomerGender">Customer Gender</label>
                                <input class="md-input" type="text" id="mcnt_CustomerGender" name="mcnt_CustomerGender" />
                            </div>
                            <div class="uk-form-row">
                                <label for="mcnt_CustomerCity">Customer City</label>
                                <input class="md-input" type="text" id="mcnt_CustomerCity" name="mcnt_CustomerCity" value="Dhaka"/>
                            </div>
                            <div class="uk-form-row">
                                <label for="mcnt_TxnNo">Customer Post Code</label>
                                <input class="md-input" type="text" id="mcnt_CustomerPostcode" name="mcnt_CustomerPostcode" />
                            </div>
                            
                        </div>                            
                    </div>
                     <div class="md-card-content">
                         <div class="uk-grid">
                             <div class="uk-form-row">
                                <label for="mcnt_TxnNo">Customer Country</label>
                                <input class="md-input" type="text" id="mcnt_CustomerCountry" name="mcnt_CustomerCountry" value="Bangladesh"/>
                            </div>
                            <div class="uk-form-row">
                                <button class="md-btn md-btn-primary md-btn-block md-btn-large" type="submit" id="btnLogin" name="btnLogin" value="Login">Submit</button>
                            </div>
                         </div>
                             
                     </div>
                            
                            
                    </div>                    
                </form>
                </div>                
            </div>
        
        <!-- common functions -->
        <script src="assets/js/common.min.js"></script>
        <!-- altair core functions -->
        <script src="assets/js/altair_admin_common.min.js"></script>

        <!-- altair login page functions -->
        <script src="assets/js/pages/login.min.js"></script>

    </body>
</html>