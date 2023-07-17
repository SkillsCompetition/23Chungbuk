<?php
  $nowPage = @G['page'] ? (int) G['page'] : 1;

  $maxPage = ceil(count($preview)/10);
  $maxPage = $maxPage == 0 ? 1 : $maxPage;

  $start = (ceil($nowPage/10) - 1) * 10 + 1;
  $end = $start + 9 > $maxPage ? $maxPage : $start + 9;

  $prev = $nowPage <= 1 ? 1 : $nowPage - 1;
  $next = $nowPage >= $maxPage ? $maxPage : $nowPage + 1;

  $preview_data = array_slice($preview, ($nowPage - 1) * 10, 10);
?>


<div class="content">
  <div class="preview_secton">
      <div class="wrap">
        <div class="title">
          <h1>관람 정보</h1>
          <div class="line"></div>
          <p>관람 정보를 확인해보세요.</p>
        </div>

        <div class="preview col-flex">
          <div class="top flex jcsb aife">
            <p>현재 <b><?= $nowPage ?></b> 페이지 / 전체 <b><?= $maxPage ?></b> 페이지</p>

            <button type="button" onclick="openSelecter()" class="btn">엑셀 다운</button>
          </div>

          <div class="container">
            <?php foreach($preview as $v): ?>
            <div class="item" onclick="location.href='/reservation?idx=<?= $v['idx'] ?>'">
              <img src="<?= $v["image"] ?>" alt="">
              <div class="text_box col-flex jcsb">
                <div>
                  <small><?= $v["address"] ?></small>
                  <h2><?= $v["title"] ?></h2>
  
                  <p><?= $v["content"] ?></p>
                </div>

                <p><?= $v["preview_dt"] ?></p>
              </div>
            </div>
            <?php endforeach ?>
          </div>

          <div class="bottom flex jcc aic">
            <div class="paging">
              <a href="/preview_info?page=<?= $prev ?>">&lt;</a>
              <?php for($i = $start;$i <= $end;$i++):?>
              <a <?= $i == $nowPage ? "class='chk'" : "" ?> href="/preview_info?page=<?= $i ?>"><?= $i ?></a>
              <?php endfor ?>
              <a href="/preview_info?page=<?= $next ?>">&gt;</a>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>

<template>

  <div class="xls_modal">
    <div class="flex jcsb aic">
      <h3>엑셀 다운</h3>

      <i class="fa fa-times-circle" onclick="Modal.close()"></i>
    </div>
    <hr>
    <form class="inputs" action="/xls_download" method="GET">
      <div class="input_box">
        <input type="date" name="start_dt" id="start_dt">
        <label for="start_dt">시작 날짜</label>
      </div>

      <div class="input_box">
        <input type="date" name="end_dt" id="end_dt">
        <label for="end_dt">마지막 날짜</label>
      </div>

      <button class="btn">다운</button>
    </form>
  </div>

</template>

<script>

  $(document)
    .on("submit", ".xls_modal form", submit)

  function openSelecter(){
    $.get("/chkLogin")
      .then(res => {
        if(res){
          Modal.open("xls");
        }else{
          alert("로그인을 먼저 진행해주세요.");
          location.href = '/login';
        }
      })
  }

  function submit(e){
    e.preventDefault();
    const start_dt = $("#start_dt").val();
    const end_dt = $("#end_dt").val();

    if(!end_dt || !start_dt ||start_dt > end_dt) return alert("날짜를 다시 설정해주세요.");

    e.target.submit();
    Modal.close();
  }

</script>
