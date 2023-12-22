<?php
namespace Metaregistrar\EPP;

class sidnEppUpdateResellerRequest extends eppRequest {

    /**
     * ContactObject object to add namespaces to
     * @var \DomElement
     */
    public $contactobject = null;

    function __construct($reseller_id, $trading_name, $url, $email, $phone, $street, $city, $zipcode, $countrycode, $namespacesinroot = true, $usecdata = true) {
        $this->setNamespacesinroot($namespacesinroot);
        parent::__construct();
        $check = $this->createElement(eppRequest::TYPE_UPDATE);
        $this->contactobject = $this->createElement('reseller:'.eppRequest::TYPE_UPDATE);
        $this->contactobject->setAttribute('xmlns:reseller','http://rxsd.domain-registry.nl/sidn-reseller-1.0');

        $this->contactobject->appendChild($this->createElement('reseller:id', $reseller_id));

        $this->chg = $this->createElement('reseller:chg');

        $this->chg->appendChild($this->createElement('reseller:tradingName', $trading_name));
        $this->chg->appendChild($this->createElement('reseller:url', $url));
        $this->chg->appendChild($this->createElement('reseller:email', $email));
        $this->chg->appendChild($this->createElement('reseller:voice', $phone));

        $this->address = $this->createElement('reseller:address');
        $this->address->setAttribute('xmlns:contact','urn:ietf:params:xml:ns:contact-1.0');

        $this->address->appendChild($this->createElement('contact:street', $street));
        $this->address->appendChild($this->createElement('contact:city', $city));
        $this->address->appendChild($this->createElement('contact:pc', $zipcode));
        $this->address->appendChild($this->createElement('contact:cc', $countrycode));

        $this->chg->appendChild($this->address);
        $this->contactobject->appendChild($this->chg);

        $check->appendChild($this->contactobject);
        $this->getCommand()->appendChild($check);

        $this->addSessionId();

    }

    function __destruct() {
        parent::__destruct();
    }

    public static function generateRandomString($length = 10) {
        $characters = '123456789ABCDEFGHIJKLMNPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

}