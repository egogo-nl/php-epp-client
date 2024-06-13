<?php
namespace Metaregistrar\EPP;

// See https://docs.dnsbelgium.be/be/epp/createreseller.html for example request/response

class orgCreateOrganisationRequest extends eppRequest {

    /**
     * ContactObject object to add namespaces to
     * @var \DomElement
     */
    public $organisationobject = null;

    function __construct($id, $name, $url) {
        parent::__construct();
        $create = $this->createElement('create');
        $this->organisationobject = $this->createElement('org:create');

        $this->organisationobject->setAttribute('xmlns:org','urn:ietf:params:xml:ns:epp:org-1.0');

        $this->id = $this->createElement('org:id', $id);
        $this->role = $this->createElement('org:role');
        $this->role->appendChild($this->createElement('org:type', 'reseller'));

        $this->postalInfo = $this->createElement('org:postalInfo');
        $this->postalInfo->setAttribute('type','loc');
        $this->postalInfo->appendChild($this->createElement('org:name', $name));

        $this->url = $this->createElement('org:url', $url);

        $this->organisationobject->appendChild($this->id);
        $this->organisationobject->appendChild($this->role);
        $this->organisationobject->appendChild($this->postalInfo);
        $this->organisationobject->appendChild($this->url);

        /*
        if (!$this->rootNamespaces()) {
            $this->contactobject->setAttribute('xmlns:contact','urn:ietf:params:xml:ns:contact-1.0');
        }
        */
        $create->appendChild($this->organisationobject);
        $this->getCommand()->appendChild($create);
    }
}