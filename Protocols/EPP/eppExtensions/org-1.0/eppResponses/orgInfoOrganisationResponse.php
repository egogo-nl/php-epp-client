<?php
namespace Metaregistrar\EPP;
class orgInfoOrganisationResponse extends eppResponse {
    function __construct() {
        parent::__construct();
    }

    public function getResellerName() {
        $ip = [];
        $xpath = $this->xPath();
        $result = $xpath->query('/epp:epp/epp:response/epp:resData/org:infData/org:postalInfo/org:name');

        if ($result->length > 0) {
            return $result->item(0)->nodeValue;
        } else {
            return null;
        }
    }

}