# Laravel Py - Laravel Python 🚀🐍

Laravel wrapper for **[php-py package](https://github.com/omaralalwi/php-py)** package, to Seamless enabling secure and efficient execution of Python scripts within Laravel applications without spread multiple applications and or setup  API.

## 📌 Table of Contents

- [🔧 Requirements](#requirements)
- [🚀 Installation](#installation-)
- [🚀 Quick Start](#-quick-start)
- [✨ Features Summary](#-features-summary)
- [📋 Changelog](#-changelog)
- [🧪 Testing](#-testing)
- [🔒 Security](#-security)
- [🤝 Contributors](#-contributors)
- [📄 License](#-license)


---

## Requirements

- PHP 8.1+ .
- [python3](https://www.python.org/) must be installed in server .

## Installation 🛠️

You can install the package via Composer:

```bash
composer require omaralalwi/laravel-py
```

## Publishing Configuration File

```bash
php artisan vendor:publish --tag=laravel-py
```

---

## 🚀 Quick Start

1. 📂 Create a folder for scripts, e.g., `phpPyScripts` in your project root directory.
2. 📝 Create a Python script file (`.py` extension) and write Python code. [See this script examples](https://github.com/omaralalwi/php-py/tree/master/example-scripts).
3. 🔧 make script file executable, `chmod +x script_file_path` .

### ⚡ Easy Usage

```php
<?php

use LaravelPy;

class LaravelPyController
{
  public function testLaravelPy() {
      $laravelPy = app(LaravelPy::class);
      $script = 'total_calculator.py';
      $arguments = [10, 20, 30];
          
      try {
           $result = $laravelPy
              ->loadScript($script)
              ->withArguments($arguments)
              ->run();
              
          print_r($result); // 60.0
      } catch (Exception $e) {
          echo "Error: " . $e->getMessage();
      }
  }
}
```

### 🔥 Advanced Usage

```php
<?php

use LaravelPy;
use Omaralalwi\PhpPy\Managers\ConfigManager;

class LaravelPyController
{
  public function testLaravelPy() 
  {
     try {
        $laravelPy = app(LaravelPy::class);
        $script = 'advance_example.py';

        $numbers = [2,4, 5,7,9];

        $config = new ConfigManager([
            'scripts_directory' => 'phpPyScripts',
            'python_executable' => '/usr/bin/python3',
            'max_timeout' => 120,
        ]);

        $result = $laravelPy
            ->setConfig($config)
            ->loadScript($script)
            ->withArguments($numbers)
            ->withEnvironment(['FIRST_ENV_VAR' => 10, 'SECOND_ENV_VAR' => 'second var value'])
            ->timeout(60)
            ->asJson()
            ->run();

        print_r(json_encode($result));
    } catch (\Exception $e) {
        print_r("Error: " . $e->getMessage());
    }
  }
}
```

---

## ✨ Features

### 🔐 Secure Execution
- **Path Validation** ✅ Ensures scripts are within allowed directories.
- **Argument & Environment Validation** 🔍 Restricts unauthorized input.
- **Timeout Control** ⏳ Prevents long-running scripts.
- **Uses `proc_close` as an alternative to `shell_exec`**.

### 🔧 Flexible Configuration
- Centralized settings via `ConfigManager`.
- Customizable execution parameters.

### 📤 Output Handling
- Supports JSON parsing.
- Captures and reports script errors.

### 🚨 Error Management
- Detailed exception handling for debugging.
- Standardized error reporting.

### 🔌 Extensibility
- Modular execution through `CommandExecutor`.
- Customizable for advanced use cases.

---

## 📋 Changelog

See detailed release notes in [CHANGELOG.md](CHANGELOG.md) 📜

---

## 🧪 Testing

```bash
composer test
OR
./vendor/bin/pest
```

---

## 🔒 Security

**Report Vulnerabilities**: Contact [omaralwi2010@gmail.com](mailto:omaralwi2010@gmail.com) 📩

---

## 🤝 Contributors

A huge thank you to these amazing people who have contributed to this project! 🎉💖

<table>
  <tr>
    <td align="center">
      <a href="https://github.com/omaralalwi">
        <img src="https://avatars.githubusercontent.com/u/25439498?v=4" width="60px;" style="border-radius:50%;" alt="Omar AlAlwi"/>
        <br />
        <b>Omar AlAlwi</b>
      </a>
      <br />
      🏆 Creator
    </td>
  </tr>
</table>

**Want to contribute?** Check out the [contributing guidelines](./CONTRIBUTING.md) and submit a pull request! 🚀

---

## 📄 License

This package is open-source software licensed under the [MIT License](LICENSE.md). 📜


