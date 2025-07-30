<style>

  #tabelwa1_filter{ 
    padding-bottom: 20px !important;
  }


</style>
<div id="main">
    <div class="col-md-12-col-12">
      <div class="card">
        <div class="card-header">
          <h5>Data Absensi Masalah</h5>
          <div class="card-body">
                <div class="col-md-12 row">
                      <div style="width:18%;" class="row col-md-3 mb-2">  
                                <label style="width:45%;" for="selectahun" class="col-sm-2 col-form-label">Tahun</label>
                                <div style="width:50%;" class="col-sm-4">
                                
                                  <select class ="form-control" id="selectahun"></select>                             
                              </div>
                      </div>  
                      <div style="width:20%;" class="row col-md-3">  
                                <label style="width:30%;" for="selecbulan" class="col-sm-2 col-form-label">Bulan</label>
                                <div  style="width:60%;" class="col-sm-6">
                                  <select class ="form-control" id="selecbulan"></select>                                
                                </div>
                        </div>
                        <!-- <div  style="width:8%;" class="row col-md-2 col-form-label">
                            <div id="harikerja"></div>
                          </div>
                        <div style="width:20%;" class="row col-md-3">
                                <label  style="width:28%;" class="col-sm-2 col-form-label">From</label>
                                    <div  style="width:70%;" class ="col-md-6">
                                       <input type="date" class="datepicker_input form-control" id="tgl_from" name="tgl_from">
                                    </div>
						              </div>
                         
                            <div style="width:20%;" class="row col-md-4">
                                    <label style="width:20%;" class="col-sm-2 col-form-label">To:</label>
                                    <div style="width:70%;" class = "col-md-6">
                                       <input type="date" class="datepicker_input form-control" id="tgl_to" name="tgl_to">
                                    </div>
                            </div> -->
                           <div class=" col-md-2 mb-3">
                              <button  type="btn" name="sumbit" id="filterdata"  class="btn btn-primary">Submit</button>
                            </div>
                      </div>

                      <div id="tabelabsensi"></div>
          </div>
        </div>
      </div>
    </div>

    <!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="DetailUserModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
    <div class="modal-content"> 
      <div class="modal-header">
        <h5 class="modal-title" id="modal_1Label">Detail Absen masalh</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"  aria-label="Close"></button>
    
      </div>
      <div class="modal-body">
      
        <!-- batas tabel -->
        <div id="tabelfullabmasalah"></div>
      </div>
      <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- end modal  -->
</div>

<script>  
 $(document).ready(function(){
 
    get_tahun();
    get_bulan();
    gettanggal();
    getdata();


   $("#filterdata").on("click",function(even){
    even.preventDefault();
    const tahun = $("#selectahun").find(":selected").val();
    const bulan = $("#selecbulan").find(":selected").val();

      const datas ={
        tahun:tahun,
        bulan:bulan
      }

       getDataAbMasalah(datas)
     
   })

   $(document).on("click","#UserMasalah",function(){
        let tahun = $(this).data('tahun');
        let bulan = $(this).data('bulan');
        let userid = $(this).data('userid');
        $("#DetailUserModal").modal("show");
        headeruserdetail();
        const datas ={
          tahun:tahun,
          bulan:bulan,
          userid
        }
        $.ajax({
              url:"<?=base_url?>/exporddata/getabsenisbyid",
              data:datas,
              method:"POST",
              dataType: "json",
              success:function(result){
                  datatabelmsluser(result);
                  
              }

            });
   })

})  //batas document ready




function getdata(){

  const tahun = $("#selectahun").find(":selected").val();
  const bulan = $("#selecbulan").find(":selected").val();
  const datas ={
    tahun:tahun,
    bulan:bulan
  }

  getDataAbMasalah(datas);
}

function getDataAbMasalah(datas){
              $.ajax({
              url:"<?=base_url?>/exporddata/getabmasalah",
              data:datas,
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
                      showConfirmButton: false,
                       timer: 100,
					          //title: result,
                    }).then(function(){ 
                      headerAbesensi();
                      showdatatabel(result);
                    });
                
              }

            });
}


function headerAbesensi(){

let tabel =`<table id="tabelwa1" class="display table-info" style="width:100%">                    
                                  <thead  id='thead'class ='thead'>
                                  <tr>      
                                            <th>Userid</th>
                                             <th>Nama</th>
                                             <th>Departemen Name</th>
                                             <th>SSN</th>
                                             <th>Total Tidak Absensi</th>
                                                  
                                  </tr>
                                  </thead>
                                  <tbody>
                                  </tbody>
                              </table>`;
      $("#tabelabsensi").empty().html(tabel);

}


function showdatatabel(result){
$('#tabelwa1').DataTable({
        response:true,
        pageLength: 5,
        lengthMenu: [[5, 10, 20, -1], [5, 10, 20, 'All']],
              fixedColumns:   {
                 // left: 1,
                  right: 1
              },
        select: {
            style:    'multi',
            selector: 'td:first-child'
        },
            "order":[[0,'asc']],
          data: result,
                    columns: [
                      { 'data': 'UserId'},
                      {
                                 'data': 'nama', className: "text-start", 
                                "render": function(data,type,row){
                                  
                                let userid = row.UserId;
                                const tahun = $("#selectahun").find(":selected").val();
                                const bulan = $("#selecbulan").find(":selected").val();
     
                                if(type === 'display'){
                                                html = `<span type="button" style="cursor:pointer" id="UserMasalah"
                                                data-userid="${userid}" data-bulan="${bulan}" data-tahun="${tahun}"">${data}</span>`;
                                                }
                                            return html
                                },
                              },
                       
                        { 'data': 'departemenName'},
                        { 'data': 'SSN' },
                        {'data':'tidakabsens'},

                    ],
              
      });  
}



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

    const tahun = d.getFullYear();
    $("#selectahun").val(tahun);
    $("#selecbulan").val(month);

}



 

  function get_tahun(){
      let startyear = 2020;
      let date = new Date().getFullYear();
      let endyear = date + 2;

      const selectahun =$("#selectahun");
      //selectahun.prepend('<option disabled="disabled">My disabled Option</option>');
      for(let i = startyear; i <=endyear; i++){
        let selected = (i !== date) ? 'selected' : date; 
        selectahun.append($(`<option />`).val(i).html(i).prop('selected', selected));

      }
    }
    function get_bulan(){
        let seletBulan = $("#selecbulan");
        const namaBulan = [
          { key: 1, value: 'Januari' },
          { key: 2, value: 'Februari' },
          { key: 3, value: 'Maret' },
          { key: 4, value: 'April' },
          { key: 5, value: 'Mai' },
          { key: 6, value: 'Juni' },
          { key: 7, value: 'Juli' },
          { key: 8, value: 'Agustus' },
          { key: 9, value: 'September' },
          { key: 10, value: 'Oktober' },
          { key: 11, value: 'November' },
          { key: 12, value: 'Desember' }
        ];
      
        $.each(namaBulan, function(index, month) {
          seletBulan.append($('<option></option>').attr('value', month.key).text(month.value));
        });
    }





  function  tampildatauserabsensi(result){
    headerAbesensi();
    showdatatabel(result);
  }




    function headeruserdetail(){
      const tabelid =$("#tabelfullabmasalah");
       tabel =`<table id="tabelwabyid" class="display table-info" style="width:100%">                    
                                  <thead  id='thead'class ='thead'>
                                  <tr>      
                                            <th>Userid</th>
                                             <th>Nama</th>
                                             <th>Departemen Name</th>
                                             <th>Masuk</th>
                                             <th>Pulang</th>    
                                  </tr>
                                  </thead>
                                  <tbody>
                                  </tbody>
                              </table>`;
        tabelid.empty().html(tabel);
    }
    function  datatabelmsluser(result){

      $tabel =``;
 
        $('#tabelwabyid').DataTable({
        response:true,
        pageLength: 5,
        lengthMenu: [[5, 10, 20, -1], [5, 10, 20, 'All']],
              fixedColumns:   {
                 // left: 1,
                  right: 1
              },
        select: {
            style:    'multi',
            selector: 'td:first-child'
        },
            "order":[[0,'asc']],
          data: result,
                    columns: [
                      { 'data': 'UserId'},
                      {'data':'nama'},
                      { 'data': 'departemenName'},
                      { 'data': 'Tgl_In' },
                      { 'data': 'Tgl_Out' },
                    ],
              
      }); 
    }

</script>


</body>
</html>