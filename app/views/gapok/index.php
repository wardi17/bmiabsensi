<div id="main">
    <div class="col-md-12-col-12">
      <div class="card">
        <div class="card-header">
          <h5>Data Gapok</h5>
          <div class="card-body">
          <div class=" row col-md-12 mb-2"> 
                <div  style="width:6%;" class="col-md-2">
                    <button id="printExcel" class="btn btn-success">Excel</button>
                </div>
                <div style="width:8%;"  class="col-md-2">
                <form role="form" action="<?= base_url; ?>/gapok/cetakpdf" target="_blank" method="POST" enctype="multipart/form-data">
					      <button type="submit" class="btn btn-primary">PDF</button>
                </form>
              </div>
    
              </div>
            <div id="TampilGapok"></div>
          </div>
          </div>
      </div>
    </div>
</div>

<script>
  $(document).ready(function () {
    const tahun = new Date().getFullYear();
     getTampilgapok();

     $(document).on("click","#printExcel",function(){
                  $("#TampilGapok").table2excel({
                    // exclude CSS class
                    exclude: ".noExl",
                    name: "Ms Gapok",
                    filename: "Ms_Gapok", //do not include extension
                    fileext: ".xls", // file extension
                    exclude_img: true,
                    exclude_links: true,
                    preserveFont:true,
                    exclude_inputs: true
                  })
                })


    })// document ready


    function getTampilgapok(){
        $.ajax({
          url:"<?=base_url?>/gapok/getdatatampil",
          method:'post',
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
          success:function(result){
            header();
            Swal.fire({
                            position: 'top-center',
                          icon: 'success',
                          title: status,
                          showConfirmButton: false,
                          timer: 100,
                          }).then(function(){ 
                            showdatatabelabsensi(result)
                          }); 
       
            
          }
        })
    }


    function header(){
      let tabel =`<table id="tabelwa1" class="display table-info" style="width:100%">                    
                                      <thead  id='thead'class ='thead'>
                                      <tr>      
                                                <th>No</th>
												<th>Userid</th>
                                                <th>NIK</th>
                                                <th>Nama</th>
                                                <th>Jabatan</th>
                                                <th>Departemen Nama</th>
                                                <th>Saleri</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                               
                                      </tr>
                                      </thead>
                                      <tbody>
                                      </tbody>
                               
                                  </table>`;
          $("#TampilGapok").empty().html(tabel);                    

    }


    function showdatatabelabsensi(result){
      $('#tabelwa1').DataTable({
        processing: true,    
        ordering: true,
        deferRender: true,
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
                      {
                          "data": null,
                          "class": "align-top",
                          "orderable": false,
                          "searchable": false,
                          "render": function (data, type, row, meta) {
                              return meta.row+meta.settings._iDisplayStart+1;
                          }
                      },
					  {'data': 'userid'},
                      { 'data': 'NIK'},
                      { 'data': 'name'},
                      { 'data': 'title'},
                      { 'data': 'departemenName'},
                      {'data':'saleri',className: "text-end"},
                      { 'data': 'status'},
                      {data:null,defaultContent: '',
                            "render": function (data, type,row) {
                              
                              const userid  =row.userid;
                              const name = row.name;
                              const title = row.title;
                              const departemenName = row.departemenName;
                              const departemenID = row.departemenID;
                              const saleri = row.saleri;
                              const NIK = row.NIK;
                              const status = row.status;

                          
                                    let html  =`<button type="button" 
                                    data-userid="${userid}" data-name="${name}"  data-title="${title}" data-departemenName="${departemenName}" 
                                    data-departemenID="${departemenID}" data-NIK="${NIK}" data-status="${status}"  data-saleri="${saleri}" 
                                    id="open-edit"class=" btn btn-lg btn-space"><i class="fa-regular fa-pen-to-square"></i></button>`

                                    //html += `<button type="button" class=" open-delete  btn  btn-lg" data-bs-toggle="modal" data-bs-target="#deleteModal"><i class="fa-regular fa-trash-can"></i></button>`   
                                          
                                     return html; 
                                  }
                      }
                    ],
              
      });  
  }
    
</script>