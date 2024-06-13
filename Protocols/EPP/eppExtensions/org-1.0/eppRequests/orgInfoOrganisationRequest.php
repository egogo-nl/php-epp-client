<?php
namespace Metaregistrar\EPP;

// See https://docs.dnsbelgium.be/be/epp/createreseller.html for example request/response

class orgInfoOrganisationRequest extends eppRequest {

    /**
     * ContactObject object to add namespaces to
     * @var \DomElement
     */
    public $organisationobject = null;

    function __construct($id) {
        parent::__construct();
        $info = $this->createElement('info');
        $this->organisationobject = $this->createElement('org:info');
        $this->organisationobject->setAttribute('xmlns:org','urn:ietf:params:xml:ns:epp:org-1.0');

        $this->id = $this->createElement('org:id', $id);

        $this->organisationobject->appendChild($this->id);

        /*
        if (!$this->rootNamespaces()) {
            $this->contactobject->setAttribute('xmlns:contact','urn:ietf:params:xml:ns:contact-1.0');
        }
        */
        $info->appendChild($this->organisationobject);
        $this->getCommand()->appendChild($info);
    }
}