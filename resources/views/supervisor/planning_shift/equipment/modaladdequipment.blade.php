<div class="modal" id="exampleAddEquipment" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Adicionar Requisição de Equipamento</h5>
          
          
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form method="POST" action="{{route('equipmentplanning.store')}}">
          @csrf
         
        <div class="modal-body">
          <div class="form-group">
              <label for="recipient-name" class="col-form-label">Equipamento:</label>
              <select type="text" class="form-control" id="type_equipment_id" name="type_equipment_id" placeholder="Brigada" required>
                @foreach (\App\Models\TypeEquipment::orderBy('name','asc')->get() as $item)
                <option value="{{$item->id}}">{{$item->name}}</option>
                @endforeach
            </select>
          </div>

          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Quantidade:</label>
            <input type="number" class="form-control" id="qtd" name="qtd" placeholder="Quantidade requisitada" required>
          </div>

          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Observação:</label>
            <input type="text" class="form-control" id="obs" name="obs" placeholder="Observação">
          </div>
         

          
          <input type="hidden" class="form-control" id="scheduled_shift_id" name="scheduled_shift_id" value="{{$planning->id}}"> 
          <input type="hidden" class="form-control" id="status" name="status" value="0"> 
          <input type="hidden" value="{{Auth::user()->terminal_id}}" class="form-control" name="terminal_id" id="terminal_id" required > 
        </div>
        <div class="modal-footer">
            
                
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('text.close')}}</button>
                <button type="submit" class="btn btn-info">{{__('text.submit')}}</button>
            </form>
          
        </div>
      </div>
    </div>
  </div>