<?php
namespace Metaregistrar\EPP;

class sidnEppCreateResellerResponse extends eppInfoResponse {

    /**
     *
     * @return string resellerid
     */
    public function getResellerId() {
        return $this->queryPath('/epp:epp/epp:response/epp:resData/reseller:creData/reseller:id');
    }

    /**
     *
     * @return string create_date
     */
    public function getResellerCreateDate() {
        return $this->queryPath('/epp:epp/epp:response/epp:resData/reseller:creData/reseller:crDate');
    }

}
