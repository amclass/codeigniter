
<article id='board_area'>
  <?
// 에러 일괄 출력
echo validation_errors();
?>
<?php
if (form_error('username')) {
    $error_username = form_error("username");
} else {
    $error_username = form_error("username_check");
}

?>
  <form method='post' class='form-horizontal'>
    <fieldset>
      <legend>폼 검증</legend>
      <input type='text' name='username' id='input01' value=<?php

    echo set_value('username')?>>
      <p class='help-block'><?php

    if ($error_username == false) {
        echo "아이디를 입력해주세요.";
    } else {
        echo $error_username;
    }
    ?></p>

      <input type='text' name='password' id='input02'value=<?php

    echo set_value('password')?>>
      <p class='help-block'><?php

    if (form_error('password') == false) {
        echo "패스워드를 입력해주세요.";
    } else {
        echo form_error('password');
    }
    ?></p>

      <input type='text' name='passconf' id='input03'value=<?php

    echo set_value('passconf')?>>
      <p class='help-block'>패스워드를 한번 더 입력하세요.</p>

      <input type='email' name='email' id='input04'value=<?php

    echo set_value('email')?>>
      <p class='help-block'>이메일을 입력하세요.</p>
<div>
<div class='control-group'>
<label class='control-label'>기본값 복원</label>
<div><input type='text' name='count' id='input05' value=<?php

echo set_value("count", 0)?>></div>
</div>


<div class='control-group'>
<label class='control-label'>셀렉트값 복원</label>
<div>
<select name='myselect'>
<option value='one' <?php

echo set_select("myselect", 'one', true)?>>one</option>
<option value='two' <?php

echo set_select("myselect", 'two')?>>two</option>
<option value='three' <?php

echo set_select("myselect", 'three')?>>three</option>
</select>
</div>
</div>


<div class='control-group'>
<label class='control-label'>checkbox</label>
<label for="mycheck1">111111111</label>
<div><input type='checkbox' name='mycheck[]' id='mycheck1' value='1' <?php

echo set_checkbox("mycheck[]", "1", true)?>></div>
<label for="mycheck2">222222</label>
<div><input type='checkbox' name='mycheck[]' value='2'id='mycheck2' <?php

echo set_checkbox("mycheck[]", "2")?>></div>
</div>


<div class='control-group'>
<label class='control-label'>checkbox</label>
<label for="myradio1">111111111</label>
<div><input type='radio' name='myradio' id='myradio1' value='1' <?php

echo set_radio("myradio", "1", true)?>></div>
<label for="mycheck2">222222</label>
<div><input type='checkbox' name='myradio' value='2'id='myradio2' <?php

echo set_radio("myradio", "2")?>></div>
</div>


</div>

    </fieldset>
    <input type='submit' value="전송" class='btn btn-primary'>
  </form>
</article>
