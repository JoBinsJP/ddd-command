<?php

namespace Jobins\DDDCommand\Traits;

/**
 * Trait StubCompilerTrait
 * @package Jobins\DDDCommand\Traits
 */
trait StubCompilerTrait
{
    /**
     * @param string $file
     */
    public function ensureFileExist($file)
    {
        if ( !file_exists($file) ) {
            $file = fopen($file, "w");
            fclose($file);
        }
    }

    /**
     * Create the directories for the files.
     *
     * @param string $directory
     *
     * @return void
     */
    protected function ensureDirectoriesExist($directory)
    {
        if ( !is_dir($directory) ) {
            mkdir($directory, 0755, true);
        }
    }

    /**
     * Export the authentication backend.
     *
     * @param string $namespace
     * @param string $class
     * @param string $stubPath
     *
     * @return void
     */
    protected function exportBackend(string $namespace, string $class, string $stubPath)
    {
        $directory = lcfirst(str_replace('\\', '/', $namespace));
        $file      = base_path("{$directory}/{$class}.php");
        $this->ensureDirectoriesExist($directory);
        $this->ensureFileExist($file);

        $data = $this->compileStub($namespace, $class, $stubPath);
        file_put_contents($file, $data);
    }

    /**
     *
     * @param string $namespace
     * @param string $class
     * @param string $stubPath
     *
     * @return string
     */
    protected function compileStub(string $namespace, string $class, string $stubPath): string
    {
        $data = str_replace('{{namespace}}', $namespace, file_get_contents($stubPath));

        return str_replace('{{class}}', $class, $data);
    }
}
