<?php





function getUser($txtUsername,$txtPassword,$searchValue){
    $entries=array();

    $ldap_password=$txtPassword;
    $ldap_username=$txtUsername."@mcb.local";
    $ldap_connection = ldap_connect("mcb.local");

    if (FALSE === $ldap_connection){
        // Uh-oh, something is wrong...
        $entries['success']=false;
        $entries["result"]= 'Unable to connect to the server';

        return $entries;
    }

    // We have to set this option for the version of Active Directory we are using.
    ldap_set_option($ldap_connection, LDAP_OPT_PROTOCOL_VERSION, 3) or die('Unable to set LDAP protocol version');
    ldap_set_option($ldap_connection, LDAP_OPT_REFERRALS, 0); // We need this for doing an LDAP search.

    if (TRUE === @ldap_bind($ldap_connection, $ldap_username, $ldap_password)){

      // echo "boo";

      //Your domains DN to query
      $ldap_base_dn = 'DC=mcb,DC=local';


      //Get standard users and contacts
      //$myMember='IT Testing Services';


   // $search_filter="(sAMAccountName=$searchValue)";
   // $search_filter="(&(objectClass=user)(|(sn=*$searchValue*)(sAMAccountName=*$searchValue*)))";
   // $search_filter="(&(objectClass=user)(|(sn=*$searchValue*)(sAMAccountName=*$searchValue*))(memberof=CN=IT Testing Services Automation,OU=Mail Distribution Groups,OU=MCB User Groups,DC=mcb,DC=local))";
   // $search_filter="(&(objectClass=user)(|(sn=*$searchValue*)(sAMAccountName=*$searchValue*))(|(memberof=CN=IT Testing Services Automation,OU=Mail Distribution Groups,OU=MCB User Groups,DC=mcb,DC=local)(CN=IT Testing Services,OU=Mail Distribution Groups,OU=MCB User Groups,DC=mcb,DC=local)))";
   // $search_filter="(&(objectClass=user)(|(sn=*$searchValue*)(sAMAccountName=*$searchValue*))(memberof=CN=IT - Testing Services Group,OU=Security Groups,OU=MCB User Groups,DC=mcb,DC=local))";
   $search_filter="(&(objectClass=user)(sAMAccountName=$searchValue)(|(memberof=CN=IT - Testing Services Group,OU=Security Groups,OU=MCB User Groups,DC=mcb,DC=local)(memberof=CN=IT Testing Services Automation,OU=Mail Distribution Groups,OU=MCB User Groups,DC=mcb,DC=local)))";

      //Connect to LDAP
     $justthese=array("cn","mail","sAMAccountName");
      $result = ldap_search($ldap_connection, $ldap_base_dn, $search_filter, $justthese);
      $Result=array();
      if (FALSE !== $result){
        // if  user exist
          $Result = ldap_get_entries($ldap_connection, $result);


          $entries['success']=true;
          $entries['result']=$Result;
          // echo "<pre>";
          // print_r($Result);
          // echo "</pre>";

      } //END FALSE !== $result
      else{
          $entries['success']=false;
          $entries['result']='An error occured. Please try again.';
      }


      ldap_unbind($ldap_connection); // Clean up after ourselves.

      return $entries;

    }
}

// $_POST['searchUser']="selgoi";
// $_POST['echoJson']=true;
if (isset($_POST['searchUser'])){
  // echo "bo";
  $searchValue = $_POST['searchUser'];
  $Result=getUser('svc_spiratest','P@$$w0rd',$searchValue);
  // if(!isset($_POST['echoJson']))
  // {
  // echo "<pre>";
  // print_r($Result);
  // echo "</pre>";
  header('Content-Type: application/json; charset=utf-8');
  echo json_encode($Result,JSON_PRETTY_PRINT);
  // }

}else{
  $Result['success']=false;
  $Result['result']="An error occured.Please Try again later";
  // echo "Error";
}



// echo "<pre>";
// print_r($Result);
// echo "</pre>";

// echo $Result;
// echo "error";

?>
