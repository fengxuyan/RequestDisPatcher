

function isEmail(str){
	var reg=/^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+((.[a-zA-Z0-9_-]{2,3}){1,2})$/;
	return reg.test(str);
}
function checkpwd(str) {
	var reg=/^(?![0-9]+$)(?![a-zA-Z]+$)[0-9A-Za-z]{6,12}$/;
	return reg.test(str);
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

	if($("#Changetimeyear").val()==''){
		return false;
	}
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

	if(!isEmail(x5)){

		return false;

	}

	if(!checkpwd(x7)){

		return false;


	}
	return true;
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
	var x15= $('#appDate').val();
	if(x15=='')
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
	return true;
}


function changepic() {
	var select =$("#gender option:selected").attr("value");
	if(select==1){
		$('#head').attr('src','Heads/header_man.png');
	}else if(select==0){
		$('#head').attr('src','Heads/header_woman.png');
	}

}
