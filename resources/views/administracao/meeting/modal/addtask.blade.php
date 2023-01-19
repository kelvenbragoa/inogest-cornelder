<div class="modal" id="exampleAddTask" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Adicionar Tarefas</h5>
          
          
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form method="POST" action="{{route('meetingtask.store')}}">
          @csrf
         
        <div class="modal-body">
          <div class="form-group">
              <label for="recipient-name" class="col-form-label">Interviniente:</label>
              <select type="text" class="form-control" id="participant_meeting_id" name="participant_meeting_id" placeholder="Nome" required>
                @foreach ($meeting->participants as $item)
                    <option value="{{$item->id}}">{{$item->name}} | {{$item->email}}</option>
                @endforeach
              </select>
          </div>

        

          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Quando:</label>
            <input type="date" class="form-control" id="when" name="when" placeholder="Observação">
          </div>

          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Oque:</label>
            <input type="text" class="form-control" id="what" name="what" placeholder="Observação">
          </div>
         

          
          <input type="hidden" class="form-control" id="meeting_id" name="meeting_id" value="{{$meeting->id}}"> 
          <input type="hidden" class="form-control" id="status" name="status" value="0"> 
          
        </div>
        <div class="modal-footer">
            
                
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('text.close')}}</button>
                <button type="submit" class="btn btn-info">{{__('text.submit')}}</button>
            </form>
          
        </div>
      </div>
    </div>
  </div>