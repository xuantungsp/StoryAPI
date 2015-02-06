<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Controller_Admin_Story extends Controller_Admin {

    //list posts
    function action_index() {
        $data['story'] = Model_Story::find('all');
        $this->template->title = "STORY";
        //$this->template->content = View::forge('admin/story/index', $data);

        $config = array(
            'name' => 'bootstrap3', //Khai báo tên bootstrap3 để chúng ta có được các nút bấm bootstrap đẹp hơn mặc định
            'pagination_url' => Uri::base(false) . 'admin/story/',
            'total_items' => Model_Story::count(),
            'per_page' => 1, //mỗi trang có 5 item
            'uri_segment' => 2, //hiển thị tối đa 5 trang
            'uri_segment' => 'page',
            'show_first' => true,
            'show_last' => true,
            'first-marker' => "First",
            'last-marker' => "Last",
            'next-marker' => "Next",
            'previous-marker' => "Previous",
        );
        $pagination = Pagination::forge('paginate', $config);
        $data['story'] = Model_Story::query()
                ->order_by('created_at', 'DESC')
                ->rows_offset($pagination->offset)
                ->rows_limit($pagination->per_page)
                ->get();
        $data['pagination'] = $pagination;
        
        
        $this->template->content = View::forge('admin/story/index', $data);
    }

    //Create new post
    public function action_create() {
        $view = View::forge('admin/story/create');
        if (Input::method() == 'POST') {
            $val = Model_Story::validate('create');
            if ($val->run()) {
                $is_upload = false;
                $files = array();
                // Custom configuration for this upload
                $config = array(
                    'path' => DOCROOT . 'files', // đây là đường dẫn chứa những file upload
                    'randomize' => true,
                    'ext_whitelist' => array('img', 'jpg', 'jpeg', 'gif', 'png'), // đây là nhũng dạng file hình ảnh bạn muốn up, nếu khác sẽ không thể upload file lên đc
                    'max_size' => 1002400
                );
                // process the uploaded files in $_FILES
                Upload::process($config);

                if (Upload::is_valid()) { //Nếu file upload là hợp lệ
                    $is_upload = true;
                    Upload::save(); //Lưu file hình
                    $files = Upload::get_files(); //lấy thông tin file đã lưu bao gồm tên file lưu được ...
                }

                if (!empty($files)) {
                    $file_name = $files[0]['saved_as'];
                } else {
                    $file_name = '';
                }
                
                  $storyTitle = Input::post('title');

                $post = new Model_Story();
                $post->title = $storyTitle;
                $post->image = $file_name;
               $post->number_view = 0;
                

                if ($is_upload) { //nếu upload thành công thì sẽ lưu thông tin dữ liệu xuống database
                    if ($post and $post->save()) {
                        Session::set_flash('success', e('Added post #' . $post->id . '.'));

                        Response::redirect('admin/story');
                    } else {
                        Session::set_flash('error', e('Could not save post.'));
                    }
                } else {
                    Session::set_flash('error', e('Upload file failed'));
                }
            } else {
                Session::set_flash('error', $val->error());
            }
        }

        $this->template->title = "Thêm Story";
        $this->template->content = $view;
    }

    //sửa 1 bài post
    public function action_edit($id = null) {
        $view = View::forge('admin/story/edit');
        $post = Model_Story::find($id);
        $file_name_old = $post["image"];
        $val = Model_Story::validate('edit');

        if ($val->run()) {
            $is_upload = false;
            $files = array();
            // Custom configuration for this upload
            $config = array(
                'path' => DOCROOT . 'files', // đây là đường dẫn chứa những file upload
                'randomize' => true,
                'ext_whitelist' => array('img', 'jpg', 'jpeg', 'gif', 'png'), // đây là nhũng dạng file hình ảnh bạn muốn up, nếu khác sẽ không thể upload file lên đc
            );
           
            // process the uploaded files in $_FILES
            if (Upload::is_valid()) {
                $is_upload = true;
                Upload::save(); //Lưu file hình
                $files = Upload::get_files(); //lấy thông tin file đã lưu bao gồm tên file lưu được ...
            } else {
                Session::set_flash('error', e("Error for upload file"));
            }

            $post["title"] = Input::post('title');
//            $post->body = Input::post('body');

            if (!empty($files)) {
                $post["image"] = $files[0]['saved_as'];
            } else {
                $post["image"] = $file_name_old;
            }

            if ($post->save()) {
                //Neu có upload file thì mới xóa không thì giữ nguyên file hình cũ
                if (!empty($files)) {
                    //xóa file hình cũ đang tồn tại sau khi save thông tin xong
                    $exists = File::exists(DOCROOT . 'files/' . $file_name_old);
                    if ($exists) {
                        File::delete(DOCROOT . 'files/' . $file_name_old);
                    }
                }
                Session::set_flash('success', e('Updated post #' . $id));

                Response::redirect('admin/story');
            } else {
                Session::set_flash('error', e('Could not update post #' . $id));
            }
        } else {
            if (Input::method() == 'POST') {
                $post["title"] = $val->validated('title');
//                        $post->body = $val->validated('body');

                Session::set_flash('story', $val->error());
            }

            $this->template->set_global('story', $post, false);
        }

        $this->template->title = "Sửa Story";
        $this->template->content = $view;
    }

    //delete a post
    public function action_delete($id = null) {
        if ($post = Model_Story::find($id)) {
            $post->delete();
            Session::set_flash('success', e('Deleted post #' . $id));
        } else {
            Session::set_flash('error', e('Could not delete post #' . $id));
        }
        Response::redirect('admin/story');
    }

}
