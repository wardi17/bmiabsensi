

      <!-- Modal  edit data  -->
      <div class="modal fade" id="EditModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class ="modal-content">
          <div class="modal-header">
              <h1 class="modal-title fs-5" id="EditModalLabel">Edit data</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" id="close_edit" aria-label="Close"></button>
            </div>
                      <div class="modal-body">
                      <form  id ="formedit"  class ="form form-horizontal">
                        <div class="row col-md-12 mb-3">  
                                    <label for="kode_edit" class="col-sm-3 col-form-label">Kode Divisi</label>
                                    <div class="col-sm-3">
                                      <input disabled type="text" class="form-control"  name="kode_edit" id="kode_edit" value="" required>
                                    </div>
                            </div>
                            <div class="row col-md-12">  
                                    <label for="nama_edit" class="col-sm-3 col-form-label">Nama Divisi</label>
                                    <div class="col-sm-6">
                                      <input type="text" class="form-control"  name="nama_edit" id="nama_edit" value="" required>
                                    </div>
                            </div>
                      </div>
                              <div class="col-sm-11 d-flex justify-content-end">
                                          <button  type="submt" name="submit" class="btn btn-primary me-1 mb-3" data-bs-dismiss="modal" id="Editdata">Save</button>
                                          <button id="close_edit" type="button" class="btn btn-secondary me-1 mb-3" id="close" data-bs-dismiss="modal">Close</button>
                              </div>
                              
                        </form>
                      </div>
                    </div>
          </div>
      <!-- end modal edit -->

<script>
    $(document).ready(function(){

   
                //edit data
            $(document).on("click",".open-edit",function(){
                
                let row = jQuery(this).closest('tr');
                let columns = row.find('td'); 
                columns.addClass('row-highlight'); 
                jQuery.each(columns, function(key, item) { 
                    switch(key){
                      case 0:
                        let kode = item.innerHTML;
                        $(".modal-body #kode_edit").val(kode);
                        break;
                      case 1:
                        let nama = item.innerHTML;
                        $(".modal-body #nama_edit").val(nama);
                        break;
                      
                    }

          });
        

      });
     //end edit data member divisi
     $("#Editdata").on("click",function(e){
                    e.preventDefault();
                  
                    let  kode = $("#kode_edit").val();
                    let  nama = $("#nama_edit").val();
                    $.ajax({
                        url:"<?= base_url; ?>/divisi/editdata",
                        type:'POST',
                        dataType:'json',
                        data :{kode:kode,nama:nama},
                        success:function(result){
                          let status = result.error;
                          Swal.fire({
                            position: 'top-center',
                          icon: 'success',
                          title: status,
                          // showConfirmButton: false,
                          // timer: 500000
                          }); 
                          get_data_divisi();
                      
                        }
                    });
                });
            //end edit
    //document ready
    });
</script>