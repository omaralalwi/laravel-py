<?php

use Omaralalwi\PhpPy\Managers\ConfigManager;
use Omaralalwi\PhpPy\PhpPy;

test('LaravelPy runs the script correctly', function () {

    $configManager = new ConfigManager([
        'scripts_directory' => __DIR__ . '/../example-scripts',
        'python_executable' => '/usr/bin/python3',
        'max_timeout' => 30,
    ]);

    $result = PhpPy::build()
        ->setConfig($configManager)
        ->loadScript('sum_calculator.py')
        ->withArguments([10, 20, 30])
        ->run();

    expect(json_decode($result))->toBe(60.0);
});

test('LaravelPy throws exception when try to run script outside allowed path', function () {

    $configManager = new ConfigManager([
        'scripts_directory' => __DIR__ . '/../example-scripts',
        'python_executable' => '/usr/bin/python3',
        'max_timeout' => 30,
    ]);

    $this->expectException(\InvalidArgumentException::class);
    $this->expectExceptionMessage('Script path does not exist.');

    $result = PhpPy::build()
        ->setConfig($configManager)
        ->loadScript('/fake-path/sum_calculator.py')
        ->withArguments([10, 20, 30])
        ->run();

    expect(json_decode($result))->toBe('Script path does not exist.');
});

test('withEnvironment throws exception for blacklisted environment variables', function () {

    $configManager = new ConfigManager([
        'scripts_directory' => __DIR__ . '/../example-scripts',
        'python_executable' => '/usr/bin/python3',
        'max_timeout' => 30,
    ]);

    $env = [
        'LD_LIBRARY_PATH' => 'fake value',
    ];

    $this->expectException(\InvalidArgumentException::class);
    $this->expectExceptionMessage("Environment variable 'LD_LIBRARY_PATH' is not allowed.");

    $result = PhpPy::build()
        ->setConfig($configManager)
        ->loadScript('sum_calculator.py')
        ->withArguments([10, 20, 30])
        ->withEnvironment($env)
        ->run();

    expect(json_decode($result))->toBe("Environment variable 'LD_LIBRARY_PATH' is not allowed.");
});
