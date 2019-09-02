<article id="board_area">

</article>
<?php
$attributes = array(
    "class" => 'form-horizontal',
    "id" => 'auth_login'
);
echo form_open('/auth/login', $attributes);

?>
<input type='text' name='username' value="<?php

echo set_value('username')?>"><BR>
<input type='text' name='password' value="<?php

echo set_value('password')?>"><BR>
<div>
<?php

echo validation_errors();
?></div>
<button type='submit'>전송</button>
</form>
