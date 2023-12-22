<?php
namespace Metaregistrar\EPP;

class sidnEppInfoResellerResponse extends eppInfoResponse {

    /**
     *
     * @return string resellerid
     */
    public function getResellerId() {
        return $this->queryPath('/epp:epp/epp:response/epp:resData/reseller:infData/reseller:id');
    }

    /**
     *
     * @return string reseller_resource_id
     */
    public function getResellerRoid() {
        return $this->queryPath('/epp:epp/epp:response/epp:resData/reseller:infData/reseller:roid');
    }

    /**
     *
     * @return string client id
     */
    public function getResellerClientId() {
        return $this->queryPath('/epp:epp/epp:response/epp:resData/reseller:infData/reseller:clID');
    }

    /**
     *
     * @return string client id
     */
    public function getResellerCreateClientId() {
        return $this->queryPath('/epp:epp/epp:response/epp:resData/reseller:infData/reseller:crID');
    }


    /**
     *
     * @return string update_date
     */
    public function getResellerUpdateDate() {
        return $this->queryPath('/epp:epp/epp:response/epp:resData/reseller:infData/reseller:upDate');
    }

    /**
     *
     * @return string create_date
     */
    public function getResellerCreateDate() {
        return $this->queryPath('/epp:epp/epp:response/epp:resData/reseller:infData/reseller:crDate');
    }


    /**
     *
     * @return string reseller_status
     */
    public function getResellerStatus() {
        $stat = null;
        $xpath = $this->xPath();
        $result = $xpath->query('/epp:epp/epp:response/epp:resData/reseller:infData/reseller:status/@s');
        foreach ($result as $status) {
            $stat[] = $status->nodeValue;
        }
        return $stat;
    }

    /**
     *
     * @return array of statuses
     */
    public function getResellerStatusCSV() {
        return parent::arrayToCSV($this->getResellerStatus());

    }

    /**
     *
     * @return string voice_telephone_number
     */
    public function getResellerVoice() {
        return $this->queryPath('/epp:epp/epp:response/epp:resData/reseller:infData/reseller:voice');
    }

    /**
     *
     * @return string fax_telephone_number
     */
    public function getResellerFax() {
        return $this->queryPath('/epp:epp/epp:response/epp:resData/reseller:infData/reseller:fax');
    }

    /**
     *
     * @return string email_address
     */
    public function getResellerEmail() {
        return $this->queryPath('/epp:epp/epp:response/epp:resData/reseller:infData/reseller:email');
    }

    /**
     *
     * @return string trading_name
     */
    public function getResellerTradingName() {
        return $this->queryPath('/epp:epp/epp:response/epp:resData/reseller:infData/reseller:tradingName');
    }

    /**
     *
     * @return string trading_name
     */
    public function getResellerUrl() {
        return $this->queryPath('/epp:epp/epp:response/epp:resData/reseller:infData/reseller:url');
    }

    public function getResellerStreet() {
        return $this->queryPath('/epp:epp/epp:response/epp:resData/reseller:infData/reseller:address/contact:street');
    }

    public function getResellerCity() {
        return $this->queryPath('/epp:epp/epp:response/epp:resData/reseller:infData/reseller:address/contact:city');
    }

    public function getResellerZipcode() {
        return $this->queryPath('/epp:epp/epp:response/epp:resData/reseller:infData/reseller:address/contact:pc');
    }

    public function getResellerCountrycode() {
        return $this->queryPath('/epp:epp/epp:response/epp:resData/reseller:infData/reseller:address/contact:cc');
    }

    /**
     *
     * @return string client id
     */
    public function getResellerUpdateClientId() {
        return $this->queryPath('/epp:epp/epp:response/epp:resData/reseller:infData/reseller:upID');
    }

}
