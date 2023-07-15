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
          </div>

          <div class="container">
            <?php foreach($preview as $v): ?>
            <div class="item">
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
              <a href="/admin?page=<?= $prev ?>">&lt;</a>
              <?php for($i = $start;$i <= $end;$i++):?>
              <a <?= $i == $nowPage ? "class='chk'" : "" ?> href="/admin?page=<?= $i ?>"><?= $i ?></a>
              <?php endfor ?>
              <a href="/admin?page=<?= $next ?>">&gt;</a>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>
