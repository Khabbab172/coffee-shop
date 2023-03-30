// JavaScript Document
// function displayAjaxMsg(msg, code){
// 	$('.spinner').addClass('d-none');
	
// 	code = typeof code !== 'undefined' ? code : -1;
	
// 	if(code == 1){
// 		swal({
//             title: "Success",
//             text: msg,
//             confirmButtonColor: "#72c02c",
//             type: "success"
//         });
// 	}else if(code == 0){
// 		swal({
//             title: "Oops...",
//             text: msg,
//             confirmButtonColor: "#EF5350",
//             type: "error"
//         });
// 	}else if(code == 2){
// 		swal({
//             title: "Oh..",
//             text: msg,
//             confirmButtonColor: "#EF5350",
//             type: "error"
//         });
// 	}else{
// 		swal({
//             title: "Oops...",
//             text: "Process failed",
//             confirmButtonColor: "#EF5350",
//             type: "error"
//         });
// 	}
// }

// function displayAjaxMsgBar(msg, code){
// 	$('.spinner').addClass('d-none');
	
// 	code = typeof code !== 'undefined' ? code : -1;
	
// 	if(code == 1){
// 		$('.ajaxMsg').removeClass('alert-warning alert-danger').addClass('alert alert-success').html(msg);
// 		$('.ajaxMsgBot').removeClass('label-warning label-danger').addClass('label label-success').html(msg);
// 	}else if(code == 0){
// 		$('.ajaxMsg').removeClass('alert-success alert-warning').addClass('alert alert-danger').html(msg);
// 		$('.ajaxMsgBot').removeClass('label-success label-warning').addClass('label label-danger').html(msg);	
// 	}else if(code == 2){
// 		$('.ajaxMsg').removeClass('alert-success alert-danger').addClass('alert alert-warning').html(msg);
// 		$('.ajaxMsgBot').removeClass('label-success label-danger').addClass('label label-warning').html(msg);	
// 	}else{
// 		$('.ajaxMsg').html('Process failed').addClass('alert alert-danger');
// 		$('.ajaxMsgBot').html('Process failed').addClass('label label-danger');	
// 	}
	
// 	setTimeout(function(){
// 		$('.ajaxMsg').removeClass('alert-danger').removeClass('alert').html('');
// 		$('.ajaxMsgBot').removeClass('label-danger').removeClass('label').html('');
// 		$('.ajaxMsg').removeClass('alert-success').removeClass('alert').html('');
// 		$('.ajaxMsgBot').removeClass('label-success').removeClass('label').html('');
// 	}, 5000);
// }

// function displayAjaxMsgText(msg, code){
// 	$('.spinner').addClass('d-none');
	
// 	code = typeof code !== 'undefined' ? code : -1;
	
// 	if(code == 1){
// 		$('.ajaxMsg').removeClass('text-warning text-danger').addClass('text-success').html(msg);
// 	}else if(code == 0){
// 		$('.ajaxMsg').removeClass('text-success text-warning').addClass('text-danger').html(msg);
// 	}else if(code == 2){
// 		$('.ajaxMsg').removeClass('text-success text-danger').addClass('text-warning').html(msg);
// 	}else{
// 		$('.ajaxMsg').html('Process failed').addClass('text-danger');
// 	}
	
// 	setTimeout(function(){
// 		$('.ajaxMsg').removeClass('text-danger').removeClass('text-success').html('');
// 	}, 5000);
// }

// function hideAjaxMsg(){
// 	$('.ajaxMsg').removeClass('alert-warning').removeClass('alert-success').removeClass('alert-danger').removeClass('alert').html('');
// 	$('.ajaxMsgBot').removeClass('alert-warning').removeClass('alert-success').removeClass('label-danger').removeClass('alert').html('');
// }

const MySwal = Swal.mixin({
	customClass: {
		confirmButton: 'button x-small',
		cancelButton: 'button button-border black x-small'
	},
	buttonsStyling: false
});

function addDashInCreditCard(ccnumber){
	var ccno = $.trim(ccnumber);
	ccno = ccno.replace(/-/g,'');
	//alert(ccno);
	var new_ccno = '';
	
	for(i=0;i<ccno.length;i++){
		if(i == 4 || i == 8 || i == 12 || i == 16){
		new_ccno = new_ccno + '-';
		}
		new_ccno = new_ccno + ccno[i];      
	}

	return new_ccno;
}

function countChar(val) {
	var len = val.value.length;
	//REPLACE 155 WITH 135 TO ADD SCHOOL NAME IN MESSAGE
	if (len >= 135) {
		val.value = val.value.substring(0, 135);
	} else {
		var left = 135 - len
	  	$('#charNum').text(' - ' + left + ' character left');
	}
};

// Bootstrap switch
//jQuery(".switch").bootstrapSwitch();
	
//VALIDATION - USERNAME
jQuery.validator.addMethod("usernamecheck", function(value, element) {
	return this.optional(element) || /^[a-zA-Z0-9]{3,15}$/i.test(value);
}, "Username can have letters, numbers and length from 3 to 15 characters");

//VALIDATION - PASSWORD
jQuery.validator.addMethod("passwordCheck", function(value, element) {
	return this.optional(element) || /^[^\s]{6,}$/i.test(value);
}, "Password must have minimum 6 characters");

//VALIDATION - LETTER ONLY
jQuery.validator.addMethod("lettersonly", function(value, element) {
	return this.optional(element) || /^[a-zA-Z\s]+$/i.test(value);
}, "Enter letters only");

//VALIDATION - US PHONE FORMAT
jQuery.validator.addMethod("phonenocheck", function(value, element) {
  //return this.optional(element) || /^[0-9]{3}-[0-9]{3}-[0-9]{4}$/i.test(value);
  return this.optional(element) || /^((?!(0))[0-9]{10})$/i.test(value);
}, "Enter valid phone number");

//VALIDATION - ZIPCODE CHECK
jQuery.validator.addMethod("zipcodecheck", function (value, element) {
	return this.optional(element) || /^((?!(0))[0-9]{5,6})$/i.test(value);
}, "Enter valid zipcode");

//VALIDATION - US POSTCODE
jQuery.validator.addMethod("usPostCodeCheck", function(value, element) {
	if($("input:radio[name=payment_method]:checked").val() == 'credit_card'){ 
		if($.trim(value) != ''){
			return this.optional(element) || /^\d{5}(?:-\d{4})?$/i.test(value);
		}else{
			return false;
		}
	}else{	
		return true;
	}
}, "Enter valid postcode");

//VALIDATION - US BANK ACCOUNT NUMBER
jQuery.validator.addMethod("validate_bank_account_no", function (value, element) {
	if ($.trim(value) != '') {
		return this.optional(element) || value.match(/^[1-9]\d{4,17}$/);
	} else {
		return false;
	}
}, "Enter valid bank account number");

//VALIDATION - US ROUTING NUMBER - GENERAL
jQuery.validator.addMethod("validate_routing_number", function (value, element) {
	if ($.trim(value) != '') {
		return this.optional(element) || value.match(/^((0[0-9])|(1[0-2])|(2[1-9])|(3[0-2])|(6[1-9])|(7[0-2])|80)([0-9]{7})$/);
	} else {
		return false;
	}
}, "Enter valid routing number");

//VALIDATION - US BANK ACCOUNT NUMBER
jQuery.validator.addMethod("bankAcNoCheck", function(value, element) {
	if($("input:radio[name=payment_method]:checked").val() == 'auto_deduction_acc'){ 
		if($.trim(value) != ''){
			return this.optional(element) || /^\d{8}$/i.test(value);
		}else{
			return false;
		}
	}else{	
		return true;
	}
}, "Enter valid bank ac number");

//VALIDATION - US BANK ACCOUNT NUMBER
jQuery.validator.addMethod("routingNoCheck", function(value, element) {
	if($("input:radio[name=payment_method]:checked").val() == 'auto_deduction_acc'){ 
		if($.trim(value) != ''){
			return this.optional(element) || /^\d{9}$/i.test(value);
		}else{
			return false;
		}
	}else{	
		return true;
	}
}, "Enter valid routing number");

//VALIDATION - MOBILE NUMBER CHECK
jQuery.validator.addMethod("mobileCheck", function(value, element) {
  return this.optional(element) || /^((?!(0))[0-9]{10})$/i.test(value);
}, "Enter valid mobile number");

//VALIDATION - CHECK CREDIT CARD EXP MONNTH
jQuery.validator.addMethod("creditCardExpMonthCheck", function(value, element) {
	if($("input:radio[name=payment_method]:checked").val() == 'credit_card'){ 	
		if(value == ''){			
			return false;  
		}else{	
			return true;  
		}
	}else{	
		return true;
	}
}, "Select expiry month");

//VALIDATION - CHECK CREDIT CARD EXP YEAR
jQuery.validator.addMethod("creditCardExpYearCheck", function(value, element) {
	if($("input:radio[name=payment_method]:checked").val() == 'credit_card'){ 	
		if(value == ''){			
			return false;  
		}else{	
			return true;  
		}
	}else{	
		return true;
	}
}, "Select expiry year");

//VALIDATION - CHECK CREDIT CARD TYPE
jQuery.validator.addMethod("creditCardTypeCheck", function(value, element) {
	if($("input:radio[name=payment_method]:checked").val() == 'credit_card'){ 	
		if(value == ''){			
			return false;  
		}else{	
			return true;  
		}
	}else{	
		return true;
	}
}, "Select credit card");

//VALIDATION - CHECK CREDIT CARD NUMBER
jQuery.validator.addMethod("creditCardNoCheck", function(value, element) { 
	if($("input:radio[name=payment_method]:checked").val() == 'credit_card'){
		var ccType = $('#credit_card_type').val();
		
		if(ccType != ''){
			if(value != ''){  
				if(ccType == 'americanexpress'){
					var reg = /^(?:3[47][0-9]{13})$/; 						
				}else if(ccType == 'visa'){
					var reg = /^(?:4[0-9]{12}(?:[0-9]{3})?)$/; 	
				}else if(ccType == 'mastercard'){
					var reg = /^(?:5[1-5][0-9]{14})$/; 	
				}else if(ccType == 'discover'){
					var reg = /^(?:6(?:011|5[0-9][0-9])[0-9]{12})$/; 	
				}else if(ccType == 'dinersclub'){
					var reg = /^(?:3(?:0[0-5]|[68][0-9])[0-9]{11})$/; 	
				}else if(ccType == 'jcb'){
					var reg = /^(?:(?:2131|1800|35\d{3})\d{11})$/; 	
				}
			
				//ADDED ON 20-JUL-2018
				value = value.replace(/-/g,'');

				if(!value.match(reg)){  
					return false; 
				}else{
					return true;
				}
			}else{
				return false;  
			}
		}else{
			return false;  
		}
	}else{
		return true;
	}
}, "Enter valid credit card number");
 
//VALIDATION FOR TIME SLOTS
jQuery.validator.addMethod("timeSlotCheck", function(value, element) {	
	if(value == ''){  
		if($('#' + $(element).attr('data-pairSlot')).val() != ''){;
			return false;
		}else{
			return true;
		}
	}else{
		return true;  
	}
}, 'This field is required');

//VALIDATION FOR TIME SLOTS - CHECK START TIME IS SMALLER THAT END TIME
jQuery.validator.addMethod("timeSlotOrderCheck", function(value, element) {	
	if(value != ''){  
		var startTime = $('#' + $(element).attr('data-pairSlot')).val();
		if(startTime != ''){ 
			if(((new Date("1970-1-1 " + value) - new Date("1970-1-1 " + startTime) ) / 1000 / 60 / 60 ) > 0){
				return true;
			}else{
				return false;
			}			
		}else{
			return true;
		}
	}else{
		return true;  
	}
}, 'End time should be greater than Start time');

//VALIDATION - MESSAGE - IS STAFF SELECTED
jQuery.validator.addMethod("checkMsgToStaff", function(value, element) {
	if($("input[name=message_to][value=staff]").is(':checked')){
		return ($('#staff').val() != '');
	}else{
		return true;
	}
}, "Select staff");

/*//VALIDATION - MESSAGE - IS TEACHER SELECTED
jQuery.validator.addMethod("checkMsgToTeacher", function(value, element) {
	if($("input[name=message_to][value=student]").is(':checked')){
		return ($('#teacher').val() != '');
	}else{
		return true;
	}
}, "Required field");*/

//VALIDATION - MESSAGE - IS GROUP SELECTED
jQuery.validator.addMethod("checkMsgToGroup", function(value, element) {
	if($("input[name=message_to][value=student]").is(':checked')){
		return ($('#group').val() != '');
	}else{
		return true;
	}
}, "Select group");

//VALIDATION - MESSAGE - IS PARENTS/STUDENT SELECTED
jQuery.validator.addMethod("checkMsgToStudent", function(value, element) {
	if($("input[name=message_to][value=student]").is(':checked')){
		return ($('#student').val() != '');
	}else{
		return true;
	}
}, "Select parents");

//VALIDATION - BANK ACCOUNT NUMBER
jQuery.validator.addMethod("checkBankAcNo", function(value, element) {
	if($('#payment_method').val() == 'auto_deduction_acc'){
		return ($.trim($('#bank_acc_no').val()) != '');
	}else{
		return true;
	}
}, "Required");

//VALIDATION - ROUTING NUMBER
jQuery.validator.addMethod("checkRoutingNo", function(value, element) {
	if($('#payment_method').val() == 'auto_deduction_acc'){
		return ($.trim($('#routing_no').val()) != '');
	}else{
		return true;
	}
}, "Required");

//VALIDATION - CREDIT CARD TYPE
jQuery.validator.addMethod("checkCreditCardType", function(value, element) {
	if($('#payment_method').val() == 'credit_card'){
		return ($.trim($('#credit_card_type').val()) != '');
	}else{
		return true;
	}
}, "Required");

//VALIDATION - CREDIT CARD NUMBER
jQuery.validator.addMethod("checkCreditCardNo", function(value, element) {
	if($('#payment_method').val() == 'credit_card'){
		if(($.trim($('#credit_card_no').val()) != '')){
			var credit_card_no = $('#credit_card_no').val();
			
			if($('#credit_card_type').val() == 'americanexpress'){
				return credit_card_no.match(/^(?:3[47][0-9]{13})$/);
			}else if($('#credit_card_type').val() == 'visa'){
				return credit_card_no.match(/^(?:4[0-9]{12}(?:[0-9]{3})?)$/);
			}else if($('#credit_card_type').val() == 'mastercard'){
				return credit_card_no.match(/^(?:5[1-5][0-9]{14})$/);
			}else if($('#credit_card_type').val() == 'discover'){
				return credit_card_no.match(/^(?:6(?:011|5[0-9][0-9])[0-9]{12})$/);
			}else if($('#credit_card_type').val() == 'dinersclub'){
				return credit_card_no.match(/^(?:3(?:0[0-5]|[68][0-9])[0-9]{11})$/);
			}else if($('#credit_card_type').val() == 'jcb'){
				return credit_card_no.match(/^(?:(?:2131|1800|35\d{3})\d{11})$/);
			}
		}else{
			return false;
		}
	}else{
		return true;
	}
}, "Enter valid credit card number");

//VALIDATION - CREDIT CARD EXPIRY MONTH
jQuery.validator.addMethod("checkCreditCardExpM", function(value, element) {
	if($('#payment_method').val() == 'credit_card'){
		return ($.trim($('#credit_card_exp_month').val()) != '');
	}else{
		return true;
	}
}, "Required");

//VALIDATION - CREDIT CARD EXPIRY YEAR
jQuery.validator.addMethod("checkCreditCardExpY", function(value, element) {
	if($('#payment_method').val() == 'credit_card'){
		return ($.trim($('#credit_card_exp_year').val()) != '');
	}else{
		return true;
	}
}, "Required");

//VALIDATION - POST CODE
jQuery.validator.addMethod("checkCreditCardPostcode", function(value, element) {
	if($('#payment_method').val() == 'credit_card'){
		return ($.trim($('#postal_code').val()) != '');
	}else{
		return true;
	}
}, "Required"); 

//VALIDATION - EMAIL COMMA SEPARATED LIKE CC,BCC
jQuery.validator.addMethod("emailCommaSep", function(value, element) {
	var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	var str_array = value.split(',');

	for(var i = 0; i < str_array.length; i++) {
	   	if($.trim(str_array[i]) != ''){
			if(!re.test(String($.trim(str_array[i])).toLowerCase())){
				return false;
			}
		}
	}
	
	return true;
}, "Enter valid email");

//GENERATE PASSWORD
function generatePassword() {
    var length = 8,
        charset = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789",
        retVal = "";
    for (var i = 0, n = charset.length; i < length; ++i) {
        retVal += charset.charAt(Math.floor(Math.random() * n));
    }
    return retVal;
}

//GET NOTIFICATION UPDATES FOR HEADER
// function get_notification_for_header(){
// 	$.post('https://bayyan.org/ajax/aj-admission-request.php?action=get_header_notif',function(data,status){
// 		if(status == 'success'){
// 			$('#notification_count').html(data.notif_count);
// 			$('#notification_summary').html(data.notif_summary);			
// 		}
// 	},'json');
// }

// $(document).ready(function(){
// 	get_notification_for_header();
// 	setInterval(function(){ get_notification_for_header(); }, 300000);
// });

//CHECK UPLOADED FILE
/*function checkUploadedFile(form, targetUrl){ 
	var formData = new FormData(form); 
	formData.append('action', 'check_photo_file');

	$.ajax({
		type:'POST',
		url: targetUrl,
		data:formData,
		cache:false,
		contentType: false,
		processData: false,
		success:function(data){ alert('13' + data);
			return '1';
		},
		error: function(data){ alert('23' + data);
			return data;
		}
	});
}*/
