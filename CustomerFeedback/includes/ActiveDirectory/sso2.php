<?php

function authenticate($txtPassword,$txtUsername){
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

       $search_filter="(sAMAccountName=$txtUsername)";



        //Connect to LDAP
        $justthese=array('memberof');
        $result = ldap_search($ldap_connection, $ldap_base_dn, $search_filter,$justthese);
        $Result=array();
        if (FALSE !== $result){
            $Result = ldap_get_entries($ldap_connection, $result);
            // echo '<pre>';
            // print_r($Result) ;
            // echo '</pre>';
            $entries['success']=true;
            $entries['result']=$Result;


        } //END FALSE !== $result
        else{
            $entries['success']=false;
            $entries['result']='you do not have access to this site. Contact admin';
        }


        ldap_unbind($ldap_connection); // Clean up after ourselves.


    } //END ldap_bind
    else{
      $entries['success']=false;
      $entries['result']='Invalid Credentials- Please check Username/Password ';
    }
    return $entries;
}
?>
