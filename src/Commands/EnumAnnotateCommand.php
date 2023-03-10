<?php

declare(strict_types=1);

namespace Datomatic\LaravelEnumHelper\Commands;

use Composer\ClassMapGenerator\ClassMapGenerator;
use Illuminate\Console\Command;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Filesystem\Filesystem;
use Jawira\CaseConverter\Convert;
use Laminas\Code\Generator\DocBlock\Tag\MethodTag;
use Laminas\Code\Generator\DocBlock\Tag\TagInterface;
use Laminas\Code\Generator\DocBlockGenerator;
use Laminas\Code\Reflection\DocBlockReflection;
use ReflectionClass;
use ReflectionException;
use UnitEnum;

class EnumAnnotateCommand extends Command
{
    protected $signature = 'enum:annotate
                            {class?}
                            {--folder=}';

    protected $description = 'Generate DocBlock annotations for enum classes';

    protected Filesystem $filesystem;

    /**
     * @throws ReflectionException|FileNotFoundException
     */
    public function handle(Filesystem $filesystem): int
    {
        $this->filesystem = $filesystem;

        $class = $this->argument('class');
        if (is_string($class)) {
            return$this->annotateClass($class);
        }

        return $this->annotateFolder();
    }

    /**
     * @throws ReflectionException|FileNotFoundException
     */
    protected function annotateFolder(): int
    {
        $searchDirectory = $this->searchDirectory();
        $searchDirectoryMap = ClassMapGenerator::createMap($searchDirectory);

        if (count($searchDirectoryMap) > 0) {
            foreach ($searchDirectoryMap as $class => $_) {
                $reflection = new ReflectionClass($class);

                if ($reflection->isSubclassOf(UnitEnum::class)) {
                    $this->annotate($reflection);
                }
            }

            return self::SUCCESS;
        }

        $this->warn("Please create enum within '{$searchDirectory}'");

        return self::FAILURE;
    }

    /**
     * @throws ReflectionException|FileNotFoundException
     */
    protected function annotateClass(string $className): int
    {
        if (! is_subclass_of($className, UnitEnum::class)) {
            $parentClass = UnitEnum::class;
            $this->error("The given class {$className} must be an instance of {$parentClass}.");

            return self::FAILURE;
        }

        $reflection = new ReflectionClass($className);
        $this->annotate($reflection);

        return self::SUCCESS;
    }

    /**
     * @param  ReflectionClass<UnitEnum>  $reflectionClass
     * @throws FileNotFoundException
     */
    protected function annotate(ReflectionClass $reflectionClass): void
    {
        $docBlock = new DocBlockGenerator;

        if ($reflectionClass->getDocComment()) {
            $docBlock->setShortDescription(
                DocBlockGenerator::fromReflection(new DocBlockReflection($reflectionClass))
                    ->getShortDescription()
            );
        }

        $this->updateClassDocblock($reflectionClass, $this->getDocBlock($reflectionClass));
    }

    /**
     * @throws FileNotFoundException
     */
    protected function updateClassDocblock(ReflectionClass $reflectionClass, DocBlockGenerator $docBlock): void
    {
        $shortName = $reflectionClass->getShortName();
        $fileName = (string) $reflectionClass->getFileName();
        $contents = $this->filesystem->get($fileName);

        $enumDeclaration = "enum {$shortName}";

        // Remove existing docblock
        $quotedClassDeclaration = preg_quote($enumDeclaration);
        $contents = preg_replace(
            "#\\r?\\n?/\*[\s\S]*?\*/(\\r?\\n)?{$quotedClassDeclaration}#ms",
            "\$1{$enumDeclaration}",
            $contents
        );
        if ($contents) {
            $enumDeclarationPos = strpos($contents, $enumDeclaration);
            if (! is_bool($enumDeclarationPos)) {
                // Make sure we don't replace too much
                $contents = substr_replace(
                    $contents,
                    "{$docBlock->generate()}{$enumDeclaration}",
                    $enumDeclarationPos,
                    strlen($enumDeclaration)
                );
            }

            $this->filesystem->put($fileName, $contents);
            $this->info("Wrote new phpDocBlock to {$fileName}.");
        }
    }

    protected function getDocBlock(ReflectionClass $reflectionClass): DocBlockGenerator
    {
        $docBlock = (new DocBlockGenerator)
            ->setWordWrap(false);

        $originalDocBlock = null;

        if ($reflectionClass->getDocComment()) {
            $originalDocBlock = DocBlockGenerator::fromReflection(
                new DocBlockReflection(ltrim($reflectionClass->getDocComment()))
            );

            if ($originalDocBlock->getShortDescription()) {
                $docBlock->setShortDescription($originalDocBlock->getShortDescription());
            }

            if ($originalDocBlock->getLongDescription()) {
                $docBlock->setLongDescription($originalDocBlock->getLongDescription());
            }
        }

        $docBlock->setTags($this->getDocblockTags(
            $originalDocBlock,
            $reflectionClass
        ));

        return $docBlock;
    }

    /**
     * @return array<TagInterface>
     */
    protected function getDocblockTags(
        DocBlockGenerator|null $originalDocblock,
        ReflectionClass $reflectionClass
    ): array {
        $constants = $reflectionClass->getConstants();
        $constantKeys = array_keys($constants);

        $tags = array_map(
            static fn (mixed $value, string $constantName): MethodTag => new MethodTag(
                (new Convert($constantName))->toCamel(),
                ['string'],
                null,
                true
            ),
            $constants,
            $constantKeys,
        );

        if ($originalDocblock) {
            $tags = array_merge(
                $tags,
                array_filter($originalDocblock->getTags(), function (TagInterface $tag) use ($constantKeys): bool {
                    return ! $tag instanceof MethodTag
                        || ! in_array(
                            (new Convert((string) $tag->getMethodName()))->toCamel(),
                            array_map(fn ($constantName) => (new Convert($constantName))->toCamel(), $constantKeys),
                            true
                        );
                })
            );
        }

        return $tags;
    }

    protected function searchDirectory(): string
    {
        $folder = $this->option('folder');
        if (is_string($folder)) {
            return $folder;
        }

        return app_path('Enums');
    }
}
