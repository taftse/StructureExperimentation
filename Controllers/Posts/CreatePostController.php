<?php namespace Controllers\Posts;

use Controllers\Controller;
use Domain\Posts\PostCreatorObserver;
use Domain\Posts\PostCreator;
use Domain\Posts\PostForm;
use Domain\Posts\Post;
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
        $this->redirector = $redirector;
        $this->request = $request;
        $this->form = $form;

        $creator->setObserver($this);
        $this->creator = $creator;
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

    public function onPostCreateSuccess(Post $post)
    {
        return $this->redirector->route('posts.show', [$post->id])->with('success', 'Your post has been successfuly created.');
    }
}
