<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Docs extends CI_Controller
{
    private $docsPath;

    public function __construct()
    {
        parent::__construct();
        $this->docsPath = FCPATH.'docs/';
        $this->router->pageName = 'Документация';
    }

    public function index($slug = 'README')
    {
        $file = $this->normalizeSlug($slug);
        if (!file_exists($file)) {
            show_404();
            return;
        }

        $markdown = file_get_contents($file);
        $this->load->library('markdown');
        $html = $this->markdown->parse($markdown);
        $title = $this->makeTitle($slug);
        $this->load->view('header', [
            'noAuth' => true,
            'pageTitle' => $title,
            'bodyClass' => 'docs-page'
        ]);
        $this->load->view('docs/view', [
            'content' => $html,
//            'title' => $title
        ]);
        $this->load->view('footer');
    }

    private function normalizeSlug($slug)
    {
        $slug = trim($slug);
        $slug = preg_replace('/[^a-zA-Z0-9_-]/', '', $slug);
        if ($slug === '') {
            return $this->docsPath.'README.md';
        }

        if (strcasecmp($slug, 'README') === 0) {
            return $this->docsPath.'README.md';
        }

        $slug = strtolower($slug);
        return $this->docsPath.$slug.'.md';
    }

    private function makeTitle($slug)
    {
        if ($slug === 'README' || $slug === '' || strcasecmp($slug, 'README') === 0) {
            return '';
            return 'Документация';
        }
        return ucwords(str_replace(['-', '_'], ' ', strtolower($slug)));
    }
}
