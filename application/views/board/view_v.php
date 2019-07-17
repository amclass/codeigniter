<article id="board_area">
  <header>
    <h1></h1>
  </header>
  <table cellspacing=0 cellpadding=0 class="table">
    <thead>
      <tr>
        <th scope="col">번호</th>
        <th scope="col">제목</th>
        <th scope="col">내용</th>
        <th scope="col">작성자</th>
        <th scope="col">조회수</th>
        <th scope="col">작성일</th>
      </tr>
    </thead>
    <tbody>
      <tr>
          <th scope="row">
            <?=$data->board_id;?>
          </th>
          <td>
            <a role="extrenal" href="/<?=$this->uri->segment(1)?>/view/<?=$this->uri->segment(3)?>/<?=$data->board_id?>"><?=$data->subject?></a>
          </td>
          <td><?=$data->contents?></td>
          <td><?=$data->user_name?></td>
          <td><?=$data->hits?></td>
          <td><?=$data->reg_date?></td>
      </tr>
    </tbody>
    <tfoot>
    <tr>
    <th colspan='4'>
    	<a href="/codeigniter/board/lists/<?=$this->uri->segment(3);?>/page/<?=$this->uri->segment(7)?>" class='btn btn-primary'>목록</a>
    	<a href="/codeigniter/board/edit/<?=$this->uri->segment(3);?>/board_id/<?=$this->uri->segment(5)?>/page/<?=$this->uri->segment(7)?>" class='btn btn-warning'>수정</a>
    	<a href="/codeigniter/board/delete/<?=$this->uri->segment(3);?>/board_id/<?=$this->uri->segment(5)?>/page/<?=$this->uri->segment(7)?>" class='btn btn-danger'>삭제</a>
    	<a href="/codeigniter/board/write/<?=$this->uri->segment(3);?>/page/<?=$this->uri->segment(7)?>" class='btn btn-success'>쓰기</a>

    </th>
    </tr>
    </tfoot>
  </table>
</article>
