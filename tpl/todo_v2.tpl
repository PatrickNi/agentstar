<html>
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <title>Agent Star - TODO</title>
  </head>
  <body>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

    <div class="container">
        <div class="row">
            <div class="col-sm-8">
                {foreach from=$todos item=task key=task_id}
                <div class="card border-secondary mb-3" remind="{$task.remind}">
                  <div class="card-header">{$task.source} --- Due: {$task.due_date}</div>
                  <div class="card-body text-secondary">
                    <h5 class="card-title" style="text-decoration:underline;" onclick="window.open('{$task.openurl}','','height='+screen.width*4/5+','+'width='+screen.width*4/5)">{$task.title}</h5>
                    <p class="card-text">{$task.descrption}.<br/>
                     <small> Begin date: {$task.begin_date} </small>
                    </p>
                      <a href="#" class="btn btn-success" onclick="update_task('done', {$task.id});">Done</a>
                      <a href="#" class="btn {if $task.remind == ''} btn-warning {else}btn-light{/if}" onclick="update_task('remind', {$task.id});">Remind after 4h</a>
                  </div>
                </div>
                {/foreach}
            </div>
            <div class="col-sm-4">
                <ul class="list-group">
                      <li class="list-group-item d-flex justify-content-between align-items-center {if $source eq ''} list-group-item-primary {/if}">
                        <a href="/scripts/todo_v2.php" >All Tasks</a>
                        <span class="badge badge-primary badge-pill">{$filters.ALL}</span>
                      </li>
                      <li class="list-group-item d-flex justify-content-between align-items-center  {if $source eq 'visa'} list-group-item-primary {/if}">
                        <a href="/scripts/todo_v2.php?src=visa" >Visa Process</a>
                        <span class="badge badge-primary badge-pill">{$filters.visa}</span>
                      </li>
                      <li class="list-group-item d-flex justify-content-between align-items-center  {if $source eq 'course'} list-group-item-primary {/if}">
                        <a href="/scripts/todo_v2.php?src=course" >Course Process</a>
                        <span class="badge badge-primary badge-pill">{$filters.course}</span>
                      </li>
                      <li class="list-group-item d-flex justify-content-between align-items-center  {if $source eq 'expire_main'} list-group-item-primary {/if}">
                        <a href="/scripts/todo_v2.php?src=expire_main" >Main Visa Expired</a>
                        <span class="badge badge-primary badge-pill">{$filters.expire_main}</span>
                      </li>
                      <li class="list-group-item d-flex justify-content-between align-items-center  {if $source eq 'expire_apply'} list-group-item-primary {/if}">
                        <a href="/scripts/todo_v2.php?src=expire_apply" >Apply Visa Expired</a>
                        <span class="badge badge-primary badge-pill">{$filters.expire_apply}</span>
                      </li>                                            
                    </ul>
             </div>
        </div>
    </div>
  </body>

  <!-- Modal -->
<div class="modal fade" id="remind_pannel" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-body">
      </div>
    </div>
  </div>
</div>

{literal}
<script type="text/javascript">
    Date.prototype.format = function(format) {
       var date = {
              "M+": this.getMonth() + 1,
              "d+": this.getDate(),
              "h+": this.getHours(),
              "m+": this.getMinutes(),
              "s+": this.getSeconds(),
              "q+": Math.floor((this.getMonth() + 3) / 3),
              "S+": this.getMilliseconds()
       };
       if (/(y+)/i.test(format)) {
              format = format.replace(RegExp.$1, (this.getFullYear() + '').substr(4 - RegExp.$1.length));
       }
       for (var k in date) {
              if (new RegExp("(" + k + ")").test(format)) {
                     format = format.replace(RegExp.$1, RegExp.$1.length == 1
                            ? date[k] : ("00" + date[k]).substr(("" + date[k]).length));
              }
       }
       return format;
  }

  function update_task(act, id){
      var postdata = {'act':act, 'id':id}
      if (act == "remind") {
          var newDate = new Date();
          newDate.setTime(Date.parse(new Date()) + 4 * 3600 * 1000);
          postdata['dt'] =  newDate.format('yyyy-MM-dd h:m:s');
      }

       $.ajax({ 
                url: '/scripts/todo_v2.php',
                dataType: 'json',
                method: 'POST',
                data: postdata,
                success: function(rtn) {
                            alert("Operation sucess, refresh page soon!");
                            if (rtn.succ == 1) {
                                location.reload();                          }
                            else {
                                alert('Operated Failed!');
                            }
                         }
        });
  }

  function remind_task() {
      var cur_timestamp = Date.parse(new Date())/1000;
      $("[remind]").each(function(){
          if ($(this).attr("remind") != '') {
              var task_timestamt = Date.parse(new Date($(this).attr("remind")))/1000;
              if (task_timestamt <= cur_timestamp) {
                  $(".modal-body").html($(this).html());
                  $("#remind_pannel").modal('show');
              }
          }
      });
  }
  setTimeout("remind_task()", 300000);
</script>
{/literal}  
</html>