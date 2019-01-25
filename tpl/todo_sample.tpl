{foreach from=$todos item=task key=task_id}
<div class="alert alert-warning" role="alert">
  <h4 class="alert-heading">{$task.source} --- Due: {$task.due_date}</h4>
  <p style="text-decoration:underline;"  onclick="window.open('{$task.openurl}','','height='+screen.width*4/5+','+'width='+screen.width*4/5)">{$task.title}</p>
  <p>{$task.descrption}</p>
  <hr>
  <p class="mb-0">
    <a href="#" class="btn btn-success" onclick="update_task('done', {$task.id});">Done</a>
    <a href="#" class="btn {if $task.remind == ''} btn-warning {else}btn-light{/if}" onclick="update_task('remind', {$task.id});">Remind after</a>
    <select class="form form-control-sm" id="remind_duetime">
        <option value="0.5">30(min)</option>
        <option value="1">1(hr)</option>
        <option value="2">2(hr)</option>
        <option value="4">4(hr)</option>
      </select>
    </div>
 </p>
</div>
{/foreach}