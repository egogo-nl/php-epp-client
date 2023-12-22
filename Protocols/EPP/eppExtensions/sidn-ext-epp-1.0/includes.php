<?php
$this->addExtension('sidn-ext-epp', 'http://rxsd.domain-registry.nl/sidn-ext-epp-1.0');

include_once(dirname(__FILE__) . '/eppResponses/sidnEppResponse.php');

// Org field is used by SIDN as organisational department
include_once(dirname(__FILE__) . '/eppRequests/sidnEppContactPostalInfo.php');
$this->addCommandResponse('Metaregistrar\EPP\sidnEppContactPostalInfo', 'Metaregistrar\EPP\eppContactPostalInfo');

// Create contact with additional parameters
include_once(dirname(__FILE__) . '/eppRequests/sidnEppCreateContactRequest.php');
$this->addCommandResponse('Metaregistrar\EPP\sidnEppCreateContactRequest', 'Metaregistrar\EPP\eppCreateContactResponse');

// Renew domain name with renew extension (this is not an extension????)
include_once(dirname(__FILE__) . '/eppRequests/sidnEppRenewRequest.php');
$this->addCommandResponse('Metaregistrar\EPP\sidnEppRenewRequest', 'Metaregistrar\EPP\eppRenewResponse');

include_once(dirname(__FILE__) . '/eppRequests/sidnEppPollRequest.php');
include_once(dirname(__FILE__) . '/eppResponses/sidnEppPollResponse.php');
$this->addCommandResponse('Metaregistrar\EPP\sidnEppPollRequest', 'Metaregistrar\EPP\sidnEppPollResponse');

include_once(dirname(__FILE__) . '/eppResponses/sidnEppCheckResponse.php');
$this->addCommandResponse('Metaregistrar\EPP\eppCheckRequest', 'Metaregistrar\EPP\sidnEppCheckResponse');

include_once(dirname(__FILE__) . '/eppRequests/sidnEppInfoDomainRequest.php');
include_once(dirname(__FILE__) . '/eppResponses/sidnEppInfoDomainResponse.php');
$this->addCommandResponse('Metaregistrar\EPP\sidnEppInfoDomainRequest', 'Metaregistrar\EPP\sidnEppInfoDomainResponse');

include_once(dirname(__FILE__) . '/eppRequests/sidnEppUpdateDomainRequest.php');
$this->addCommandResponse('Metaregistrar\EPP\sidnEppUpdateDomainRequest', 'Metaregistrar\EPP\eppUpdateDomainResponse');

include_once(dirname(__FILE__) . '/eppRequests/sidnEppInfoResellerRequest.php');
include_once(dirname(__FILE__) . '/eppResponses/sidnEppInfoResellerResponse.php');
$this->addCommandResponse('Metaregistrar\EPP\sidnEppInfoResellerRequest', 'Metaregistrar\EPP\sidnEppInfoResellerResponse');

include_once(dirname(__FILE__) . '/eppRequests/sidnEppCreateResellerRequest.php');
include_once(dirname(__FILE__) . '/eppResponses/sidnEppCreateResellerResponse.php');
$this->addCommandResponse('Metaregistrar\EPP\sidnEppCreateResellerRequest', 'Metaregistrar\EPP\sidnEppCreateResellerResponse');

include_once(dirname(__FILE__) . '/eppRequests/sidnEppUpdateResellerRequest.php');
$this->addCommandResponse('Metaregistrar\EPP\sidnEppUpdateResellerRequest', 'Metaregistrar\EPP\eppInfoResponse');

include_once(dirname(__FILE__) . '/eppExceptions/sidnEppException.php');
$this->addException('Metaregistrar\EPP\sidnEppException');

