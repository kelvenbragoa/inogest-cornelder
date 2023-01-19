<div class="modal" id="waiting3" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Equipamento Acidentados</h5>
        
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="table-responsive">
          <table id="myTable1" class="table display" >
              <thead>
                  <tr>
                    
                      <th style="width:20%">Estado</th>
                      <th style="width:60%">Equipamentos</th>
                      <th>{{__('text.action')}}</th>
                  </tr>
              </thead>
              <tbody>
                  @foreach (\App\Models\Mcscr::where('waiting_id',3)->get() as $item)
                      <tr>
                        <td>@if ($item->status == 0) <span class="badge bg-danger">Em execução</span> @endif @if($item->status == 1) <span class="badge bg-success">Terminado</span> @endif @if($item->status == 2) <span class="badge bg-warning">Aguarda Aprovação</span> @endif</td>
                        <td>{{$item->equipment->name}} ({{$item->equipment->ref}})</td>
                          <td class="table-action">
                            
                              <a href="{{URL::to('/mcscr/'.$item->id)}}"><i class="align-middle" data-feather="eye"></i></a>
                           
                          </td> 
                      </tr>
                   
                  @endforeach
              </tbody>
          </table>
          </div>
      </div>
      <div class="modal-footer">
         
              <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('text.close')}}</button>
             
        
      </div>
    </div>
  </div>
</div>