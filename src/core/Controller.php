<?php

namespace Core;

/**
 * Class Controller
 *
 * Base controller class to be extended by application controllers.
 * Provides methods for rendering views and managing data.
 * @package Core
 * @version 1.0
 * @author Leandro Rocha
 */
class Controller {
    protected View $view;
    protected array $data;

    public function __construct() {
        $this->view = new View(__DIR__ . '/../app/views');
        $this->data = [];
    }

    /**
     * Render a view with the provided data.
     * 
     * @param string $view The view file name (without .php extension).
     * @param array $data An associative array of data to be passed to the view.
     * @return void
     */
    protected function render(string $view, array $data = []): void {
        $this->data = array_merge($this->data, $data);
        extract($this->data);

        echo $this->view->render($view, $this->data);
    }
}
