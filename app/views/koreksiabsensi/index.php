<style>

  #tabelwa1_filter{ 
    padding-bottom: 20px !important;
  }


</style>
<div id="main">
    <div class="col-md-12-col-12">
      <div class="card">
        <div class="card-header">
          <h5>Data Absensi Koreksi</h5>
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
                      
                       <div id="printpdf"></div>
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

       getDataAbKoreksi(datas)
     
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
  const  bulan = $("#selecbulan").find(":selected").val();
  const datas ={
    tahun:tahun,
    bulan:bulan
  }

  getDataAbKoreksi(datas);
}

function getDataAbKoreksi(datas){
              $.ajax({
              url:"<?=base_url?>/koreksiabsensi/datakoreksi",
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
  const tahun = $("#selectahun").find(":selected").val();
  const bulan = $("#selecbulan").find(":selected").val();
  const datas ={
    tahun:tahun,
    bulan:bulan
  }

  let tabel=``;
  tabel +=`
                <!-- batas pindah -->
                      <div class="text-start mb-2">
                        <form role="form" action="<?= base_url; ?>/koreksiabsensi/cetakpdf" target="_blank" method="POST" enctype="multipart/form-data">
                            <input type="hidden" class="form-control col-md-6" id="tahun_pdf" name="tahun" value ="${tahun}">
                            <input type="hidden" class="form-control col-md-6" id="bulan_pdf" name="bulan" value ="${bulan}">
                          <button type="submit" class="btn btn-primary">PDF</button>
                          </form>
                      </div>
                      <!-- end pindah -->
                            `;
 tabel +=`<table id="tabelwa1" class="display table-info" style="width:100%">                    
                                  <thead  id='thead'class ='thead'>
                                  <tr>      
                                                <th>Tgl</th>
                                                <th>Hari</th>
                                                <th>Userid</th>
                                                 <th>Nama</th>
                                                 <th>Tanggal Masuk</th>
                                                 <th>Tanggal Pulang</th>
                                                 <th class="text-end">Hadir</th>
                                                 <th class="text-end">Lembur</th>
                                                 <th>Ket</th>
                                                 <th class="text-center">Action</th>
                                                  
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
                      { 'data': 'tanggal'},
                      { 'data': 'hari'},
                      { 'data': 'userid'},
                      { 'data': 'nama'},
                      { 'data': 'tanggal_in'},
                      { 'data': 'tanggal_out'},
                      {'data':'hadir',className: "text-end"},
                      { 'data': 'lembur',className: "text-end" },
                      { 'data': 'ket'}, 
                      {data:null,defaultContent: '',
                                  "render": function (data, type,row) {
                                  
                              const userid  =row.userid;
                                const nama = row.nama;
                                const tgl_in = row.tanggal_in;
                                const tgl_out = row.tanggal_out;
                                const jabatan = row.jabatan;
                                const tanggal = row.tanggal;
                                const hadir  = row.hadir;
                                const lembur = row.lembur;
                                const ket    = row.ket;
                                    let html  =`<button type="button" 
                                    data-userid="${userid}" data-tanggal="${tanggal}" data-nama="${nama}" data-tgl_in="${tgl_in}" data-tgl_out="${tgl_out}" data-jabatan="${jabatan}"
                                    data-hadir="${hadir}" data-lembur="${lembur}" data-ket="${ket}" 
                                    id="formeditkoreksi"class=" btn btn-lg btn-space"><i class="fa-regular fa-pen-to-square"></i></button>`

                                    //html += `<button type="button" class=" open-delete  btn  btn-lg" data-bs-toggle="modal" data-bs-target="#deleteModal"><i class="fa-regular fa-trash-can"></i></button>`   
                                          
                                     return html; 
                                  }
                      }
                    ],
              
      });  
}

$(document).on("click","#formeditkoreksi",function(e){
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


   
 
    $("#EditKoreksiAbsen").modal("show");

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

// save edit koreksi absen
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
      tahun:tahun,
      bulan:bulan
    }
    
    $.ajax({
         url:"<?=base_url?>/koreksiabsensi/editdata",
          data:datas,
          method:"POST",
          dataType: "json",
          success:function(result){
            $("#EditKoreksiAbsen").modal("hide");
            getDataAbKoreksi(datarolback);
           /* let pesan = result.error;
            Swal.fire({
                      position: 'top-center',
                      icon: "success",
                      showConfirmButton: false,
                       timer: 500,
					            title:pesan,
                    }).then(function(){ 
                      
                     $("#EditKoreksiAbsen").modal("hide");
                      getDataAbKoreksi(datas);
                    });*/
            
        
          }

          });
        
 });

//and koreksi absen

//hapus koreksi absen
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
      tahun:tahun,
      bulan:bulan
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
                      $("#EditKoreksiAbsen").modal("hide");
                      getDataAbKoreksi(datarolback);
                    });
            
        
          }

          });

});
//and koreksi absen


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

<!-- Modal -->
<div class="modal fade" id="EditKoreksiAbsen" tabindex="-1" aria-labelledby="EditKoreksiAbsenLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="EditKoreksiAbsenLabel">Edit Koreksi Absen</h5>
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