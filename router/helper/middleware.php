<?php

  function notUser(){
    err(@USER, "비회원만 이용할 수 있습니다.");
  }

  function user(){
    err(!USER, "회원만 이용할 수 있습니다.");
  }

  function admin(){
    err(@USER["userid"] != "admin", "관리자만 접근가능합니다.");
  }
?>