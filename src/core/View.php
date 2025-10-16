<?php

namespace Core;

use Exception;

/**
 * Class View
 *
 * A simple templating engine for rendering views with support for layouts and sections.
 * @package Core
 * @version 1.0
 * @author Leandro Rocha
 */
class View
{
    protected string $basePath;
    protected ?string $layout = null;
    protected array $sections = [];
    protected ?string $currentSection = null;
    protected array $data = [];

    public function __construct(string $basePath)
    {
        $this->basePath = rtrim($basePath, '/');
    }
    /**
     * Render a view file with optional data.
     *
     * @param string $view
     * @param array $data
     * @return string
     * @throws Exception
     */
    public function render(string $view, array $data = []): string
    {
        $this->data = $data;

        $viewFile = "{$this->basePath}/{$view}.php";
        if (!file_exists($viewFile)) {
            throw new \Exception("View '{$view}' não encontrada.");
        }

        extract($this->escapeData($data));

        ob_start();
        include $viewFile;
        $content = ob_get_clean();

        if ($this->layout) {
            $layoutFile = "{$this->basePath}/{$this->layout}.php";
            if (!file_exists($layoutFile)) {
                throw new \Exception("Layout '{$this->layout}' não encontrado.");
            }

            ob_start();
            include $layoutFile;
            return ob_get_clean();
        }

        return $content;
    }

    /**
     * Set the layout for the view.
     *
     * @param string $layout
     * @return void
     */
    public function extend(string $layout): void
    {
        $this->layout = $layout;
    }

    /**
     * Start a new section for content injection.
     *
     * @param string $section
     * @return void
     */
    public function startSection(string $section): void
    {
        ob_start();
        $this->currentSection = $section;
    }

    /**
     * End the current section and store its content.
     *
     * @return void
     */
    public function endSection(): void
    {
        $this->sections[$this->currentSection] = ob_get_clean();
    }

    /**
     * Render a section defined in the view.
     *
     * @param string $section
     * @return void
     */
    public function section(string $section): void
    {
        echo $this->sections[$section] ?? '';
    }

    /**
     * Include a partial view (e.g., header, footer).
     *
     * @param string $partial
     * @param array $data
     * @return void
     */
    public function include(string $partial, array $data = []): void
    {
        extract($this->escapeData($data));
        include "{$this->basePath}/partials/{$partial}.php";
    }

    /**
     * Escape data to prevent XSS attacks.
     *
     * @param array $data
     * @return array
     */
    protected function escapeData(array $data): array
    {
        return array_map(function ($value) {
            return is_string($value)
                ? htmlspecialchars($value, ENT_QUOTES, 'UTF-8')
                : $value;
        }, $data);
    }
}
