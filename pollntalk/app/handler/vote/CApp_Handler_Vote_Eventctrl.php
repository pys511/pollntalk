<?php

class CApp_Handler_Vote_Eventctrl extends CCore_Lib_Routines_Handler
{
    public function __construct()
    {
    }
    
    public function getVoteEventInfo($vote_seq)
    {
        $query  = "SELECT 
                        VOTE_EVENT_CONTEXT_SEQ,
                        VOTE_SEQ,
                        VOTE_EVENT_SUBJECT,
                        VOTE_EVENT_TEXT,
                        VOTE_PRESENT_PATH,
                        VOTE_BANNER_PATH,
                        VOTE_EVENT_URL,
                        VOTE_EVENT_CONTEXT_REGI_DATE
                    FROM 
                        VOTE_EVENT_CONTEXT
                    WHERE
                        VOTE_SEQ = :VOTE_SEQ";   
        
        $this->query($query);
        $this->bind("VOTE_SEQ", $vote_seq);
        
        $result = $this->execute(CCore_Lib_Routines_Handler::SELECT);
        
        return $result[0];
    }
    
    public function registerVoteEventContext($array)
    {
        $vote_seq               = $array['vote_seq'];
        $voteEventContextSeq    = $array['vote_event_context_seq'];
        $voteEventSubject       = $array['vote_event_subject'];
        $voteEventContext       = $array['vote_event_context'];
        $voteEventContext       = str_replace("\r", "", $voteEventContext);
        $voteEventContext       = str_replace("\n", "<br/>", $voteEventContext);
        $eventRealPath          = $array['event_real_path'];
        $adRealPath             = $array['ad_real_path'];
        $eventMovieUrl          = $array['event_movie_url'];
        
        $query  = "";
        if ($voteEventContextSeq == "")
        {
            $query  = "INSERT INTO VOTE_EVENT_CONTEXT
                        (
                          VOTE_SEQ,
                          VOTE_EVENT_SUBJECT,
                          VOTE_EVENT_TEXT,
                          VOTE_PRESENT_PATH,
                          VOTE_BANNER_PATH,
                          VOTE_EVENT_URL
                        )
                        VALUES
                        (
                          :VOTE_SEQ,
                          :VOTE_EVENT_SUBJECT,
                          :VOTE_EVENT_TEXT,
                          :VOTE_PRESENT_PATH,
                          :VOTE_BANNER_PATH,
                          :VOTE_EVENT_URL
                        )";
        }
        else
        {
            $query = "UPDATE VOTE_EVENT_CONTEXT
                        SET
                          VOTE_SEQ = :VOTE_SEQ,
                          VOTE_EVENT_SUBJECT = :VOTE_EVENT_SUBJECT,
                          VOTE_EVENT_TEXT = :VOTE_EVENT_TEXT,
                          VOTE_PRESENT_PATH = :VOTE_PRESENT_PATH,
                          VOTE_BANNER_PATH = :VOTE_BANNER_PATH,
                          VOTE_EVENT_URL = :VOTE_EVENT_URL
                        WHERE VOTE_EVENT_CONTEXT_SEQ = :VOTE_EVENT_CONTEXT_SEQ";
        }
        
        $this->query($query);
        if ($voteEventContextSeq != "")
            $this->bind("VOTE_EVENT_CONTEXT_SEQ", $voteEventContextSeq);
        $this->bind("VOTE_SEQ", $vote_seq);
        $this->bind("VOTE_EVENT_SUBJECT", $voteEventSubject);
        $this->bind("VOTE_EVENT_TEXT", $voteEventContext);
        $this->bind("VOTE_PRESENT_PATH", $eventRealPath);
        $this->bind("VOTE_BANNER_PATH", $adRealPath);
        $this->bind("VOTE_EVENT_URL", $eventMovieUrl);
        
        $result = $this->execute(CCore_Lib_Routines_Handler::INSERT);
        if (! $result)
            return false;
        
        return true;
    }
}