<?php
  $reservation_status = [
    "accpet" => "수락한 예약",
    "wait" => "예약 확인 중"
  ]
?>

<div class="content">
  <div class="reservation_section">
    <div class="wrap">
      <div class="title">
        <h1>투어 예약</h1>
        <div class="line"></div>
        <p>투어에 예약하고 예약 내역을 확인하세요.</p>
      </div>


      <div class="reservation">
        <table class="table">
          <tr>
            <th>예약 날짜</th>
            <th>관람 정보 제목</th>
            <th>관람 주소</th>
            <th>예약 상태</th>
            <th>비고</th>
          </tr>
          <?php foreach($reservation as $v): ?>
          <tr>
            <td><?= $v["reservation_dt"] ?></td>
            <td><?= $v["title"] ?></td>
            <td><?= $v["address"] ?></td>
            <td><?= $reservation_status[$v["status"]] ?></td>
            <td>
              <div class="btn_box">
                <a href="/cancel/reservation/<?= $v["idx"] ?>" class="btn">예약 취소</a>
              </div>
            </td>
          </tr>
          <?php endforeach ?>
        </table>
      </div>
    </div>
  </div>
</div>

<template>

  <div class="reservation_modal">
    <div class="flex jcsb aic">
      <h3>투어 예약</h3>

      <i class="fa fa-times-circle" onclick="Modal.close()"></i>
    </div>
    <hr>
    <form class="inputs" action="/reservation" method="POST">
      <input type="text" name="preview_idx" id="preview_idx" hidden>
      <input type="text" name="userid" value="<?= USER["userid"] ?>" hidden>

      <small id="preview_dt">관람 날짜 : </small>

      <div class="input_box">
        <input type="date" name="reservation_dt" id="reservation_dt" min="<?= date("Y-m-d") ?>" required>
        <label for="reservation_dt">예약 날짜</label>
      </div>

      <button class="btn">예약</button>
    </form>
  </div>

</template>

<script>

  const data = <?= !@G["idx"] ? 0 : json_encode(preview::find("idx = ?", @G["idx"])) ?>;

  $(document)
    .on("submit", ".reservation_modal form", (e) => {
      e.preventDefault();
      const date = $("#reservation_dt").val();

      if(data.preview_dt < date) return alert("관람 일정을 초과해서 예약할 수 없습니다.")

      e.target.submit();
    })

  $(() => {
    if(data){
      Modal.open("reservation");
  
      $("#preview_idx").val(data.idx);
      $("#preview_dt").html(`관람 날짜 : ${data.preview_dt}`)
    }
  })



</script>