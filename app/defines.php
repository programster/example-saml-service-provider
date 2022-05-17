<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

// Specify the identity of this service provider. Must be a URI
define('APP_URL', "https://app.programster.org");

// Identifier of the SP entity  (must be a URI)
define('APP_SERVICE_PROVIDER_IDENTITY', APP_URL);


define('APP_SERVICE_PROVIDER_NAME', "Test Service Provider");


// URL Location where the <Response> from the IdP will be returned
define('APP_LOGIN_RESPONSE_ENDPOINT', APP_URL . '/auth/saml-login-handler');

// URL Location where the response from the IdP will be returned
define('APP_SLO_RESPONSE_ENDPOINT', APP_URL . '/auth/saml-logout-handler');

# this define just helps with setting the other defines, and is the base URL
define('IDENTITY_PROVIDER_BASE_URL', 'https://idp.programster.org:8443');

# Specify the identity of the IDP.
define('IDENTITY_PROVIDER_IDENTITY_URI', IDENTITY_PROVIDER_BASE_URL . "/simplesaml/saml2/idp/metadata.php");

// Specify the URL where to send the SAML auth requests.
define('IDENTITY_PROVIDER_AUTH_URL', IDENTITY_PROVIDER_BASE_URL . "/simplesaml/saml2/idp/SSOService.php");
//define('IDENTITY_PROVIDER_AUTH_URL', IDENTITY_PROVIDER_BASE_URL . "/simplesaml/module.php/saml/sp/saml2-acs.php/default-sp");


// URL Location of the identity providers logout url.
define('IDENTITY_PROVIDER_LOGOUT_URL', IDENTITY_PROVIDER_BASE_URL . "/simplesaml/saml2/idp/SingleLogoutService.php");
//define('IDENTITY_PROVIDER_LOGOUT_URL', IDENTITY_PROVIDER_BASE_URL . "/simplesaml/module.php/saml/sp/saml2-logout.php/default-sp");

# Specify the path to the folder containing any/all of the public "signing" certificates 
# for the IDP for validating responses. At least one of these certificates should correspond
# to the private key being used by the IDP to sign their messages.
# Allowing multiple certificates facilitates certificate rollover by the IDP.
define('IDENTITY_PROVIDER_PUBLIC_SIGNING_CERT_DIR', '/saml-certs/idp-public-signing-certs');

# Specify the path to the x509 certificate file for this service provider
define('SERVICE_PROVIDER_CERT_PATH', '/saml-certs/sp-public-signing-certificate.crt');

# Specify the path to the private key for the service provider.
define('SERVICE_PROVIDER_PRIVATE_KEY_PATH', '/saml-certs/sp-private-signing-certificate.pem');


