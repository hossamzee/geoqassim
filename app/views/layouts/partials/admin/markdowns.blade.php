
<script type="text/javascript">

$(function(){

  $("textarea").keydown(function(e) {

      if(e.keyCode === 9) { // tab was pressed
          // get caret position/selection
          var start = this.selectionStart;
          var end = this.selectionEnd;

          var $this = $(this);
          var value = $this.val();

          // set textarea value to: text before caret + tab + text after caret
          $this.val(value.substring(0, start)
                      + "\t"
                      + value.substring(end));

          // put caret at right position again (add one for the tab)
          this.selectionStart = this.selectionEnd = start + 1;

          // prevent the focus lose
          e.preventDefault();
      }
  });

});

function insertLink()
{
  $('#content').val($('#content').val() + '= رابط (النص) (الرابط)');
}

function insertTable()
{
  $('#content').val($('#content').val() + '\r\n\r\n= جدول\r\n- العمود الأول\tالعمود الثاني\t\r\n- الخلية الأولى\tالخلية الثانية');
}

function insertList()
{
  $('#content').val($('#content').val() + '\r\n\r\n= قائمة\r\n- العنصر الأول\r\n- العنصر الثاني');
}

</script>

<div class="col-md-12">
  <div class="form-group">
    <a href="#" class="btn btn-default" onclick="insertLink()"><i class="fa fa-link"></i> رابط</a>
    <a href="#" class="btn btn-default" onclick="insertTable()"><i class="fa fa-table"></i> جدول</a>
    <a href="#" class="btn btn-default" onclick="insertList()"><i class="fa fa-list-ul"></i> قائمة</a>
  </div>
</div>
