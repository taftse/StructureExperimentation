<?php namespace Controllers\Posts;

use Controllers\Controller;
use Domain\Posts\PostUpdaterResponder;
use Domain\Posts\PostUpdater;
use Domain\Posts\PostForm;
use Domain\Posts\Post;
use ...\...\Redirector;
use ...\...\Request;

class UpdatePostController extends Controller implements PostUpdaterResponder
{
    private $updater;
    private $redirector;
    private $request;
    private $form;

    public function __construct(PostUpdater $updater, PostForm $form, Redirector $redirector, Request $request)
    {
        $this->updater = $updater;
        $this->form = $form;
        $this->redirector = $redirector;
        $this->request = $request;
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
        return $this->updater->respondsWith($this)->update($post, $this->input->all());
    }

    public function onPostUpdateFailure($errors)
    {
        return $this->redirector->back()->withInput()->withErrors($errors);
    }

    public function onPostUpdateSuccess(Post $post)
    {
        return $this->redirector->route('posts.show', [$post->id])->with('success', 'Your post has been successfuly updated.');
    }
}
