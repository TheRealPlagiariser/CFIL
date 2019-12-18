<?php





function getUser($txtUsername,$txtPassword,$searchValue,$from){
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



      //Your domains DN to query
      $ldap_base_dn = 'DC=mcb,DC=local';


      //Get standard users and contacts
      //$myMember='IT Testing Services';

      if(isset($from) && $from=="respondSurvey")
      {
        $search_filter="(sAMAccountName=$searchValue)";
      }

      else{
        $search_filter="(&(objectClass=user)(|(sn=*$searchValue*)(sAMAccountName=*$searchValue*)))";
      }



      //Connect to LDAP
     $justthese=array("cn","mail","sAMAccountName");
      $result = ldap_search($ldap_connection, $ldap_base_dn, $search_filter,$justthese);
      $Result=array();
      if (FALSE !== $result){
        // if  user exist
          $Result = ldap_get_entries($ldap_connection, $result);

          $entries['success']=true;
          $entries['result']=$Result;


      } //END FALSE !== $result
      else{
          $entries['success']=false;
          $entries['result']='An error occured. Please try again.';
      }


      ldap_unbind($ldap_connection); // Clean up after ourselves.
      return $entries;

    }
}

if (isset($_POST['searchUser'])){
  $searchValue = $_POST['searchUser'];
  if(isset($fromRespondUser) && $fromRespondUser=="respondSurvey")
  {
    $from=$fromRespondUser;
  }
  else{
    $from="";
  }
  $Result=getUser('svc_spiratest','P@$$w0rd',$searchValue,$from);
  if(!isset($_POST['echoJson']))
  {
    // echo "helllo";
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($Result,JSON_PRETTY_PRINT);
  }

}else{
  $Result['success']=false;
  $Result['result']="An error occured.Please Try again later";
  // echo "Error";
}


?>
