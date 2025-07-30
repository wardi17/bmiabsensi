

      <!-- Modal  edit data  -->
      <div class="modal fade" id="EditModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class ="modal-content">
          <div class="modal-header">
              <h1 class="modal-title fs-5" id="EditModalLabel">Edit Data Gapok</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" id="close_edit" aria-label="Close"></button>
            </div>
                      <div class="modal-body">
                      <form  id ="formedit"  class ="form form-horizontal">
                        <div class="row col-md-12">
                        <input  type="hidden" class="form-control"  name="userid" id="userid" value="">
                          <div class="col-md-6">
                          <div class="row col-md-12 mb-3">  
                                    <label  for="nik" class="col-sm-2 col-form-label">NIK</label>
                                    <div  class="col-sm-6">
                                      <input disabled type="text" class="form-control"  name="nik" id="nik" value="" required>
                                    </div>
                            </div>
                            <div class="row col-md-12 mb-3">  
                                    <label  for="nama" class="col-sm-2 col-form-label">Nama</label>
                                    <div class="col-sm-8">
                                      <input disabled type="text" class="form-control"  name="nama" id="nama" value="" required>
                                    </div>
                            </div>
                            <div class="row col-md-12 mb-3">  
                                    <label  for="jabatan" class="col-sm-2 col-form-label">Jabatan</label>
                                    <div class="col-sm-4">
                                      <input disabled type="text" class="form-control"  name="jabatan" id="jabatan" value="" required>
                                    </div>
                            </div>
                          </div>
                          <div class="col-md-6">
                          <div class="row col-md-12 mb-3">  
                                    <label style="width:30% ;"  for="departemenName" class="col-sm-2 col-form-label">Departemen Nama</label>
                                    <div class="col-sm-8">
                                      <input disabled type="text" class="form-control"  name="departemenName" id="departemenName" value="" required>
                                    </div>
                            </div>
                          <div class="row col-md-12 mb-3">  
                                    <label style="width:30% ;" for="saleri" class="col-sm-2 col-form-label">Saleri</label>
                                    <div class="col-sm-6">
                                      <input  type="text" class="form-control"  name="saleri" id="saleri" value="" required>
                                    </div>
                            </div>
                            <div class="row col-md-12 mb-3">  
                                    <label style="width:30% ;"  for="status" class="col-sm-2 col-form-label">Status</label>
                                    <div style="width:25% ;" class="col-sm-4">
                                        <select class="form-select text-center" id="status">
                                          <option class="text-center" value="Y">Y</option>
                                          <option class="text-center" value="N">N</option>
                                        </select>
                                    </div>
                                   
                            </div>
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
      getmatauang();
   
                //edit data
            $(document).on("click","#open-edit",function(){
     
              $("#EditModal").modal("show");
            
              const userid = $(this).data("userid");
              const nama = $(this).data("name");
              const jabatan = $(this).data("title");
              const departemenName = $(this).data("departemenname");
              const departemenID = $(this).data("departemenID");
              const nik = $(this).data("nik");
             const status = $(this).data("status");
              const saleri = $(this).data("saleri");
             
              $(".modal-body #userid").val(userid);
              $(".modal-body #nama").val(nama);
              $(".modal-body #jabatan").val(jabatan);
              $(".modal-body #saleri").val(saleri);
              $(".modal-body #departemenName").val(departemenName);
              $(".modal-body #status").val(status).change();
              $(".modal-body #nik").val(nik);

      });
     //end edit data member divisi
     $("#Editdata").on("click",function(e){
                    e.preventDefault();
                  
      
        const userid = $("#userid").val();
        const status = $("#status").find(":selected").val();
        const pjn_saleri = $("#saleri").val();
        let rpc_saleri = pjn_saleri.replace(/\./g,"");
                    const datas ={
                      userid:userid,
                      status:status,
                      saleri:rpc_saleri
                    }
                    console.log(datas);

                    $.ajax({
                        url:"<?= base_url; ?>/gapok/editdata",
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
                            getTampilgapok();
                          }); 
                        
                      
                        }
                    });
                });
            //end edit
    //document ready
    });

  function getmatauang(){
  let rupiah_budget =  document.getElementById("saleri");

   rupiah_budget.addEventListener('keyup', function(e){
			// tambahkan 'Rp.' pada saat form di ketik
			// gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka

			rupiah_budget.value = formatRupiah(this.value);
		});
}
function formatRupiah(angka, prefix){
			var number_string = angka.replace(/[^,\d]/g, '').toString();
    
			split   		= number_string.split(','),
    
			sisa     		= split[0].length % 3,
			rupiah     		= split[0].substr(0, sisa),
			ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);

			// tambahkan titik jika yang di input sudah menjadi angka ribuan
			if(ribuan){
				separator = sisa ? '.' : '';
				rupiah += separator + ribuan.join('.');
			}

			rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
			return prefix == undefined ? rupiah : (rupiah ?  + rupiah : '');
	}
</script>