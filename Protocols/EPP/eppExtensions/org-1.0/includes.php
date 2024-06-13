<?php
$this->addExtension('org-1.0', 'urn:ietf:params:xml:ns:epp:org-1.0');

include_once(dirname(__FILE__) . '/eppRequests/orgCreateOrganisationRequest.php');
include_once(dirname(__FILE__) . '/eppResponses/orgCreateOrganisationResponse.php');
$this->addCommandResponse('Metaregistrar\EPP\orgCreateOrganisationRequest', 'Metaregistrar\EPP\orgCreateOrganisationResponse');

include_once(dirname(__FILE__) . '/eppRequests/orgInfoOrganisationRequest.php');
include_once(dirname(__FILE__) . '/eppResponses/orgInfoOrganisationResponse.php');
$this->addCommandResponse('Metaregistrar\EPP\orgInfoOrganisationRequest', 'Metaregistrar\EPP\orgInfoOrganisationResponse');
