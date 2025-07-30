      <!-- Modal  tambah baru -->
      <div class="modal fade" id="TambaModal" tabindex="-1" aria-labelledby="TambahModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="tambahModalLabel">Tambah data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" id="close_tambah" aria-label="Close"></button>
              </div>
              <div class="modal-body">
              <form  id ="formtambah"  class ="form form-horizontal">
                          <div class="row col-md-12 mb-3">  
                                      <label for="kode_divisi" class="col-sm-2 col-form-label">Tahun</label>
                                      <div class="col-sm-3">
                                          <select class ="form-control" id="tahuntambah"></select>
                                      </div>
                              </div>
                              
                              </div>
                                  <div class="col-sm-11 d-flex justify-content-end">
                                          <button  type="submit" name="submit" class="btn btn-primary me-1 mb-3" data-bs-dismiss="modal" id="Createdata">Save</button>
                                          <button type="button" class="btn btn-secondary me-1 mb-3" data-bs-dismiss="modal"  id="close_tambah2" >Close</button>
                                        </div>
            </form>
              </div>
      </div>
      </div>
      <!-- end modal tambah -->
<script>
        //tambah data
        $("#Createdata").on('click',function(e){
                e.preventDefault();
            
                let tahun = $("#tahuntambah").find(":selected").val();
                
                $.ajax({
                  url:'<?= base_url; ?>/harikerja/tambahhk',
                  method:'POST',
                  data:{tahun:tahun},
                  cache:true,
                  dataType:'json',
                  beforeSend: function(){
                      Swal.fire({
                        title: 'Loading',
                        html: 'Please wait...',
                        allowEscapeKey: false,
                        allowOutsideClick: false,
                        didOpen: () => {
                        Swal.showLoading()
                    }
                        });
                    },
                  success:function(result){
                    let status = result.error;
                    Swal.fire({
                            position: 'top-center',
                          icon: 'success',
                          title: status,
                          showConfirmButton: false,
                          timer: 500,
                          }).then(function(){ 
                            getTampilhk(tahun);
                          }); 
                  }  
                })
              });
              //end tambah data
</script>