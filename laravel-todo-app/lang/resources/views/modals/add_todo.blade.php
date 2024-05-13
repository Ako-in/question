{{-- タグの編集用モーダル --}}
@include('modals.edit_tag');
{{-- タグの削除用モーダル --}}
@include('modals.delete_tag');


<div class="modal fade" id="addTodoModal{{$goal->id}}" tabindex="-1" aria-labelledby="addTodoModalLabel">
  <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="addTodoModalLabel{{$goal->id}}">ToDoの追加</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="閉じる"></button>
          </div>
          
          <form action="{{ route('goals.todos.store',$goal) }}" method="post">
              @csrf
              <div class="modal-body">
                  <input type="text" class="form-control" name="content">
                  <div class="d-flex flex-wrap">
                    @foreach($tags as $tag)
                      <div class="d-flex align-items-center mt-3 me-3">
                        <button type="button" class="btn btn-secondary"data-bs-toggle="modal"data-bs-target="#editTagModal"data-bs-dismiss="modal" data-tag-id="{{$tag->id}}" data-tag-name="{{$tag->name}}">{{$tag->name}}></button>
                        <button type="button" class="btn btn-close ms-1"arial-label="削除"data-bs-toggle="modal"data-bs-target="#deleteTagModal"data-bs-dismiss="modal" data-tag-id="{{$tag->id}}" data-tag-name="{{$tag->name}}"></button>
                      </div>
                    @endforeach  
                    </div>
              </div>
              <div class="modal-footer">
                  <button type="submit" class="btn btn-primary">登録</button>
              </div>
          </form>
      </div>
  </div>
</div>
