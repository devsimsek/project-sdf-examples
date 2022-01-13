<?php
/**
 * Copyright (C)devsimsek.
 * Flat database library.
 * version 1.0 unstable.
 * Warning: Do not use in production.
 * This file could have potential security risks.
 * So don't use in production.
 */

class Fdb extends SDF\Library
{


    // Example configuration
    public array $config = [];

    // Temporary database filename
    private string $databaseFile;

    // Temporary data. Holds new updates on database.
    private mixed $tempQuery;

    // is fdb initialized?
    private bool $fdbInit = false;

    // Construct
    public function __construct(string $databaseFile, array $configuration = null)
    {
        if (!empty($configuration)) $this->config = $configuration;
        if (file_exists($databaseFile)) {
            $this->databaseFile = $databaseFile;
            $this->fdbInit = true;
            self::openDbf(); // idk why but if you use $this->openDbf it does not opens. Use static calling.
            error_log('FDB: FDB successfully initialized. Version v1.0');
        } else {
            $this->fdbInit = false;
            error_log('FDB: Error. Database file does not exists');
        }
    }

    /**
     * Open Database
     * @return bool
     */
    private function openDbf(): bool
    {
        if ($this->fdbInit) {
            $read = file_get_contents($this->databaseFile);
            if (!empty($read)) {
                error_log('FDB_IO: Database file found! Decoding database...');
                $this->tempQuery = $read;
                $this->tempQuery = $this->parseQuery();
                return true;
            }
            error_log('FDB_IO: Error, Database is empty.');
        }
        return false;
    }

    /**
     * Parse Database
     * @param int $mode
     * @return string|array|false
     */
    private function parseQuery(int $mode = 0): string|array|false
    {
        if (!$this->fdbInit) return false;
        switch ($mode) {
            case 0:
                $return = json_decode($this->tempQuery, true);
                break;
            case 1:
                $return = json_encode($this->tempQuery);
                break;
        }
        if (empty($return)) return false;
        return $return;
    }

    /**
     * Save Database
     * @return bool
     */
    public function saveDbq(): bool
    {
        if (!$this->fdbInit) return false;
        if (!empty($this->tempQuery)) {
            $encode = self::parseQuery(1);
            if (!$encode) return false;
            return file_put_contents($this->databaseFile, $encode);
        }
        return false;
    }

    /**
     * Create
     * @return bool
     * @var mixed $value
     * @var mixed $key
     */
    public function create($key, $value = null): bool
    {
        if (!$this->fdbInit) return false;
        $this->tempQuery[$key] = $value;
        return array_key_exists($key, $this->tempQuery);
    }

    /**
     * Read
     * @param mixed|null $key
     * @param bool $json
     * @return mixed|false
     */
    public function read(mixed $key = null, bool $json = false): mixed
    {
        if (!$this->fdbInit) return false;
        if (!empty($key)) if (array_key_exists($key, $this->tempQuery)) return $this->tempQuery[$key];
        if ($json) {
            if (!empty($this->tempQuery)) return $this->tempQuery;
            return false;
        }
        if (empty($key) and !empty($this->tempQuery)) return self::parseQuery(1);
        return false;
    }

    /**
     * Update
     * @return bool
     * @var mixed $value
     * @var mixed $key
     */
    public function update($key, $value): bool
    {
        if (!$this->fdbInit) return false;
        if (array_key_exists($key, $this->tempQuery)) {
            $this->tempQuery[$key] = $value;
            return array_key_exists($key, $this->tempQuery);
        }
        return false;
    }

    /**
     * Delete
     * @return bool
     * @var mixed $key
     */
    public function delete($key): bool
    {
        if (!$this->fdbInit) return false;
        if (array_key_exists($key, $this->tempQuery)) {
            unset($this->tempQuery[$key]);
            return array_key_exists($key, $this->tempQuery);
        }
        return false;
    }

}
