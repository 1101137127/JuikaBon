function Newslettersjs() {
    var self = this;

    this.Insert = function(){
      $mess_name=$('#mess_name').val();
      $mess_text=$('#mess_text').val();
      $.ajax({
      url: "./model/DoInsertNewsletters.php", 
      type:"POST",
      data: $('#Insert_form').serialize(),
      datatype:"text",//回傳的資料型態
      success: function(data){
              if(data==true)
              {
                  document.location.href="../home/home.php";
              }
              else
              {
                  location.reload();
              }
          },
          error:function(xhr, ajaxOptions, thrownError){ 
                    console.log(xhr.status); 
                    console.log(thrownError);
                 }

        });
    }
}
var InsertNewsletters = new Newslettersjs();



