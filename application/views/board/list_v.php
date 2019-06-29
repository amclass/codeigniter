<article id="board_area">
  <header>
    <h1></h1>
  </header>
  <table cellspacing=0 cellpadding=0 class="table">
    <thead>
      <tr>
        <th scope="col">번호</th>
        <th scope="col">제목</th>
        <th scope="col">작성자</th>
        <th scope="col">조회수</th>
        <th scope="col">작성일</th>
      </tr>
    </thead>
    <tbody>
      <?
        foreach ($list as $key => $value) {
          ?>
          <tr>
              <th scope="row">
                <?=$value->board_id;?>
              </th>
              <td>
                <a role="extrenal" href="/<?=$this->uri->segment(1)?>/view/<?=$this->uri->segment(3)?>/<?=$value->board_id?>"><?=$value->subject?></a>
              </td>
              <td><?=$value->user_name?></td>
              <td><?=$value->hits?></td>
              <td><?=$value->reg_date?></td>
          </tr>
        <?}
      ?>
    </tbody>
  </table>
</article>
