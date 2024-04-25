## About

This is a wrapper for the Csomagpiac API v1, which utilizes Laravel's built-in HTTP Requests class. The package manages authentication using a universal token. In its absence, it can also request the necessary token using a username + password combination. The token obtained in this manner is cached for faster access. The package supports switching between demo and production environments (demo vs. bestr).

API Documentation: [Csomagpiac API v1](https://documenter.getpostman.com/view/25719380/2s93CSpWuF)

## Installation

**Requires**

- **[PHP 8.2+](https://php.net/releases/)**
- **[Laravel 10.0+](https://github.com/laravel/laravel)**

To get started with package, simply install it via Composer:

``` bash
composer require cserepesmark/laravel-csomagpiac
```

## Configuration

The packages support the use of either a universal token or a username and password. However, the package prioritizes the use of the universal token.

Configure your API credentials in .env

``` env
CSOMAGPIAC_TOKEN=
CSOMAGPIAC_USERNAME=
CSOMAGPIAC_PASSWORD=
```

or in config/csomagpiac.php file:

``` php
'token' => env('CSOMAGPIAC_TOKEN', null),
'username' => env('CSOMAGPIAC_USERNAME', null),
'password' => env('CSOMAGPIAC_PASSWORD', null),
```

You can also easily switch between environments in .env

``` env
CSOMAGPIAC_LIVE_ENV=
```

or in config/csomagpiac.php file:

``` php
'live_env' => env('CSOMAGPIAC_LIVE_ENV', false),
```

## Usage

See `/examples` folder

### Shipment

| ShipmentService method | API Name                | API Endpoint      |
|------------------------|-------------------------|-------------------|
| createShipment         | new shipment            | shipment/new      |
| downloadShipmentLabel  | download shipment label | shipment/download |
| deleteShipment         | delete shipment         | shipment/delete   |
| listShipments          | list of shipments       | shipment/list     |
| getShipmentStatus      | shipment status         | shipment/status   |
| listShipmentHistories  | shipment history        | shipment/history  |
| listAllStatuses        | statuses                | shipment/statuses |

### MPL Close

| ShipmentService method | API Name      | API Endpoint  |
|------------------------|---------------|---------------|
| handleMplClose         | mplClose      | mplclose      |
| listMplCloses          | mplClosesList | mplcloseslist |
| downloadMplClose       | mplClosePdf   | mplclosepdf   |

### Other
| ShipmentService method | API Name     | API Endpoint    |
|------------------------|--------------|-----------------|
| listPickupPoints       | pickuppoints | pickuppoints    |
| listLocations          | pdpoints     | locations/list  |
| listServices           | services     | client/services |
| listLocationTypes      | pdpointTypes | locations/types |
| listHandlers           | handlers     | handlers        |

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
