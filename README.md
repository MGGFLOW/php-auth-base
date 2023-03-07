# Basic authentication methods

## Installation

``
composer require mggflow/auth-base
``


## About

This package provides following Use Cases:
1. Register User
2. Verify User registration
3. Remove unverified Users
4. Authenticate User by:
   1. Login + Password
   2. Access Token
   3. Cookie
5. Remember User by Cookie

## Usage
To use necessary cases:
1. Implement appropriate interface from MGGFLOW\AuthBase\Interfaces
2. Construct an instance of case with instance of implementation
3. Use public methods

## Example

```
$code = "received verification code"
// VerificationDataProvider implements MGGFLOW\AuthBase\Interfaces\VerifyRegData
$dataProvider = new VerificationDataProvider();

$verificationCase = new MGGFLOW\AuthBase\VerifyRegistation($dataProvider);
try {
   $verificationCase->setVerificationCode($code);
   $verificationCase->verify();
} catсh (NoVerificationCode | VerificationFailed  $e) {
   throw $e;
}
```
