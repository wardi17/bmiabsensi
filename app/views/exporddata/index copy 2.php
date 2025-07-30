
<?php
$level_us = (isset($_SESSION["level_user"]))? $_SESSION["level_user"] : '';


?>
<div id="main">
<header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>
    <div class="col-md-12-col-12">
      <div class="card">
        <div class="card-header">
          <h5>Data Absensi</h5>
          <div class="card-body">
                <div class="col-md-12 row">
                      <div style="width:16%;" class="row col-md-3 mb-2">  
                                <label style="width:44%;" for="selectahun" class="col-sm-2 col-form-label">Tahun</label>
                                <div style="width:55%;" class="col-sm-4">
                                
                                  <select class ="form-control" id="selectahun"></select>                             
                              </div>
                      </div>  
                      <div style="width:20%;" class="row col-md-3">  
                                <label style="width:30%;" for="selecbulan" class="col-sm-2 col-form-label">Bulan</label>
                                <div  style="width:60%;" class="col-sm-6">
                                  <select class ="form-control" id="selecbulan"></select>                                
                                </div>
                        </div>
                        <div  style="width:8%;" class="row col-md-2 col-form-label">
                            <div id="harikerja"></div>
                          </div>
                        <div style="width:20%;" class="row col-md-3">
                                <label  style="width:28%;" class="col-sm-2 col-form-label">From</label>
                                    <div  style="width:70%;" class ="col-md-6">
                                       <input type="date" class="datepicker_input form-control" id="tgl_from" name="tgl_from">
                                    </div>
						              </div>
                         
                            <div style="width:20%;" class="row col-md-4">
                                    <label style="width:20%;" class="col-sm-2 col-form-label">To</label>
                                    <div style="width:70%;" class = "col-md-6">
                                       <input type="date" class="datepicker_input form-control" id="tgl_to" name="tgl_to">
                                    </div>
                            </div>
                           <div class=" col-md-2 mb-3">
                              <button  type="btn" name="sumbit" id="filterdata"  class="btn btn-primary">Sikron</button>
                              <button  type="btn" name="sumbit" id="filterTampildata"  class="btn btn-info">Tampil</button>
                            </div>
                      </div>

                      <!-- batas pindah -->
                      <div class="row col-md-4">
                        <div class="col-md-2">
                        <div class="text-start">
                        <form role="form" action="<?= base_url; ?>/exporddata/cetakpdf" target="_blank" method="POST" enctype="multipart/form-data">
                            <input type="hidden" class="form-control col-md-6" id="tahun_pdf" name="tahun" value ="${tahun}">
                            <input type="hidden" class="form-control col-md-6" id="bulan_pdf" name="bulan" value ="${bulan}">
                            <input type="hidden" class="form-control col-md-6" id="from_pdf" name="tgl_from" value ="${tgl_from}">
                            <input type="hidden" class="form-control col-md-6" id="to_pdf" name="tgl_to" value ="${tgl_to}">
                          <button type="submit" class="btn btn-primary">PDF</button>
                          </form>
                      </div>
                        </div>
                        <div class="col-md-4">
                        <div style="width:50% ;" class="text-start">
                          <select class="form-select  mb-3" aria-label=".form-select-lg" id="fulltabel">
                              <option selected value="N">N</option>
                              <option value="Y">Y</option>
                            </select>
                      </div>
                        </div>
                      </div>
                    
                      <!-- end pindah -->
                      <div id="tabelabsensi"></div>
                      <div id="tabelabsensifull"></div>
          </div>
        </div>
      </div>
    </div>

    <!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="View_absensiModal" tabindex="-1" aria-labelledby="View_absensiModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
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
    sectHk();
   $("#filterTampildata").on("click",function(even){
    even.preventDefault();
    const tgl_from = $("#tgl_from").val();
		const tgl_to = $("#tgl_to").val();
    const tahun = $("#selectahun").find(":selected").val();
    const bulan = $("#selecbulan").find(":selected").val();
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
        tahun:tahun,
        bulan:bulan
      }

      Tampildataabsensisajah(datas)
     }
   })

   //tabale full 
   $("#fulltabel").on("change",function(e){
    e.preventDefault();
      const st_tabel = $(this).val();
      const tgl_from = $("#tgl_from").val();
      const tgl_to = $("#tgl_to").val();
      const tahun = $("#selectahun").find(":selected").val();
      const bulan = $("#selecbulan").find(":selected").val();
      if(st_tabel=="Y"){
        const datas ={
        tgl_from:tgl_from,
        tgl_to:tgl_to,
        tahun:tahun,
        bulan:bulan
      }
     
      Tampildatafullabsensi(datas)
      }
   })

   //and tabel full

   $("#filterdata").on("click",function(even){
    even.preventDefault();
    const tgl_from = $("#tgl_from").val();
	const tgl_to = $("#tgl_to").val();
    const tahun = $("#selectahun").find(":selected").val();
    const bulan = $("#selecbulan").find(":selected").val();
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
        tahun:tahun,
        bulan:bulan
      }

       kirimdata(datas);
     }
   });

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
              url:"<?=base_url?>/harikerja/getharikj",
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



    $("#from_pdf").val(formattedDate);
    $("#to_pdf").val(output);
    $("#tahun_pdf").val(tahun);
    $("#bulan_pdf").val(month);

}



  function setTanggalAwalAkhir(tahun,bulan){
    let currentDate = new Date();
    // Mengatur tanggal pada objek Date ke 1 untuk mendapatkan awal bulan
    currentDate.setDate(1);
    let formattedDate = currentDate.toISOString().split('T')[0];
   
    let split = formattedDate.split('-');
    let tgl_awl = split[2];
    

    let set_tgl = tahun+'-'+(bulan<10 ? '0' : '')+ bulan + '-'+tgl_awl;
    let f = new Date(set_tgl)
    let tgl_awal = f.toISOString().slice(0,10);

    $("#tgl_from").val(tgl_awal);
    

    let lastDay = new Date(tahun, bulan, 0);
    let set_tglakh = moment(lastDay).format("YYYY-MM-DD");
    // let split_akh = dateString_.split('-');
    // console.log(dateString_);
    // let tgl_akh = split_akh[2];
    // let set_tglakh = tahun+'-'+(bulan<10 ? '0' : '')+ bulan + '-'+tgl_akh;

    $("#tgl_to").val(set_tglakh);

   // $tglra2 = new DateTime($tan2);
		//$tglra2->modify('last day of this month')->setTime(23,59,59)
    $("#from_pdf").val(tgl_awal);
    $("#to_pdf").val(set_tglakh);
    $("#tahun_pdf").val(tahun);
    $("#bulan_pdf").val(bulan);


  }




	function kirimdata(datas){
   //getdataabesnsiuser(datas);
    
   $.ajax({
                  url:"<?=base_url?>/exporddata/kirimdata",
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
                   getdataabesnsiuser(datas);
                 
                     
                  }
      });
	}
//untuk tampil full tabel  by wardi 29/04/24
   function Tampildatafullabsensi(datas){
    $.ajax({
          url:"<?=base_url?>/exporddata/tampildatafullabsensi",
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
            settabelfull(result)
          }

        });

   }
//and tampil full tabel

function settabelfull(result){
      const tgl_from = $("#tgl_from").val();
      const tgl_to = $("#tgl_to").val();
      const tahun = $("#selectahun").find(":selected").val();
      const bulan = $("#selecbulan").find(":selected").val();
      const userl_level = "<?=$level_us?>";
   

      let dataTable =``;
            let  id =``;
                dataTable +=`
                          <div  class="page-heading mb-3">
                              <div class="page-title">
                              <h4 class="text-center">Rincian</h4>
                              </div>
                          </div>`;
    
                dataTable +=`
                <!-- batas pindah -->
                      
                        <div class="text-start">
                        <form role="form" action="<?= base_url; ?>/exporddata/cetakpdfdetail" target="_blank" method="POST" enctype="multipart/form-data">
                            <input type="hidden" class="form-control col-md-6" id="tahun_pdf" name="tahun" value ="${tahun}">
                            <input type="hidden" class="form-control col-md-6" id="bulan_pdf" name="bulan" value ="${bulan}">
                          <button type="submit" class="btn btn-primary">PDF</button>
                          </form>
                      </div>
                    
                      <!-- end pindah -->
                            `;
          
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
                                                                <th  width="150px" class="text-start">NIK</th>
                                                                <th  width="150px" class="text-start">Nama</th>
                                                                <th  width="150px" class="text-start">Jabatan</th>
                                                                <th  width="150px" class="text-start">Saleri</th>
                                                                <th  width="150px" class="text-start">HK</th>
                                                                <th  width="150px" class="text-start">Hadir</th>
                                                                <th  width="150px" class="text-start">Jam Lembur</th>
                                                                <th  width="150px" class="text-start">Gapok</th>
                                                                <th  width="150px" class="text-start">Gaji Lembur</th>
                                                                <th  width="150px" class="text-start">Gaji Diterima</th>

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
                                            <td width="150px" class="text-start">${b.saleri}</td>
                                            <td width="150px" class="text-start">${b.hariKerja}</td>
                                            <td width="150px" style="cursor:pointer"  id="Userkosong" data-userid="${b.UserId}"  data-namauser="${b.nama}" class="text-start">${b.hadir}</td>
                                            <td width="150px" class="text-start">${b.lembur}</td>
                                            <td width="150px" class="text-start">${b.gapok}</td>
                                            <td width="150px" class="text-start">${b.gaji_lembur}</td>
                                            <td width="150px" class="text-start">${b.gaji_diterima}</td>
									   `
											dataTable+=`</tr>`;
									});
							dataTable+=`</tbody>
								</table>`;    
						}else{
						dataTable +=``;	
						}
						
						 });
						

         
					 $("#tabelabsensifull").empty().html(dataTable);
					  // let str_id = id.slice(0,-1);

            
					  // datatabelfullAbsens(str_id)
				 
        
    }

    function datatabelfullAbsens(str_id){
      let data_id = str_id.split(",");
   
$.each(data_id,function(index,value){
      let id_tbl ="#"+value;
      $(id_tbl).DataTable({
        order: [[0, 'desc']],
          responsive: true,
          "ordering": true,
          "destroy":true,
          pageLength: 5,
          lengthMenu: [[5, 10, 20, -1], [5, 10, 20, 'All']],
          fixedColumns:   {
               // left: 1,
                right: 1
            },
            
        })
});
    }
  // haya untuk tampildataabsensi
  function  Tampildataabsensisajah(datas){
    $.ajax({
 
                  url:"<?=base_url?>/exporddata/tampildataabsensi",
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
                    
                    // console.log(result == null);
                    if(result == null){
                      Swal.fire({
                      position: 'top-center',
                      icon: "info",
                      showConfirmButton: true,
                       //timer: 500,
					           title: "Data Absen Belum di Sikron dengan bulan yang di tampilkan !!!",
                    })
                    }else{

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
  
                   }

                });
    }
  //and



  function  getdataabesnsiuser(datas){
    $.ajax({
 
                  url:"<?=base_url?>/exporddata/getdatabensi",
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
      const tgl_from = $("#tgl_from").val();
      const tgl_to = $("#tgl_to").val();
      const tahun = $("#selectahun").find(":selected").val();
      const bulan = $("#selecbulan").find(":selected").val();
      const userl_level = "<?=$level_us?>";
   

      let dataTable =``;
            let  id =``;
                dataTable +=`
                          <div  class="page-heading mb-3">
                              <div class="page-title">
                              <h4 class="text-center">Rincian</h4>
                              </div>
                          </div>`;
          if(userl_level!=="Y"){
            dataTable +=`
                <!-- batas pindah -->
                        <div class="text-start">
                          <form role="form" action="<?= base_url; ?>/exporddata/cetakpdf" target="_blank" method="POST" enctype="multipart/form-data">
                              <input type="hidden" class="form-control col-md-6" id="tahun_pdf" name="tahun" value ="${tahun}">
                              <input type="hidden" class="form-control col-md-6" id="bulan_pdf" name="bulan" value ="${bulan}">
                              <input type="hidden" class="form-control col-md-6" id="from_pdf" name="tgl_from" value ="${tgl_from}">
                              <input type="hidden" class="form-control col-md-6" id="to_pdf" name="tgl_to" value ="${tgl_to}">
                            <button type="submit" class="btn btn-primary">PDF</button>
                            </form>
                      </div>
                    
                      <!-- end pindah -->
                            `;
          }else{
                dataTable +=`
                <!-- batas pindah -->
                      
                        <div class="text-start">
                        <form role="form" action="<?= base_url; ?>/exporddata/cetakpdfdetail" target="_blank" method="POST" enctype="multipart/form-data">
                            <input type="hidden" class="form-control col-md-6" id="tahun_pdf" name="tahun" value ="${tahun}">
                            <input type="hidden" class="form-control col-md-6" id="bulan_pdf" name="bulan" value ="${bulan}">
                          <button type="submit" class="btn btn-primary">PDF</button>
                          </form>
                      </div>
                    
                      <!-- end pindah -->
                            `;
          }
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
                                                                <th  width="150px" class="text-start">NIK</th>
                                                                <th  width="150px" class="text-start">Nama</th>
                                                                <th  width="150px" class="text-start">Jabatan</th>
                                                                <th  width="150px" class="text-start">Hadir</th>
                                                                <th  width="150px" class="text-start">Jam Lembur</th>

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
                                            <td width="150px" style="cursor:pointer"  id="Userkosong" data-userid="${b.UserId}"  data-namauser="${b.nama}" class="text-start">${b.masukkerja}</td>
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
              order: [[0, 'desc']],
                responsive: true,
                "ordering": true,
                "destroy":true,
                pageLength: 5,
                lengthMenu: [[5, 10, 20, -1], [5, 10, 20, 'All']],
                fixedColumns:   {
                     // left: 1,
                      right: 1
                  },
                  
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
          { key: 5, value: 'Mei' },
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


    $(document).on("click","#Userkosong",function(){
      
      
       $("#View_absensiModal").modal("show");
      headerAbesensi();
      const tahun = $("#selectahun").find(":selected").val();
      const bulan = $("#selecbulan").find(":selected").val();
      const userid = $(this).data('userid');
      const namauser = $(this).data('namauser');
    
      const datas ={
        userid:userid,
        tahun:tahun,
        bulan:bulan,
        nama:namauser
      }

      getdatakosong(datas);
     

    })



  function getdatakosong(datas){
    $.ajax({
         url:"<?=base_url?>/exporddata/getdataUserkosong",
          data:datas,
          method:"POST",
          dataType: "json",
          success:function(result){
            showdatatabelabsensi(result);
        
          }

          });
  }




  function headerAbesensi(){

    let tabel =`<table id="tabelwa1" class="display table-info" style="width:100%">                    
                                      <thead  id='thead'class ='thead'>
                                      <tr>      
                                                <th>Tgl</th>
                                                <th>Hari</th>
                                                <th>Userid</th>
                                                 <th>Nama</th>
                                                 <th>Tanggal Masuk</th>
                                                 <th>Tanggal Pulang</th>
                                                 <th>Hadir</th>
                                                 <th>Lembur</th>
                                                 <th>Ket</th>
                                                      
                                      </tr>
                                      </thead>
                                      <tbody>
                                      </tbody>
                                      <tfoot>
                                      <tr>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th class="text-end">Total:</th>
                                        <th class="text-end">Total:</th>
                                        <th></th>
										                    </tr>
                                  </tfoot>
                                  </table>`;
          $("#tabelmodal").empty().html(tabel);

  }


function showdatatabelabsensi(result){
    $('#tabelwa1').DataTable({
            response:true,
            pageLength: 5,
            lengthMenu: [[5, 10, 20, -1], [5, 10, 20, 'All']],
                  fixedColumns:   {
                     // left: 1,
                      right: 14
                  },
            select: {
                style:    'multi',
                selector: 'td:first-child'
            },
                "order":[[0,'asc']],
                rowReorder: {
                      selector: 'td:nth-child(5)'
                  },
                  "footerCallback": function (row, data, start, end, display ) {
                              let api = this.api();
                  
                          // Remove the formatting to get integer data for summation
                          let intVal = function (i) {
                              const w = i.toFixed(2);
                              return typeof w === 'string'
                                  ? w.replace(/[\$,]/g, '') * 1
                                  : typeof w === 'number'
                                  ? w
                                  : 0;
                          };
                  
                          // Total over all pages
                          hadir = api
                              .column(6)
                              .data()
                              .reduce((a, b) =>intVal(a) + intVal(b), 0);
                  
                         lembur = api
                              .column(7)
                              .data()
                              .reduce((a, b) =>intVal(a) + intVal(b), 0);
                          // Total over this page
                          // pageTotal = api
                          //     .column(4, { page: 'current' })
                          //     .data()
                          //     .reduce((a, b) => intVal(a) + intVal(b), 0);
                  
                          // Update footer
                          api.column(6).footer().innerHTML =
                          hadir;  
                          api.column(7).footer().innerHTML =
                          lembur;  
                      
                          
                      
                          
            },
             /*untuk filter warana tanggal merah  */
             "fnRowCallback": function(row, Data, iDisplayIndex, iDisplayIndexFull) {
                     
                             
                              const c_tgl_libur = Data.warna_hariSM;
                              const c_tgl_merah = Data.warna_hariLB;  
                              const c_status = Data.status;

                              if(c_tgl_libur !==""){
                                $('td', row).css('color', c_tgl_libur); 
                              }
                              if(c_tgl_merah !==""){
                                $('td', row).css('color', c_tgl_merah); 
                              }

                              if(c_status !=""){
                                $('td', row).css('color', c_status); 
                              }
              },
              //and
              data: result,
                        columns: [
                          { 'data': 'tanggal'},
                          { 'data': 'hari'},
                          { 'data': 'UserId'},
                            { 'data': 'nama',
                              "render":function(data,type,row){
                             
                                const userid  =row.UserId;
                                const nama = data;
                                const tgl_in = row.Tgl_In;
                                const tgl_out = row.Tgl_Out;
                                const jabatan = row.jabatan;
                                const tanggal = row.tanggal;
                                const hadir  = row.hadir;
                                const lembur = row.lembur;
                                const ket    = row.keterangan;
                              
                              if(type == 'display'){
                                html =`<span type="button" style="cursor:pointer"
                                data-userid="${userid}" data-tanggal="${tanggal}" data-nama="${nama}" data-tgl_in="${tgl_in}" data-tgl_out="${tgl_out}" data-jabatan="${jabatan}"
                                data-hadir="${hadir}" data-lembur="${lembur}" data-ket="${ket}"
                                id="forminputkoreksi">${data}</span>`;
                              }
                              return html;
                            } 
                            },
                            { 'data': 'Tgl_In' },
                            { 'data': 'Tgl_Out' },
                            {'data':'hadir',className: "text-end"},
                            { 'data': 'lembur',className: "text-end" },
                            { 'data': 'keterangan'},
                        ],
                  
          });  
  }


  $(document).on("click","#forminputkoreksi",function(e){
    e.preventDefault();
    let userid = $(this).data("userid");
    let nama = $(this).data("nama");
    let tgl_in = $(this).data("tgl_in");
    let tanggal = $(this).data("tanggal");

    let set_jamin =(tgl_in == null ?"00:00:00" : tampiljam(tgl_in));
 

    let tgl_out = $(this).data("tgl_out");
    let set_jamout =(tgl_out == null ?"00:00:00" : tampiljam(tgl_out));

    let jabatan = $(this).data("jabatan");
   
    let hadir = $(this).data("hadir");
    let lembur= $(this).data("lembur");
    let ket   = $(this).data("ket");

    $("#View_absensiModal").modal("hide");
    $("#InputKoreksiAbsen").modal("show");

    $("#userid").val(userid);
    $("#namauser").val(nama);
    $("#jabatan").val(jabatan);
    $("#tgl_masuk").val(tanggal);
    $("#tgl_pulang").val(tanggal);
    
    $("#jam_masuk").val(set_jamin);
    $("#jam_pulang").val(set_jamout);

    $("#hadir").val(hadir);
    $("#lembur").val(lembur);
    $("#ket").val(ket);
  

    // if(tgl_in !==null){
    //   $("#tgl_masuk").prop('disabled', true);
    // }
    // if(tgl_out !==null){
    //   $("#tgl_pulang").prop('disabled', true);
    // }

    // if(jabatan !==null){
    //   $("#jabatan").prop('disabled', true);
    // }
  })

function tampiljam(tgl){
    let sekarang = new Date(tgl);
    let jam = sekarang.getHours();
        let menit = sekarang.getMinutes();
        let detik = sekarang.getSeconds();
        
        // Format waktu agar selalu dua digit
        jam = (jam < 10 ? "0" : "") + jam;
        menit = (menit < 10 ? "0" : "") + menit;
        detik = (detik < 10 ? "0" : "") + detik;
        
        // Menampilkan waktu dalam format HH:MM:SS
        let waktu = jam + ":" + menit + ":" + detik;

       return waktu;
}

 function goBack(){
  $("#View_absensiModal").modal("show");
  $("#InputKoreksiAbsen").modal("hide");
 }


 $(document).on("click","#Createdata",function(e){
  e.preventDefault();
    const userid = $("#userid").val();
    const namauser = $("#namauser").val();
    const jabatan = $("#jabatan").val();
    const tgl_masuk = $("#tgl_masuk").val();
    const jam_masuk = $("#jam_masuk").val();
    const tgl_pulang = $("#tgl_pulang").val();
    const jam_pulang = $("#jam_pulang").val();
    const hadir = $("#hadir").val();
    const lembur = $("#lembur").val();
    const ket = $("#ket").val();
  

    const datas ={
      userid:userid,
      namauser:namauser,
      jabatan:jabatan,
      tgl_masuk:tgl_masuk,
      jam_masuk:jam_masuk,
      tgl_pulang:tgl_pulang,
      jam_pulang:jam_pulang,
      hadir:hadir,
      lembur:lembur,
      ket:ket
    }

    const split_tgl =tgl_masuk.split("-");
    let tahun = split_tgl[0];
    let bulan = split_tgl[1];

    const datarolback ={
      userid:userid,
      tahun:tahun,
      bulan:bulan,
      nama:namauser
    }
      
    $.ajax({
         url:"<?=base_url?>/exporddata/savedatakoreksiabsen",
          data:datas,
          method:"POST",
          dataType: "json",
          success:function(result){
            let pesan = result.error;
            Swal.fire({
                      position: 'top-center',
                      icon: "success",
                      showConfirmButton: false,
                       timer: 500,
					            title:pesan,
                    }).then(function(){ 
                      goBack();
                     // $("#View_absensiModal").modal("show");
                      headerAbesensi();
                      getdatakosong(datarolback);
                    });
            
        
          }

          });

 });

 $(document).on("click","#Deletedata",function(e){
  e.preventDefault();
  const userid = $("#userid").val();
    const namauser = $("#namauser").val();
    const jabatan = $("#jabatan").val();
    const tgl_masuk = $("#tgl_masuk").val();
    const jam_masuk = $("#jam_masuk").val();
    const tgl_pulang = $("#tgl_pulang").val();
    const jam_pulang = $("#jam_pulang").val();
    const hadir = $("#hadir").val();
    const lembur = $("#lembur").val();
    const ket = $("#ket").val();
  

    const datas ={
      userid:userid,
      namauser:namauser,
      jabatan:jabatan,
      tgl_masuk:tgl_masuk,
      jam_masuk:jam_masuk,
      tgl_pulang:tgl_pulang,
      jam_pulang:jam_pulang,
      hadir:hadir,
      lembur:lembur,
      ket:ket
    }
    const split_tgl =tgl_masuk.split("-");
    let tahun = split_tgl[0];
    let bulan = split_tgl[1];

    const datarolback ={
      userid:userid,
      tahun:tahun,
      bulan:bulan,
      nama:namauser
    }
      
    $.ajax({
         url:"<?=base_url?>/exporddata/deletedatakoreksiabsen",
          data:datas,
          method:"POST",
          dataType: "json",
          success:function(result){
            let pesan = result.error;
            Swal.fire({
                      position: 'top-center',
                      icon: "success",
                      showConfirmButton: false,
                       timer: 500,
					            title:pesan,
                    }).then(function(){ 
                      goBack();
                      headerAbesensi();
                      getdatakosong(datarolback);
                    });
            
        
          }

          });
 })
</script>
<!-- Modal -->
<div class="modal fade" id="InputKoreksiAbsen" tabindex="-1" aria-labelledby="InputKoreksiAbsenLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="InputKoreksiAbsenLabel">Input Koreksi Absen</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" onclick="goBack();" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form  id ="formtambah" class ="form form-horizontal">
              <div class="row col-md-12-col-12">
              <div class="col-md-6">
                <input type="hidden" id="userid" value="">
                <div class="row col-md-12 mb-2">
                        <label for="namauser" class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-8">
                          <input  disabled value="" type="text" id="namauser" class="form-control">
                        </div>
                </div>
                <div class="row col-md-12 mb-2">
                        <label for="jabatan" class="col-sm-2 col-form-label">jabatan</label>
                        <div class="col-sm-8">
                          <input   value="" type="text" id="jabatan" class="form-control">
                        </div>
                </div>
                <div class="row col-md-12 mb-2">
                        <label for="tgl_masuk" class="col-sm-2 col-form-label">Tanggal masuk</label>
                        <div class=" row col-sm-8">
                        <div  style ="width:48%" class="col-sm-6">
                          <input disabled  value="" type="date" id="tgl_masuk" class="form-control">
                        </div>
                          <div style ="width:35%" class="col-sm-2"> 
                            <input value="" class="form-control" type="text" id="jam_masuk">
                          </div>
                        </div>
                </div>
                <div class="row col-md-12 mb-2">
                        <label for="tgl_pulang" class="col-sm-2 col-form-label">Tanggal Pulang</label>
                        <div class="row col-sm-8">
                          <div  style ="width:48%" class="col-sm-6">
                            <input  disabled value="" type="date" id="tgl_pulang" class="form-control">
                          </div>
                          <div style ="width:35%" class="col-sm-2">
                            <input value="" class="form-control" type="text" id="jam_pulang">
                          </div>
                        </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="row col-md-12 mb-2">
                        <label for="hadir" class="col-sm-2 col-form-label">Hadir</label>
                        <div class="col-sm-4">
                          <input  value="" type="number" id="hadir" class="form-control">
                        </div>
                </div>
                <div class="row col-md-12 mb-2">
                        <label for="lembur" class="col-sm-2 col-form-label">Lembur</label>
                        <div class="col-sm-4">
                          <input  value="" type="number" id="lembur" class="form-control">
                        </div>
                </div>
                <div class="row col-md-12 mb-2">
                        <label for="ket" class="col-sm-2 col-form-label">Ket</label>
                        <div class="col-sm-10">
                          <textarea  value="" type="text" id="ket" class="form-control"></textarea>
                        </div>
                </div>
              </div>
          </div>
              <div class="col-sm-11 d-flex justify-content-center">
                    <button type="btn" class="btn btn-primary me-1 mb-3" id="Createdata">Save</button>
                    <button type="button" class="btn btn-danger me-1 mb-3" id="Deletedata">Delete</button>
                </div>
      </form>
      </div>
  
    </div>
  </div>
</div>
<!-- end modal  -->

</body>
</html>