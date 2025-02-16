# Env Loader

A lightweight and efficient PHP package for loading `.env` files and managing environment configurations.

## 🚀 Features

✔️ Reads and parses `.env` files efficiently.

✔️ Supports multi-line and quoted values.

✔️ Handles comments and whitespace gracefully.

✔️ Provides a flexible configuration system.

✔️ Uses a service-based architecture for extensibility.

### 📦 Installation

Install via Composer(soon):

### 🛠️ Usage

#### 1️⃣ Load Environment Variables

```php

use EnvLoader\Factories\EnvFactory;

$env = EnvFactory::create();

```

#### 2️⃣ Access Configuration Values

```php

use EnvLoader\Services\ConfigLoader;
use EnvLoader\Services\Config;

// Load Config ../configs/env.php
$configArray = ConfigLoader::loadStatic(__DIR__ . '/configs', 'env');
$configService = new Config($configArray);

// Get Config Values
$fileName = $configService->get('file.name.default');

```

### 📁 Project Structure

```css

📦 EnvLoader
 ┣ 📂 configs
 ┣ 📂 src
 ┃ ┣ 📂 Contracts
 ┃ ┣ 📂 Enums
 ┃ ┣ 📂 Exceptions
 ┃ ┣ 📂 Factories
 ┃ ┣ 📂 Services
 ┃ ┗ Env.php
 ┣ 📂 tests
 ┣ 📜 .gitignore
 ┣ 📜 .env.example
 ┣ 📜 composer.json
 ┣ 📜 phpunit.xml
 ┣ 📜 LICENSE
 ┗ 📜 README.md

```

### 🛠 Configuration

By default, EnvLoader expects a .env file in your project's root.
You can change this by create a config file in your project file like below and pass your path and your file name based on **Usage** part:

```php

return [
    'file' => [
        'name' => ['default' => '.env']
    ]
];

```

## 📌 Error Handling

EnvLoader automatically detects invalid regex operations and missing files.
It throws RuntimeException when errors occur.

Example:

```php

throw new \RuntimeException("Config file not found: $filePath");

```

## ✅ Testing

Run PHPUnit tests:

```bash

vendor/bin/phpunit

```

## 📄 License

This package is licensed under the MIT License.

