<div id="main">
    <div class="col-md-12-col-12">
      <div class="card">
        <div class="card-header">
          <h5>Data Hari Kerja</h5>
          <div class="card-body">
          <div class=" row col-md-12 mb-3">
                          <div class=" col-md-6 text-start">
                            <div class="col-md-2">
                                <select class ="form-control" id="filter_tahun"></select>
                              </div>
                          </div>
                          <div class=" col-md-6 text-end">
                                <button type="button" class=" openDataTambah btn" data-bs-toggle="modal" data-bs-target="#TambaModal">
                                      <i class="fa-solid fa-file fa-lg text-primary"></i>
                              </button>
                            </div>
                           <!-- <div class="col-md-2">
                               <select class ="form-control" id="filter_status"></select>
                            </div> 
                            <div class="col-md-2">
                            <button  type="sumbit" name="sumbit" class="btn btn-primary">Submit</button>
                            </div> -->
            </div>
            <div id="TampilhariKerja"></div>
          </div>
          </div>
      </div>
    </div>
</div>




<script>
  $(document).ready(function () {
    get_tahun();
    const tahun = new Date().getFullYear();
    $("#filter_tahun").val(tahun);
    $("#tahuntambah").val(tahun);
    getTampilhk(tahun);

    $("#filter_tahun").on("change",function(){
        let tahun = $(this).val();
        getTampilhk(tahun);
   })

    })//documetn ready

    function get_tahun(){
      let startyear = 2020;
      let date = new Date().getFullYear();
      let endyear = date + 2;
      for(let i = startyear; i <=endyear; i++){
        var selected = (i !== date) ? 'selected' : date; 

        $("#filter_tahun").append($(`<option />`).val(i).html(i).prop('selected', selected));
        $("#tahuntambah").append($(`<option />`).val(i).html(i).prop('selected', selected));
      }
    }

    function getTampilhk(tahun){
        $.ajax({
          url:"<?=base_url?>/harikerja/getdatatampil",
          data:{tahun:tahun},
          method:"POST",
          dataType:"JSON",
          success:function(result){
            header();
            showdatatabelabsensi(result)
            
          }
        })
    }


    function header(){
      let tabel =`<table id="tabelwa1" class="display table-info" style="width:100%">                    
                                      <thead  id='thead'class ='thead'>
                                      <tr>      
                                                <th>Tahun</th>
                                                <th>Bulan</th>
                                                <th>Hari Kerja</th>
                                                <th>Action</th>
                                               
                                      </tr>
                                      </thead>
                                      <tbody>
                                      </tbody>
                               
                                  </table>`;
          $("#TampilhariKerja").empty().html(tabel);                    

    }


    function showdatatabelabsensi(result){
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
                      { 'data': 'tahun'},
                      { 'data': 'bulan'},
                      {'data':'lhk',className: "text-end"},
                      {data:null,defaultContent: '',
                            "render": function (data, type,row) {
                              const tahun  =row.tahun;
                              const bulan = row.bulan;
                              const lhk = row.lhk;
                          
                                    let html  =`<button type="button" 
                                    data-tahun="${tahun}" data-bulan="${bulan}"  data-lhk="${lhk}" 
                                    id="open-edit"class=" btn btn-lg btn-space"><i class="fa-regular fa-pen-to-square"></i></button>`

                                    //html += `<button type="button" class=" open-delete  btn  btn-lg" data-bs-toggle="modal" data-bs-target="#deleteModal"><i class="fa-regular fa-trash-can"></i></button>`   
                                          
                                     return html; 
                                  }
                      }
                    ],
              
      });  
  }
    
</script>