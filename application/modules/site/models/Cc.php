<?php
class Cc extends CI_Model
{
   public function getCCavenuesValues($Redirect_Url,$cancel_url,$Amount,$orderid,$custname,$custaddress,$custcountry,$custstate,$custcity,$custzip,$custphone,$custemail)
   {
      $ccavenues['merchant_id'] ='108321';
      $ccavenues['order_id'] =  $orderid;
      $ccavenues['tid'] =  time() ;
      $ccavenues['currency'] =  'INR';
      $ccavenues['language'] =  'EN' ;  
      $ccavenues['amount'] =$Amount;
    
    $ccavenues['redirect_url'] =$Redirect_Url;
    $ccavenues['cancel_url'] =$cancel_url;

    $ccavenues['billing_name'] =$custname;
    $ccavenues['billing_address'] =$custaddress;
    $ccavenues['billing_city'] = $custcity;
    $ccavenues['billing_state'] =$custstate;
    $ccavenues['billing_zip'] = $custzip;
    $ccavenues['billing_country'] =$custcountry;
    $ccavenues['billing_tel'] =$custphone;
    $ccavenues['billing_email'] =$custemail;
    

    $ccavenues['delivery_name'] =$custname;
    $ccavenues['delivery_address'] =$custaddress;
    $ccavenues['delivery_city'] =$custcity;
    $ccavenues['delivery_state'] =$custstate;
    $ccavenues['delivery_zip'] =$custzip;
    $ccavenues['delivery_country'] =$custcountry;
    $ccavenues['delivery_tel'] =$custphone; 
    $merchant_data = '' ;

    foreach ($ccavenues as $key => $value){
      $merchant_data.=$key.'='.urlencode($value).'&';
    }

   // echo $merchant_data ;
    
    $workingKey = 'D3CCB3359FD42CF4281421A641AA60FD';
    $accessCode = 'AVCB95HJ99BH60BCHB';
    
    $encrypted_data=$this->encrypt($merchant_data,$workingKey);
    
        $data['encRequest'] = $encrypted_data ;
        $data['access_code'] =  $accessCode ;

        return $data ; 
        
   } 




 private function encrypt($plainText,$key)
  {
    $secretKey = $this->hextobin(md5($key));
    $initVector = pack("C*", 0x00, 0x01, 0x02, 0x03, 0x04, 0x05, 0x06, 0x07, 0x08, 0x09, 0x0a, 0x0b, 0x0c, 0x0d, 0x0e, 0x0f);
      $openMode = mcrypt_module_open(MCRYPT_RIJNDAEL_128, '','cbc', '');
      $blockSize = mcrypt_get_block_size(MCRYPT_RIJNDAEL_128, 'cbc');
    $plainPad = $this->pkcs5_pad($plainText, $blockSize);
      if (mcrypt_generic_init($openMode, $secretKey, $initVector) != -1) 
    {
          $encryptedText = mcrypt_generic($openMode, $plainPad);
                mcrypt_generic_deinit($openMode);
                
    } 
    return bin2hex($encryptedText);
  }

  public function decrypt($encryptedText,$key)
  {
    $secretKey = $this->hextobin(md5($key));
    $initVector = pack("C*", 0x00, 0x01, 0x02, 0x03, 0x04, 0x05, 0x06, 0x07, 0x08, 0x09, 0x0a, 0x0b, 0x0c, 0x0d, 0x0e, 0x0f);
    $encryptedText=$this->hextobin($encryptedText);
      $openMode = mcrypt_module_open(MCRYPT_RIJNDAEL_128, '','cbc', '');
    mcrypt_generic_init($openMode, $secretKey, $initVector);
    $decryptedText = mdecrypt_generic($openMode, $encryptedText);
    $decryptedText = rtrim($decryptedText, "\0");
    mcrypt_generic_deinit($openMode);
    return $decryptedText;
    
  }
  //*********** Padding Function *********************

   private function pkcs5_pad ($plainText, $blockSize)
  {
      $pad = $blockSize - (strlen($plainText) % $blockSize);
      return $plainText . str_repeat(chr($pad), $pad);
  }

  //********** Hexadecimal to Binary function for php 4.0 version ********

  private function hextobin($hexString) 
     { 
          $length = strlen($hexString); 
          $binString="";   
          $count=0; 
          while($count<$length) 
          {       
              $subString =substr($hexString,$count,2);           
              $packedString = pack("H*",$subString); 
              if ($count==0)
        {
        $binString=$packedString;
        } 
              
        else 
        {
        $binString.=$packedString;
        } 
              
        $count+=2; 
          } 
            return $binString; 
        } 



}