
<div class="modal" id="editEquipment{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Equipamento - {{$item->equipment->name ?? ''}}  </h5>
        <?php 
        $operator=$item->user_operator_id;
        ?>
        
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST" action="{{route('equipmentitem-supervisor.update',$item->id)}}">
        @csrf
        @method('PATCH')
       
      <div class="modal-body">
        <div class="form-group">
            <label for="recipient-name" class="col-form-label">Equipamento:</label>
            <input type="text" class="form-control" readonly value="{{$item->equipment->name ?? ''}}" placeholder="Equipamento" required>
        </div>

        <div class="form-group">
          <label for="recipient-name" class="col-form-label">Referência:</label>
          <input type="text" class="form-control" readonly value="{{$item->equipment->ref ?? ''}}" placeholder="Referencia" required>
      </div>


      <div class="form-group">
        <label for="recipient-name" class="col-form-label">Operador:</label>
         @if($item->user_operator_id == null)
             <select type="text" class="form-control" id="user_operator_id" name="user_operator_id" placeholder="Brigada">
                
                
               
              <option value="">Selecionar</option>
              @foreach (\App\Models\OperatorBrigadeScheduledShift::where('shift_id',$planning->id)->where('status',0)->get() as $item)
              <option value="{{$item->user->id}}" @if ($item->user->id == $operator ) selected @endif>{{$item->user->name}}</option>
              @endforeach
            </select>
                
        @else
            <input type="text" class="form-control" readonly value="{{$item->user->name ?? ''}}" placeholder="Referencia" required>
            <input type="hidden" class="form-control" name="user_operator_id" readonly value="{{$item->user_operator_id ?? ''}}" placeholder="Referencia" required>
        @endif
        
        
    </div>
        <div class="form-group">
          <label for="recipient-name" class="col-form-label">Combustivel:</label>
          <input type="text" value="{{$item->petrol}}" class="form-control" id="petrol" name="petrol" placeholder="Combustivel(Litros)" >
        </div>

        <div class="form-group">
          <label for="recipient-name" class="col-form-label">Moves:</label>
          <input type="text" value="{{$item->moves}}" class="form-control" id="moves" name="moves" placeholder="Moves" >
        </div>

        <div class="form-group">
          <label for="recipient-name" class="col-form-label">Toneladas:</label>
          <input type="text" value="{{$item->ton}}" class="form-control" id="ton" name="ton"  placeholder="Toneladas">
        </div>
        
         <div class="form-group">
          <label for="recipient-name" class="col-form-label">Kilometragem:</label>
          <input type="text" value="{{$item->km}}" class="form-control" id="km" name="km" placeholder="Kilometragem">
        </div>
       

        
      
      </div>
      <div class="modal-footer">
          
              
              <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('text.close')}}</button>
              <button type="submit" class="btn btn-info">{{__('text.submit')}}</button>
          </form>
        
      </div>
    </div>
  </div>
</div>