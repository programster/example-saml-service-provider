<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class AuthController extends AbstractSlimController
{

    public static function registerRoutes($app)
    {
        $app->get('/auth/login', function (Psr\Http\Message\ServerRequestInterface $request, Psr\Http\Message\ResponseInterface $response, $args) {
            $controller = new AuthController($request, $response, $args);
            return $controller->handleUserLoginRequest();
        });

        $app->get('/auth/logout', function (Psr\Http\Message\ServerRequestInterface $request, Psr\Http\Message\ResponseInterface $response, $args) {
            $controller = new AuthController($request, $response, $args);
            return $controller->handleUserLogoutRequest();
        });

        # Handle response back from SAML identity provider.
        $app->post('/auth/saml-login-handler', function (Psr\Http\Message\ServerRequestInterface $request, Psr\Http\Message\ResponseInterface $response, $args) {
            $controller = new AuthController($request, $response, $args);
            return $controller->handleSamlLoginResponse();
        });

        # Handle response back from SAML identity provider.
        $app->get('/auth/saml-logout-handler', function (Psr\Http\Message\ServerRequestInterface $request, Psr\Http\Message\ResponseInterface $response, $args) {
            $controller = new AuthController($request, $response, $args);
            return $controller->handleSamlLogoutResponse();
        });

        # Handle response back from SAML identity provider.
        $app->get('/auth/saml-metadata', function (Psr\Http\Message\ServerRequestInterface $request, Psr\Http\Message\ResponseInterface $response, $args) {
            $controller = new AuthController($request, $response, $args);
            return $controller->handleSamlMetadataRequest();
        });
    }


    /**
     * Handle a request to get the metdata file for SAML integration.
     * @return
     */
    private function handleSamlMetadataRequest() : Psr\Http\Message\ResponseInterface
    {
        // SAML posted back the data, processResponse relies on this data being in $_POST
        $samlClient = SiteSpecific::getSamlClient();
        $settings = $samlClient->getAuth()->getSettings();

        $technicalContact = new \Programster\Saml\Contact(
            \Programster\Saml\ContactType::createTechnical(),
            "Programster",
            "me@programster.org"
        );

        $contacts = new Programster\Saml\ContactCollection($technicalContact);

        $organizationInfo = new \Programster\Saml\OrganizationTranslation(
            "Programster Ltd",
            "Programster Ltd",
            "https://blog.programster.org"
        );

        $organization = new Programster\Saml\Organization($organizationInfo);

        $metadata = $samlClient->getServiceProviderMetadata(
            signMetadata: true,
            authnsign: true,
            wantAssertionsSigned: true,
            contacts : $contacts,
            organization: $organization,
        );

        return SlimLib::createXmlResponse($metadata);
    }


    private function handleSamlLoginResponse()
    {
        // SAML posted back the data, processResponse relies on this data being in $_POST
        //$auth = new \OneLogin\Saml2\Auth(SiteSpecific::getSamlSettings());
        //$samlClient = new \Programster\Saml\SamlClient($auth);
        $samlClient = SiteSpecific::getSamlClient();

        $response = $samlClient->handleSamlLoginResponse();
        $userAttributes = $response->getUserAttributes();
        $email = $userAttributes['email'][0];
        SiteSpecific::setLoggedInUser($email);
        $userInfoView = new ViewUserInfo($response);
        $page = new ViewHtmlTemplate($userInfoView);
        return SlimLib::createHtmlResponse($page);
    }


    private function handleSamlLogoutResponse()
    {
        // SAML posted back the data, processResponse relies on this data being in $_POST
        //$auth = new \OneLogin\Saml2\Auth(SiteSpecific::getSamlSettings());
        //$samlClient = new \Programster\Saml\SamlClient($auth);
        $samlClient = SiteSpecific::getSamlClient();
        $ssoLoggedOutUrl = $samlClient->handleSamlLogoutResponse();
        SiteSpecific::setLoggedOut();
        $page = new ViewHtmlTemplate("You are now logged out.");
        return SlimLib::createHtmlResponse($page);
    }


    /**
     * Handle a request from the user to login.
     * Shoot off a request to the identity provider to authenticate, instead of showing a login form.
     */
    private function handleUserLoginRequest()
    {
        //$auth = new \OneLogin\Saml2\Auth(SiteSpecific::getSamlSettings());
        //$samlClient = new \Programster\Saml\SamlClient($auth);
        $samlClient = SiteSpecific::getSamlClient();
        $returnToURL = "https://localhost/saml-login-handler";
        $samlClient->handleUserLoginRequest($returnToURL);
        die();
    }


    /**
     * Handle a user requesting to log out.
     */
    private function handleUserLogoutRequest()
    {
        //$auth = new \OneLogin\Saml2\Auth(SiteSpecific::getSamlSettings());
        //$samlClient = new \Programster\Saml\SamlClient($auth);
        $samlClient = SiteSpecific::getSamlClient();
        $returnToUrl = 'http://localhost/auth/saml-logout-handler';
        $samlClient->handleUserLogoutRequest($returnToUrl);
        die();
    }

}

