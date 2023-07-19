<div class="content">

  <div class="calendar_section">
    <div class="wrap">
      <div class="title">
        <h1>관람 일정</h1>
        <div class="line"></div>
        <p>관람 일정을 확인해보세요.</p>
      </div>

      <div class="calendar col-flex">
        <div class="btn_box jcsb">
          <div class="btn" data-dir="-1" onclick="changeMonth(this)">이전</div>
          <h2>2023년</h2>
          <div class="btn" data-dir="1" onclick="changeMonth(this)">다음</div>
        </div>
        <div class="top">
          <div>SUN</div>
          <div>MON</div>
          <div>TUE</div>
          <div>WEN</div>
          <div>THU</div>
          <div>FRI</div>
          <div>SAT</div>
        </div>
        <div class="main">

        </div>
      </div>
    </div>
  </div>

</div>

<script>
  let year = new Date().getFullYear();
  let month = new Date().getMonth();

  const preview = <?= json_encode($preview) ?>;

  function changeMonth(target){
    if(target){
      const dir = $(target).attr("data-dir") * 1;
  
      month += dir;
    }

    $(".calendar .main").html("");

    const date = new Date(year, month)

    $(".calendar .btn_box h2").html(`${date.getFullYear()}년 ${date.getMonth() + 1}월`)

    const emp = new Date(year, month, 1).getDay();
    const today = new Date().getDate();
    const last = new Date(year, month + 1, 0).getDate();

    for(let i = 0;i < emp;i++){
      $(".calendar .main").append(`<div></div>`);
    }

    for(let i = 1;i <= last;i++){
      let list = [];
      
      if(today <= i){
        const data = preview.filter(v => {
          return v.preview_dt == new Date(year, month, i + 1).toISOString().split("T")[0]
        });
        const d_day = today - i == 0 ? "day" : i - today;
        dd(d_day);
        list = data.map(v => `<a href="/reservation?idx=${v.idx}">${v.title} ( D - ${d_day} )</a>`);
      }else{
        const data = preview.filter(v => {
          return v.preview_dt == new Date(year, month, i + 1).toISOString().split("T")[0]
        });
        list = data.map(v => `<small>${v.title}</small>`);
      }

      $(".calendar .main").append(`
        <div>
          <p>${i}</p>
          ${list.join("")}
        </div>`);
    }
  }

  changeMonth();

</script>