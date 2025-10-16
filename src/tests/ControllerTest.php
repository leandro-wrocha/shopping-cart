<?php

use PHPUnit\Framework\TestCase;
use Core\Controller;
use Core\View;

class TestController extends Controller
{
    // Expose protected method for testing via public wrapper
    public function renderPublic(string $view, array $data = []): void
    {
        $this->render($view, $data);
    }

    // Allow injection of a mock view for testing
    public function setView(View $view): void
    {
        $this->view = $view;
    }
}

class ControllerTest extends TestCase
{
    public function testRenderEchoesViewOutput()
    {
        // Cria um mock de View que retorna um conteúdo específico
        $mockView = $this->createMock(View::class);
        $mockView->method('render')
            ->willReturn('conteudo-renderizado');

        $controller = new TestController();
        $controller->setView($mockView);

        // Capture a saída
        ob_start();
        $controller->renderPublic('any', ['foo' => 'bar']);
        $output = ob_get_clean();

        $this->assertEquals('conteudo-renderizado', $output);
    }
}
