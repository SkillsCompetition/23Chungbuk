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
        <h1>관람 일정 관리</h1>
        <div class="line"></div>
        <p>관람 일정을 등록하거나 수정해보세요.</p>
      </div>

      <div class="preview col-flex">
        <div class="top flex jcsb aife">
          <p>현재 <b><?= $nowPage ?></b> 페이지 / 전체 <b><?= $maxPage ?></b> 페이지</p>

          <div class="btn" onclick="Modal.open('preview')">관람정보추가</div>
        </div>

        <div class="middle">
          <table class="table">
            <tr>
              <th>관람정보 제목</th>
              <th>관람 내용</th>
              <th>관람 날짜</th>
              <th>관람 장소</th>
              <th>비고</th>
            </tr>
            <?php foreach($preview_data as $v): ?>
              <tr>
                <td><?= $v["title"] ?></td>
                <td><?= $v["content"] ?></td>
                <td><?= $v["preview_at"] ?></td>
                <td><?= $v["place"] ?></td>
                <td></td>
              </tr>
            <?php endforeach ?>
          </table>
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

<template>

  <div class="preview_modal">
    <div class="flex jcsb aic">
      <h3>관람 정보 추가</h3>

      <i class="fa fa-times-circle" onclick="Modal.close()"></i>
    </div>
    <hr>
    <div class="inputs">
      <div class="input_box">
        <input type="text" name="title" id="title" required>
        <label for="title">제목</label>
      </div>

      <div class="input_box">
        <textarea name="content" id="content" cols="30" rows="10" required></textarea>
        <label for="content">내용</label>
      </div>
    </div>
  </div>

</template>