<?php

/*
 *
 */

class SiteSpecific
{
    public static function isLoggedIn() : bool
    {
        return isset($_SESSION['user_id']);
    }


    public static function setLoggedInUser(string $email)
    {
        $_SESSION['user_id'] = $email;
    }


    public static function setLoggedOut()
    {
        session_destroy();
    }


    /**
     * Gets the client for interfacing with SAML SSO.
     * @return \Programster\Saml\SamlClient
     */
    public static function getSamlClient() : \Programster\Saml\SamlClient
    {
        $mailAttribute = new Programster\Saml\RequestedAttribute(
            isRequired: true,
            name: "urn:oid:0.9.2342.19200300.100.1.3",
            friendlyName: "mail"
        );

        $surnameAttribute = new Programster\Saml\RequestedAttribute(
            isRequired: true,
            name: "urn:oid:2.5.4.4",
            friendlyName: "surname"
        );

        $givenNameAttribute = new Programster\Saml\RequestedAttribute(
            isRequired: true,
            name: "urn:oid:2.5.4.42",
            friendlyName: "givenName"
        );

        $requestedAttributes = new Programster\Saml\RequestedAttributeCollection(
            $givenNameAttribute,
            $surnameAttribute,
            $mailAttribute
        );

        $spConfig = new Programster\Saml\ServiceProviderConfig(
            entityId: APP_SERVICE_PROVIDER_IDENTITY,
            subjectNameIdFormat: Programster\Saml\NameIdFormat::createPersistent(),
            name: APP_SERVICE_PROVIDER_NAME,
            description: "A test service provider",
            loginHandlerUrl: APP_URL . "/auth/saml-login-handler",
            logoutHandlerUrl: APP_URL . "/auth/saml-logout-handler",
            publicCert: file_get_contents(SERVICE_PROVIDER_CERT_PATH),
            privateKey: file_get_contents(SERVICE_PROVIDER_PRIVATE_KEY_PATH)
        );

        $idpSigningCerts = \Programster\CoreLibs\Filesystem::getDirContents(
            dir: IDENTITY_PROVIDER_PUBLIC_SIGNING_CERT_DIR,
            includeHiddenFilesAndFolders: false
        );

        // convert the list of certificate filepaths to a list of their contents.
        foreach ($idpSigningCerts as $index => $filepath)
        {
            $idpSigningCerts[$index] = file_get_contents($filepath);
        }

        $idpConfig = new \Programster\Saml\IdentityProviderConfig(
            entityId: IDENTITY_PROVIDER_IDENTITY_URI,
            authUrl: IDENTITY_PROVIDER_AUTH_URL,
            logoutUrl: IDENTITY_PROVIDER_LOGOUT_URL,
            publicSigningCertificates: $idpSigningCerts,
        );

        $samlConfig = new \Programster\Saml\SamlConfig($spConfig, $idpConfig);
        return new \Programster\Saml\SamlClient($samlConfig);
    }
}
