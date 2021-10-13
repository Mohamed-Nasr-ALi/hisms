# HiSms


The  [`ibtdi/hisms`](https://github.com/Mohamed-Nasr-ALi/hisms) package provides a fluent interface to send sms using [HISMS](https://www.hisms.ws) in your php application.


## HISMS Intro
[<img src="https://hisms.ws/templates/default/img/logo/blue-big.png" width="419px" />](https://www.hisms.ws)
### we can send sms using HISMS sms service provider that allow only saudi arabia phone numbers
#### List Of Supported Numbers 
[`saudi arabia phones`](https://en.wikipedia.org/wiki/Telephone_numbers_in_Saudi_Arabia)

## Install

You can install the package via composer:

``` bash
composer require ibtdi/hisms
```

## Usage

- After install package run the installation command
```
php artisan hisms:install
```
- Set your env variables - take a look at `config/hisms.php`
- Send first sms:
```
HiSms::to(['9665 xxx xxxx','9665 xxx xxxx'])
        ->message('hello world')
        ->send();
```
and that's it...
- other was you would like to get some response it can be done like so:
```
$response=HiSms::to(['9665 xxx xxxx','9665 xxx xxxx'])
        ->message('hello world')
        ->send()
        ->andGetMessage();
```
- there are other functions to get infos individual not chaining `andGetStatus` `andGetCode`
```
 $response=HiSms::to(['9665 xxx xxxx','9665 xxx xxxx'])
        ->message('hello world')
        ->send()
        ->andGetStatus();
```
```
 $response=HiSms::to(['9665 xxx xxxx','9665 xxx xxxx'])
        ->message('hello world')
        ->send()
        ->andGetCode();
```
- `andGetStatus : bool`
`andGetMessage : string`
`andGetCode : int`

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Testing

``` bash
phpunit
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security

If you discover any security related issues, please email mohamednasrali00@gmail.be instead of using the issue tracker.

## License

The MIT License (MIT). Please see [License File](LICENSE) for more information.
