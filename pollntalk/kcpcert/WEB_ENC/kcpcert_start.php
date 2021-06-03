<?
/* ============================================================================== */
/* =   PAGE : 인증 요청 PAGE                                                    = */
/* = -------------------------------------------------------------------------- = */
/* =   Copyright (c)  2012.02   KCP Inc.   All Rights Reserved.                 = */
/* ============================================================================== */

/* ============================================================================== */
/* =   환경 설정 파일 Include                                                   = */
/* = -------------------------------------------------------------------------- = */
include "../cfg/cert_conf.php";       // 환경설정 파일 include

/* = -------------------------------------------------------------------------- = */
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>*** KCP Online Certification System [PHP Version] ***</title>
        <link href="../css/sample.css" rel="stylesheet" type="text/css">
        <script type="text/javascript">

            // 인증창 종료후 인증데이터 리턴 함수
            function auth_data(frm)
            {
                var auth_form     = document.form_auth;
                var nField        = frm.elements.length;
                var response_data = "";

                // up_hash 검증 
                if( frm.up_hash.value != auth_form.veri_up_hash.value )
                {
                    alert("up_hash 변조 위험있음");
                    
                }           
               
                
               /* 리턴 값 모두 찍어보기 (테스트 시에만 사용) */
                var form_value = "";

                /* for ( i = 0 ; i < frm.length ; i++ )
                {
                    form_value += "{"+frm.elements[i].name + "} = [" + frm.elements[i].value + "]\n";
                } */

                form_value += "{"+frm.phone_no.name + "} = [" + frm.phone_no.value + "]\n";
                form_value += "{"+frm.user_name.name + "} = [" + frm.user_name.value + "]\n";
                form_value += "{"+frm.birth_day.name + "} = [" + frm.birth_day.value + "]\n";
                form_value += "{"+frm.sex_code.name + "} = [" + frm.sex_code.value + "]\n";

				if(frm.phone_no.value != ""){
					
					var form = document.createElement('form');
					form.setAttribute("method", "post");
					form.setAttribute("action", "/controller.php?mode=cert_ctrl");

					document.charset = "utf-8";

					var hiddenField1 = document.createElement('input');
					hiddenField1.setAttribute('type', 'hidden');
					hiddenField1.setAttribute('name', "user_name");
					hiddenField1.setAttribute('value', frm.user_name.value);
					form.appendChild(hiddenField1);

					var hiddenField2 = document.createElement('input');
					hiddenField2.setAttribute('type', 'hidden');
					hiddenField2.setAttribute('name', "birth_day");
					hiddenField2.setAttribute('value', frm.birth_day.value);
					form.appendChild(hiddenField2);

					var hiddenField3 = document.createElement('input');
					hiddenField3.setAttribute('type', 'hidden');
					hiddenField3.setAttribute('name', "phone_no");
					hiddenField3.setAttribute('value', frm.phone_no.value);
					form.appendChild(hiddenField3);

					var hiddenField4 = document.createElement('input');
					hiddenField4.setAttribute('type', 'hidden');
					hiddenField4.setAttribute('name', "sex_code");
					hiddenField4.setAttribute('value', frm.sex_code.value);
					form.appendChild(hiddenField4);

					document.body.appendChild(form);
					form.submit();
				}else{
					alert("인증에 실패하였습니다.");
					window.close();
				}
            }
            
            // 인증창 호출 함수
            function auth_type_check()
            {
                var auth_form = document.form_auth;
    
                if( auth_form.ordr_idxx.value == "" )
                {
                    alert( "요청번호는 필수 입니다." );
    
                    return false;
                }
                else
                {
                    if( ( navigator.userAgent.indexOf("Android") > - 1 || navigator.userAgent.indexOf("iPhone") > - 1 ) == false ) // 스마트폰이 아닌경우
                    {
	                    var return_gubun;
	                    var width  = 410;
	                    var height = 500;
	
	                    var leftpos = screen.width  / 2 - ( width  / 2 );
	                    var toppos  = screen.height / 2 - ( height / 2 );
	
	                    var winopts  = "width=" + width   + ", height=" + height + ", toolbar=no,status=no,statusbar=no,menubar=no,scrollbars=no,resizable=no";
	                    var position = ",left=" + leftpos + ", top="    + toppos;
	                    var AUTH_POP = window.open('','auth_popup', winopts + position);
                    }
                    
                    auth_form.method = "post";
                    auth_form.target = "auth_popup"; // !!주의 고정값 ( 리턴받을때 사용되는 타겟명입니다.)
                    auth_form.action = "./kcpcert_proc_req.php"; // 인증창 호출 및 결과값 리턴 페이지 주소
                    
                    return true;
                }
            }
    
            /* 예제 */
            window.onload=function()
            {
            	init_orderid();
            }

            // 요청번호 생성 예제 ( up_hash 생성시 필요 ) 
            function init_orderid()
            {
                var today = new Date();
                var year  = today.getFullYear();
                var month = today.getMonth()+ 1;
                var date  = today.getDate();
                var time  = today.getTime();

                if(parseInt(month) < 10)
                {
                    month = "0" + month;
                }

                var vOrderID = year + "" + month + "" + date + "" + time;

                document.form_auth.ordr_idxx.value = vOrderID;
            }

        </script>
    </head>
    <body oncontextmenu="return false;" ondragstart="return false;" onselectstart="return false;">
        <div align="center">
            <form name="form_auth">
                <table width="589" cellpadding="0" cellspacing="0">
                    <tr style="height:14px"><td style="background-image:url('../img/boxtop589.gif');"></td></tr>
                    <tr>
                        <td style="background-image:url('../img/boxbg589.gif')">
        
                            <!-- 상단 테이블 Start -->
                            <table width="551px" align="center" cellspacing="0" cellpadding="16">
                                <tr style="height:17px">
                                    <td style="background-image:url('../img/ttbg551.gif');border:0px " class="white">
                                        <span class="bold big">[인증요청]</span> 이 페이지는 휴대폰 인증요청 페이지입니다.
                                    </td>
                                </tr>
                                <tr style="height:11px"><td style="background:url('../img/boxbtm551.gif') no-repeat;"></td></tr>
                            </table>
                            <!-- 상단 테이블 End -->
        
                            <!-- 인증요청 정보 출력 테이블 Start -->                           
                            <!-- 인증요청 정보 출력 테이블 End -->
        
                            <!-- 인증요청 버튼 테이블 Start -->
                            <table width="527" align="center" cellspacing="0" cellpadding="0" class="margin_top_20">
                                <!-- 인증요청 이미지 버튼 -->
                                <tr id="show_pay_btn">
                                    <td colspan="2" align="center">
                                        <input type="image" src="../img/btn_certi.gif" onclick="return auth_type_check();" width="108" height="37" alt="인증을 요청합니다" />
                                    </td>
                                </tr>
                            </table>
                            <!-- 인증요청 버튼 테이블 End -->
                        </td>
                    </tr>
                    <tr><td><img src="../img/boxbtm589.gif" alt="Copyright(c) KCP Inc. All rights reserved."/></td></tr>
                </table>
 
 
 				<!-- 생년월일 -->
        		<input type="hidden" name="phone_no"  value=""/>
        		<!-- 생년월일 -->
        		<input type="hidden" name="birth_day"  value=""/>
        		<!-- 성별코드 -->
        		<input type="hidden" name="sex_code" value="" />
        		<!-- 유저네임 -->
				<input type="hidden" name="user_name"    value="" />
                <!-- 주문번호 -->
				<input type="hidden" name="ordr_idxx"    value="" />
                <!-- 요청종류 -->
                <input type="hidden" name="req_tx"       value="cert"/>
                <!-- 요청구분 -->
                <input type="hidden" name="cert_method"  value="01"/>
                <!-- 웹사이트아이디 : ../cfg/cert_conf.php 파일에서 설정해주세요 -->
                <input type="hidden" name="web_siteid"   value="<?= $g_conf_web_siteid ?>"/> 
                <!-- 노출 통신사 default 처리시 아래의 주석을 해제하고 사용하십시요 
                     SKT : SKT , KT : KTF , LGU+ : LGT
                <input type="hidden" name="fix_commid"      value="KTF"/>
                -->
                <!-- 사이트코드 : ../cfg/cert_conf.php 파일에서 설정해주세요 -->
                <input type="hidden" name="site_cd"      value="<?= $g_conf_site_cd ?>" />               
                <!-- Ret_URL : ../cfg/cert_conf.php 파일에서 설정해주세요 -->
                <input type="hidden" name="Ret_URL"      value="<?= $g_conf_Ret_URL ?>" />
                <!-- cert_otp_use 필수 ( 메뉴얼 참고)
                     Y : 실명 확인 + OTP 점유 확인 , N : 실명 확인 only
                -->
                <input type="hidden" name="cert_otp_use" value="Y"/>
                <!-- 리턴 암호화 고도화 -->
                <input type="hidden" name="cert_enc_use_ext" value="Y"/>                

                <input type="hidden" name="res_cd"       value=""/>
                <input type="hidden" name="res_msg"      value=""/>

                <!-- up_hash 검증 을 위한 필드 -->
                <input type="hidden" name="veri_up_hash" value=""/>

                <!-- 본인확인 input 비활성화 -->
                <input type="hidden" name="cert_able_yn" value=""/>

                <!-- web_siteid 을 위한 필드 -->
                <input type="hidden" name="web_siteid_hashYN" value="N"/>

                <!-- 가맹점 사용 필드 (인증완료시 리턴)-->
                <input type="hidden" name="param_opt_1"  value="opt1"/> 
                <input type="hidden" name="param_opt_2"  value="opt2"/> 
                <input type="hidden" name="param_opt_3"  value="opt3"/>
            </form>
        </div>
    </body>
</html>