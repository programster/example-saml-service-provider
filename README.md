# Example SAML Service Provider
An example of integrating a PHP website with a SAML single sign-on (SSO) service.


## Certificate Generation
To allow SAML to sign/verify requests, one has to create x509 public/private key-pairs to use for 
signing/encrypting the requests.

You can generate such a keypair with the command:

```bash
openssl req \
  -newkey rsa:2048 \
  -nodes -keyout private.pem \
  -x509 \
  -days 365 \
  -out public.crt
```

You will need to generate one pair for the service provider and either be given the public 
certificate for the identity provider, or you need to generate a pair for it as well (and keep its 
public certificate in this codebase).

The saml-certs folder expects the service providers certificate files with the names:

* *sp-public-signing-certificate.crt* - the public certificate
* *sp-private-signing-certificate.pem* - the private key.

The folder should also contain the identity providers public certificate with the name:
*idp-public-signing-certificate.crt*.

