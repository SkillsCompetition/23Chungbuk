  <div class="content">

    <div class="modify_section">
      <div class="wrap">
        <div class="title">
          <h1>투어 영상 등록</h1>
          <div class="line"></div>
          <p>투어 영상을 등록해보세요.</p>
        </div>

        <div class="modify col-flex">
          <input type="file" id="videoLoader" accept="video/*" multiple hidden>

          <div class="video_box flex">
            <div class="prev btn" style="display: none;" data-value="-1"><i class="fa fa-angle-left"></i></div>
            <div class="main col-flex aic">
              <div class="timeblock flex jcsb">
                <div class="start"></div>
                <div class="end"></div>
              </div>
              <div class="status_box flex">
                <div class="timeline">
                  <p>00:00:00 / 00:00:00</p>
                </div>

                <div class="page">
                  <p>0/0</p>
                </div>

                <div class="name">
                  <p>---</p>
                </div>
              </div>
              <div class="video">
                <video preload="none" src=""></video>
              </div>
              <div class="current_bar"></div>
              <div class="prograss">
                <div class="item"></div>
                <div class="item"></div>
                <div class="item"></div>
                <div class="item"></div>
                <div class="item"></div>
                <div class="item"></div>
                <div class="item"></div>
                <div class="item"></div>
                <div class="item"></div>
                <div class="item"></div>
              </div>
            </div>
            <div class="next btn" style="display: none;" data-value="1"><i class="fa fa-angle-right"></i></div>
          </div>

          <div class="video_list">
          </div>
        </div>
      </div>
    </div>

  </div>

  <canvas id="video_canvas" width="150" height="150" hidden></canvas>