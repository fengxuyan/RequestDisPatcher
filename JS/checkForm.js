function checkForm(){

	var x1= $('#firstName').val();
	if(x1=='')
	{
		alert("Please input firstName");
		return false;

	};


	var x2= $('#lastName').val();
	if(x2=='')
	{
		alert("Please input lastName");
		return false;

	};
	var x3= $('#gender').val();
	if(x3=='')
	{
		alert("Please input gender");
		return false;

	};

	var x4= $('#phone').val();
	if(x4=='')
	{
		alert("Please input phone");
		return false;

	};
	var x5= $('#email').val();
	if(x5=='')
	{
		alert("Please input email");
		return false;

	};
	var x7 = $('#password').val();
	if(x7=='')
	{
		alert("Please input password");
		return false;

	};

	var x9 = $('#repassword').val();
	if(x7!=x9){
		alert("Please Check Your Password!Keep the Same");
		return false;
	}

	var x10 =$('#checkService').prop('checked');
	if(!x10){
		alert("Please Accept the Terms of Service,or You Can Read it");
		return false;
	}
}


function checkForm1(){
	var x7 = $('#password').val();
	var x9 = $('#repassword').val();
	if(x7!=x9){
		return false;
	}
	var x1= $('#firstName').val();
	if(x1=='')
	{
		return false;

	};

	if(x7=='')
	{

		return false;

	};
	var x2= $('#lastName').val();
	if(x2=='')
	{
		return false;

	};
	var x3= $('#gender').val();
	if(x3=='')
	{
		return false;

	};

	var x4= $('#phone').val();
	if(x4=='')
	{
		return false;

	};
	var x5= $('#email').val();
	if(x5=='')
	{
		return false;
	};
	var x10 =$('#checkService').prop('checked');
	if(!x10){
		return false;
	}
}

function checkFormmodify() {
	var x1= $('#firstName').val();
	if(x1=='')
	{
		alert("Please input firstName");
		return false;

	};


	var x2= $('#lastName').val();
	if(x2=='')
	{
		alert("Please input lastName");
		return false;

	};
	var x3= $('#gender').val();
	if(x3=='')
	{
		alert("Please input gender");
		return false;

	};

	var x4= $('#phone').val();
	if(x4=='')
	{
		alert("Please input phone");
		return false;

	};
	var x5= $('#email').val();
	if(x5=='')
	{
		alert("Please input email");
		return false;

	};
	var x7 = $('#password').val();
	if(x7=='')
	{
		alert("Please input password");
		return false;

	};

	var x9 = $('#repassword').val();
	if(x7!=x9){
		alert("Please Check Your Password!Keep the Same");
		return false;
	}

}

function checkFormmodify1() {
	var x1= $('#firstName').val();
	if(x1=='')
	{

		return false;

	};


	var x2= $('#lastName').val();
	if(x2=='')
	{

		return false;

	};
	var x3= $('#gender').val();
	if(x3=='')
	{

		return false;

	};

	var x4= $('#phone').val();
	if(x4=='')
	{

		return false;

	};
	var x5= $('#email').val();
	if(x5=='')
	{

		return false;

	};
	var x7 = $('#password').val();
	if(x7=='')
	{

		return false;

	};

	var x9 = $('#repassword').val();
	if(x7!=x9){

		return false;
	}

}


function changepic() {
	var select =$("#gender option:selected").attr("value");
	if(select==1){
		$('#head').attr('src','Heads/header_man.png');
	}else if(select==0){
		$('#head').attr('src','Heads/header_woman.png');
	}

}
