<?php

declare(strict_types=1);

beforeEach(function () {
    if (! file_exists(app_path('Enums'))) {
        mkdir(app_path('Enums'), 0755, true);
    }
    if (! file_exists($this->withoutDocBlockEnumsFolder)) {
        mkdir($this->withoutDocBlockEnumsFolder, 0755, true);
    }
    copy(
        __DIR__ . '/../stubs/StatusWithoutDocBlock.stub',
        $this->withoutDocBlockEnumsFolder . '/StatusWithoutDocBlock.php'
    );
});

afterEach(function () {
    if (file_exists($this->withoutDocBlockEnumsFolder . '/StatusWithoutDocBlock.php')) {
        unlink($this->withoutDocBlockEnumsFolder . '/StatusWithoutDocBlock.php');
    }
    rmdir($this->withoutDocBlockEnumsFolder);
    rmdir(app_path('Enums'));
});

it('can be success single file', function () {
    $this->artisan("enum:annotate --folder={$this->withoutDocBlockEnumsFolder} Datomatic\\\\LaravelEnumHelper\\\\Tests\\\\Support\\\\WithoutDocBlockEnums\\\\StatusWithoutDocBlock")
        ->assertSuccessful();
    $contents = file_get_contents($this->withoutDocBlockEnumsFolder . '/StatusWithoutDocBlock.php');
    $this->assertEquals(1, substr_count($contents, '@method static string pending()'));
    $this->assertEquals(1, substr_count($contents, '@method static string accepted()'));
    $this->assertEquals(1, substr_count($contents, '@method static string discarded()'));
    $this->assertEquals(1, substr_count($contents, '@method static string noResponse()'));
});

it('can be success single file with exists doc block', function () {
    $this->artisan("enum:annotate --folder={$this->enumsFolder} Datomatic\\\\LaravelEnumHelper\\\\Tests\\\\Support\\\\Enums\\\\Status")
        ->assertSuccessful();
    $contents = file_get_contents($this->enumsFolder . '/Status.php');
    $this->assertEquals(1, substr_count($contents, '@method static string pending()'));
    $this->assertEquals(1, substr_count($contents, '@method static string accepted()'));
    $this->assertEquals(1, substr_count($contents, '@method static string discarded()'));
    $this->assertEquals(1, substr_count($contents, '@method static string noResponse()'));
});

it('can be success single file with exists doc block without method tags', function () {
    copy(__DIR__ . '/../stubs/StatusWithoutMethodTagDocBlock.stub', $this->withoutDocBlockEnumsFolder . '/StatusWithoutMethodTagDocBlock.php');
    $this->artisan("enum:annotate --folder={$this->withoutDocBlockEnumsFolder} Datomatic\\\\LaravelEnumHelper\\\\Tests\\\\Support\\\\WithoutDocBlockEnums\\\\StatusWithoutMethodTagDocBlock")
        ->assertSuccessful();
    $contents = file_get_contents($this->withoutDocBlockEnumsFolder . '/StatusWithoutMethodTagDocBlock.php');
    $this->assertEquals(1, substr_count($contents, '@method static string pending()'));
    $this->assertEquals(1, substr_count($contents, '@method static string accepted()'));
    $this->assertEquals(1, substr_count($contents, '@method static string discarded()'));
    $this->assertEquals(1, substr_count($contents, '@method static string noResponse()'));
    unlink($this->withoutDocBlockEnumsFolder . '/StatusWithoutMethodTagDocBlock.php');
});

it('can be success whole folder', function () {
    $this->artisan("enum:annotate --folder={$this->withoutDocBlockEnumsFolder}")
        ->assertSuccessful();
    $contents = file_get_contents($this->withoutDocBlockEnumsFolder . '/StatusWithoutDocBlock.php');
    $this->assertEquals(1, substr_count($contents, '@method static string pending()'));
    $this->assertEquals(1, substr_count($contents, '@method static string accepted()'));
    $this->assertEquals(1, substr_count($contents, '@method static string discarded()'));
    $this->assertEquals(1, substr_count($contents, '@method static string noResponse()'));
});

it('can be failed with class', function () {
    $this->artisan('enum:annotate Datomatic\\\\LaravelEnumHelper\\\\Tests\\\\Support\\\\NotEnums\\\\TestClass')
        ->assertFailed();
});

it('can be failed with without any argument or option with empty app enums folder', function () {
    $this->artisan('enum:annotate')
        ->assertFailed();
});

it('can be failed with empty folder', function () {
    unlink($this->withoutDocBlockEnumsFolder . '/StatusWithoutDocBlock.php');
    $this->artisan("enum:annotate --folder={$this->withoutDocBlockEnumsFolder}")
        ->assertFailed();
});
