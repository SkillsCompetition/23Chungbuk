  <input type="checkbox" name="mobile" id="mobile" hidden>
  <div class="mobile_menu">
    <label for="mobile"></label>
    <div class="col-flex jcsb aic">
      <div class="menu">
        <div class="depth_box">
          <a href="#" class="depth1">투어 소개</a>
          <div class="sub_menu">
            <a href="#" class="depth2">독립기념관</a>            
            <a href="#" class="depth2">유관순 기념관</a>            
            <a href="#" class="depth2">홍대용 과학관</a>            
          </div>
        </div>
        <div class="depth_box">
          <a href="#" class="depth1">투어 정보</a>
          <div class="sub_menu">
            <a href="#" class="depth2">관람 정보</a>            
            <a href="#" class="depth2">관람 일정</a>            
          </div>
        </div>
        <div class="depth_box">
          <a href="#" class="depth1">투어 추천</a>
          <div class="sub_menu">
            <a href="#" class="depth2">투어 예약</a>            
            <a href="#" class="depth2">투어 추천</a>            
            <a href="#" class="depth2">추천 영상 등록</a>            
          </div>
        </div>
        <div class="depth_box">
          <a href="#" class="depth1">투어 후기</a>
          <div class="sub_menu">
            <a href="#" class="depth2">후기 게시판</a>            
          </div>
        </div>
      </div>

      <div class="utility flex jcfe">
        <div class="btn_box">
          <div class="btn"><i class="fa fa-user"></i>로그인</div>
          <div class="btn"><i class="fa fa-user-plus"></i>회원가입</div>
        </div>
      </div>
    </div>
  </div>

  <div class="visual">
    <div class="item">
      <div class="flex jcsb">
        <div class="text_box col-flex jcc aic">
          <h1>우리의 혼이 담긴<br>역사를 여행하다</h1>

          <p>천안을 여행하며 우리 역사를 함께 알아보세요.</p>
        </div>
        <img src="./resources/img/visual/1.png" alt="#" title="#">
      </div>
    </div>
    <div class="item">
      <div class="flex jcsb">
        <div class="text_box col-flex jcc aic">
          <h1>자연과 함께하는<br>천안 투어</h1>

          <p>자연 관경과 함께 아름다운 천안을 여행하보세요.</p>
        </div>
        <img src="./resources/img/visual/2.jpg" alt="#" title="#">
      </div>
    </div>
    <div class="item">
      <div class="flex jcsb">
        <div class="text_box col-flex jcc aic">
          <h1>우리를 보여주는<br>역사적인 장소</h1>

          <p>천안에 있는 역사적인 장소를 방문해보세요.</p>
        </div>
        <img src="./resources/img/visual/3.jpg" alt="#" title="#">
      </div>
    </div>

    <input type="checkbox" name="play" id="play" hidden>
    <label for="play" class="state_btn">
      <i class="fa fa-pause"></i>
      <i class="fa fa-play"></i>
    </label>
  </div>

  <div class="content">

    <div class="visited_section">
      <div class="wrap">
        <div class="title">
          <h1>관람객 통계</h1>
          <div class="line"></div>
          <p>천안에 방문하신 관람객의 통계입니다.</p>
        </div>

        <div class="visited col-flex">
          <input type="radio" name="graph" id="circle" checked hidden>
          <input type="radio" name="graph" id="bars" hidden>

          <div class="label_box">
            <label for="circle"><i class="fa fa-circle"></i>원그래프</label>
            <label for="bars"><i class="fa fa-bars"></i>막대그래프</label>
          </div>

          <div class="container flex">
            <div class="graph_box">
              <div class="item flex jcc">
                <svg viewBox="0 0 32 32">
                  <circle cx="16" cy="16" r="16" stroke-dasharray="0 100"></circle>
                  <circle cx="16" cy="16" r="16" stroke-dasharray="0 100"></circle>
                  <circle cx="16" cy="16" r="16" stroke-dasharray="0 100"></circle>
                </svg>
              </div>

              <div class="item col-flex jcsb">
                <div class="bar"></div>
                <div class="bar"></div>
                <div class="bar"></div>
              </div>
            </div>
  
            <div class="info_box flex jcc aic">
              <div class="item col-flex">
                <div class="box">
                  <i></i>
                  <p>20대</p>
                </div>

                <div class="box">
                  <i></i>
                  <p>30대</p>
                </div>

                <div class="box">
                  <i></i>
                  <p>40대</p>
                </div>
              </div>

              <div class="item col-flex">
                <div class="box">
                  <i></i>
                  <p>2020년</p>
                </div>

                <div class="box">
                  <i></i>
                  <p>2021년</p>
                </div>

                <div class="box">
                  <i></i>
                  <p>2022년</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="notice_section">
      <div class="wrap">
        <div class="title">
          <h1>공지사항</h1>
          <div class="line"></div>
          <p>천안에서 알려드리는 소식들입니다.</p>
        </div>

        <div class="notice col-flex">
          <input type="radio" name="news" id="news1" hidden checked>
          <input type="radio" name="news" id="news2" hidden>
          <input type="radio" name="news" id="news3" hidden>

          <div class="label_box">
            <label for="news1">독립 기념관</label>
            <label for="news2">유관순 기념관</label>
            <label for="news3">홍대용 과학관</label>
          </div>

          <div class="wrapper">

            <div class="container">
              <div class="item">
                <div>
                  <small>NEWS</small>
                  <h2>2023년 현충시설 및 문화관광 해설사 온라인 교육 안내</h2>
                </div>

                <div class="flex jcsb aife">
                  <p><i class="fa fa-clock"></i>2023-10-06</p>

                  <a>더보기</a>
                </div>
              </div>
              <div class="item">
                <div>
                  <small>NEWS</small>
                  <h2>역사왜곡 관련 국제학술심포지엄 개최 안내</h2>
                </div>

                <div class="flex jcsb aife">
                  <p><i class="fa fa-clock"></i>2023-10-01</p>

                  <a>더보기</a>
                </div>
              </div>
              <div class="item">
                <div>
                  <small>NEWS</small>
                  <h2>독립기념관 온라인 교육 '내 손안에 독도' 9월 교육 7~8차 참가자 모집</h2>
                </div>

                <div class="flex jcsb aife">
                  <p><i class="fa fa-clock"></i>2023-09-18</p>

                  <a>더보기</a>
                </div>
              </div>
              <div class="item">
                <div>
                  <small>NEWS</small>
                  <h2>제19회 독립기념관 학술상 시상식 개최 안내</h2>
                </div>

                <div class="flex jcsb aife">
                  <p><i class="fa fa-clock"></i>2023-09-10</p>

                  <a>더보기</a>
                </div>
              </div>
              <div class="item">
                <div>
                  <small>NEWS</small>
                  <h2>독립기념관 제78주년 광복절 경축행사 SNS 공유 이벤트 </h2>
                </div>

                <div class="flex jcsb aife">
                  <p><i class="fa fa-clock"></i>2023-10-06</p>

                  <a>더보기</a>
                </div>
              </div>
              <div class="item plus">
                <i class="fa fa-plus"></i>
              </div>
            </div>

            <div class="container">
              <div class="item">
                <div>
                  <small>NEWS</small>
                  <h2>유관순연사사적지 100% 즐기기! "유관순 AR 미션투어"출시</h2>
                </div>

                <div class="flex jcsb aife">
                  <p><i class="fa fa-clock"></i>2023-10-01</p>

                  <a>더보기</a>
                </div>
              </div>
              <div class="item">
                <div>
                  <small>NEWS</small>
                  <h2>2023년 아우내 봉화제에 여러분을 초대합니다</h2>
                </div>

                <div class="flex jcsb aife">
                  <p><i class="fa fa-clock"></i>2023-09-23</p>

                  <a>더보기</a>
                </div>
              </div>
              <div class="item">
                <div>
                  <small>NEWS</small>
                  <h2>2023년 유관순열사기념관 홈페이지 개편 안내</h2>
                </div>

                <div class="flex jcsb aife">
                  <p><i class="fa fa-clock"></i>2023-08-29</p>

                  <a>더보기</a>
                </div>
              </div>
              <div class="item">
                <div>
                  <small>NEWS</small>
                  <h2>유관순 교육관의 이름을 지어주세요!</h2>
                </div>

                <div class="flex jcsb aife">
                  <p><i class="fa fa-clock"></i>2023-08-12</p>

                  <a>더보기</a>
                </div>
              </div>
              <div class="item">
                <div>
                  <small>NEWS</small>
                  <h2>제78주년 광복절 맞이 체험행사 운영 안내</h2>
                </div>

                <div class="flex jcsb aife">
                  <p><i class="fa fa-clock"></i>2023-08-05</p>

                  <a>더보기</a>
                </div>
              </div>
              <div class="item plus">
                <i class="fa fa-plus"></i>
              </div>
            </div>

            <div class="container">
              <div class="item">
                <div>
                  <small>NEWS</small>
                  <h2>천안홍대용과학관 천제관측시설 일부 제한운영 안내</h2>
                </div>

                <div class="flex jcsb aife">
                  <p><i class="fa fa-clock"></i>2023-09-23</p>

                  <a>더보기</a>
                </div>
              </div>
              <div class="item">
                <div>
                  <small>NEWS</small>
                  <h2>2023년 9월 휴관 안내</h2>
                </div>

                <div class="flex jcsb aife">
                  <p><i class="fa fa-clock"></i>2023-09-01</p>

                  <a>더보기</a>
                </div>
              </div>
              <div class="item">
                <div>
                  <small>NEWS</small>
                  <h2>홍대용과학관 개관 8주년 기념 특별전시 - 천안문화유산 별빛夜行(야행)</h2>
                </div>

                <div class="flex jcsb aife">
                  <p><i class="fa fa-clock"></i>2023-08-20</p>

                  <a>더보기</a>
                </div>
              </div>
              <div class="item">
                <div>
                  <small>NEWS</small>
                  <h2>2023년 천체투영관 상영작 안내</h2>
                </div>

                <div class="flex jcsb aife">
                  <p><i class="fa fa-clock"></i>2023-08-10</p>

                  <a>더보기</a>
                </div>
              </div>
              <div class="item">
                <div>
                  <small>NEWS</small>
                  <h2>천안홍대용과학관 특별전 -제 31회 천체사진 공모전 입상작 전시</h2>
                </div>

                <div class="flex jcsb aife">
                  <p><i class="fa fa-clock"></i>2023-08-01</p>

                  <a>더보기</a>
                </div>
              </div>
              <div class="item plus">
                <i class="fa fa-plus"></i>
              </div>
            </div>

          </div>


        </div>
      </div>
    </div>

    <div class="gallery_section">
      <div class="wrap">
        <div class="title">
          <h1>갤러리</h1>
          <div class="line"></div>
          <p>천안에 아름다운 모습을 담은 사진들입니다.</p>
        </div>

        <div class="gallery flex">
          <div class="circle">
            <img src="resources/img/gallery/circle/1.png" alt="#" title="#">
            <img src="resources/img/gallery/circle/2.png" alt="#" title="#">
            <img src="resources/img/gallery/circle/3.png" alt="#" title="#">
            <img src="resources/img/gallery/circle/4.png" alt="#" title="#">
          </div>

          <div class="wrapper">
            <div class="container">
              <div class="rotater">
                <div class="item"><img src="resources/img/gallery/rotate/1.jpg" alt="#" title="#"></div>
                <div class="item"><img src="resources/img/gallery/rotate/2.png" alt="#" title="#"></div>
                <div class="item"><img src="resources/img/gallery/rotate/3.png" alt="#" title="#"></div>
                <div class="item"><img src="resources/img/gallery/rotate/4.jpg" alt="#" title="#"></div>
                <div class="item"><img src="resources/img/gallery/rotate/5.png" alt="#" title="#"></div>
                <div class="item"><img src="resources/img/gallery/rotate/6.png" alt="#" title="#"></div>
                <div class="item"><img src="resources/img/gallery/rotate/7.jpg" alt="#" title="#"></div>
                <div class="item"><img src="resources/img/gallery/rotate/8.png" alt="#" title="#"></div>
              </div>
            </div>

            <div class="container shadow">
              <div class="rotater">
                <div class="item"><img src="resources/img/gallery/rotate/1.jpg" alt="#" title="#"></div>
                <div class="item"><img src="resources/img/gallery/rotate/2.png" alt="#" title="#"></div>
                <div class="item"><img src="resources/img/gallery/rotate/3.png" alt="#" title="#"></div>
                <div class="item"><img src="resources/img/gallery/rotate/4.jpg" alt="#" title="#"></div>
                <div class="item"><img src="resources/img/gallery/rotate/5.png" alt="#" title="#"></div>
                <div class="item"><img src="resources/img/gallery/rotate/6.png" alt="#" title="#"></div>
                <div class="item"><img src="resources/img/gallery/rotate/7.jpg" alt="#" title="#"></div>
                <div class="item"><img src="resources/img/gallery/rotate/8.png" alt="#" title="#"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>