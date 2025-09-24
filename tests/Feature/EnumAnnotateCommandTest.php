<?php

declare(strict_types=1);

use Datomatic\LaravelEnumHelper\Tests\Support\Enums\DoesntUseEnumHelperTrait;

beforeEach(function () {
    if (! file_exists(app_path('Enums'))) {
        mkdir(app_path('Enums'), 0755, true);
    }
    if (! file_exists($this->withoutDocBlockEnumsFolder)) {
        mkdir($this->withoutDocBlockEnumsFolder, 0755, true);
    }
    copy(
        __DIR__.'/../stubs/StatusWithoutDocBlock.stub',
        $this->withoutDocBlockEnumsFolder.'/StatusWithoutDocBlock.php'
    );
    copy(
        __DIR__.'/../stubs/StatusIntWithoutDocBlock.stub',
        $this->withoutDocBlockEnumsFolder.'/StatusIntWithoutDocBlock.php'
    );
    copy(
        __DIR__.'/../stubs/StatusStringWithoutDocBlock.stub',
        $this->withoutDocBlockEnumsFolder.'/StatusStringWithoutDocBlock.php'
    );
    copy(
        __DIR__.'/../stubs/DoesntUseEnumHelperTrait.stub',
        $this->withoutDocBlockEnumsFolder.'/DoesntUseEnumHelperTrait.php'
    );
    copy(
        __DIR__.'/../stubs/StatusWithoutMethodTagDocBlock.stub',
        $this->withoutDocBlockEnumsFolder.'/StatusWithoutMethodTagDocBlock.php'
    );
});

/**
 * @param  \Datomatic\LaravelEnumHelper\Tests\TestCase|\PHPUnit\Framework\TestCase  $this
 */
function unlinkAllPhpFiles(string $folder): void
{
    try {
        unlink($folder.'/DoesntUseEnumHelperTrait.php');
        unlink($folder.'/StatusWithoutDocBlock.php');
        unlink($folder.'/StatusIntWithoutDocBlock.php');
        unlink($folder.'/StatusStringWithoutDocBlock.php');
        unlink($folder.'/StatusWithoutMethodTagDocBlock.php');
    } catch (\Exception) {
    }
}

afterEach(function () {
    unlinkAllPhpFiles($this->withoutDocBlockEnumsFolder);

    rmdir($this->withoutDocBlockEnumsFolder);
    rmdir(app_path('Enums'));
});

it('can be success single file', function () {
    $this->artisan("enum:annotate --folder={$this->withoutDocBlockEnumsFolder} Datomatic\\\\LaravelEnumHelper\\\\Tests\\\\Support\\\\WithoutDocBlockEnums\\\\StatusWithoutDocBlock")
        ->assertSuccessful();
    $contents = file_get_contents($this->withoutDocBlockEnumsFolder.'/StatusWithoutDocBlock.php');
    $this->assertEquals(1, substr_count($contents, '@method static string pending()'));
    $this->assertEquals(1, substr_count($contents, '@method static string accepted()'));
    $this->assertEquals(1, substr_count($contents, '@method static string discarded()'));
    $this->assertEquals(1, substr_count($contents, '@method static string noResponse()'));
});

it('can be success single file int backed enum', function () {
    $this->artisan("enum:annotate --folder={$this->withoutDocBlockEnumsFolder} Datomatic\\\\LaravelEnumHelper\\\\Tests\\\\Support\\\\WithoutDocBlockEnums\\\\StatusIntWithoutDocBlock")
        ->assertSuccessful();
    $contents = file_get_contents($this->withoutDocBlockEnumsFolder.'/StatusIntWithoutDocBlock.php');
    $this->assertEquals(1, substr_count($contents, '@method static int pending()'));
    $this->assertEquals(1, substr_count($contents, '@method static int accepted()'));
    $this->assertEquals(1, substr_count($contents, '@method static int discarded()'));
    $this->assertEquals(1, substr_count($contents, '@method static int noResponse()'));
});

it('can be success single file stribng backed enum', function () {
    $this->artisan("enum:annotate --folder={$this->withoutDocBlockEnumsFolder} Datomatic\\\\LaravelEnumHelper\\\\Tests\\\\Support\\\\WithoutDocBlockEnums\\\\StatusStringWithoutDocBlock")
        ->assertSuccessful();
    $contents = file_get_contents($this->withoutDocBlockEnumsFolder.'/StatusStringWithoutDocBlock.php');
    $this->assertEquals(1, substr_count($contents, '@method static string pending()'));
    $this->assertEquals(1, substr_count($contents, '@method static string accepted()'));
    $this->assertEquals(1, substr_count($contents, '@method static string discarded()'));
    $this->assertEquals(1, substr_count($contents, '@method static string noResponse()'));
});

it('can be success single file with exists doc block', function () {
    $this->artisan("enum:annotate --folder={$this->enumsFolder} Datomatic\\\\LaravelEnumHelper\\\\Tests\\\\Support\\\\Enums\\\\Status")
        ->assertSuccessful();
    $contents = file_get_contents($this->enumsFolder.'/Status.php');
    $this->assertEquals(1, substr_count($contents, '@method static string pending()'));
    $this->assertEquals(1, substr_count($contents, '@method static string accepted()'));
    $this->assertEquals(1, substr_count($contents, '@method static string discarded()'));
    $this->assertEquals(1, substr_count($contents, '@method static string noResponse()'));
});

it('can be success single file with exists doc block without method tags', function () {
    copy(__DIR__.'/../stubs/StatusWithoutMethodTagDocBlock.stub', $this->withoutDocBlockEnumsFolder.'/StatusWithoutMethodTagDocBlock.php');
    $this->artisan("enum:annotate --folder={$this->withoutDocBlockEnumsFolder} Datomatic\\\\LaravelEnumHelper\\\\Tests\\\\Support\\\\WithoutDocBlockEnums\\\\StatusWithoutMethodTagDocBlock")
        ->assertSuccessful();
    $contents = file_get_contents($this->withoutDocBlockEnumsFolder.'/StatusWithoutMethodTagDocBlock.php');
    $this->assertEquals(1, substr_count($contents, '@method static string pending()'));
    $this->assertEquals(1, substr_count($contents, '@method static string accepted()'));
    $this->assertEquals(1, substr_count($contents, '@method static string discarded()'));
    $this->assertEquals(1, substr_count($contents, '@method static string noResponse()'));
    unlink($this->withoutDocBlockEnumsFolder.'/StatusWithoutMethodTagDocBlock.php');
});

it('can be success whole folder', function () {
    $this->artisan("enum:annotate --folder={$this->withoutDocBlockEnumsFolder}")
        ->assertSuccessful();
    $contents = file_get_contents($this->withoutDocBlockEnumsFolder.'/StatusWithoutDocBlock.php');
    $this->assertEquals(1, substr_count($contents, '@method static string pending()'));
    $this->assertEquals(1, substr_count($contents, '@method static string accepted()'));
    $this->assertEquals(1, substr_count($contents, '@method static string discarded()'));
    $this->assertEquals(1, substr_count($contents, '@method static string noResponse()'));
});

it('doesnt annotate enums that don\'t use LaravelEnumTrait', function () {
    $this->artisan('enum:annotate Datomatic\\\\LaravelEnumHelper\\\\Tests\\\\Support\\\\Enums\\\\DoesntUseEnumHelperTrait')
        ->assertSuccessful();
    $e = new ReflectionEnum(DoesntUseEnumHelperTrait::class);
    $this->assertEquals(false, $e->getDocComment());
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
    unlinkAllPhpFiles($this->withoutDocBlockEnumsFolder);
    $this->artisan("enum:annotate --folder={$this->withoutDocBlockEnumsFolder}")->assertFailed();
});
