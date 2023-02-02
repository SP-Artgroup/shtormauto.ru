 $(document).ready(function(){
	$('.login_register_page').on('submit', 'form', function(e){
		e.preventDefault();
		var form_action = $(this).attr('action');
		var form_backurl = $(this).find('input[name="backurl"]').val();
		$.ajax({
			type: "POST",
			url: form_action,
			data: $('.login_register_page form').serialize(),
			timeout: 3000,
			error: function(request,error) {
				if (error == "timeout") {
					alert('timeout');
				}
				else {
					alert('Error! Please try again!');
				}
			},
			success: function(data) {
				console.log($(data).find('.login_register_page .errortext'));
				var res = $(data).find('.login_register_page .errortext');
				if(res.length > 0){
					var captcha = $(data).find('.captcha-group')[0].innerHTML;
					$(".login_register_page .reg_error").html(res[0].innerHTML);
					$(".login_register_page .captcha-group").html(captcha);
				}
				else{
					location.reload();
				}
			}
		});
	});
})
	