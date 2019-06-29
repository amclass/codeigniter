<!DOCTYPE>
<html>
<head>
  <script
  src="https://code.jquery.com/jquery-2.2.4.min.js"
  integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
   crossorigin="anonymous"></script>
  <script src="<?php echo base_url(); ?>include/js/bootstrap.js"></script>
  <link rel="stylesheet" href="<?php echo base_url(); ?>include/css/bootstrap.css">
</head>
<body>
<div id="main">
  <header id="header" data-role="header" data-position="fixed">
    <blockquote>
      <p>만들면서 배우는 CodeIgniter<p>
        <small>실행 예제</small>
    </blockquote>
  </header>
  <nav>
    <ul>
      <li> <a rel="external" href="/board/<?=$this->uri->segment(1)?>/lists/<?=$this->uri->segment(3)?>">게시판 프로젝트</a></li>
    </ul>
  </nav>
