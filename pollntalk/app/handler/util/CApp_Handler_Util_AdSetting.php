<?php
/**
 *  @auth   : PARK Y.S.
 *  @date   : 20210421
 *  메인화면 처리
 */
class CApp_Handler_Util_AdSetting extends CCore_Lib_Routines_Handler
{
    
    public function __construct()
    {
    }
    
    /*
     * 광고 저장
     */
    public function setAdver($array)
    {
        
        $ad_index       = $array["ad_index"];
        $ad_subject     = $array['ad_subject'];
        $ad_position    = $array['ad_position'];
        $ad_type        = $array['ad_type'];
        $ad_use         = $array['ad_use'];
        $ad_realimg     = $array['pc_real_name'];
        $ad_tempimg     = $array['pc_temp_path'];
        $ad_mrealimg    = $array['mobile_real_name'];
        $ad_mtempimg    = $array['mobile_temp_path'];
        $ad_url         = $array['ad_url'];
        $ad_script      = $array['ad_script'];
        
        trigger_error ( print_r($array, true), E_USER_ERROR );
        if ($ad_index == "")
        {
            $query  = "INSERT INTO ptp_ad
                        (
                          ad_subject,
                          ad_position,
                          ad_type,
                          ad_use,
                          ad_realimg,
                          ad_tempimg,
                          ad_mrealimg,
                          ad_mtempimg,
                          ad_url,
                          ad_script
                        )
                        VALUES
                        (
                          :AD_SUBJECT,
                          :AD_POSITION,
                          :AD_TYPE,
                          :AD_USE,
                          :AD_REALIMG,
                          :AD_TEMPIMG,
                          :AD_MREALIMG,
                          :AD_MTEMPIMG,
                          :AD_URL,
                          :AD_SCRIPT
                        )";
        }
        else
        {
            $query  = "UPDATE ptp_ad
                        SET
                          ad_subject = :AD_SUBJECT,
                          ad_position = :AD_POSITION,
                          ad_type = :AD_TYPE,
                          ad_use = :AD_USE,
                          ad_realimg = :AD_REALIMG,
                          ad_tempimg = :AD_TEMPIMG,
                          ad_mrealimg = :AD_MREALIMG,
                          ad_mtempimg = :AD_MTEMPIMG,
                          ad_url = :AD_URL,
                          ad_script = :AD_SCRIPT
                        WHERE
                          ad_index = :AD_INDEX";
        }
        
        $this->query($query);
        if ($ad_index != "")
            $this->bind("AD_INDEX", $ad_index);
            
        $this->bind("AD_SUBJECT", $ad_subject);
        $this->bind("AD_POSITION", $ad_position);
        $this->bind("AD_TYPE", $ad_type);
        $this->bind("AD_USE", $ad_use);
        $this->bind("AD_REALIMG", $ad_realimg);
        $this->bind("AD_TEMPIMG", $ad_tempimg);
        $this->bind("AD_MREALIMG", $ad_mrealimg);
        $this->bind("AD_MTEMPIMG", $ad_mtempimg);
        $this->bind("AD_URL", $ad_url);
        $this->bind("AD_SCRIPT", $ad_script);
        
        if ($ad_index == "")
        {
            $result = $this->execute(CCore_Lib_Routines_Handler::INSERT);
        }
        else
        {
            $result = $this->execute(CCore_Lib_Routines_Handler::UPDATE);
        }
        
        trigger_error ( print_r($query, true), E_USER_ERROR );
        
        if (! $result)
            return false;
            
        return true;
    }
    
    /*
     * 광고 삭제
     */
    public function deleteAdver($array)
    {
        $query  = "DELETE FROM ptp_ad A WHERE ad_index = :AD_INDEX";    
        
        $this->query($query);
        $this->bind("AD_INDEX", $array["ad_index"]);
        $result = $this->execute(CCore_Lib_Routines_Handler::DELETE);
        
        return $result;
    }
    
    /*
     * index로 광고가져오기
     */
    public function getAd($num)
    {
        $query  = "SELECT
                          ad_index,
                          ad_subject,
                          ad_position,
                          ad_type,
                          ad_use,
                          ad_realimg,
                          ad_tempimg,
                          ad_mrealimg,
                          ad_mtempimg,
                          ad_url,
                          ad_script
                    FROM
                        ptp_ad A
                    WHERE
                        ad_index = :AD_INDEX";
        $this->query($query);
        $this->bind("AD_INDEX", $num);
        $result = $this->execute(CCore_Lib_Routines_Handler::SELECT);
        
        return $result[0];
    }
    
    /*
     * index로 광고가져오기
     */
    public function getAdverByPosition($pos)
    {
        $query  = "SELECT
                          ad_index,
                          ad_subject,
                          ad_position,
                          ad_type,
                          ad_use,
                          ad_realimg,
                          ad_tempimg,
                          CASE WHEN ad_mrealimg IS NULL THEN ad_realimg
                               ELSE ad_mrealimg
                          END AS ad_realimg,
                          CASE WHEN ad_mtempimg IS NULL THEN ad_tempimg
                               ELSE ad_mtempimg
                          END AS ad_mtempimg,
                          ad_url,
                          ad_script
                    FROM
                        ptp_ad A
                    WHERE
                        ad_position = :AD_POSITION
                    ORDER BY ad_index DESC
                    LIMIT 1";
        $this->query($query);
        $this->bind("AD_POSITION", $pos);
        $result = $this->execute(CCore_Lib_Routines_Handler::SELECT);
        
        return $result[0];
    }
    
    /*
     * 광고 리스트 가져오기
     */
    public function getAdList($paging)
    {
        $query  = "SELECT * FROM ptp_ad order by ad_index limit :start, :length";
        
        $this->query($query);
        $start = (((integer) $paging["current"]) - 1) * 10; // 현재 페이지의 시작 항목
        $this->bind("start", $start);
        $this->bind("length", 10);
        $result = $this->execute(CCore_Lib_Routines_Handler::SELECT);
        
        return $result;
    }
    
    /*
     * 광고 카운트 가져오기
     */
    public function getAdCount()
    {
        $query = "";
        $query = "SELECT count(*) FROM ptp_ad";
        
        $this->query($query);
        $result = $this->execute(CCore_Lib_Routines_Handler::SELECT);
        $count = $result[0]["count(*)"];
        
        return $count;
    }
}
?>
