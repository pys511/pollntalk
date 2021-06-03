<?php
/**
 *  @auth   : Park Yoon Sik
 *  @date   : 20200809
 *  로그인 화면
 */
?>
<div class="messagecontent">
	<!-- 회원 정보 시작 -->
	<div class="messagestatus">
		<div class="messagestatustitle title">
			<span>회원 정보</span>
		</div>
	</div>
	<!-- 회원 정보 상세 시작 -->
	<div class="memberstatus">
		<!-- 회원 정보  영역 시작 -->
		<div class="table">
			<div class="tablebox">
				<div class="tableborder">
					<div class="tablefield">
						<div class="membertableitem">
							<span>구분</span>
						</div>
						<div class="membertableitemlong wrline wlline">
							<div class="memberinfoitem wrline">
								<span>항목</span>
							</div>
							<div class="memberinfoitem wrline">
								<span>내용</span>
							</div>
							<div class="memberinfoitem">
								<span>정보수정</span>
							</div>
						</div>
						<div class="membertableitem">
							<span>비고</span>
						</div>
					</div>
					<div class="tablelist">
						<!-- 회원 정보 내용 시작 -->
						<ul>
							<li>
								<div class="membertableitem mline">
									<span>가입 필수 항목</span>
								</div>
								
								<div class="membertableitemlong wlline wrline">
									
									<div class="memberinfolong">
										<div class="memberinfolayer wbline">
											<div class="memberinfoitem mlline mrline wrline">
												<span>이메일</span>
											</div>
											<div class="memberinfoitem mrline wrline">
												<span><?php echo($member[0]["email"]); ?></span>
											</div>
										</div>
										<div class="memberinfolayer wbline">
											<div class="memberinfoitem mlline mrline wrline">
												<span>닉네임</span>
											</div>
											<div class="memberinfoitem mrline wrline">
												<span><?php echo($member[0]["nname"]); ?></span>
											</div>
										</div>
									</div>
									<div class="memberinfo">
										<div class="memberinfolayer">
											<div class="memberinfoitem">
												<span></span>
											</div>
											<div class="memberinfoitem">
												<span></span>
											</div>
										</div>
									</div>
									<div class="memberinfolong">
										<div class="memberinfolayer wbline">
											<div class="memberinfoitem mlline mrline wrline">
												<span>비밀번호</span>
											</div>
											<div class="memberinfoitem mrline wrline">
												<span>***********</span>
											</div>
										</div>
										<div class="memberinfolayer">
											<div class="memberinfoitem mlline mrline wrline">
												<span>거주지역</span>
											</div>
											<div class="memberinfoitem mrline wrline">
												<span>
												<?php
												switch ($member[0]["abode"]) {
                                                        case "01":
                                                            echo ("서울특별시");
                                                            break;
                                                        case "02":
                                                            echo ("부산광역시");
                                                            break;
                                                        case "03":
                                                            echo ("대구광역시");
                                                            break;
                                                        case "04":
                                                            echo ("인천광역시");
                                                            break;
                                                        case "05":
                                                            echo ("광주광역시");
                                                            break;
                                                        case "06":
                                                            echo ("대전광역시");
                                                            break;
                                                        case "07":
                                                            echo ("울산광역시");
                                                            break;
                                                        case "08":
                                                            echo ("세종특별자치시");
                                                            break;
                                                        case "11":
                                                            echo ("경기도");
                                                            break;
                                                        case "12":
                                                            echo ("강원도");
                                                            break;
                                                        case "13":
                                                            echo ("충청북도");
                                                            break;
                                                        case "14":
                                                            echo ("충청남도");
                                                            break;
                                                        case "15":
                                                            echo ("전라북도");
                                                            break;
                                                        case "16":
                                                            echo ("전라남도");
                                                            break;
                                                        case "17":
                                                            echo ("경상북도");
                                                            break;
                                                        case "18":
                                                            echo ("경상남도");
                                                            break;
                                                        case "20":
                                                            echo ("제주특별자치도");
                                                            break;
                                                        default:
                                                            echo ("서울특별시");
                                                            break;
                                                    }
                                        
                                                    ?>
												</span>
											</div>
										</div>
									</div>
									<div class="memberinfo wtline">
										<a id="modification" href="#">
											<button class="defaultbutton">
												<span class="title">수정</span>
											</button>
										</a>
									</div>
								</div>	
								<div class="membertableitem wview mbline">
									<span>수정 불가</span>
								</div>
								<div class="membertableitem">
									<span>&nbsp;</span>
								</div>
								<div class="membertableitem wview wtline">
									<span>수정 가능</span>
								</div>
							</li>
							
							
							<li>
								<div class="membertableitem mline">
									<span>인증 추가 항목</span>
								</div>
								<div class="membertableitemlong wlline wrline">
									<div class="memberinfolong">
										<div class="memberinfolayer wbline">
											<div class="memberinfoitem mlline mrline wrline">
												<span>이름</span>
											</div>
											<div class="memberinfoitem mrline wrline">
												<span><?php echo($member[0]["uname"]); ?></span>
											</div>
										</div>
										<div class="memberinfolayer wbline">
											<div class="memberinfoitem mlline mrline wrline">
												<span>성별</span>
											</div>
											<div class="memberinfoitem mrline wrline">
												<span><?php
												switch ($member[0]["gender"]) {
                                                            case "f":
                                                                echo ("여자");
                                                                break;
                                                            case "m":
                                                                echo ("남자");
                                                                break;
                                                            default:
                                                                echo ("여자");
                                                                break;
                                                        }
                                            
                                                        ?></span>
											</div>
										</div>
										<div class="memberinfolayer wbline">
											<div class="memberinfolayer">
												<div class="memberinfoitem mlline mrline wrline">
													<span>생년월일</span>
												</div>
												<div class="memberinfoitem mrline wrline">
													<span><?php
												    echo (substr($member[0]["birthday"], 0, 4) . "년" . substr($member[0]["birthday"], 5, 2) . "월" . substr($member[0]["birthday"], 8, 2) . "일");
                                                            ?></span>
												</div>
											</div>
										</div>
										<div class="memberinfolayer">
											<div class="memberinfoitem mlline mrline wrline">
												<span>핸드폰</span>
											</div>
											<div class="memberinfoitem mrline wrline">
												<?php if($member[0]["phon_number"] == ""){
												   echo "<span>&nbsp;</span>";
												}else{											   
												    echo "<span>".$member[0]["phon_number"]."</span>";
												}
												?>
												
											</div>
										</div>
									</div>
									<div class="memberinfo mlline mbline mrline">
										<a id="cert" href="/kcpcert/WEB_ENC/kcpcert_start.php" onclick="window.open(this.href,'','width=610, height=210, scrollbars=no'); return false;">
											<button class="defaultbutton">
												<span class="title">본인인증</span>
											</button>
										</a>
									</div>
								</div>
								<div class="membertableitem wview">
									<span>본인인증 시</br>누적 포인트로</br>쿠폰 구입 가능
									</span>
								</div>
							</li>
							<li>
								<div class="membertableitem mline">
									<span>대표사진</span>
								</div>
								<div class="membertableitemlong wlline wrline">
									<div class="memberinfolong tpadding wrline">
										<div class="imgbox">										
											<span><img src="<?php echo($member[0]['pic']); ?>" style="width: 100%; height: 100%;"></span>
										</div>
									</div>
									<div class="memberinfo mlline mbline mrline">
										<a id="file_up" href="#">
											<button class="defaultbutton">
												<span class="title">사진 올리기</span>
											</button>
										</a>
									</div>
								</div>
								<div class="membertableitem wview">
									<span>선택사항</span>
								</div>
							</li>
						</ul>
						<!-- 회원 정보 내용 끝 -->
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- 회원 정보 상세 끝 -->
	<!-- 회원 정보 끝 -->
</div>