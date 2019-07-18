
<article id='board_area'>
  <? echo validation_errors();?>
  <form method='post' class='form-horizontal'>
    <fieldset>
      <legend>폼 검증</legend>
      <input type='text' name='username' id='input01'>
      <p class='help-block'>아이디를 입력하세요.</p>

      <input type='text' name='password' id='input02'>
      <p class='help-block'>패스워드를 입력하세요.</p>

      <input type='text' name='passconf' id='input03'>
      <p class='help-block'>패스워드를 한번 더 입력하세요.</p>

      <input type='email' name='email' id='input01'>
      <p class='help-block'>이메일을 입력하세요.</p>


    </fieldset>
    <input type='submit' value="전송" class='btn btn-primary'>
  </form>
</article>
