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
        $spConfig = new Programster\Saml\ServiceProviderConfig(
            entityId: APP_SERVICE_PROVIDER_IDENTITY,
            name: APP_SERVICE_PROVIDER_NAME,
            description: "A test service provider",
            loginHandlerUrl: APP_URL . "/auth/saml-login-handler",
            logoutHandlerUrl: APP_URL . "/auth/saml-logout-handler",
            publicCert: file_get_contents(SERVICE_PROVIDER_CERT_PATH),
            privateKey: file_get_contents(SERVICE_PROVIDER_PRIVATE_KEY_PATH)
        );

        $idpConfig = new \Programster\Saml\IdentityProviderConfig(
            entityId: IDENTITY_PROVIDER_IDENTITY_URI,
            authUrl: IDENTITY_PROVIDER_AUTH_URL,
            logoutUrl: IDENTITY_PROVIDER_LOGOUT_URL,
            publicSigningCertificate: file_get_contents(IDENTITY_PROVIDER_PUBLIC_SIGNING_CERT),
        );

        $samlConfig = new \Programster\Saml\SamlConfig($spConfig, $idpConfig);
        return new \Programster\Saml\SamlClient($samlConfig);
    }
}
