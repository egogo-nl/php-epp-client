<?php
namespace Metaregistrar\EPP;

class sidnEppInfoResellerRequest extends eppRequest {

    /**
     * ContactObject object to add namespaces to
     * @var \DomElement
     */
    public $contactobject = null;

    function __construct($reseller_id, $namespacesinroot = true, $usecdata = true) {
        $this->setNamespacesinroot($namespacesinroot);
        parent::__construct();
        $info = $this->createElement(eppRequest::TYPE_INFO);
        $check = $this->createElement('reseller:'.eppRequest::TYPE_INFO);
        $check->setAttribute('xmlns:reseller','http://rxsd.domain-registry.nl/sidn-reseller-1.0');
        $check->appendChild($this->createElement('reseller:id', $reseller_id));

        $info->appendChild($check);
        $this->getCommand()->appendChild($info);
        $this->addSessionId();

    }

    function __destruct() {
        parent::__destruct();
    }

}