<div class="modal" id="exampleAdd" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Adicionar Operador ao turno na  {{$brigade_planning->brigade->name}}</h5>
          
          
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form method="POST" action="{{route('operatorplanning.store')}}">
          @csrf
         
        <div class="modal-body">
          <div class="form-group">
              <label for="recipient-name" class="col-form-label">Operador:</label>
              <select type="text" class="form-control" id="user_id" name="user_id" placeholder="Brigada" required>
                @foreach (\App\Models\User::where('role_id',6)->orderBy('code','asc')->get() as $item)
                <option value="{{$item->id}}">{{$item->code}}-{{$item->name}}</option>
                @endforeach
            </select>
          </div>
         

          
          <input type="hidden" class="form-control" id="scheduled_shift_id" name="scheduled_shift_id" value="{{$brigade_planning->id}}"> 
        </div>
        <div class="modal-footer">
            
                
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('text.close')}}</button>
                <button type="submit" class="btn btn-info">{{__('text.submit')}}</button>
            </form>
          
        </div>
      </div>
    </div>
  </div>