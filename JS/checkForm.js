function checkForm(){
	var x7 = $('#password').val();
	var x9 = $('#repassword').val();
	if(x7!=x9){
		alert("Please Check Your Password!Keep the Same");
		return false;
	}
	if($('#middleName').val==''){

		$('#middleName').val==' ';

	};
	if($('#address').val==''){

		$('#address').val==' ';

	};


	var select =$("#gender option:selected").attr("value");
	$(".check input").each(
		function () {
			if($(this).is('text')){
				if ($(this).val() == "") {
					alert("Some Option is not Filled");
					return false;
				}
			}else{
				if (select== "") {

					alert("Some Option is not Filled");
					return false;
				}
			}
		}
	);
	var x10 =$('#checkService').prop('checked');
	if(!x10){
		alert("Please Accept the Terms of Service,or You Can Read it");
		return false;
	}
	return true;
}
function changepic() {
	var select =$("#gender option:selected").attr("value");
	if(select=='Male'){
		$('#head').attr('src','Heads/header_man.png');
	}else if(select=='Female'){
		$('#head').attr('src','Heads/header_woman.png');
	}

}
