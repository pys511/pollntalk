<?php
/**
 *  @auth   : JY JEON
 *  @date   : 202001008
 *  상품 관리
 */
class CApp_Handler_Product_Ctrl extends CCore_Lib_Routines_Handler
{
    public function __construct()
    {
    }
    
    /*
     * 상품 등록
     */
    public function registerProductInfo($array)
    {
        $serviceSeq     = $array['service_seq'];
        $serviceType    = $array['product_type'];
        $serviceName    = $array['product_name'];
        $serviceContext = $array['product_context'];
        $paymentType    = $array['payment_type'];
        $productPrice   = str_replace(",", "", $array['product_price']);
        
        $isOpen         = $array['product_is_open'];
        
        if ($serviceSeq == "")
        {
            $query = "INSERT INTO PRODUCT
                        (
                          SERVICE_TYPE,
                          SERVICE_NAME,
                          SERVICE_CONTEXT,
                          SERVICE_PAYMENT_TYPE,
                          SERVICE_PRICE,
                          SERVICE_IS_OPEN
                        )
                        VALUES
                        (
                          :SERVICE_TYPE,
                          :SERVICE_NAME,
                          :SERVICE_CONTEXT,
                          :SERVICE_PAYMENT_TYPE,
                          :SERVICE_PRICE,
                          :SERVICE_IS_OPEN
                        )";
        }
        else
        {
            $query = "UPDATE PRODUCT
                        SET
                          SERVICE_TYPE = :SERVICE_TYPE,
                          SERVICE_NAME = :SERVICE_NAME,
                          SERVICE_CONTEXT = :SERVICE_CONTEXT,
                          SERVICE_PAYMENT_TYPE = :SERVICE_PAYMENT_TYPE,
                          SERVICE_PRICE = :SERVICE_PRICE,
                          SERVICE_IS_OPEN = :SERVICE_IS_OPEN
                        WHERE SERVICE_SEQ = SERVICE_SEQ = :SERVICE_SEQ";
        }
        
        $this->query($query);
        if ($serviceSeq != "")
            $this->bind("SERVICE_SEQ", $serviceSeq);
            
        $this->bind("SERVICE_TYPE", $serviceType);
        $this->bind("SERVICE_NAME", $serviceName);
        $this->bind("SERVICE_CONTEXT", $serviceContext);
        $this->bind("SERVICE_PAYMENT_TYPE", $paymentType);
        $this->bind("SERVICE_PRICE", $productPrice);
        $this->bind("SERVICE_IS_OPEN", $isOpen);
        $result = $this->execute(CCore_Lib_Routines_Handler::UPDATE);
        
        if (! $result)
            return false;
                
        return true;
    }
    
    /*
     * 상품 목록
     */
    public function getProductList($service_type)
    {
        $query = "SELECT
                    SERVICE_SEQ,
                    SERVICE_TYPE,
                    SERVICE_NAME,
                    SERVICE_CONTEXT,
                    SERVICE_PAYMENT_TYPE,
                    SERVICE_PRICE,
                    SERVICE_IS_OPEN
                FROM PRODUCT
                WHERE SERVICE_TYPE = :SERVICE_TYPE
                ORDER BY SERVICE_SEQ ASC";
        
        $this->query($query);
        $this->bind("SERVICE_TYPE", $service_type);
        $result = $this->execute(CCore_Lib_Routines_Handler::SELECT);
        
        return $result;
    }
    
    /*
     * 상품 정보
     */
    public function getProductInfo($serviceSeq)
    {
        $query = "SELECT 
                    SERVICE_SEQ,
                    SERVICE_TYPE,
                    SERVICE_NAME,
                    SERVICE_CONTEXT,
                    SERVICE_PAYMENT_TYPE,
                    SERVICE_PRICE,
                    SERVICE_IS_OPEN
                FROM PRODUCT
                WHERE SERVICE_SEQ = :SERVICE_SEQ";
        
        $this->query($query);
        $this->bind("SERVICE_SEQ", $serviceSeq);
        $result = $this->execute(CCore_Lib_Routines_Handler::SELECT);
        
        return $result[0];
    }
    
    /*
     *  상품 결제(프리미엄)
     */
    public function payProduct($array)
    {
        $vote_seq           = $array['vote_seq'];
        $productSeq         = $array['productSeq'];
        $voteEndDate        = $array['vote_end_date'];
        $voteServiceSeq     = $array['vote_service_seq'];
        $voteServiceType    = $array['service_type'];
        $voteServicePrice   = str_replace(",", "", $array['vote_service_price']);
        $votePaymentType    = $array['vote_payment_type'];
        $accountSeq         = $array['bank_account_seq'];
        $voteServiceAccount = $array['vote_service_account'];
        $serviceAccountType = $array['service_account_type'];
        $voteServicePayer   = $array['vote_service_payer'];
        
        $query      = "INSERT INTO VOTE_PAYMENT_LOG
                        (
                          SERVICE_MEMBER_SEQ,
                          VOTE_SEQ,
                          SERVICE_TYPE,
                          PRODUCT_SEQ,
                          SERVICE_END_DATE,
                          SERVICE_PRICE,
                          SERVICE_PAYMENT_TYPE,
                          SERVICE_ACCOUNT_SEQ,
                          SERVICE_ACCOUNT_TYPE,
                          SERVICE_ACCOUNT,
                          SERVICE_PAYER
                        )
                        SELECT 
                            A.VOTE_WRITER_SEQ, A.VOTE_SEQ, :SERVICE_TYPE, :PRODUCT_SEQ, A.VOTE_END_DATE, :SERVICE_PRICE, :SERVICE_PAYMENT_TYPE, :SERVICE_ACCOUNT_SEQ, :SERVICE_ACCOUNT_TYPE, :SERVICE_ACCOUNT, :SERVICE_PAYER
                        FROM 
                            VOTE A 
                        WHERE 
                            A.VOTE_SEQ = :VOTE_SEQ";
        
        $this->query($query);
        $this->bind("VOTE_SEQ", $vote_seq);
        $this->bind("SERVICE_PRICE", $voteServicePrice);
        $this->bind("PRODUCT_SEQ", $voteServiceSeq);
        $this->bind("SERVICE_TYPE", $voteServiceType);
        $this->bind("SERVICE_PAYMENT_TYPE", $votePaymentType);
        $this->bind("SERVICE_ACCOUNT_SEQ", $accountSeq);
        $this->bind("SERVICE_ACCOUNT", $voteServiceAccount);
        $this->bind("SERVICE_ACCOUNT_TYPE", $serviceAccountType);
        $this->bind("SERVICE_PAYER", $voteServicePayer);
        
        $result = $this->execute(CCore_Lib_Routines_Handler::INSERT);
        if (! $result)
            return false;
        
        $vote   = new CApp_Handler_Vote_Ctrl();
        $result = $vote->updateIsPremium($vote_seq);
        if (! $result)
            return false;
            
        return true;
    }
    
    /*
     *  결제 정보 조회
     */
    public function getProductPaymentInfo($vote_seq)
    {
        $query  = "SELECT 
                    	SERVICE_PAYMENT_SEQ,
                        SERVICE_MEMBER_SEQ,
                        VOTE_SEQ,
                        A.SERVICE_TYPE,
                        A.PRODUCT_SEQ,
                        C.SERVICE_NAME,
                        SERVICE_END_DATE,
                        SERVICE_ACCOUNT_SEQ,
                        A.SERVICE_PRICE,
                        A.SERVICE_PAYMENT_TYPE,
                        CASE WHEN A.SERVICE_PAYMENT_TYPE = 1 THEN '무통장입금'
                             ELSE '기타'
                        END AS ACCOUNT_TYPE_NAME,
                        SERVICE_ACCOUNT,
                        B.ACCOUNT_NAME,
                        SERVICE_PAYER,
                        SERVICE_REGI_DATE
                    FROM 
                    	 VOTE_PAYMENT_LOG AS A 
                         INNER JOIN
                         BANK_ACCOUNT AS B
                         ON A.SERVICE_ACCOUNT_SEQ = B.ACCOUNT_SEQ
                         INNER JOIN
                         PRODUCT AS C
                         ON A.PRODUCT_SEQ = C.SERVICE_SEQ
                    WHERE
                        VOTE_SEQ = :VOTE_SEQ";
        
        $this->query($query);
        $this->bind("VOTE_SEQ", $vote_seq);
        
        $result     = $this->execute(CCore_Lib_Routines_Handler::SELECT);
        if (! $result)
            return false;
            
        return $result[0];
    }
    
    /*
     * 입금 계좌 등록
     */
    public function registerBankAccount($array)
    {
        $accountSeq     = $array['account_seq'];
        $accountName    = $array['bank_account_name'];
        $accountNumber  = $array['bank_account_number'];
        
        if ($accountSeq == "")
        {
            $query = "INSERT INTO BANK_ACCOUNT
                        (
                          ACCOUNT_NAME,
                          ACCOUNT_NUMBER
                        )
                        VALUES
                        (
                          :ACCOUNT_NAME,
                          :ACCOUNT_NUMBER
                        )";
        }
        else
        {
            $query = "UPDATE 
                        BANK_ACCOUNT
                        SET
                          ACCOUNT_NAME = :ACCOUNT_NAME,
                          ACCOUNT_NUMBER = :ACCOUNT_NUMBER
                        WHERE ACCOUNT_SEQ = :ACCOUNT_SEQ";
        }
        
        $this->query($query);
        if ($accountSeq != "")
            $this->bind("ACCOUNT_SEQ", $accountSeq);
        
        $this->bind("ACCOUNT_NAME", $accountName);
        $this->bind("ACCOUNT_NUMBER", $accountNumber);
        $result = $this->execute(CCore_Lib_Routines_Handler::UPDATE);
        
        if (! $result)
            return false;
            
        return true;
    }
    
    /*
     * 입금 계좌 정보 조회
     */
    public function getBankAccount($account_seq)
    {
        $query      = "SELECT ACCOUNT_SEQ, ACCOUNT_NAME, ACCOUNT_NUMBER
                        FROM BANK_ACCOUNT
                        WHERE ACCOUNT_SEQ = :ACCOUNT_SEQ"; 
        
        $this->query($query);
        $this->bind("ACCOUNT_SEQ", $account_seq);
        
        $result     = $this->execute(CCore_Lib_Routines_Handler::SELECT);
        if (! $result)
            return false;
        
        return $result[0];
    }
    
    /*
     * 입금 계좌 목록 조회
     */
    public function getBankAccountList()
    {
        $query      = "SELECT ACCOUNT_SEQ, ACCOUNT_NAME, ACCOUNT_NUMBER
                        FROM BANK_ACCOUNT
                        ORDER BY ACCOUNT_SEQ ASC";
        
        $this->query($query);
        
        $result     = $this->execute(CCore_Lib_Routines_Handler::SELECT);
        if (! $result)
            return false;
            
        return $result;
    }
}