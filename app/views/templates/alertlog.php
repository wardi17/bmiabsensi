<script>  Swal.fire({
					position: 'top-center',
					icon: 'info',
					title:'username atau password ada yang salah',
					showConfirmButton: true,
					  //timer: 1500
					}).then(function(){ 
					  window.location.replace('<?=base_url?>');
					});
</script>