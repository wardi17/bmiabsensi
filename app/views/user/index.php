<div id="main">
    <div class="col-md-12-col-12">
      <div class="card">
        <div class="card-header">
          <h5>Data Absensi</h5>
          <div class="card-body">
          <button  type="btn" name="btn" id="getdatuser"  class="btn btn-primary">getdataUser</button>

                      <!-- <div class="col-md-10 row">
                        <div class="row col-md-4 mb-3">
                                <label  style="width:35%;" class="col-sm-2 col-form-label" >Date From</label>
                                    <div class ="col-md-6">
                                       <input type="date" class="datepicker_input form-control" id="tgl_from" name="tgl_from">
                                    </div>
						              </div>
                            <div class="row col-md-4 mb-3">
                                    <label style="width:35%;" class="col-sm-2 col-form-label">Date To:</label>
                                    <div class = "col-md-6">
                                       <input type="date" class="datepicker_input form-control" id="tgl_to" name="tgl_to">
                                    </div>
                            </div>
                           <div class=" col-md-2 mb-3">
                              <button  type="btn" name="sumbit" id="filterdata"  class="btn btn-primary">Submit</button>
                            </div>
                      </div> -->
          </div>
        </div>
      </div>
    </div>
</div>



<script>  
 $(document).ready(function(){

    //gettanggal();

   $("#getdatuser").on("click",function(even){
    even.preventDefault();
    $.ajax({
                  url:"<?=base_url?>/user/setdatauser",
                  //data:{tgl_from:tgl_from,tgl_to:tgl_to},
                  method:"POST",
                  dataType: "json",
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
                    Swal.fire({
                      position: 'top-center',
                      icon: "success",
                      showConfirmButton: true,
                       //timer: 1500,
					          title: result,
                    }).then(function(){ 
                      
                    });
                     
  
                  }
      });
    
    

   })
})

function  gettanggal(){
	  let currentDate = new Date();
    // Mengatur tanggal pada objek Date ke 1 untuk mendapatkan awal bulan
    currentDate.setDate(1);
    // Membuat format tanggal YYYY-MM-DD
    let formattedDate = currentDate.toISOString().slice(0,10);
    // Menampilkan hasil
    $("#tgl_from").val(formattedDate);
	
    let d = new Date();
      let month = d.getMonth()+1;
      let day = d.getDate();
      let  output =  d.getFullYear() +'-'+
					(month<10 ? '0' : '') + month + '-' +
				 (day<10 ? '0' : '') + day;
    $("#tgl_to").val(output);
}




	function kirimdata(tgl_from,tgl_to){

    
		$.ajax({
                  url:"<?=base_url?>/exporddata/kirimdata",
                  data:{tgl_from:tgl_from,tgl_to:tgl_to},
                  method:"POST",
                  dataType: "json",
                  // beforeSend: function(){
                  //     Swal.fire({
                  //       title: 'Loading',
                  //       html: 'Please wait...',
                  //       allowEscapeKey: false,
                  //       allowOutsideClick: false,
                  //       didOpen: () => {
                  //       Swal.showLoading()
                  //   }
                  //       });
                  //   },
                  success:function(result){
                    Swal.fire({
                      position: 'top-center',
                      icon: "success",
                      showConfirmButton: true,
                       //timer: 1500,
					          title: result,
                    }).then(function(){ 
                      
                    });
                     
  
                  }
      });
	}
</script>


</body>
</html>