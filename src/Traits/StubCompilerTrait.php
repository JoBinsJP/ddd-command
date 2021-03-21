<?php

namespace Aammui\DDD\Traits;

trait StubCompilerTrait
{
    /**
     * Create the directories for the files.
     *
     * @return void
     */
    protected function ensureDirectoriesExist($directory)
    {
        if ( !is_dir($directory) ) {
            mkdir($directory, 0755, true);
        }
    }

    public function ensureFileExist($file)
    {
        if ( !file_exists($file) ) {
            $file = fopen($file, "w");
            fclose($file);
        }
    }


    /**
     * Export the authentication backend.
     *
     * @return void
     */
    protected function exportBackend($namespace, $class, $stubPath)
    {
        $directory = lcfirst(str_replace('\\', '/', $namespace));
        $file      = base_path($directory.'/'.$class.'.php');
        $this->ensureDirectoriesExist($directory);
        $this->ensureFileExist($file);

        $data = $this->compileStub($namespace, $class, $stubPath);
        file_put_contents($file, $data);
    }

    /**
     *
     * @return string
     */
    protected function compileStub($namespace, $class, $stubPath)
    {
        $data = str_replace('{{namespace}}', $namespace, file_get_contents($stubPath));

        return str_replace('{{class}}', $class, $data);
    }
}
