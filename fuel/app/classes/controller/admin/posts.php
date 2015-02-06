<?php

class Controller_Admin_Posts extends Controller_Admin {

    public function action_index() {
        $data['posts'] = Model_Chap::find('all');
        $this->template->title = "CHAP";
        $this->template->content = View::forge('admin/posts/index', $data);
        $config = array(
            'name' => 'bootstrap3', //Khai báo tên bootstrap3 để chúng ta có được các nút bấm bootstrap đẹp hơn mặc định
            'pagination_url' => Uri::base(false) . 'admin/posts/',
            'total_items' => Model_Chap::count(),
            'per_page' => 5, //mỗi trang có 5 item
            'uri_segment' => 5, //hiển thị tối đa 5 trang
            'uri_segment' => 'page',
            'show_first' => true,
            'show_last' => true,
            'first-marker' => "First",
            'last-marker' => "Last",
            'next-marker' => "Next",
            'previous-marker' => "Previous",
        );
        $pagination = Pagination::forge('paginate', $config);
        $data['posts'] = Model_Chap::query()
                ->order_by('created_at', 'DESC')
                ->rows_offset($pagination->offset)
                ->rows_limit($pagination->per_page)
                ->get();
        $data['pagination'] = $pagination;
        $this->template->content = View::forge('admin/posts/index', $data);
    }

    public function action_view($id = null) {
        $data['post'] = Model_Chap::find($id);

        $this->template->title = "CHAP";


        $this->template->content = View::forge('admin/posts/view', $data);
    }

    public function action_create() {
        if (Input::method() == 'POST') {
            $val = Model_Chap::validate('create');

            if ($val->run()) {


                $chapTitle = Input::post('title');
                $chapContent = Input::post('content');
                $storyId = Input::post('story_id');


                $post = new Model_Chap();
                $post->title = $chapTitle;
                $post->content = $chapContent;
                $post->story_id = $storyId;



                if ($post and $post->save()) {
                    Session::set_flash('success', e('Added post #' . $post->id . '.'));

                    Response::redirect('admin/posts');
                } else {
                    Session::set_flash('error', e('Could not save post.'));
                }
            } else {
                Session::set_flash('error', $val->error());
            }
        }

        $this->template->title = "CHAP";
        $this->template->content = View::forge('admin/posts/create');
    }

    public function action_edit($id = null) {
        $post = Model_Chap::find($id);
        $val = Model_Chap::validate('edit');

        if ($val->run()) {
            $post["title"] = Input::post('title');

            $post["content"] = Input::post('content');
            $post["story_id"] = Input::post('story_id');
            if ($post->save()) {
                Session::set_flash('success', e('Updated post #' . $id));

                Response::redirect('admin/posts');
            } else {
                Session::set_flash('error', e('Could not update post #' . $id));
            }
        } else {
            if (Input::method() == 'POST') {
                $post["title"] = $val->validated('title');

                $post["content"] = $val->validated('content');
                $post["story_id"] = $val->validated('story_id');

                Session::set_flash('error', $val->error());
            }

            $this->template->set_global('post', $post, false);
        }

        $this->template->title = "CHAP";
        $this->template->content = View::forge('admin/posts/edit');
    }

    public function action_delete($id = null) {
        if ($post = Model_Chap::find($id)) {
            $post->delete();

            Session::set_flash('success', e('Deleted post #' . $id));
        } else {
            Session::set_flash('error', e('Could not delete post #' . $id));
        }

        Response::redirect('admin/posts');
    }

}
