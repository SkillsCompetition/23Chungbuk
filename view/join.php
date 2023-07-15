<div class="content">
  <div class="join_section">
    <div class="wrap">
      <div class="title">
        <h1>회원가입</h1>
        <div class="line"></div>
      </div>

      <form class="join" action="/join" method="POST">
        <div class="inputs">
          <div class="btn_box">
            <div class="input_box chkSign">
              <input type="text" name="userid" id="userid" required>
              <label for="userid">아이디</label>
            </div>
            
            <button type="button" onclick="vali()" class="vali btn" disabled>아이디 중복확인</button                       >
          </div>

          <div class="input_box">
            <input type="password" name="password" id="password" required>
            <label for="password">비밀번호</label>
          </div>

          <div class="input_box">
            <input type="password" name="passwordChk" id="passwordChk" required>
            <label for="passwordChk">비밀번호 확인</label>
          </div>

          <button class="btn">회원가입</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
  let valied = false;

  $(document)
    .on("input", "#userid", toggleVali)
    .on("submit", ".join", submit)

  function toggleVali(e){
    const value = e.target.value;

    $(".vali").prop("disabled", !value)
    $(".chkSign").removeClass("chk")
  }

  function vali(){
    const $userid = $("#userid").val();

    $.get(`/checkID/${$userid}`)
      .then(chk => {
        valied = chk;
        const msg = chk ? "사용 가능한 아이디 입니다." : "중복된 아이디입니다.";

        $(".chkSign").addClass(chk ? "chk" : "");

        alert(msg);
      })
  }

  function submit(e){
    e.preventDefault();

    if(!valied) return alert("아이디 중복 확인을 먼저 해주세요.");

    const pass = $('#password').val();
    const passChk = $('#passwordChk').val();

    if(!(/[A-z]/g).test(pass) ||
       !(/\d/g).test(pass) ||
       !(/\W/g).test(pass) ||
       pass.length < 8) return alert("비밀번호는 영문과 숫자, 특수문자를 포함한 8자리 이상이여야합니다.");
    if(pass != passChk) return alert("비밀번호와 비밀번호 확인 값이 다릅니다.");

    $(".join")[0].submit();
  }

</script>