<div class="modal" id="exampleViewEquipment{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Lista dos Equipamentos Fornecidos</h5>
          
          
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
     
         
        <div class="modal-body">
        
         @foreach ($item->items as $item)
         <div style="background: rgb(236, 236, 236)">
         <p>Equipamento:{{$item->equipment->name ?? ''}}</p>
         <p>Referência:{{$item->equipment->ref ?? ''}}</p>
         <p>Operador:{{$item->user_operador_id ?? ''}}</p>
         <p>Moves:{{$item->moves ?? ''}}</p>
         <p>Toneladas:{{$item->tons ?? ''}} ton</p>
         <p>Combustivel:{{$item->petrol ?? ''}} Litros</p>
        </div>
        <br>
        
         @endforeach
      
          
        </div>
      </div>
    </div>
  </div>