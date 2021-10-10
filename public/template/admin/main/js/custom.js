
//CHANGE STATUS
function changeStatus(url){
    $.get(url, function(data){

        var element = 'a#status-' + data[0];
        var classRemove = 'state publish';
        var classAdd    = 'state unpublish';
        if(data[1]==1){
            classRemove = 'state unpublish';
            classAdd    = 'state publish';
        }
        $(element).attr('href', "javascript:changeStatus('" +data[2]+ "')");
        $(element + ' span').removeClass(classRemove).addClass(classAdd);

        


    }, 'json');//thêm json để trả về 1 đối tượng
}

//CHANGE GROUPACP
function changeGroupACP(url){
    $.get(url, function(data){

        var element = 'a#groupACP-' + data[0];
        var classRemove = 'state publish';
        var classAdd    = 'state unpublish';
        if(data[1]==1){
            classRemove = 'state unpublish';
            classAdd    = 'state publish';
        }
        $(element).attr('href', "javascript:changeGroupACP('" +data[2]+ "')");
        $(element + ' span').removeClass(classRemove).addClass(classAdd);

        


    }, 'json');//thêm json để trả về 1 đối tượng
}

//CHECKBOX
$(document).ready(function(){
   $( "input[name='checkall-toggle']" ).change(function() {
      var checkStatus = this.checked;
      $('#adminForm').find(':checkbox').each(function(index, el) {
          this.checked = checkStatus;
      });
    }); 


  //TIỀM KIẾM
   $('#filter-bar button[name=submit_keyword]').click(function(){
      $('#adminForm').submit();  
   });
     // XÓA KEY WORD
   $('#filter-bar button[name=clear_keyword]').click(function(){
      $('#filter-bar input[name=filter_search]').val('');
      $('#adminForm').submit();  
   });

   $('#filter-bar select[name=filter_state]').change(function(){
      $('#adminForm').submit();  
   });

   $('#filter-bar select[name=filter_group_id]').change(function(){
      $('#adminForm').submit();  
   });

   $('#filter-bar select[name=filter_category_id]').change(function(){
      $('#adminForm').submit();  
   });








});



// SẮP XẾP KHI ẤN VÀO MENU
function sortList(column, order){
  $('input[name=filter_column]').val(column);
  $('input[name=filter_column_dir]').val(order);
  $('#adminForm').submit();
}



//submit form: publish unpublish 1 hoặc nhiều phần tử
function submitForm(url){

      $('#adminForm').attr('action', url);
      $('#adminForm').submit();  
}

//submit form: phan trang
function changePage(page){
  
  $('input[name=filter_page]').val(page);
  $('#adminForm').submit();
}

