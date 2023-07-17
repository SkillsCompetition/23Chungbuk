<?php
  $nowPage = @G['page'] ? (int) G['page'] : 1;

  $maxPage = ceil(count($preview)/10);
  $maxPage = $maxPage == 0 ? 1 : $maxPage;

  $start = (ceil($nowPage/10) - 1) * 10 + 1;
  $end = $start + 9 > $maxPage ? $maxPage : $start + 9;

  $prev = $nowPage <= 1 ? 1 : $nowPage - 1;
  $next = $nowPage >= $maxPage ? $maxPage : $nowPage + 1;

  $preview_data = array_slice($preview, ($nowPage - 1) * 10, 10);

  $reservation_status = [
    "accpet" => "수락한 예약",
    "cancel" => "취소된 예약"
  ]
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
                <td><p><?= $v["title"] ?></p></td>
                <td><p><?= $v["content"] ?></p></td>
                <td><?= $v["preview_dt"] ?></td>
                <td><?= $v["address"] ?></td>
                <td>
                  <div class="btn_box">
                    <div onclick="modify(<?= $v['idx'] ?>)" class="btn">수정</div>
                    <a href="/delete/preview/<?= $v["idx"] ?>" class="btn">삭제</a>
                  </div>
                </td>
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

  <div class="reservation_list_section">
    <div class="wrap">
      <div class="title">
        <h1>투어 예약 관리</h1>
        <div class="line"></div>
        <p>방문객들의 예약을 관리해보세요.</p>
      </div>

      <div class="reservation_list">
        <table class="table">
          <tr>
            <th>예약한 유저 아이디</th>
            <th>예약 날짜</th>
            <th>관람 정보 제목</th>
            <th>관람 주소</th>
            <th>예약 상태</th>
          </tr>
          <?php foreach($reservation as $v): ?>
            <tr>
              <td><?= $v["userid"] ?></td>
              <td><?= $v["reservation_dt"] ?></td>
              <td><?= $v["title"] ?></td>
              <td><?= $v["address"] ?></td>
              <td>
                <?php if($v["status"] == "wait"): ?>
                  <div class="btn_box">
                    <a href="/status/reservation/<?= $v["idx"] ?>/accpet" class="btn green">수락</a>
                    <a href="/status/reservation/<?= $v["idx"] ?>/cancel" class="btn tomato">취소</a>
                  </div>
                <?php else: ?>
                  <?= $reservation_status[$v["status"]] ?>
                <?php endif ?>
              </td>
            </tr>
          <?php endforeach ?>
        </table>
      </div>
    </div>
  </div>

</div>

<script>

  const json = <?= json_encode($preview) ?>;

  function modify(idx){
    Modal.open("modify");

    const data = json.find(v => v.idx == idx);

    $(".modal #idx").val(idx);

    $(".modal #title").val(data.title);
    $(".modal #content").val(data.content);
    $(".modal #preview_at").val(data.preview_dt);
    $(".modal #address").val(data.address);
  }

</script>

<template>

  <div class="preview_modal">
    <div class="flex jcsb aic">
      <h3>관람 정보 추가</h3>

      <i class="fa fa-times-circle" onclick="Modal.close()"></i>
    </div>
    <hr>
    <form class="inputs" action="/preview" method="POST" enctype="multipart/form-data">
      <div class="input_box">
        <input type="text" name="title" id="title" required>
        <label for="title">관람정보 제목</label>
      </div>

      <div class="input_box">
        <textarea name="content" id="content" required>내용을 입력해주세요.</textarea>
        <label for="content">관람정보 내용</label>
      </div>
      
      <div class="input_box">
        <input type="file" name="image" id="image" required>
        <label for="image">관람정보 이미지</label>
      </div>
      
      <div class="input_box">
        <input type="date" name="preview_dt" id="preview_at" min="<?= date("Y-m-d", strtotime("+1 days")) ?>" required>
        <label for="preview_at">관람 날짜</label>
      </div>

      <div class="input_box">
        <input type="text" name="address" id="address" required>
        <label for="address">관람 주소</label>
      </div>

      <button class="btn">추가</button>
    </form>
  </div>

  <div class="modify_modal">
    <div class="flex jcsb aic">
      <h3>관람 정보 수정</h3>

      <i class="fa fa-times-circle" onclick="Modal.close()"></i>
    </div>
    <hr>
    <form class="inputs" action="/modify/preview" method="POST" enctype="multipart/form-data">
      <input type="text" name="idx" id="idx" hidden>

      <div class="input_box">
        <input type="text" name="title" id="title" required>
        <label for="title">관람정보 제목</label>
      </div>

      <div class="input_box">
        <textarea name="content" id="content" required></textarea>
        <label for="content">관람정보 내용</label>
      </div>
      
      <div class="input_box">
        <input type="file" name="image" id="image">
        <label for="image">관람정보 이미지</label>
      </div>
      
      <div class="input_box">
        <input type="date" name="preview_dt" id="preview_at" min="<?= date("Y-m-d", strtotime("+1 days")) ?>" required>
        <label for="preview_at">관람 날짜</label>
      </div>

      <div class="input_box">
        <input type="text" name="address" id="address" required>
        <label for="address">관람 주소</label>
      </div>

      <button class="btn">수정</button>
    </form>
  </div>

</template>