

      <!-- Modal  edit data  -->
      <div class="modal fade" id="EditModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class ="modal-content">
          <div class="modal-header">
              <h1 class="modal-title fs-5" id="EditModalLabel">Edit Data Hari Kerja</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" id="close_edit" aria-label="Close"></button>
            </div>
                      <div class="modal-body">
                      <form  id ="formedit"  class ="form form-horizontal">
                        <div class="row col-md-12 mb-3">  
                                    <label for="tahun" class="col-sm-3 col-form-label">Tahun</label>
                                    <div  style="width:25%;" class="col-sm-2">
                                      <input disabled type="text" class="form-control"  name="tahun" id="tahun" value="" required>
                                    </div>
                            </div>
                            <div class="row col-md-12 mb-3">  
                                    <label for="bulan" class="col-sm-3 col-form-label">Bulan</label>
                                    <div class="col-sm-4">
                                      <input disabled type="text" class="form-control"  name="bulan" id="bulan" value="" required>
                                    </div>
                            </div>
                            <div class="row col-md-12">  
                                    <label for="lhk" class="col-sm-3 col-form-label">Hari Kerja</label>
                                    <div style="width:22%;" class="col-sm-2">
                                      <input  type="number" class="form-control"  name="lhk" id="lhk" value="" required>
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
            $(document).on("click","#open-edit",function(){
     
              $("#EditModal").modal("show")
                let row = jQuery(this).closest('tr');
                let columns = row.find('td'); 
                columns.addClass('row-highlight'); 
               
                jQuery.each(columns, function(key, item) { 
                    switch(key){
                      case 0:
                        let tahun = item.innerHTML;
                        $(".modal-body #tahun").val(tahun);
                        break;
                      case 1:
                        let bulan = item.innerHTML;
                        $(".modal-body #bulan").val(bulan);
                        break;
                        case 2:
                        let lhk = item.innerHTML;
                        $(".modal-body #lhk").val(lhk);
                        break;
                    }

          });
        

      });
     //end edit data member divisi
     $("#Editdata").on("click",function(e){
                    e.preventDefault();
                  
                    let  tahun = $("#tahun").val();
                    let  bulan = $("#bulan").val();
                    let  lhk = $("#lhk").val();

                    const datas ={
                      tahun:tahun,
                      bulan:bulan,
                      lhk:lhk
                    }
                    $.ajax({
                        url:"<?= base_url; ?>/harikerja/editdata",
                        type:'POST',
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
                        data :datas,
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
                    });
                });
            //end edit
    //document ready
    });
</script>