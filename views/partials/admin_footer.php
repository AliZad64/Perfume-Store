	<!-- import script -->
	<script> 

$(document).ready(function() {
$('.editbtn').on('click', function() {
    $('#editmodal').modal('show');
		$tr = $(this).closest('tr');
		var data = $tr.children("td").map(function() {
			return $(this).text();
	}).get();
	console.log(data);

	$('#update_id').val(data[0]);
	$('#name').val(data[1]);
	$('#description').val(data[2]);
	$('#price').val(data[3]);
	$('#brand').val(data[4]);
	$('#gender').val(data[5]);
    });
});
</script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
	<script src="../../js/index.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>

</body>
</html>