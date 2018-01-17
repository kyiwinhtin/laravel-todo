@extends('layout.app')

@section('content')

    <div class="row">
        <div class="col-lg-6 col-lg-offset-3">
            <form action="{{ route('todo.store') }}" method="POST">
                {{ csrf_field() }}
                <input type="text" class="form-control input-lg" name="todo" placeholder="Create a new todo">
                <button class="btn btn-success">Save</button>
            </form>
        </div>
    </div>
    @foreach($todos as $todo)

    <div class="posts" style="display: inline-block;">
        <p id="title">{{ $todo->todo }}</p>
        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal" id="getButton" value="{{ $todo->id }}">
        Edit
        </button>
        <a href="{{ route('todo.delete',$todo->id) }}" class="btn btn-danger">x</a>
        <br>
    </div>
    @endforeach

    <!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" id="update" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>


<script>

    $(document).ready(function(event){


         $('.posts').on('click','#getButton',function(event){
            $('.appended').remove();
            event.preventDefault();
            getId = $(this).val();
            dataTodo = $(this).siblings('#title');
            var data = $(this).siblings('#title').text();
            var display = $('.modal-body').html();
            $('.modal-body').prepend("<form class='appended'><input type='text' name='todo' id='todo' value='"+ data+"'>"+" <input type='hidden' name='_token' value='{{ csrf_token() }}' id='token'></form>");

         });


            $('#update').on('click',function(e){
                e.preventDefault();
                var geturl = "{{ route('ajax.get',':id') }}";
                geturl = geturl.replace(":id",getId);
                $.ajax({
                    url: geturl,
                    type: 'POST',
                    dataType: 'JSON',
                    data: {todo: $('#todo').val(),_token : $('#token').val() },
                })
                .done(function(data) {
                    console.log(data);
                    dataTodo.text(data.todo);
                })
                .fail(function() {
                    console.log("error");
                })
                .always(function() {
                    console.log("complete");
                });

            })
    });
</script>
@stop
