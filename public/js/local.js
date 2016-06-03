jQuery(function() {
	$("#example").dataTable();
	$("#Guardar").before('<a class="btn" id="masTel" href="javascript:;">Teléfonos +</a>');
	$("#telefono-element").after("<br><dd id='adjuntar'></dd>");
	$("#formContacto").submit(function() {
		$.ajax({
			url : $(this).attr('action'),
			data : $(this).serialize(),
			type : 'POST',
			dataType : 'json',
			success : function(data) {
				if (data['msg'] == true && data['msg'] !== undefined) {
					alert('Contacto registrado');
					location.reload();
				} else {
					var span = '<ul>';
					for (var i in data['error']) {
						span += '<li>Campo: ' + data['error'][i]['clave'] + '-' + data['error'][i]['valor'] + '</li>';
					}
					span += '</ul>';
					$("#Guardar-label").empty().append(span);
				}
			}
		})
		return false;
	});

	$(document).on('click', '#masTel', function() {
		var copy = $("#telefono-element").clone();
		copy.find("input").val('');
		copy.find("input").removeAttr('id');
		copy.find("input").after("<a onclick='removedd(this)' class='btn btn-xs' href='javascript:void(0);'>Eliminar</a>")
		$("#adjuntar").append(copy);
	});
	
	$("#formEditar").submit(function(){
		$.ajax({
			url : $(this).attr('action'),
			data : $(this).serialize(),
			type : 'POST',
			dataType : 'json',
			success : function(data) {
				if(data['msg']){
					alert('Contacto actualizado');
					location.reload();
				}
			}
		})
		return false;
	});
});

function removedd(e) {
	$(e).parent().remove();
}