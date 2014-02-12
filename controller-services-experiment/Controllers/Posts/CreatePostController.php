<?php namespace Controllers\Posts;

use Controllers\Controller;
use Domain\Posts\PostForm;
use Domain\Posts\PostCreator;
use ...\...\Redirector;
use ...\...\Request;

class CreatePostController extends Controller implements CreationObserver
{
    private $creator;
    private $redirector;
    private $request;
    private $form;

    public function __construct(PostCreator $creator, PostForm $form, Redirector $redirector, Request $request)
    {
        $this->creator = $creator;
        $this->redirector = $redirector;
        $this->request = $request;
        $this->form = $form;
    }

    public function getCreate()
    {
        $this->view('post.create');
    }

    public function postCreate()
    {
        if ( ! $this->form->isValid($request->all())) {
            return $this->onFailure($this->form->getErrors());
        }
        return $this->creator->create($this, $this->input->all());
    }

    public function onFailure($errors)
    {
        return $this->redirector->back()->withInput()->withErrors($errors);
    }

    public function onSuccess($post)
    {
        return $this->redirector->route('posts.show', [$post->id])->with('success', 'Your post has been successfuly created.');
    }
}
