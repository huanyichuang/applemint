<?php 
// 智付通提供的加密方式 begins
function create_mpg_aes_encrypt ($parameter = "" , $key = "", $iv = "") {    
    $return_str = '';
    if (!empty($parameter)) { 
// 將參數經過 URL ENCODED QUERY STRING
        $return_str = http_build_query($parameter);
    }
    return trim(bin2hex(mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $key,addpadding($return_str), MCRYPT_MODE_CBC, $iv)));
}
function addpadding($string, $blocksize = 32) {
    $len = strlen($string);
    $pad = $blocksize - ($len % $blocksize);
    $string .= str_repeat(chr($pad), $pad);
return $string; 
}

$trade_info_arr = array(
    'MerchantID' => $_POST['MerchantID'], //從資料頁取得POST來的資料
    'RespondType' => $_POST['RespondType'], 
    'TimeStamp' => time(), 
    'Version' => 1.4, //要避免使用""，不然被讀成string的話會顯示版本錯誤
    'MerchantOrderNo' => date("Ym").substr(uniqid(),7,12), //目前先產生隨機代碼，到時候有其他命名規則可以再補上
    'Amt' => $_POST['Amt'], 
    'ItemDesc' => $_POST['ItemDesc'],
    'Email' => $_POST['Email'],
    'ReturnURL' => "https://www.applemint.tech/dev/thankyou.php"
    );
$mer_key = 'KYuCP67M4PORLKEnBOABZxj13clUOMEE'; //智付通提供的Hash key
$mer_iv = 'mBunmuODdthH2u8C'; //智富通提供的Hash IV

// 交易資料經 AES 加密後取得 TradeInfo 
$TradeInfo = create_mpg_aes_encrypt($trade_info_arr,$mer_key,$mer_iv); 
$TradeSha = strtoupper(hash("sha256", "HashKey=".$mer_key."&".$TradeInfo."&HashIV=".$mer_iv));
// 智付通提供的加密方式 ends
?>
<!-- 將加密過的資料PASS到智付通 -->
<form id="encrypt" action="https://ccore.spgateway.com/MPG/mpg_gateway" method="post">
        <input type="hidden" name="MerchantID" value="MS32495785">
        <input type="hidden" name="Version" value=1.4>
        <input type="hidden" name="RespondType" value="JSON">
        <input type="hidden" name="TradeInfo" value="<?php echo $TradeInfo?>">
        <input type="hidden" name="TradeSha" value="<?php echo $TradeSha?>">
        <input type="hidden" name="Amt" value="<?php echo $trade_info_arr['Amt']?>"><br>
        <input type="hidden" name="ItemDesc" value="<?php echo $trade_info_arr['ItemDesc'] ?>"><br>
        <input type="hidden" name="ReturnURL" value="https://www.applemint.tech/dev/thankyou.php">
        <input type="hidden" name="NotifyURL" value="">
        <input type="hidden" name="LoginType" value=0>
        <input type="hidden" name="Email" value="<?php echo $trade_info_arr['Email'] ?>">
<!--         <input type="submit" value="Lucky ball, go!"> -->
</form>
<script type="text/javascript">encrypt.submit();</script>
<!-- <?php echo $TradeInfo."<br>" ?>  -->
<!-- 測試是否能正確加密資料時使用 -->

<!-- 為了測試而做的解碼器
<?php 
function create_aes_decrypt($parameter="",$key="KYuCP67M4PORLKEnBOABZxj13clUOMEE",$iv="mBunmuODdthH2u8C"){
    return strippadding(mcrypt_decrypt(MCRYPT_RIJNDAEL_128,$key,hex2bin($parameter),MCRYPT_MODE_CBC,$iv));
}
function strippadding($string){
    $slast=ord(substr($string,-1));
    $slastc = chr($slast);
    $pcheck = substr($string,-$slast);
    if (preg_match("/$slastc{".$slast."}/",$string)) {
        $string = substr($string,0,strlen($string)-$slast);
        return $string;
    }
    else {
        return false;
    }
}
echo create_aes_decrypt($TradeInfo) ?> -->

