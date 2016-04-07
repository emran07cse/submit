<?php
error_reporting(0);
$invoiceNumber='';$status='';$amount='';
$data = $_REQUEST;

require_once("classes/clsPaymentRequest.php");

//$invoiceNumber=$_REQUEST['MerchantTxnNo'];
//$status=$_REQUEST['TxnResponse'];
//$amount=$_REQUEST['TxnAmount'];

require_once("db/DBHandler.php");
$conn = DBHandler::ConnectMainDB();

$invoiceNumber=$data['MerchantTxnNo'];
$status=$data['TxnResponse'];
$amount=$data['TxnAmount'];

if($invoiceNumber!=''&& $status!=''&&$amount!=''){




if($status==7){$status='Cencel';
$responce="Your Transaction is Cencel.Please try Again.";
}
if($status==2){$status='Successfully';
$responce="Your Transaction is successfully done.Thanks for your $amount BDT Transaction.";

}
if($status==3){$status='Fail';$responce="Your Transaction is $status.Please try Again.";}

$strSQL="update ep_invoice set status=$status,TxnAmount=$amount,TxnResponseTime=CURRENT_TIMESTAMP() where invoiceNo='$invoiceNumber' ";
$mysqli_affected_rows = DBHandler::Mysqli_insert($conn, $strSQL);
if($mysqli_affected_rows >0) {
}

$strSQL="SELECT * FROM   fpg_daily_transactions
        INNER JOIN ep_importdozesublist ON (fpg_daily_transactions.OrderNo = ep_importdozesublist.InvoiceNo)
        WHERE ep_importdozesublist.InvoiceNo='$invoiceNumber'" ;
$mysqli_affected_rows = DBHandler::Mysqli_insert($conn, $strSQL);
if($mysqli_affected_rows >0) {
    while($row = $arrList->fetch_assoc()){
        $DozeId=$row['DozeId'];
        //$MerchantTxnNo=$row['MerchantTxnNo'];
        $secret = '16EE4D3CBC8A77DFA1C0A871936F1D16';
        echo $hashinput = strtoupper(hash_hmac('SHA256', $urlparamForHash, pack('H*',$secret)));
        $urlparamForHash = http_build_query(
            array(
                //'AccessCode' => '20151223001',
                //'MerchantTxnNo' => 'Txn20160218122740',
                'MerchantTxnNo' => $DozeId,
                'TxnResponse' => $status,
                'TxnAmount' => $amount,
                //'mcnt_Currency' => 'BDT',
                'SecureHashKey'=>$hashinput
            )
        );
        
        
        
        //OUTPUT: SJNGDXXXXXXXXXXXXXXJDKKDKDK (It is a sample)

        echo $url = "http://www.dozeinternet.com/SubscriptionServices/services/foster/billpayment.php?" . $urlparamForHash;
        //http://www.dozeinternet.com/SubscriptionServices/services/foster/billpayment.php?MerchantTxnNo=201602160216238152&TxnResponse=2&TxnAmount=1500&SecureHashKey=SJNGDXXXXXXXXXXXXXXJDKKDKDK
    
        $dozestatus=file_get_contents($url);
        echo $dozestatus;
        $strSQL="update ep_importdozesublist set DozeStatus='$dozestatus',DozeStatusReceiveTime=CURRENT_TIMESTAMP() where invoiceNo='$invoiceNumber' ";
        $mysqli_affected_rows = DBHandler::Mysqli_insert($conn, $strSQL);
    }
}
?>
<html lang='en'>
    <head>
        <title>Foster Payments | Invoice  | Pay Now</title>
        <meta charset='utf-8'>
        <meta name='viewport' content='width=device-width'>
        <style type='text/css'>
            /* CLIENT-SPECIFIC STYLES */
            #outlook a{padding:0;} /* Force Outlook to provide a 'view in browser' message */
            .ReadMsgBody{width:100%;} .ExternalClass{width:100%;} /* Force Hotmail to display emails at full width */
            .ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td, .ExternalClass div {line-height: 100%;} /* Force Hotmail to display normal line spacing */
            body, table, td, a{-webkit-text-size-adjust:100%; -ms-text-size-adjust:100%;} /* Prevent WebKit and Windows mobile changing default text sizes */
            table, td{mso-table-lspace:0pt; mso-table-rspace:0pt;} /* Remove spacing between tables in Outlook 2007 and up */
            img{-ms-interpolation-mode:bicubic;} /* Allow smoother rendering of resized image in Internet Explorer */

            /* RESET STYLES */
            body{margin:0; padding:0;}
            img{border:0; height:auto; line-height:100%; outline:none; text-decoration:none;}
            table{border-collapse:collapse !important;}
            body{height:100% !important; margin:0; padding:0; width:100% !important;}

            /* iOS BLUE LINKS */
            .appleBody a {color:#68440a; text-decoration: none;}
            .appleFooter a {color:#999999; text-decoration: none;}

            /* MOBILE STYLES */
            @media screen and (max-width: 525px) {

                /* ALLOWS FOR FLUID TABLES */
                table[class='wrapper']{
                    width:100% !important;
                }

                /* ADJUSTS LAYOUT OF LOGO IMAGE */
                td[class='logo']{
                    text-align: left;
                    padding: 20px 0 20px 0 !important;
                }

                td[class='logo'] img{
                    margin:0 auto!important;
                }

                /* USE THESE CLASSES TO HIDE CONTENT ON MOBILE */
                td[class='mobile-hide']{
                    display:none;}

                img[class='mobile-hide']{
                    display: none !important;
                }

                img[class='img-max']{
                    max-width: 100% !important;
                    height:auto !important;
                }

                /* FULL-WIDTH TABLES */
                table[class='responsive-table']{
                    width:100%!important;
                }

                /* UTILITY CLASSES FOR ADJUSTING PADDING ON MOBILE */
                td[class='padding']{
                    padding: 10px 5% 15px 5% !important;
                }

                td[class='padding-copy']{
                    padding: 10px 5% 10px 5% !important;
                    text-align: center;
                }

                td[class='padding-meta']{
                    padding: 30px 5% 0px 5% !important;
                    text-align: center;
                }

                td[class='no-pad']{
                    padding: 0 0 20px 0 !important;
                }

                td[class='no-padding']{
                    padding: 0 !important;
                }

                td[class='section-padding']{
                    padding: 50px 15px 50px 15px !important;
                }

                td[class='section-padding-bottom-image']{
                    padding: 50px 15px 0 15px !important;
                }

                /* ADJUST BUTTONS ON MOBILE */
                td[class='mobile-wrapper']{
                    padding: 10px 5% 15px 5% !important;
                }

                table[class='mobile-button-container']{
                    margin:0 auto;
                    width:100% !important;
                }

                a[class='mobile-button']{
                    width:80% !important;
                    padding: 15px !important;
                    border: 0 !important;
                    font-size: 16px !important;
                }

            }
        </style>
    </head>
    <body style='margin: 0; padding: 0;'>

        <!-- HEADER -->
        <table border='0' cellpadding='0' cellspacing='0' width='100%'>
            <tr>
                <td bgcolor='#ffffff'>
                    <div align='center' style='padding: 0px 15px 0px 15px;'>
                        <table border='0' cellpadding='0' cellspacing='0' width='500' class='wrapper'>
                            <!-- LOGO/PREHEADER TEXT -->
                            <tr>
                                <td style='padding: 20px 0px 30px 0px;' class='logo'>
                                    <table border='0' cellpadding='0' cellspacing='0' width='100%'>
                                        <tr>
                                            <td bgcolor='#ffffff' width='100' align='left'><a href='#' target='_blank'><img alt='Logo' src='http://demo.fosterpayments.com/emailpayments/img/logo.jpg' width='170' height='77' style='display: block; font-family: Helvetica, Arial, sans-serif; color: #666666; font-size: 16px;' border='0'></a></td>
                                            <td bgcolor='#ffffff' width='400' align='right' class='mobile-hide'>
                                                <table border='0' cellpadding='0' cellspacing='0'>
                                                    <tr>
                                                        <td align='right' style='padding: 0 0 5px 0; font-size: 14px; font-family: Arial, sans-serif; color: #666666; text-decoration: none;'>
                                                            <span style='color: #666666; text-decoration: none;'>
                                                                <h2>Paid Invoice</h2>
                                                            </span>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </div>
                </td>
            </tr>
        </table>

        <!-- ONE COLUMN SECTION -->
        <table border='0' cellpadding='0' cellspacing='0' width='100%'>
            <tr>
                <td bgcolor='#ffffff' align='center' style='padding: 10px 15px 70px 15px;' class='section-padding'>
                    <table border='0' cellpadding='0' cellspacing='0' width='500' class='responsive-table'>
                        <tr>
                            <td>
                                <table width='100%' border='0' cellspacing='0' cellpadding='0'>
                                    <tr>
                                        <td>
                                            <!-- HERO IMAGE -->
                                            <table width='100%' border='0' cellspacing='0' cellpadding='0'>
                                                <tbody>
                                                    <tr>
                                                        <td class='padding-copy'>
                                                            <table width='100%' border='0' cellspacing='0' cellpadding='0'>
                                                                <tr>
                                                                    <td>
                                                                        <a href='#' target='_blank'>
                                                                            <img src='http://demo.fosterpayments.com/emailpayments/img/responsive-email.jpg' width='500' height='250' border='0' alt='Can an email really be responsive?' style='display: block; padding: 0; color: #666666; text-decoration: none; font-family: Helvetica, arial, sans-serif; font-size: 16px; width: 500px; height: 250px;' class='img-max'>
                                                                        </a>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                    
                                    <tr>
                                        <td>
                                            <!-- BULLETPROOF BUTTON -->
                                            <table width='100%' border='0' cellspacing='0' cellpadding='0' class='mobile-button-container'>
                                                <tr>
                                                    <td align='center' style='padding: 25px 0 0 0;' class='padding-copy'>
                                                        <table border='0' cellspacing='0' cellpadding='0' class='responsive-table'>
                                                            <tr>
                                                                <!--<td align='center'><a style='font-size: 16px; font-family: Helvetica, Arial, sans-serif; font-weight: normal; color: #ffffff; text-decoration: none; background-color: #078B7D; border-top: 15px solid #078B7D; border-bottom: 15px solid #078B7D; border-left: 25px solid #078B7D; border-right: 25px solid #078B7D; border-radius: 3px; -webkit-border-radius: 3px; -moz-border-radius: 3px; display: inline-block;' class='mobile-button'>Pay Now &rarr;</a></td>-->
                                                                
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>

        <!-- ONE COLUMN W/ BOTTOM IMAGE SECTION -->
        <table border='0' cellpadding='0' cellspacing='0' width='100%'>
            <tr>
                <td bgcolor='#048B7C' align='center' style='padding: 30px 15px 30px 15px; color:#FFFFFF; font-size: 16px; font-family: Helvetica, Arial, sans-serif; font-weight:' class='section-padding-bottom-image'>
                    <table border='0' cellpadding='0' cellspacing='0' width='600' class='responsive-table'>
                        <?php echo $responce?>
                        <!--Your Transaction is successfully done.Thanks for your <?php // echo $amount ?> BDT Transaction .-->
                    
                    </table>
                </td>
            </tr>
        </table>
    </td>
</tr>
</table>

<!-- TWO COLUMN SECTION -->
<table border='0' cellpadding='0' cellspacing='0' width='100%'>
    <tr>
        <td bgcolor='#ffffff' align='center' style='padding: 70px 15px 70px 15px;' class='section-padding'>
            <table border='0' cellpadding='0' cellspacing='0' width='500' class='responsive-table'>
                <tr>
                    <td>
                        <!-- TITLE SECTION AND COPY -->
                        <table width='100%' border='0' cellspacing='0' cellpadding='0'>
                            <tr>
                                <td align='center' style='font-size: 25px; font-family: Helvetica, Arial, sans-serif; color: #333333;' class='padding-copy'>Supported Payment Methods</td>
                            </tr>
                            <tr>
                                <td align='center' style='padding: 20px 0 20px 0; font-size: 16px; line-height: 25px; font-family: Helvetica, Arial, sans-serif; color: #666666;' class='padding-copy'><img src='http://demo.fosterpayments.com/emailpayments/img/payment-methods.JPG' width='314' height='70'></td>
                            </tr>
                        </table>
                    </td>
                </tr>


            </table>
        </td>
    </tr>
</table>


<!-- COMPACT ARTICLE SECTION --><!-- FOOTER -->
<table border='0' cellpadding='0' cellspacing='0' width='100%'>
    <tr>
        <td bgcolor='#ffffff' align='center'>
            <table width='100%' border='0' cellspacing='0' cellpadding='0' align='center'>
                <tr>
                    <td style='padding: 20px 0px 20px 0px;'>
                        <!-- UNSUBSCRIBE COPY -->
                        <table width='500' border='0' cellspacing='0' cellpadding='0' align='center' class='responsive-table'>
                            <tr>
                                <td align='center' valign='middle' style='font-size: 12px; line-height: 18px; font-family: Helvetica, Arial, sans-serif; color:#666666;'>
                                    <!--<span class='appleFooter' style='color:#666666;'>1234 Main Street, Anywhere, MA 01234, USA</span><br>
                                    <a class='original-only' style='color: #666666; text-decoration: none;'>Unsubscribe</a>
                                    <span class='original-only' style='font-family: Arial, sans-serif; font-size: 12px; color: #444444;'>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;</span>
                                    <a style='color: #666666; text-decoration: none;'>View this email in your browser</a>-->
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>

</body>
</html>


<?php
   $checkinvoicenumber="select ep_login.user_name,ep_login.email,ep_invoice.Sendto,ep_invoice.IssueDate,ep_invoice.Createby,ep_invoice.CustomerAddress,ep_invoice.CustomerMobileNo,ep_invoice.CustomerName,
                                ep_invoice.Discount,ep_invoice.ShippingAmount,ep_invoice.TotalAmout,ep_invoice.Cc
                                from ep_login INNER JOIN ep_invoice
                                ON ep_login.MerchantId=ep_invoice.MerchantId
                                and ep_invoice.InvoiceNo='".$invoiceNumber."' ";
        $arrList = mysqli_query($conn, $checkinvoicenumber);
        
    //$arrList = DBHandler::Query($conn, 'ep_invoice','',"invoiceNo = '$invoiceNumber'");
    if ($arrList->num_rows > 0)
     while($row = $arrList->fetch_assoc()){
        $user_name=$row['user_name'];
        $email=$row['email'];
      $sentto = $row['Sendto'];
      $issueDate = $row['IssueDate'];
      $createby = $row['Createby'];       
      $Customer_address= $row['CustomerAddress']; 
      $C_M_N= $row['CustomerMobileNo']; 
      $C_N= $row['CustomerName']; 
      $ShippingAmount= $row['ShippingAmount']; 
      $Discount= $row['Discount']; 
      $TotalAmount = $row['TotalAmout'];
      $CC=$row['Cc'];
      
	if($Discount==''){$Discount='0';}
	if($ShippingAmount==''){$ShippingAmount='0';}
	if($CC==''){$CC='';}
      
     } 
$message = "
<html>
    <head>
        <meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>
        <title>Invoice</title>
        <link href='http://demo.fosterpayments.com/emailpayments/css/invoicedetails_app.css' media='all' rel='stylesheet' type='text/css'>
        <link href='http://demo.fosterpayments.com/emailpayments/css/invoicedetails.css' media='all' rel='stylesheet' type='text/css'>
        
        <script type='text/javascript' charset='utf-8' async='' data-requirecontext='_' data-requiremodule='invoicedetails' src='http://demo.fosterpayments.com/emailpayments/js/InvoiceDetails_files/invoicedetails.js'></script>
    </head>
    <body id='page' data-token='YFhTVBSwoub/d5WLdUL/569ie2aF0bckCuFjM='  class=' ltrhawkExperience'>
        <script src='http://demo.fosterpayments.com/emailpayments/js/Invoice_details/header-footer.js'></script>
         <div class='logo' style='padding-left: 150px;padding-right: 15px; height: 20px;width:20px'>
            <img alt='Summary' src='http://demo.fosterpayments.com/emailpayments/images/Foster_payments-01.png'>
        </div>
        <div role='content' id='content' class='containerCentered invoice' tabindex='-1'>
            <section>
                <div class='section invoiceDetails'>      
                    <nav role='navigation' id='subNav'>
                        <input type='hidden' id='_uid' name='_uid' value='GUID-a0bf7771-64c7-d85e-c81d-25fc71564167'>
                        <input type='hidden' id='locality' name='locality' value='US/en'>
                        <div class='clearfix'>

                        </div>
                        <hr style='margin: 0px;'>
                    </nav>
                    <div id='flashMsg'>

                    </div>
                    <!--<form name='invoiceDetailsForm' id='invoiceDetailsForm' method='post' action='Mailsend.php'>-->
                    <form name='invoiceDetailsForm' id='invoiceDetailsForm' method='post' action='http://payment.fosterpayments.com/fosterpayments_testtxn/PayCheckout.php'>
                        <input type='hidden' id='uid' name='uid' value='GUID-a0bf7771-64c7-d85e-c81d-25fc71564167'>
                        <input type='hidden' id='encryptedInvoiceId' name='encryptedInvoiceId' value='INV2-QZUV-4RUH-H237-NXZ9' class='encryptedInvoiceId'>
                        <input type='hidden' id='isMobile' name='isMobile' value=''>
                        <input type='hidden' id='invoiceStatus' name='invoiceStatus' value='1'>
                        <div class='row anchorRow'>
                            <div class='col-xs-12'>
                                <div class='pageHeader'>
                                    <h1>Paid Invoice</h1>
                                    <div class='actionHeader'>
                                        <!--input type='submit' id='send' class='btn8 btn8-primary btn8-small' href='Mailsend.php' value='Send' name='send'-->
                                        <!--input type='submit' id='send' class='btn8 btn8-primary btn8-small' href='Mailsend.php' value='Send' name='send'-->
                                        <!--<a id='editLink' class='btn8 btn8-secondary btn8-small' href='Mailsend.php'>Send</a>-->
                                        <!--a id='editLink' class='btn8 btn8-secondary btn8-small' onclick='QueryData();'>Send</a-->
                                       <!--label class='accessAid' for='moreInvAction'>More Actions</label-->                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        
                        <div class='row invoiceInfo'>
                            <span class='folded-corner'>

                            </span>
                            <div class='col-xs-12'>
                                <div class='row' style='padding-right: 150px;'>
                                    <div class='col-xs-5' id='createby'>
                                        <div class='businessLogo'>
                                            <img border='0' alt='' src=''>
                                        </div>
                                        <div class='businfobox'>
                                            <div class='headline'></div>
                                            <div>Invoice From:".$user_name." [".$createby."]</div>

                                        </div>                                         
                                            <br>
                                            <br>
                                            Invoice To :".$C_N."<br>
                                            Address :".$Customer_address."<br>
                                            Contract Number :".$C_M_N."
                                        <br><br>
                                            Invoice NO :".$invoiceNumber."<br>
                                            Invoice date :". $issueDate."
                                    </div>                                    
                                </div>
                                <div class='sectionBottom'>

                                </div>                                
                                <div class='row' id='invoiceTotals'>
                                    <table style='width:87%;'>
                                        <thead class='itemdetailsheader'>
                                            <tr>
                                                <td class='text-left' style='width:15%;text-align: center'>Description</td>
                                                <td class='text-right' style='width:15%; text-align: center'>Quantity</td>
                                                <td class='text-right' style='width:15%; text-align: center'>Unit Price</td>
                                                <td class='text-right' style='width:15%;text-align: center '>Unite Total Price</td>
                                            </tr>
                                        </thead>
                                        <tbody class='itemdetailsbody'></tbody>
                                    </table><!-- section header end-->
                                </div>
                                <div class='row' id='invoiceTotals'>
                                    <table style='width:87%;'>
                                        <thead class='itemdetailsheader'>";
                                                
                                                $strSQL='select * from  ep_invoiceitems where  InvoiceNo="'.$invoiceNumber.'" ';
                                                $arrList = mysqli_query($conn,$strSQL);
                                                if ($arrList->num_rows > 0) {
                                                    while ($row = $arrList->fetch_assoc()) {
                                                        $description = $row['ItemName'];
                                                        $quntity = $row['ItemQuntity'];
                                                        $quntityamount = $row['UnitPrice'];
                                                        $itemAmount = $row['ItemAmount'];
                                                        $message="$message<tr>
                                                        <td class='text-left' style='width:15%; text-align: center'>$description </td>
                                                        <td class='text-left' style='width:15%; text-align: center'>$quntity</td>
                                                        <td class='text-left' style='width:15%; text-align: center'>$quntityamount </td>
                                                        <td class='text-left' style='width:15%; text-align: center'>$itemAmount</td>
                                                        </tr>";
                                                    }
                                                }
                                                //mysqli_close($conn);                                                       
                                                                                      
                                            $message=$message."
                                            <tr class='invoiceTotal' style='border-bottom-width: 0px;'>                                                
                                                <td></td>
                                                <td></td>                                                 
                                                <td class='text-right'style='width:15%;text-align: center'>Discount(%)</td>
                                                <td class='text-right' style='width:15%;text-align: center'>$Discount</td>
                                            </tr>
                                            <tr class='invoiceTotal' style='border-bottom-width: 0px;'>                                                
                                                <td></td>
                                                <td></td>                                                 
                                                <td class='text-right'style='width:15%;text-align: center'>Shipping/handling(BDT)</td>
                                                <td class='text-right' style='width:15%;text-align: center'>$ShippingAmount</td>
                                            </tr>
                                            <tr class='invoiceTotal' style='border-bottom-width: 0px;'>                                                
                                                <td></td>
                                                <td></td> 
                                                
                                                <td class='text-right'style='width:15%;text-align: center'>Total(BDT)</td>
                                                <td class='text-right' style='width:15%;text-align: center'>$TotalAmount</td>
                                            </tr>
                                        </thead>
                                        <tbody class='itemdetailsbody'></tbody>
                                    </table>
                                    <!-- section header end-->
                                </div>
                                
                                <div style='margin-top: 20px;'></div>

                            </div>
			
                        </div>
                        <input type='hidden' name='dateFormat' id='dateFormat' value='mm/dd/yyyy'>
                        <input type='hidden' name='weekStart' id='weekStart' value='0'>
                        <input type='hidden' name='calendarFormat' id='calendarFormat' value='{&quot;days&quot;:[&quot;Sunday&quot;,&quot;Monday&quot;,&quot;Tuesday&quot;,&quot;Wednesday&quot;,&quot;Thursday&quot;,&quot;Friday&quot;,&quot;Saturday&quot;],&quot;daysShort&quot;:[&quot;Sun&quot;,&quot;Mon&quot;,&quot;Tue&quot;,&quot;Wed&quot;,&quot;Thu&quot;,&quot;Fri&quot;,&quot;Sat&quot;],&quot;daysMin&quot;:[&quot;Su&quot;,&quot;Mo&quot;,&quot;Tu&quot;,&quot;We&quot;,&quot;Th&quot;,&quot;Fr&quot;,&quot;Sa&quot;],&quot;months&quot;:[&quot;January&quot;,&quot;February&quot;,&quot;March&quot;,&quot;April&quot;,&quot;May&quot;,&quot;June&quot;,&quot;July&quot;,&quot;August&quot;,&quot;September&quot;,&quot;October&quot;,&quot;November&quot;,&quot;December&quot;],&quot;monthsShort&quot;:[&quot;Jan&quot;,&quot;Feb&quot;,&quot;Mar&quot;,&quot;Apr&quot;,&quot;May&quot;,&quot;Jun&quot;,&quot;Jul&quot;,&quot;Aug&quot;,&quot;Sep&quot;,&quot;Oct&quot;,&quot;Nov&quot;,&quot;Dec&quot;],&quot;today&quot;:&quot;Today&quot;,&quot;clear&quot;:&quot;Clear&quot;,&quot;titleFormat&quot;:&quot;MM yyyy&quot;}'>
                        <input type='hidden' name='locLang' id='locLang' value='en'>
                        <input type='hidden' name='nSeparator' id='nSeparator' value=','>
                        <input type='hidden' name='nDecimal' id='nDecimal' value='.'>
			
                    </form>
                </div>
            </section>
        </div>
	 <div style='height: 36px; color: #000;width:30%;text-align: center'>
            
        </div>
    </body>
</html>
";

$to =$sentto;


require_once 'utility/mailapi.php';

$setFromAddress = "paynow@fosterpayments.com";
$setFromName = $MerchantName;
$subject = $invoiceNumber . ' From ' . $user_name;
$toAddress = $sentto;


if ($CC != '') {
    //$toAddress1 = "$cc";
    //$reply = PHPMailSender::SendMail($setFromAddress, $setFromName, $subject, $CC, $message);
}
//$reply = PHPMailSender::SendMail($setFromAddress, $setFromName, $subject, $toAddress, $message);

	mysqli_close($conn);
}
if($invoiceNumber==''|| $status==''|| $amount==''){
    $error='NO parameter.';
    echo $error;
    //$_SESSION['errortext']=$error;
    //file_get_contents($url);
    clsPaymentRequest::RedirectToErrorPage($conn, $error);
	mysqli_close($conn);
}

    /*$secret = '7F099A1C07D4874B2EA14CC63B584C16';
        echo $hashinput = strtoupper(hash_hmac('SHA256', $urlparamForHash, pack('H*',$secret)));
        $urlparamForHash = http_build_query(
            array(
                //'AccessCode' => '20151223001',
                'MerchantTxnNo' => 'Txn20160218122740',
                'TxnResponse' => $status,
                'TxnAmount' => 1500,
                //'mcnt_Currency' => 'BDT',
                'SecureHashKey'=>$hashinput
            )
        );
        
        echo $url = "http://www.dozeinternet.com/SubscriptionServices/services/foster/billpayment.php?" . $urlparamForHash;

     */
?>
