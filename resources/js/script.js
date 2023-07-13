const dd = console.log;

const App = {

  init(){
    App.hook();

    VideoPlayer.init();
  },

  hook(){
    $(document)
      .on("keydown", document, VideoPlayer.shoutCut)
      .on("change", "#videoLoader", VideoPlayer.fileLoad)
      .on("mousedown", ".video_box .current_bar", VideoPlayer.mouse.down)
      .on("mouseup mouseleave", ".video_box", VideoPlayer.mouse.up)
      .on("mousemove click", ".video_box .video", VideoPlayer.mouse.move)
      .on("click", ".video_list .item", VideoPlayer.selectVideo)
      .on("click", ".prev, .next", VideoPlayer.moveVideo)
      .on("click", ".video_box .prograss .item", VideoPlayer.clickSnapshot)
  }

}

const VideoPlayer = {
  list: [],
  countId : 0,
  shoutCutList : {
    192 : "fileOpen",
    73 : "setStartTime", // i
    79 : "setEndTime", // o
    82 : "resetTime", // r
    32 : "changeVideoStatus" // space
  },
  nowSelect : 0,
  video : null,

  init(){
    VideoPlayer.video = $(".video_box video")[0];
    VideoPlayer.hook();

    VideoPlayer.Database.init();
  },

  hook(){
    VideoPlayer.video.addEventListener("timeupdate", () => {
      VideoPlayer.checkTimeOver();
      VideoPlayer.changeCurrentBar();
      VideoPlayer.chagneTimeline();
    });
  },

  shoutCut(e){
    const func = VideoPlayer.shoutCutList[e.keyCode];
    if(!func) return;

    VideoPlayer[func](e);
  },

  fileOpen(){
    $("#videoLoader").click();
  },

  fileLoad(e){
    const promise = [...e.target.files].map((v, i) => {
      return new Promise(res => {
        const canvas = $("#video_canvas")[0];
        const ctx = canvas.getContext("2d");
        const fileReader = new FileReader();

        fileReader.readAsDataURL(v);
        fileReader.onload = () => {
          const video = $(`<video src="${fileReader.result}"></video>`)[0];
          const frame = [];

          video.onloadeddata = () => {
            const changeTime = (count = 0) => {
              if(count == 10){
                res({
                  id : VideoPlayer.countId++,
                  name : v.name,
                  base64 : fileReader.result,
                  duration : video.duration,
                  startTime : null,
                  endTime : null,
                  frame
                });

                return video.remove();
              };
              video.currentTime = video.duration * (count/10);

              video.ontimeupdate = () => {
                ctx.drawImage(video, 0, 0, canvas.width, canvas.height);
                const data = canvas.toDataURL("image/jpeg");

                frame.push(data);
                changeTime(++count);
              }
            }

            changeTime();
          }
        }
      })
    })

    Promise.all(promise).then(res => {
      VideoPlayer.list = [...VideoPlayer.list, ...res];

      VideoPlayer.Database.save(res);
      VideoPlayer.setVideoList(); 
      VideoPlayer.settingVideo(); 
    });
  },

  setVideoList(){
    $(".modify .video_list").html(VideoPlayer.list.map((v, i) => {
      return `
        <div class="item ${VideoPlayer.nowSelect == i ? 'select' : ''}">
          <img src="${v.frame[1]}" alt="">
          <p>${v.name}</p>
        </div>`
    }));
  },

  settingVideo(){
    clearTimeout(VideoPlayer.loader);
    const metadata = VideoPlayer.list[VideoPlayer.nowSelect];

    VideoPlayer.changePage();
    VideoPlayer.changeStatusButton();
    VideoPlayer.chagneTimeline();
    VideoPlayer.changeCurrentBar();
    VideoPlayer.changeVideoName();

    VideoPlayer.settingTimeblock();
    VideoPlayer.setThumbnailList(metadata);

    $(VideoPlayer.video).attr("src", metadata.base64);
    VideoPlayer.loader = setTimeout(() => {
      VideoPlayer.video.load()
    }, 200)
  },

  setThumbnailList(metadata){
    $(".prograss").html(metadata.frame.map((v, i) => {
      return `<div class="item" data-idx="${i}"><img src="${v}" alt="#"></div>`
    }));
  },

  changeCurrentBar(){
    const video = VideoPlayer.video;
    const { duration } = VideoPlayer.list[VideoPlayer.nowSelect]
    const per = video.currentTime/duration * 100;

    $(".video_box .current_bar").css({
      "left" : `${per}%`
    });
  },

  chagneTimeline(){
    const video = VideoPlayer.video;
    const { currentTime } = video;
    const { duration } = VideoPlayer.list[VideoPlayer.nowSelect]

    const format = (time) => {
      const sec = `${Math.floor(time%60)}`.padStart(2, "0");
      const min = `${Math.floor(time/60)%60}`.padStart(2, "0");
      const hour = `${Math.floor(min/60)}`.padStart(2, "0");

      return hour + ":" + min +  ":" + sec;
    }

    $(".video_box .timeline p").html(`${format(currentTime)} / ${format(duration)}`);
  },

  changeVideoName(){
    $(".video_box .status_box .name p").html(VideoPlayer.list[VideoPlayer.nowSelect].name);
  },

  mouse : {
    moving : false,

    down(){
      VideoPlayer.mouse.moving = true;
      VideoPlayer.video.pause();
    },

    up(){
      if(!VideoPlayer.mouse.moving) return;
      VideoPlayer.mouse.moving = false;
      VideoPlayer.video.play();
    },

    move(e){
      if(!VideoPlayer.mouse.moving && e.type != "click") return;
      const box = $(".video_box .main");
      const max = box.css("width").replace("px", "");
      const { left } = box.offset();

      let nowLeft = e.pageX - left;
      nowLeft = nowLeft < 0 ? 0 : (nowLeft > max ? max : nowLeft);

      VideoPlayer.video.currentTime = VideoPlayer.video.duration * (nowLeft/max);
      VideoPlayer.changeCurrentBar();
      VideoPlayer.checkTimeOver();
    }
  },

  selectVideo(e){
    const target = $(e.target);
    const idx = target.index();

    VideoPlayer.nowSelect = idx;

    $(".item.select").removeClass("select");
    target.addClass("select");

    VideoPlayer.settingVideo();
  },

  changeStatusButton(){
    if(VideoPlayer.list.length < 2) $(".video_box .btn").hide();
    else $(".video_box .btn").show()

    if(VideoPlayer.nowSelect === 0){
      $(".video_box .prev").css({
        "opacity" : ".5",
        "pointer-events" : "none"
      })
    }else if(VideoPlayer.nowSelect === VideoPlayer.list.length - 1){
      $(".video_box .next").css({
        "opacity" : ".5",
        "pointer-events" : "none"
      })
    }else{
      $(".video_box .btn").css({
        "opacity" : "1",
        "pointer-events" : "all"
      })
    }
  },

  moveVideo(e){
    const value = $(e.target).attr("data-value") * 1;

    VideoPlayer.nowSelect += value;

    VideoPlayer.settingVideo();
    VideoPlayer.setVideoList();
  },

  clickSnapshot(e){
    const video = VideoPlayer.video;
    const idx = $(e.target).attr("data-idx") * 1;

    video.currentTime = video.duration * (idx/10);
  },

  changePage(){
    $(".video_box .page p").html(`${VideoPlayer.nowSelect + 1} / ${VideoPlayer.list.length}`)
  },

  setStartTime(){
    const time = VideoPlayer.video.currentTime;
    const chk = VideoPlayer.list[VideoPlayer.nowSelect].endTime;
    if(chk && chk < time){
      return alert("시작시간은 종료시간 이후로 설정할 수 없습니다.");
    }
    
    VideoPlayer.list[VideoPlayer.nowSelect].startTime = time;

    VideoPlayer.settingTimeblock();
    VideoPlayer.Database.update();
  },

  setEndTime(){
    const time = VideoPlayer.video.currentTime;
    const chk = VideoPlayer.list[VideoPlayer.nowSelect].startTime;
    if(chk && chk > time){
      return alert("종효시간은 시작시간 이전로 설정할 수 없습니다.");
    }
    
    VideoPlayer.list[VideoPlayer.nowSelect].endTime = time;

    VideoPlayer.settingTimeblock();
    VideoPlayer.Database.update();
  },

  resetTime(){
    VideoPlayer.list[VideoPlayer.nowSelect].startTime = null;
    VideoPlayer.list[VideoPlayer.nowSelect].endTime = null;

    VideoPlayer.settingTimeblock();
    VideoPlayer.Database.update();
  },

  settingTimeblock(){
    const { startTime, endTime, duration } = VideoPlayer.list[VideoPlayer.nowSelect];

    $(".video_box .timeblock div").css({
      "width" : `0%`
    })

    if(startTime){
      const startWidth = (startTime/duration) * 100;
      $(".video_box .timeblock .start").css({
        "width" : `${startWidth}%`
      })
    }

    if(endTime){
      const endWidth = 100 - ((endTime/duration) * 100);
      $(".video_box .timeblock .end").css({
        "width" : `${endWidth}%`
      })
    }
  },

  checkTimeOver(){
    const video = VideoPlayer.video;
    const { startTime, endTime } = VideoPlayer.list[VideoPlayer.nowSelect];
    
    if(video.currentTime < startTime && startTime){
      video.currentTime = startTime;

      VideoPlayer.mouse.moving = false;
    }

    if((video.currentTime > endTime && endTime) || video.ended){
      video.pause();

      video.currentTime = startTime || 0;
    }
  },

  changeVideoStatus(e){
    e.preventDefault();
    const video = VideoPlayer.video;

    if(video.paused) video.play();
    else video.pause();
  },


  Database : {
    DB : null,

    init(){
      const openDB = window.indexedDB.open("video", 2);

      openDB.onupgradeneeded = () => {
        VideoPlayer.Database.DB = openDB.result;
        const db = VideoPlayer.Database.DB;

        db.createObjectStore("video_list", { keyPath : "id" });
      }

      openDB.onsuccess = () => {
        VideoPlayer.Database.DB = openDB.result;

        VideoPlayer.Database.loadData();
      }
    },

    save(data){
      const db = VideoPlayer.Database.DB;
      const transaction = db.transaction(["video_list"], "readwrite");

      const store = transaction.objectStore("video_list");
      data.forEach(v => {
        store.add(v);
      })
    },

    loadData(){
      const db = VideoPlayer.Database.DB;
      const transaction = db.transaction(["video_list"]);

      const store = transaction.objectStore("video_list");
      const cursorOpen = store.openCursor();
      cursorOpen.onsuccess = (e) => {
        const cursor = e.target.result;
        if(cursor){
          const loaddata = store.get(cursor.key);

          loaddata.onsuccess = (data) => {
            VideoPlayer.list.push(data.target.result);
          }
          cursor.continue();
        }else{
          if(VideoPlayer.list.length != 0){
            VideoPlayer.countId = VideoPlayer.list.length;

            VideoPlayer.setVideoList();
            VideoPlayer.settingVideo();
          }
        }
      }
    },

    update(){
      const db = VideoPlayer.Database.DB;
      const transaction = db.transaction(["video_list"], "readwrite");

      const store = transaction.objectStore("video_list");
      const request = store.get(VideoPlayer.nowSelect);

      request.onsuccess = () => {
        store.put(VideoPlayer.list[VideoPlayer.nowSelect]);
      }
    }

  }

}

$(() => App.init())