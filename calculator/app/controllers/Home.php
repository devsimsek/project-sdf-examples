<?php

class Home extends \SDF\Controller
{

    public function __construct()
    {
        error_log('Home Controller Initialized.');
        parent::__construct();
    }

    public function homeRenderer()
    {
        $pageData = new stdClass();
        $pageData->app_title = $this->get_config('app_title') . ' | Home';
        $this->load->view('homeView', $pageData);
        return;
    }

    public function calculateRenderer()
    {
        if (!isset($_POST['equation'])) {
            $this->homeRenderer();
            return;
        }
        $pageData = new stdClass();
        $pageData->app_title = $this->get_config('app_title') . ' | Calculation Result';
        $pageData->result = $this->str_to_math($_POST['equation']) ?? 'no_input_specified';
        $this->load->view('homeView', $pageData);
        return;
    }

    private function str_to_math(string $string)
    {
        if (preg_match('/(\d+)(?:\s*)([\+\-\*\/])(?:\s*)(\d+)/', $string, $matches) !== FALSE) {
            if (!empty($matches[2])) {
            $operator = $matches[2];
            switch ($operator) {
                case '+':
                    $p = $matches[1] + $matches[3];
                    break;
                case '-':
                    $p = $matches[1] - $matches[3];
                    break;
                case '*':
                    $p = $matches[1] * $matches[3];
                    break;
                case '/':
                    $p = $matches[1] / $matches[3];
                    break;
                default:
                    $p = 'syntax_error';
                    break;
            }
            return $p;
            }
            return 'syntax_error';
        }
    }

}
