<?php

class CCore_Lib_Util_Crypto
{
    private static 	$m_instance		= null;
    
    public function __construct()
    {
        
    }
    
    public static function instance()
    {
        if (self::$m_instance == null)
            self::$m_instance	= new CCore_Lib_Util_Crypto();
            
            return self::$m_instance;
    }
    
    public function encrypt($plainText, $pubKey, $privKey)
    {
        $publicKey		= hash('sha512', $pubKey);
        $privateKey		= substr(hash('sha512', $privKey), 0, 8);
        
        $cipher			= openssl_encrypt($plainText, "AES-128-CFB", $publicKey, 0, $privateKey);
        
        return base64_encode($cipher);
    }
    
    public function decrypt($cipherText, $pubKey, $privKey)
    {
        $publicKey		= hash('sha256', $pubKey);
        $privateKey		= substr(hash('sha256', $privKey), 0, 16);
        
        $plainText		= base64_decode($cipherText);
        $result			= openssl_decrypt($plainText, "AES-128-CFB", $publicKey, 0, $privateKey);
        
        return $result;
    }
}

