<?php
namespace Metaregistrar\EPP;
/*
<?xml version="1.0" encoding="UTF-8" standalone="no"?>
 <epp xmlns="urn:ietf:params:xml:ns:epp-1.0">
     <command>
         <update>
             <domain:update xmlns:domain="urn:ietf:params:xml:ns:domain-1.0">
                 <domain:name>domeinnaam.nl</domain:name>
             </domain:update>
         </update>
         <extension>
             <scheduledDelete:update xmlns:scheduledDelete="http://rxsd.domain-registry.nl/sidn-ext-epp-scheduled-delete-1.0">
                 <scheduledDelete:operation>setDateToEndOfSubscriptionPeriod</scheduledDelete:operation>
             </scheduledDelete:update>
         </extension>
         <clTRID>300100</clTRID>
     </command>
 </epp>
*/

class sidnEppUpdateDomainRequest extends eppDnssecUpdateDomainRequest {

    function __construct($objectname, $addinfo = null, $removeinfo = null, $updateinfo = null, $forcehostattr = false, $namespacesinroot = true, $usecdata = true) {
        $this->setNamespacesinroot($namespacesinroot);
        $this->setForcehostattr($forcehostattr);
        eppDomainRequest::__construct(eppRequest::TYPE_UPDATE);
        $this->setUseCdata($usecdata);
        if ($objectname instanceof eppDomain) {
            $domainname = $objectname->getDomainname();
        } else {
            if (strlen($objectname)) {
                $domainname = $objectname;
            } else {
                throw new eppException("Object name must be valid string on eppUpdateDomainRequest");
            }
        }
        $this->updateDomain($domainname, $addinfo, $removeinfo, $updateinfo);
        $this->setForcehostattr($forcehostattr);

        $secdns = $this->createElement('secDNS:update');
        $secdns->setAttribute('xmlns:secDNS', 'urn:ietf:params:xml:ns:secDNS-1.1');
        $secdns_updated = false;
        if ($removeinfo instanceof eppDomain) {
            $dnssecs = $removeinfo->getSecdns();
            if (count($dnssecs) > 0) {
                $rem = $this->createElement('secDNS:rem');
                foreach ($dnssecs as $dnssec) {
                    /* @var $dnssec eppSecdns */
                    if (strlen($dnssec->getPubkey()) > 0) {
                        $keydata = $this->createElement('secDNS:keyData');
                        $keydata->appendChild($this->createElement('secDNS:flags', $dnssec->getFlags()));
                        $keydata->appendChild($this->createElement('secDNS:protocol', $dnssec->getProtocol()));
                        $keydata->appendChild($this->createElement('secDNS:alg', $dnssec->getAlgorithm()));
                        $keydata->appendChild($this->createElement('secDNS:pubKey', $dnssec->getPubkey()));
                        $rem->appendChild($keydata);
                    }
                    if (strlen($dnssec->getKeytag()) > 0) {
                        $dsdata = $this->createElement('secDNS:dsData');
                        $dsdata->appendChild($this->createElement('secDNS:keyTag', $dnssec->getKeytag()));
                        $dsdata->appendChild($this->createElement('secDNS:alg', $dnssec->getAlgorithm()));
                        if (strlen($dnssec->getSiglife()) > 0) {
                            $dsdata->appendChild($this->createElement('secDNS:maxSigLife', $dnssec->getSiglife()));
                        }
                        $dsdata->appendChild($this->createElement('secDNS:digestType', $dnssec->getDigestType()));
                        $dsdata->appendChild($this->createElement('secDNS:digest', $dnssec->getDigest()));
                        $rem->appendChild($dsdata);
                    }
                }
                $secdns->appendChild($rem);
                $secdns_updated = true;
            }
        }
        if ($addinfo instanceof eppDomain) {
            $dnssecs = $addinfo->getSecdns();
            if (count($dnssecs) > 0) {
                $add = $this->createElement('secDNS:add');
                foreach ($dnssecs as $dnssec) {
                    /* @var $dnssec eppSecdns */
                    if (strlen($dnssec->getPubkey()) > 0) {
                        $keydata = $this->createElement('secDNS:keyData');
                        $keydata->appendChild($this->createElement('secDNS:flags', $dnssec->getFlags()));
                        $keydata->appendChild($this->createElement('secDNS:protocol', $dnssec->getProtocol()));
                        $keydata->appendChild($this->createElement('secDNS:alg', $dnssec->getAlgorithm()));
                        $keydata->appendChild($this->createElement('secDNS:pubKey', $dnssec->getPubkey()));
                        $add->appendChild($keydata);
                    }
                    if (strlen($dnssec->getKeytag()) > 0) {
                        $dsdata = $this->createElement('secDNS:dsData');
                        $dsdata->appendChild($this->createElement('secDNS:keyTag', $dnssec->getKeytag()));
                        $dsdata->appendChild($this->createElement('secDNS:alg', $dnssec->getAlgorithm()));
                        if (strlen($dnssec->getSiglife()) > 0) {
                            $dsdata->appendChild($this->createElement('secDNS:maxSigLife', $dnssec->getSiglife()));
                        }
                        $dsdata->appendChild($this->createElement('secDNS:digestType', $dnssec->getDigestType()));
                        $dsdata->appendChild($this->createElement('secDNS:digest', $dnssec->getDigest()));
                        $add->appendChild($dsdata);
                    }
                }
                $secdns->appendChild($add);
                $secdns_updated = true;
            }
        }
        if ($secdns_updated) {
            $this->getExtension()->appendchild($secdns);
        }

    }

   public function scheduledDelete($operation, $date = null) {
       $scheduledDelete = $this->createElement('scheduledDelete:update');
       $scheduledDelete->setAttribute('xmlns:scheduledDelete','http://rxsd.domain-registry.nl/sidn-ext-epp-scheduled-delete-1.0');
       $scheduledDelete->appendChild($this->createElement('scheduledDelete:operation', $operation));
       if (!empty($date)) {
           $scheduledDelete->appendChild($this->createElement('scheduledDelete:date', $date));
       }
       $this->getExtension()->appendChild($scheduledDelete);
       // session id needs to be added after the extension
       $this->addSessionId();
   }

   public function removeReseller($reseller_id) {

       $resellerRem = $this->createElement('resellerExt:rem');
       $resellerRem->appendChild($this->createElement('resellerExt:id', $reseller_id));

       if ($resellerExt = $this->getExtension()->getElementsByTagName('resellerExt:update')->item(0)) {
           $resellerExt->appendChild($resellerRem);
       } else {
           $resellerExt = $this->createElement('resellerExt:update');
           $resellerExt->setAttribute('xmlns:resellerExt','http://rxsd.domain-registry.nl/sidn-ext-epp-reseller-1.0');
           $resellerExt->appendChild($resellerRem);
       }

       $this->getExtension()->appendChild($resellerExt);

       // session id needs to be added after the extension
       $this->addSessionId();
   }

   public function addReseller($reseller_id) {

       $resellerAdd = $this->createElement('resellerExt:add');
       $resellerAdd->appendChild($this->createElement('resellerExt:id', $reseller_id));

       if ($resellerExt = $this->getExtension()->getElementsByTagName('resellerExt:update')->item(0)) {
           $resellerExt->appendChild($resellerAdd);
       } else {
           $resellerExt = $this->createElement('resellerExt:update');
           $resellerExt->setAttribute('xmlns:resellerExt','http://rxsd.domain-registry.nl/sidn-ext-epp-reseller-1.0');
           $resellerExt->appendChild($resellerAdd);
       }

       $this->getExtension()->appendChild($resellerExt);

       // session id needs to be added after the extension
       $this->addSessionId();
   }

}