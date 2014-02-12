<?php namespace Controllers\Posts;

use Controllers\Controller;
use Domain\Posts\PostRepository;
use Domain\Posts\PostForm;
use Domain\Posts\PostCreatorObserver;

class CreatePostController extends Controller implements PostCreatorObserver
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
            return $this->onPostCreationFailure($this->form->getErrors());
        }
        return $this->creator->create($this, $this->input->all());
    }

    public function onPostCreationFailure($errors)
    {
        return $this->redirector->back()->withInput()->withErrors($errors);
    }

    public function onPostCreationSuccess($post)
    {
        return $this->redirector->route('posts.show', [$post->id])->with('success', 'Your post has been successfuly created.');
    }
}