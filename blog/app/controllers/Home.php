<?php

/**
 * Example controller.
 * Please remove direct access to
 * application configuration
 * if you want to use this example
 * in production.
 * ($this->get_config())
 */
class Home extends SDF\Controller
{

    private $fdb;

    /**
     * Not necessary to add, but
     * it feels kinda nice to
     * control all variables
     * flowing through
     * controller.
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->fdb = $this->load->library('Fdb', ['posts.fdb']);
        $this->load->helper('io');
    }

    /**
     * Index Page Renderer
     * @return void
     */
    public function index()
    {
        /**
         * $this->fdb->create(time(), [
         * 'title' => 'Welcome to SDF 2',
         * 'author' => 'sdf_core',
         * 'body' => '<h1>Welcome to SDF!</h1> <br> SDF is a powerful, under heavy development framework for php 8!',
         * ]);
         */
        //print_r($this->fdb->read(null, true));
        $pageData = new stdClass();
        $pageData = $this->get_config();
        $pageData['posts'] = $this->fdb->read(null, true);
        $pageData['load'] = $this->load;
        $this->load->view('home', $pageData);
    }

    /**
     * Post Page Renderer
     * @return void
     */
    public function postView($postID)
    {
        $pageData = $this->get_config();
        $pageData['post'] = $this->fdb->read($postID, true) ?? '0000000000';
        $pageData['id'] = $postID ?? '0000000000';
        $pageData['load'] = $this->load;
        $this->load->view('post', $pageData);
    }

    /**
     * Add Post Page Renderer
     * @return void
     */
    public function addPostView()
    {
        $pageData = $this->get_config();
        $pageData['load'] = $this->load;
        $this->load->view('addView', $pageData);
    }

    /**
     * Edit Post Page Renderer
     * @return void
     */
    public function editPostView($postID) {
       if ($this->fdb->read($postID, true) == false) return $this->index();
        $pageData = $this->get_config();
        $pageData['post'] = $this->fdb->read($postID, true);
        $pageData['post']['id'] = $postID;
        $pageData['load'] = $this->load;
        $this->load->view('editView', $pageData);
    }

    /**
     * Handle new post
     * @return void
     */
    public function handlePost()
    {
        if (!isset($_POST)) die('Warning. Forbidden Access...');
        if (!isset($_POST['edit'])) {
            $time = time();
            $this->fdb->create($time, [
                'title' => $_POST['title'],
                'author' => $_POST['author'],
                'body' => $_POST['body']
            ]);
            $this->fdb->saveDbq();
            if (!empty($this->fdb->read($time))) header('Location: /?success');
        } else {
            if ($this->fdb->read($_POST['id'], true) !== false) {
                $this->fdb->update($_POST['id'], [
                    'title' => $_POST['title'],
                    'author' => $_POST['author'],
                    'body' => $_POST['body'],
                ]);
                $this->fdb->saveDbq();
                if (!empty($this->fdb->read($_POST['id']))) header('Location: /?success');
            } else {
                header('Location: /?error');
            }
        }
        header('Location: /?error');
    }
}
