<div id="main">
    <div class="col-md-12-col-12">
      <div class="card">
        <div class="card-header">
          <h5>Data Absensi</h5>
          <div class="card-body">
                <div class="col-md-12 row">
                      <!-- <div style="width:15%;" class="row col-md-3 mb-2">  
                                <label style="width:45%;" for="selectahun" class="col-sm-2 col-form-label">Tahun</label>
                                <div style="width:55%;" class="col-sm-4">
                                
                                  <select class ="form-control" id="selectahun"></select>                             
                              </div>
                      </div>  
                      <div style="width:20%;" class="row col-md-3">  
                                <label style="width:30%;" for="selecbulan" class="col-sm-2 col-form-label">Bulan</label>
                                <div  style="width:60%;" class="col-sm-6">
                                  <select class ="form-control" id="selecbulan"></select>                                
                                </div>
                        </div> -->
                        <!-- <div  style="width:8%;" class="row col-md-2 col-form-label">
                            <div id="harikerja"></div>
                          </div> -->
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
                            </div>
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
<div class="modal fade" id="View_absensiModal" tabindex="-1" aria-labelledby="View_absensiModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="View_absensiModalLabel">Detail Absensi</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div id="tabelmodal"></div>
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
    //sectHk();
   $("#filterdata").on("click",function(even){
    even.preventDefault();
    const tgl_from = $("#tgl_from").val();
		const tgl_to = $("#tgl_to").val();
    // const tahun = $("#selectahun").find(":selected").val();
    // const bulan = $("#selecbulan").find(":selected").val();
    if(tgl_from > tgl_to){
          Swal.fire({
              position: 'top-center',
              icon: 'info',
              title:'tanggal from tidak boleh melebihi tanggal to',
              showConfirmButton: true,
              //timer: 10000
            })
     }else{

      const datas ={
        tgl_from:tgl_from,
        tgl_to:tgl_to,

      }

       kirimdata(datas);
     }
   })


   $("#selecbulan").on("change",function(){
      const tahun = $("#selectahun").find(":selected").val();
      const bulan = $(this).val();
      const datas ={
        tahun:tahun,
        bulan:bulan
      }
      getDataHK(datas);
      setTanggalAwalAkhir(tahun,bulan);
    })
})

function sectHk(){

  const tahun = $("#selectahun").find(":selected").val();
  const bulan = $("#selecbulan").find(":selected").val();
  const datas ={
    tahun:tahun,
    bulan:bulan
  }
  getDataHK(datas);
}

function getDataHK(datas){
              $.ajax({
              url:"<?=base_urlport?>/harikerja/getharikj",
              data:datas,
              method:"POST",
              dataType: "json",
              success:function(result){
                let hk = result+" HK";
                $("#harikerja").empty().html(hk);
              
              }

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


  function setTanggalAwalAkhir(tahun,bulan){
    let currentDate = new Date();
    // Mengatur tanggal pada objek Date ke 1 untuk mendapatkan awal bulan
    currentDate.setDate(1);
    let formattedDate = currentDate.toISOString().slice(0,10);
    
    let split = formattedDate.split('-');
    let tgl_awl = split[2];
    

    let set_tgl = tahun+'-'+(bulan<10 ? '0' : '')+ bulan + '-'+tgl_awl;
    let f = new Date(set_tgl)
    let tgl_awal = f.toISOString().slice(0,10);
    
    $("#tgl_from").val(tgl_awal);
    

    let lastDay = new Date(new Date().getFullYear(), bulan, 0);
    let formatladday = lastDay.toISOString().slice(0,10);
    let split_akh = formatladday.split('-');
    let tgl_akh = split_akh[2];
    
    let set_tglakh = tahun+'-'+(bulan<10 ? '0' : '')+ bulan + '-'+tgl_akh;

    $("#tgl_to").val(set_tglakh);

   // $tglra2 = new DateTime($tan2);
		//$tglra2->modify('last day of this month')->setTime(23,59,59)
  }




	function kirimdata(datas){
    //getdataabesnsiuser(datas);
    
    	$.ajax({
                  url:"<?=base_url?>/sumdataMM/kirimdata",
                  data:datas,
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
                    //getdataabesnsiuser(datas);
                 
                     
                  }
      }); 
	}


  function  getdataabesnsiuser(datas){
    $.ajax({
 
                  url:"<?=base_urlport?>/absensi/getdatabsensiuser",
                  data:datas,
                  method:"POST",
                  dataType: "json",
            
                  success:function(result){
                    Swal.fire({
                      position: 'top-center',
                      icon: "success",
                      showConfirmButton: false,
                       timer: 500,
					          //title: result,
                    }).then(function(){ 
                      settabel(result);
                    });
                     
  
                  }

                });
    }


    function settabel(result){
      
      let dataTable =``;
            let  id =``;
                          dataTable +=`
                          <div  class="page-heading mb-3">
                              <div class="page-title">
                              <h4 class="text-center">Rincian</h4>
                              </div>
                          </div>`;

          $.each(result,function(key,value){
       
						const dept = value.departemenheader;
            let ac_head='';
            if(dept==''){
             ac_head ="NULL";
            }else{
              ac_head =dept;
            }
						let data_tabel = value.Detail;

             let substri = ac_head.substring(2,0);
						let tb_nama =substri+"_tabel";
                 id+= tb_nama +',';
						  if(data_tabel.length !==0){
						
						        dataTable +=`
									<h6 class="text-start mt-4">${ac_head}</h6>
                                    <table id="${tb_nama}" class="display table-info" style='width:100%'>                    
                                                    <thead id="thead"class ="thead">
                                                    <tr>
                                                                <th  width="150px" class="text-start">UserId</th>
                                                                <th  width="150px" class="text-start">Ssn</th>
                                                                <th  width="150px" class="text-start">Nama</th>
                                                                <th  width="150px" class="text-start">jabatan</th>
                                                                <th  width="150px" class="text-start">Hadir</th>
                                                                <th  width="150px" class="text-start">Lembur(Jam)</th>

                                                    </tr>
                                                    </thead>
                                                    <tbody>`;
						 $.each(data_tabel,function(a,b){

							        dataTable +=`
                                          <tr>
                                            <td  width="150px"  class="text-start">${b.UserId}</td>
                                            <td width="150px" class="text-start">${b.ssn}</td>
                                            <td width="150px" class="text-start">${b.nama}</td>
                                            <td width="150px" class="text-start">${b.jabatan}</td>
                                            <td width="150px" style="cursor:pointer"  onclick="Userkosong('${b.UserId}')" class="text-start">${b.masukkerja}</td>
                                            <td width="150px" class="text-start">${b.lebur}</td>
                                           
                                           
									   `
											dataTable+=`</tr>`;
									});
							dataTable+=`</tbody>
								</table>`;
						}else{
						dataTable +=``;	
						}
						
						 });
						
					 $("#tabelabsensi").empty().html(dataTable);
					  let str_id = id.slice(0,-1);

            //console.log(str_id);
					 datatabelTrsn(str_id)
				 

    }


    function datatabelTrsn(str_id){
      let data_id = str_id.split(",");

      $.each(data_id,function(index,value){
            let id_tbl ="#"+value;
            $(id_tbl).DataTable({

                responsive: true,
                "ordering": false,
                "destroy":true,
                pageLength: 5,
                lengthMenu: [[5, 10, 20, -1], [5, 10, 20, 'All']],
                fixedColumns:   {
                     // left: 1,
                      right: 1
                  },
                  order: [[ 3, 'desc' ], [ 0, 'asc' ]]
              })
      });
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


function Userkosong(UserId){
  
 
   const tahun = $("#selectahun").find(":selected").val();
  const bulan = $("#selecbulan").find(":selected").val();
  const datas ={
    userid:UserId,
    tahun:tahun,
    bulan:bulan
  }

   $.ajax({
          url:"<?=base_urlport?>/absensi/getdataUserkosong",
          data:datas,
          method:"POST",
          dataType: "json",
          success:function(result){
            $("#View_absensiModal").modal("show");
          
            tampildatauserabsensi(result);
        
          }

          });
}


  function  tampildatauserabsensi(result){
    headerAbesensi();
    showdatatabel(result);
  }



  function headerAbesensi(){

    let tabel =`<table id="tabelwa1" class="display table-info" style="width:100%">                    
                                      <thead  id='thead'class ='thead'>
                                      <tr>      
                                                <th>Userid</th>
                                                 <th>Nama</th>
                                                 <th>Tanggal Masuk</th>
                                                 <th>Tanggal Pulang</th>
                                                      
                                      </tr>
                                      </thead>
                                      <tbody>
                                      </tbody>
                                  </table>`;
          $("#tabelmodal").empty().html(tabel);

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
                            { 'data': 'nama' },
                            { 'data': 'Tgl_In' },
                            { 'data': 'Tgl_Out' },

                        ],
                  
          });  
  }



</script>


</body>
</html>