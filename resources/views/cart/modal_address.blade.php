<!-- Modal -->
<div class="modal fade" id="addressModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add new address</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-group">
            <label>Province</label>
            <select class="form-control" id="province">
              <option value="0" disabled selected> Select Province</option>
              @foreach($provinces as $province)
                <option value="{{$province->province_id}}" region_id="{{$province->region_id}}">{{$province->name}}</option>
              @endforeach
              </select>
          </div>

          <div class="form-group">
            <label>City/Municipality</label>
            <select class="form-control" id="municipality" >
              <option value="0" disabled selected> Select City/Municipality</option>
              </select>
          </div>
          <div class="form-group">
            <label>Barangay</label>
            <input type="text" id="barangay" class="form-control">
          </div>
          <div class="form-group">
            <label>Building, House/Lot No, Street, and etc.</label>
            <input type="text" class="form-control" id="other_details">
          </div>
          <div class="form-check">
            
            <input type="checkbox" class="form-check-input" value="1" id="set_default">
            <label class="form-check-label" for="set_default">Set as default shipping address</label>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary save_address">Save changes</button>
      </div>
    </div>
  </div>
</div>