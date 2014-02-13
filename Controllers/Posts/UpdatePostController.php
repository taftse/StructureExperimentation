<?php namespace Controllers\Posts;

use Controllers\Controller;
use Domain\Posts\PostUpdaterObserver;
use Domain\Posts\PostUpdater;
use Domain\Posts\PostForm;
use ...\...\Redirector;
use ...\...\Request;

class UpdatePostController extends Controller implements PostUpdaterObserver
{
    private $updater;
    private $redirector;
    private $request;
    private $form;

    public function __construct(PostUpdater $updater, PostForm $form, Redirector $redirector, Request $request)
    {
        $this->updater = $updater;
        $this->redirector = $redirector;
        $this->request = $request;
        $this->form = $form;
    }

    public function getUpdate($id)
    {
        $post = $this->posts->requireById($id);
        $this->view('posts.update', compact('post'));
    }

    public function postUpdate($id)
    {
        $post = $this->posts->requireById($id);
        if ( ! $this->form->isValid($this->request->all())) {
            return $this->onPostUpdateFailure($this->form->getErrors());
        }
        return $this->updater->update($this, $post, $this->input->all());
    }

    public function onPostUpdateFailure($errors)
    {
        return $this->redirector->back()->withInput()->withErrors($errors);
    }

    public function onPostUpdateSuccess($post)
    {
        return $this->redirector->route('posts.show', [$post->id])->with('success', 'Your post has been successfuly updated.');
    }
}
