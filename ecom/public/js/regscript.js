
var character_min = 3;     //set up of minimum character
var character_max = 25;    //set up of maximum character
var address_max  = 255;
var zipcode_max  = 6;
var zipcode_min  = 3;
var phone_max    = 14;
var phone_min    = 7;




function checkfirstname(){

  var firstname = document.getElementById('first_name').value;

  if( firstname.length < character_min) {
    document.getElementById('checkfname').innerHTML = " ** First Name Cannot be Less than 3 letters";
    document.getElementById('checkfname').style.color='red';
    document.getElementById('checkfname').style.fontSize='medium';
    return false;

  }else if( firstname.length > character_max) {
    document.getElementById('checkfname').innerHTML = " ** First Name Cannot be more than 25 letters";
    document.getElementById('checkfname').style.color='red';
    document.getElementById('checkfname').style.fontSize='medium';
    return false;

  }else{
    document.getElementById('checkfname').innerHTML = " ** First Name varified";
    document.getElementById('checkfname').style.color='green';
    document.getElementById('checkfname').style.fontSize='medium';

  }

}










function checklname(){

  var lastname = document.getElementById('flast_name').value;


  if( lastname.length < character_min) {
    document.getElementById('checklname').innerHTML = " ** Last Name Cannot be Less than 3 letters";
    document.getElementById('checklname').style.color='red';
    document.getElementById('checklname').style.fontSize='medium';
    return false;
  }
  if( lastname.length > character_max) {
    document.getElementById('checklname').innerHTML = " ** Last Name Cannot be more than 25 letters";
    document.getElementById('checklname').style.color='red';
    document.getElementById('checklname').style.fontSize='medium';
    return false;
  }

  if(!isNaN(lastname)){
    document.getElementById('checklname').innerHTML = " ** Please enter character";
    document.getElementById('checklname').style.color='red';
    document.getElementById('checklname').style.fontSize='medium';
    return false;
  }

  else {
    document.getElementById('checklname').innerHTML = " ** Last Name varified";
    document.getElementById('checklname').style.color='green';
    document.getElementById('checklname').style.fontSize='medium';

  }
}








function checkuname(){

  var uname = document.getElementById('username').value;

  if( uname.length < character_min) {
    document.getElementById('checkuname').innerHTML = " ** User Name Cannot be Less than 3 letters";
    document.getElementById('checkuname').style.color='red';
    document.getElementById('checkuname').style.fontSize='medium';
    return false;
  }

  if( uname.length > character_max) {
    document.getElementById('checkuname').innerHTML = " ** User Name Cannot be more than 25 letters";
    document.getElementById('checkuname').style.color='red';
    document.getElementById('checkuname').style.fontSize='medium';
    return false;
  }

  if(!isNaN(uname)){
    document.getElementById('checkuname').innerHTML = " ** User name can not be only Numeric value";
    document.getElementById('checkuname').style.color='red';
    document.getElementById('checkuname').style.fontSize='medium';
    return false;
  }

  else {
    document.getElementById('checkuname').innerHTML = " ** User Name varified";
    document.getElementById('checkuname').style.color='green';
    document.getElementById('checkuname').style.fontSize='medium';

  }
}










function checkzipcode(){

  var zip = document.getElementById('zipcode').value;
  if( zip.length < zipcode_min) {
    document.getElementById('checkzipcode').innerHTML = " ** Zip Code Cannot be Less than 3 Digits";
    document.getElementById('checkzipcode').style.color='red';
    document.getElementById('checkzipcode').style.fontSize='medium';
    return false;
  }

  if( zip.length > zipcode_max) {
    document.getElementById('checkzipcode').innerHTML = " ** Zip Code Cannot be more than 6 Digits";
    document.getElementById('checkzipcode').style.color='red';
    document.getElementById('checkzipcode').style.fontSize='medium';
    return false;
  }

  else {
    document.getElementById('checkzipcode').innerHTML = " ** Zip Code varified";
    document.getElementById('checkzipcode').style.color='green';
    document.getElementById('checkzipcode').style.fontSize='medium';

  }

  if(isNaN(zip)){
    document.getElementById('checkzipcode').innerHTML = " ** Zip Code must be only Numeric value";
    document.getElementById('checkzipcode').style.color='red';
    document.getElementById('checkzipcode').style.fontSize='medium';
    return false;
  }
}









function checkphone(){

  var phone = document.getElementById('phone').value;

  if( phone.length < phone_min) {
    document.getElementById('checkphone').innerHTML = " ** Phone Number can not be less than 7 Digits";
    document.getElementById('checkphone').style.color='red';
    document.getElementById('checkphone').style.fontSize='medium';
    return false;
  }

  else if( phone.length < phone_max) {
    document.getElementById('checkphone').innerHTML = " ** Phone Number can not be more than 14 Digits";
    document.getElementById('checkphone').style.color='red';
    document.getElementById('checkphone').style.fontSize='medium';
    return false;
  }


  if(isNaN(phone)){
    document.getElementById('checkphone').innerHTML = " ** Phone Number Must be only Numeric value";
    document.getElementById('checkphone').style.color='red';
    document.getElementById('checkphone').style.fontSize='medium';
    return false;
  }

  else {
    document.getElementById('checkphone').innerHTML = " ** Phone Number varified";
    document.getElementById('checkphone').style.color='green';
    document.getElementById('checkphone').style.fontSize='medium';

  }
}







function checkpass(){

  if (document.getElementById('password').value == document.getElementById('confirm-password').value) {

      document.getElementById('checkpass').innerHTML='Password Matching';
      document.getElementById('checkpass').style.color='green';
      document.getElementById('checkpass').style.fontSize='medium';


    }else{

      document.getElementById('checkpass').innerHTML='Password Is Not Matching';
      document.getElementById('checkpass').style.color='red';
      document.getElementById('checkpass').style.fontSize='medium';
  }

}
