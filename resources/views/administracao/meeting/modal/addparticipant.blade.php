<div class="modal" id="exampleAddEquipment" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Adicionar Intervinientes</h5>
          
          
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form method="POST" action="{{route('meetingparticipant.store')}}">
          @csrf
         
        <div class="modal-body">
          <div class="form-group">
              <label for="recipient-name" class="col-form-label">Nome:</label>
              <input type="text" class="form-control" id="name" name="name" placeholder="Nome" required>
          </div>

          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Email:</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
          </div>

       

          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Observação</label>
            <input type="text" class="form-control" id="obs" name="obs" placeholder="Observação">
          </div>
         

          <input type="hidden" class="form-control" id="status" name="status" value="0"> 
          <input type="hidden" class="form-control" id="meeting_id" name="meeting_id" value="{{$meeting->id}}"> 
          
        </div>
        <div class="modal-footer">
            
                
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('text.close')}}</button>
                <button type="submit" class="btn btn-info">{{__('text.submit')}}</button>
            </form>
          
        </div>
      </div>
    </div>
  </div>