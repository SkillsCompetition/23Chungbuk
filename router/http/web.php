<?php

  get("/", function(){
    view("index");
  });

  get("/sub1", function(){
    view("sub1");
  });

  get("/video", function(){
    view("video");
  });

  middleware("notUser", function(){

    get("/checkID/$", function($id){
      $chk = user::find("userid = ?", $id);

      echo(!$chk ? true : false);
    });

    get("/join", function(){
      view("join");
    });

    post("/join", function(){
      err(emp_vali(P), "모든 값을 입력해주세요.");
      err(user::find("userid = ?", P["userid"]), "중복된 아이디입니다.");

      $salt = md5(uniqid(rand(), true));
      $hash = hash("sha256", P["password"].$salt);

      user::insert([
        "userid" => P["userid"],
        "hash" => $hash,
        "salt" => $salt
      ]);

      move("회원가입이 완료되었습니다.", "/");
    });

    get("/login", function(){
      view("login");
    });

    post("/login", function(){
      $find = user::find("userid = ?", P["userid"]);

      if(!$find) move("아이디와 일치하는 회원이 존재하지 않습니다.");

      $pass = hash("sha256", P["password"].$find["salt"]);
      if($pass != $find["hash"]) move("비밀번호가 일치하지 않습니다.");

      $_SESSION["user_101"] = $find;
      move("로그인이 완료되었습니다.", $find["userid"] == "admin" ? "/admin" : "/");
    });

  });

  middleware("user", function(){

    get("/logout", function(){
      session_destroy();
      move("로그아웃이 완료되었습니다.", "/");
    });

    get("/calendar", function(){
      $preview = preview::all();
      view("preview_calendar", get_defined_vars());
    });

    get("/preview_info", function(){
      $preview = preview::all();
      view("preview_info", get_defined_vars());
    });

  });

  middleware("admin", function(){

    get("/admin", function(){
      $preview = preview::all();
      $reservation = DB::mq("SELECT R.*, P.title, P.address 
                              FROM reservation AS R 
                              LEFT JOIN preview AS P 
                              ON P.idx = R.preview_idx
                              WHERE R.reservation_dt >= ?
                              ORDER BY R.create_dt DESC", date("Y-m-d"));

      view("admin", get_defined_vars());
    });

    post("/preview", function(){
      err(emp_vali(P) || !F["image"], "모든 값을 입력해주세요.");

      $file = F["image"];
      $type = explode(".", $file["name"]);
      $ext = end($type);

      err(!in_array($ext, ["png", "jpg"]), "이미지 파일 형식은 png 또는 jpg만 지원합니다.");

      $name = md5(uniqid(rand(), true));
      $url = "/upload/$name.$ext";

      move_uploaded_file($file["tmp_name"], ROOT.$url);

      $insert_data = P;
      $insert_data["image"] = $url;

      preview::insert($insert_data);
      move("등록이 완료되었습니다.");
    });

    get("/delete/preview/$", function($idx){
      preview::delete("idx = ?", $idx);

      move("관람 내역이 삭제되었습니다.");
    });

    post("/modify/preview", function(){
      err(emp_vali(P), "이미지를 제외한 모든 값을 입력해주세요.");

      $update_data = P;

      $idx = $update_data["idx"];
      unset($update_data["idx"]);

      $url = "";

      if(F["image"]["name"]){
        $file = F["image"];
        $type = explode(".", $file["name"]);
        $ext = end($type);
  
        err(!in_array($ext, ["png", "jpg"]), "이미지 파일 형식은 png 또는 jpg만 지원합니다.");
  
        $name = md5(uniqid(rand(), true));
        $url = "/upload/$name.$ext";
  
        move_uploaded_file($file["tmp_name"], ROOT.$url);
  
        $update_data["image"] = $url;

        preview::update("idx = ?", $idx, $update_data);
      }else{
        preview::update("idx = ?", $idx, $update_data);
      }

      move("수정이 완료되었습니다.");
    });

    get("/status/reservation/$/$", function($idx, $status){
      reservation::update("idx = ?", $idx, [
        "status" => $status
      ]);

      move("예약 상태가 변경되었습니다.");
    });

  });

?>