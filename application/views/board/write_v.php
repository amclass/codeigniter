<script>
/*
$(document).ready(function(){
	$("#write_btn").click(function(){
		if($("#input01").val()==""){
			alert("제목을 입력해주세요.");
			$("#input01").focus();
			return false;
		}else if($("#input02").val()==""){
			alert("내용을 입력해주세요.");
			$("#input03").focus();
			return false;
		}else{
			$("#write_action").submit();
		}

	});
});
*/
</script>
<article id='board_area'>
<header><h1></h1></header>
<form action="" id='write_action' class='form-horizontal' method='post'>
<fieldset>
<legend>게시물 쓰기</legend>
<div class='control-group'>
	<label class='control-label' for='input01'>제목</label>
	<div class='controls'>
		<input type='text' class='input-xlarge' id='input01' name='subject' value=<?php
echo set_value("subject");
?>>
		<p class='help-block'><?php

if (form_error('subject') == false) {
    echo "게시물의 제목을 써주세요.";
} else {
    echo form_error('subject');
}
?></p>
	</div>

	<label class='control-label' for='input02'>내용</label>
	<div class='controls'>

		<textarea rows="" cols="" name='contents'><?php

echo set_value("contents")?></textarea>
		<p class='help-block'><?php

if (form_error('contents') == false) {
    echo "게시물의 내용을 써주세요.";
} else {
    echo form_error('contents');
}
?></p>
	</div>

	<div>
	<?php

echo validation_errors();
?>
	</div>

	<div class='form-actions'>
		<button type='submit' class='btn btn-primary' id='write_btn'>작성</button>
		<button type='button' class='btn' onclick='javascript:window.location.reload()'>취소</button>
	</div>


</div>
</fieldset>

</form>
</article>
