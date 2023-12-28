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

class sidnEppUpdateDomainRequest extends eppUpdateDomainRequest {

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