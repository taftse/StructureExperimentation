<?php namespace Controllers\Posts;

use Controllers\Controller;
use Domain\Posts\PostCreatorObserver;
use Domain\Posts\PostCreator;
use Domain\Posts\PostForm;
use ...\...\Redirector;
use ...\...\Request;

class CreatePostController extends Controller implements PostCreatorObserver
{
    private $creator;
    private $redirector;
    private $request;
    private $form;

    public function __construct(PostCreator $creator, PostForm $form, Redirector $redirector, Request $request)
    {
        $this->creator = $creator->setObserver($this);
        $this->redirector = $redirector;
        $this->request = $request;
        $this->form = $form;
    }

    public function getCreate()
    {
        $this->view('posts.create');
    }

    public function postCreate()
    {
        if ( ! $this->form->isValid($this->request->all())) {
            return $this->onPostCreateFailure($this->form->getErrors());
        }
        return $this->creator->create($this->input->all());
    }

    public function onPostCreateFailure($errors)
    {
        return $this->redirector->back()->withInput()->withErrors($errors);
    }

    public function onPostCreateSuccess($post)
    {
        return $this->redirector->route('posts.show', [$post->id])->with('success', 'Your post has been successfuly created.');
    }
}
