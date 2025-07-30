 <!-- Modal delete -->
 <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class ="modal-content">
          <div class="modal-header">
              <h1 class="modal-title fs-5" id="EditModalLabel">Delete data</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" id="close_delete" aria-label="Close"></button>
            </div>
                      <div class="modal-body">
                        <form id="formdelete">
                            <div class="row col-md-12 mb-3">  
                                    <label for="kode_delete" class="col-sm-3 col-form-label">Kode Divisi</label>
                                    <div class="col-sm-3">
                                      <input disabled type="text" class="form-control"  name="kode_delete" id="kode_delete" value="" required>
                                    </div>
                            </div>
                            <div class="row col-md-12 mb-3">  
                                    <label for="div_delete" class="col-sm-3 col-form-label">Nama Divisi</label>
                                    <div class="col-sm-6">
                                      <input  disabled type="text" class="form-control "  name="div_delete" id="div_delete" value="" required>
                                    </div>
                            </div>
                          

                            <div class="col-sm-11 d-flex justify-content-end">
                                  <button  id="delete" class="btn btn-primary text-center me-1 md-3" data-bs-dismiss="modal" >Yes</button> 
                                <button  id="close_delete" type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                              </div>
                              
                        </form>
                      </div>
                    </div>
          </div>
        </div>
      <!-- end form delete  -->

    <script>
                 // delete data 
                 $(document).on("click",".open-delete",function(){
                  let row = jQuery(this).closest('tr');
                    let columns = row.find('td'); 
                
                    columns.addClass('row-highlight');
                    jQuery.each(columns, function(key, item) { 
                        switch(key){
                          case 0:
                      let kode = item.innerHTML;
                      $(".modal-body #kode_delete").val(kode);
                        break;
                        case 1:
                      let div = item.innerHTML;
                      $(".modal-body #div_delete").val(div);
                        break;
                      }
                    
                    });
                  
                


                });
                
                $("#delete").on("click",function(e){
                    e.preventDefault();
                    let kode = $("#kode_delete").val();
                
                    $.ajax({
                        url:"<?= base_url; ?>/divisi/deletedata",
                        type:"POST",
                        data:{kode:kode},
                            dataType:'json',                  
                        success: function(result){ 
                          let status = result.error;
                          Swal.fire({
                            position: 'top-center',
                          icon: 'success',
                          title: status,
                        
                          }); 
                          get_data_divisi();
                        }
                    
                    })
                });
                //end delete data
    </script>