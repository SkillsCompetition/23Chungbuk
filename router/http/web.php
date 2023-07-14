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

  });

  middleware("admin", function(){

    get("/admin", function(){
      $preview = preview::all();

      view("admin", get_defined_vars());
    });

  });

?>