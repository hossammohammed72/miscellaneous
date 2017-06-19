<?php 
// this is a hashing password function 
// you can check this link to understand what's going on
// http://www.jasypt.org/howtoencryptuserpasswords.html

function hash_password($password,$salt ="1" ){
// a salt is a random value we add to the password before digesting to make brute forcing harder
// because even if he knew the password he deson't know the salt
// you will understand the default value at the end of the function
	if($salt=="1")
		$salt=random_character(8);
    // here we add the salt to the password
	$password .=$salt ; 
  // here we digest the password a thousand time is a good number don't just go strict add any larger number as a matter of security
	for($i=0;$i<1000;$i++)
	$password=sha1($password);
  // we add the salt for the digested password just to store in the database so we are able to get it back to match passwords 
	$password.=$salt;
	return $password; 
}
// here we verify the passwords
function verify_password($password,$hashed_password){
	// extracting the undigested salt from the stored password value
  $salt = substr($hashed_password,-8);
	if($hashed_password== hash_password($password,$salt))
		return true ; 
	else 
		return false; 
// I love code reviews :]
}
