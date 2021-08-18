<?php

class ViewUserInfo extends Programster\AbstractView\AbstractView
{
    private \Programster\Saml\SamlAuthResponse $m_responseData;


    public function __construct(\Programster\Saml\SamlAuthResponse $responseData)
    {
        $this->m_responseData = $responseData;
    }


    protected function renderContent()
    {
?>

<table cellpadding="5px" cellspacing="0" border="1px" style="border: 1px solid black;">
    <tr><td>SAML Name ID</td><td><?= $this->m_responseData->getNameId(); ?></td></tr>
    <tr><td>SAML Name ID Format</td><td><?= $this->m_responseData->getNameIdFormat(); ?></td></tr>
    <tr><td>SAML Name ID Name Qualifier</td><td><?= $this->m_responseData->getNameIdNameQualifier(); ?></td></tr>
    <tr><td>Service Provider Name Qualifier</td><td><?= $this->m_responseData->getServiceProviderNameQualifier(); ?></td></tr>
    <tr><td>User Attributes</td><td><pre><?= print_r($this->m_responseData->getUserAttributes(), true); ?></pre></td></tr>
    <tr><td>SAML Session Index</td><td><?= $this->m_responseData->getSessionIndex(); ?></td></tr>
</table>


<?php
    }

}