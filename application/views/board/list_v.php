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
      <?
    foreach ($list as $key => $value) {
        ?>
          <tr>
              <th scope="row">
                <?=$value->board_id;?>
              </th>
              <td>
                <a role="extrenal" href="/codeigniter/<?=$this->uri->segment(1)?>/view/<?=$this->uri->segment(3)?>/board_id/<?=$value->board_id?>/page/<?=$this->uri->segment(5)?>"><?=$value->subject?></a>
              </td>
              <td><?=$value->contents?></td>
              <td><?=$value->user_name?></td>

              <td><?=$value->hits?></td>
              <td><?=$value->reg_date?></td>
          </tr>
        <?
    }
    ?>
    </tbody>
    <tfoot>
      <tr>
        <td colspan='5'><?=$pagination;?></td>
      </tr>
    </tfoot>
  </table>
  <div>
    <form id="bd_search" method="post" >
      <input type='text' name='search_word' id="q" onkeypress="board_search_enter(document.q)"/>
      <input type='button'  value="검색" id='search_btn'/>
    </form>
  </div>
</article>
